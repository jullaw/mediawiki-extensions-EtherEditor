/**
 * Library to create a remote editor (particularly an instance of the modified etherpad editor pad-mediawiki)
 *
 * dependencies: mediawiki.uri
 *
 * @author Mark Holmquist
 * @license GPLv2+
 *
 */

( function( $, mw ) {

	/**
	 * Creates a new remote editor object
	 *
	 * @param {HTMLTextAreaElement} (can be jQuery-wrapped)
	 */
	function remoteEditor( textarea ) {
		if ( typeof textarea === 'undefined' ) {
			throw new Error( "need a textarea as argument to remoteEditor" );
		}

		var _this = this;
		_this.$textarea = $( textarea );
		_this.userName = mw.config.get( 'wgUserName' );
		_this.hostname = _this.getHostName();
		_this.baseUrl = mw.config.get( 'wgEtherEditorPadUrl' );
		_this.padId = mw.config.get( 'wgEtherEditorPadName' );
		_this.dbId = mw.config.get( 'wgEtherEditorDbId' );
		_this.sessionId = mw.config.get( 'wgEtherEditorSessionId' );
		if ( !_this.padId || !_this.sessionId ) {
			return false; // there was an error, clearly, so let's quit
		}

		this.hasSubmitted = false;

		$( 'input[type="submit"]' ).click( function ( e ) {
			if ( ! _this.hasSubmitted ) {
				e.preventDefault();
				e.stopPropagation();
				_this.hasSubmitted = true;
				var __this = this;
				$.ajax( {
					url: mw.util.wikiScript( 'api' ),
					method: 'GET',
					data: { format: 'json', action: 'GetEtherPadText', padId: _this.dbId },
					success: function( data ) {
						_this.$textarea.html( data.GetEtherPadText.text );
						$( __this ).click();
						return 0;
					},
					dataType: 'json'
				} );
				return 0;
			}
		} );

		_this.$textarea.after( $( '<input type="hidden" name="enableether" value="true" />' ) );

		_this.initializeControls();
		_this.initializePad();
		_this.initializePadList();
		_this.initializeContribs();

		$( '#wikiEditor-ui-toolbar' ).add( '#toolbar' ).hide();
	};

	remoteEditor.prototype = {
		/**
		 * Get the hostname for the Etherpad Lite instance
		 */
		getHostName: function () {
			var hostname = mw.config.get( 'wgEtherEditorApiHost' );
			if ( hostname ) {
				hostname += ':' + ( mw.config.get( 'wgEtherEditorApiPort' ) || '9001' );
			} else {
				hostname = 'localhost:9001';
			}
			return hostname;
		},
		/**
		 * Authenticate the current user to the current pad.
		 *
		 * @param function cb the callback for after the authentication is done
		 */
		authenticateUser: function ( cb ) {
			var _this = this;
			$.ajax( {
				url: mw.util.wikiScript( 'api' ),
				method: 'GET',
				data: { format: 'json', action: 'EtherPadAuth', padId: _this.dbId },
				success: function( data ) {
					_this.sessionId = data.EtherPadAuth.sessionId;
					cb();
					return 0;
				},
				dataType: 'json'
			} );
		},
		/**
		 * Add the list of contributors to the edit summary field
		 */
		populateSummary: function () {
			var _this = this;
			var contribs = _this.contribs;
			var $smry = $( '#wpSummary' );
			var contribstr = '';
			var cx = 0;
			while ( 1 ) {
				var contrib = contribs[cx];
				contribstr += contrib.username;
				if ( ++cx < contribs.length ) {
					contribstr += ', ';
				} else {
					break;
				}
			}
			var oldsmry = $smry.val();
			oldsmry = oldsmry.replace(/%% .* %%/, '');
			$smry.val( '%% Contributors in EtherEditor: ' + contribstr + ' %%' + oldsmry );
		},
		/**
		 * Adds some controls to the form specific to the extension.
		*/
		initializeControls: function () {
			var _this = this;
			var $ctrls = $( '<div></div>' );
			$ctrls.attr( 'id', 'ethereditor-ctrls' );
			_this.$textarea.before( $ctrls );

			_this.initializeAdminControls();
		},
		/**
		 * Adds the delete pad button and the kick field.
		 */
		initializeAdminControls: function () {
			var _this = this;
			var $actls = $( '<div></div>' );
			$actls.attr( 'id', 'ethereditor-admin-ctrls' );
			var $delbtn = $( '<button></button>' );
			$delbtn.attr( 'id', 'ethereditor-delete-button' );
			$delbtn.html( mw.msg( 'ethereditor-delete-button' ) );
			$delbtn.click( function () {
				_this.deletePad();
				return false;
			} );
			$actls.append( $delbtn );
			_this.$textarea.before( $actls );
			_this.addKickField();
		},
		/**
		 * Initializes an automatic process of constantly checking for, and
		 * adding, new contributors.
		 */
		initializeContribs: function (oldthis) {
			var _this = this;
			var oldDbId = _this.dbId;
			$.ajax( {
				url: mw.util.wikiScript( 'api' ),
				method: 'GET',
				data: { format: 'json', action: 'GetContribs', padId: _this.dbId },
				success: function( data ) {
					if ( oldDbId == _this.dbId ) {
						_this.contribs = data.GetContribs.contribs;
						_this.populateSummary();
						setTimeout( function () { _this.initializeContribs() }, 5000 );
					} else {
						_this.initializeContribs();
					}
					return 0;
				},
				dataType: 'json'
			} );
		},
		/**
		 * Adds a field and button for kicking users from the pad
		 * Only available if you're an admin (and the backend checks it)
		 */
		addKickField: function () {
			var _this = this;
			var $actrls = $( '#ethereditor-admin-ctrls' );
			var $kickbtn = $( '#ethereditor-kickbtn', $actrls );
			if ( $kickbtn.length == 0 ) {
				_this.$kickfield = $( '<input type="text" id="ethereditor-kickfield" />' );
				$kickbtn = $( '<button></button>' );
				$kickbtn.attr( 'id', 'ethereditor-kickbtn' );
				$kickbtn.html( mw.msg( 'ethereditor-kick-button' ) );
				$kickbtn.click( function () {
					var uname = _this.$kickfield.val();
					$.ajax( {
						url: mw.util.wikiScript( 'api' ),
						method: 'GET',
						data: {
							format: 'json', action: 'KickFromPad',
							padId: _this.dbId, user: uname
						},
						success: function( data ) {
							_this.$kickfield.val( '' );
							return 0;
						},
						dataType: 'json'
					} );
					return false;
				} );
				$actrls.append( _this.$kickfield );
				$actrls.append( $kickbtn );
			}
		},
		/**
		 * Adds a list of other pads to the page, so you can have multiple.
		*/
		initializePadList: function () {
			var _this = this;
			var $padlistdiv = $( '<div></div>' );
			var pads = mw.config.get( 'wgEtherEditorOtherPads' );
			if ( pads && pads.length ) {
				_this.$select = $( '<select></select>' ).attr( 'id', 'ethereditor-select-pad' );
				pads.unshift( { pad_id: _this.dbId, ep_pad_id: _this.padId, admin_user: ( this.isAdmin ? mw.user.name() : '' ) } );
				for ( var px in pads ) {
					var pad = pads[px];
					var $option = $( '<option></option>' );
					$option.html( pad.ep_pad_id.substr( 19 ) );
					$option.val( pad.pad_id );
					$option.data( 'admin', pad.admin_user );
					$option.data( 'ep_pad_id', pad.ep_pad_id );
					_this.$select.append( $option );
				}
				_this.$select.change( function () {
					var $selopt = $( 'option:selected', $( this ) );
					_this.padId = $selopt.data( 'ep_pad_id' );
					_this.dbId = $selopt.val();
					_this.isAdmin = mw.user.name() == $selopt.data( 'admin' );
					_this.authenticateUser( function () {
						_this.initializePad();
					} );
				} );
				$padlistdiv.append( _this.$select );
			}

			var $forkbtn = $( '<button></button>' );
			$forkbtn.html( mw.msg( 'ethereditor-fork-button' ) );
			$forkbtn.click( function () {
				$.ajax( {
					url: mw.util.wikiScript( 'api' ),
					method: 'GET',
					data: { format: 'json', action: 'ForkEtherPad', padId: _this.dbId },
					success: function( data ) {
						_this.padId = data.ForkEtherPad.padId;
						_this.dbId = data.ForkEtherPad.dbId;
						_this.sessionId = data.ForkEtherPad.sessionId;
						_this.isAdmin = true;
						_this.initializePad();
						return 0;
					},
					dataType: 'json'
				} );
				return false;
			} );
			$padlistdiv.append( $forkbtn );

			_this.$textarea.before( $padlistdiv );
		},
		/**
		 * Initializes the pad.
		*/
		initializePad: function () {
			$.cookie( 'sessionID', this.sessionId, { domain: mw.config.get( 'wgEtherEditorApiHost' ), path: '/' } );
			this.$textarea.pad( {
				padId: this.padId,
				baseUrl: this.baseUrl,
				hideQRCode: true,
				host: 'http://' + this.hostname,
				showControls: true,
				showLineNumbers: false,
				showChat: true,
				noColors: false,
				useMonospaceFont: true,
				userName: this.userName,
				height: this.$textarea.height(),
				width: this.$textarea.width(),
				border: 1,
				borderStyle: 'solid grey'
			} );
			this.$textarea.after( $( '<input type="hidden" name="dbId" value="' + this.dbId + '" />' ) );
			if ( this.isAdmin ) {
				$( '#ethereditor-admin-ctrls' ).show();
				this.$kickfield.show();
			} else if ( this.$kickfield && this.$kickfield.length ) {
				$( '#ethereditor-admin-ctrls' ).hide();
				this.$kickfield.hide();
			}
		},
		/**
		 * Deletes the pad's contents. (requires admin, of course)
		 */
		deletePad: function () {
			var _this = this;
			$.ajax( {
				url: mw.util.wikiScript( 'api' ),
				method: 'GET',
				data: {
					format: 'json', action: 'DeleteEtherPad',
					padId: _this.dbId
				},
				success: function( data ) {
					$( 'option[value=' + _this.dbId + ']', _this.$select ).remove();
					var $newOpt = $( 'option', _this.$select ).first();
					_this.dbId = $newOpt.val();
					_this.padId = $newOpt.html();
					_this.isAdmin = mw.user.name() == $newOpt.data( 'admin' );
					_this.authenticateUser( function () {
						_this.initializePad();
					} );
					return 0;
				},
				dataType: 'json'
			} );
		}
	};

	$.fn.remoteEditor = function() {
		$( '#ca-collaborate' ).removeClass( 'collapsible' ).addClass( 'selected' );
		$( '#ca-edit' ).removeClass( 'selected' );
		var $elements = this;
		$.each( $elements, function( i, textarea ) {
			var editor = new remoteEditor( textarea );
		} );
	};

	$( '#wpTextbox1' ).remoteEditor();

} )( jQuery, mediaWiki );
