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
		this.$textarea = $( textarea );
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

		this.$textarea.after( $( '<input type="hidden" name="enableether" value="true" />' ) );

		this.initializePad();
		this.initializeControls();
		this.initializePadList();

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
			for ( var cx in contribs ) {
				var contrib = contribs[cx];
				contribstr += contrib.username;
				if ( cx + 1 < contribs.length ) {
					contribstr += ', ';
				}
			}
			$smry.val( $smry.val() + ' Contributors in EtherEditor: ' + contribstr );
		},
		/**
		 * Adds some controls to the form specific to the extension.
		*/
		initializeControls: function () {
			var _this = this;
			var $ctrls = $( '<div></div>' );
			$ctrls.attr( 'id', 'ethereditor-ctrls' );

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
			$ctrls.append( $forkbtn );

			var $contribbtn = $( '<button></button>' );
			$contribbtn.html( mw.msg( 'ethereditor-contrib-button' ) );
			$contribbtn.click( function () {
				$.ajax( {
					url: mw.util.wikiScript( 'api' ),
					method: 'GET',
					data: { format: 'json', action: 'GetContribs', padId: _this.dbId },
					success: function( data ) {
						_this.contribs = data.GetContribs.contribs;
						_this.populateSummary();
						return 0;
					},
					dataType: 'json'
				} );
				return false;
			} );
			$ctrls.append( $contribbtn );

			_this.$textarea.before( $ctrls );
		},
		/**
		 * Adds a field and button for kicking users from the pad
		 * Only available if you're an admin (and the backend checks it)
		 */
		addKickField: function () {
			var _this = this;
			var $ctrls = $( '#ethereditor-ctrls' );
			var $kickbtn = $( '#ethereditor-kickbtn', $ctrls );
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
				$ctrls.append( _this.$kickfield );
				$ctrls.append( $kickbtn );
			}
		},
		/**
		 * Adds a list of other pads to the page, so you can have multiple.
		*/
		initializePadList: function () {
			var _this = this;
			var pads = mw.config.get( 'wgEtherEditorOtherPads' );
			if ( pads && pads.length ) {
				var $select = $( '<select></select>' );
				pads.unshift( { pad_id: _this.dbId, ep_pad_id: _this.padId, admin_user: ( this.isAdmin ? mw.user.name() : '' ) } );
				for ( var px in pads ) {
					var pad = pads[px];
					var $option = $( '<option></option>' );
					$option.html( pad.ep_pad_id );
					$option.val( pad.pad_id );
					$option.data( 'admin', pad.admin_user );
					$select.append( $option );
				}
				$select.change( function () {
					var $selopt = $( 'option:selected', $( this ) );
					_this.padId = $selopt.html();
					_this.dbId = $selopt.val();
					_this.isAdmin = mw.user.name() == $selopt.data( 'admin' );
					_this.authenticateUser( function () {
						_this.initializePad();
					} );
				} );
				_this.$textarea.before( $select );
			}
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
				this.addKickField();
			} else if ( this.$kickfield && this.$kickfield.length ) {
				$( '#ethereditor-kickbtn' ).remove();
				this.$kickfield.remove();
			}
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
