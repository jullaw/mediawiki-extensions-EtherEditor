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
		_this.$ctrls = null;
		_this.$toolbar = null;
		_this.userName = mw.config.get( 'wgUserName' );
		_this.hostname = _this.getHostName();
		_this.baseUrl = mw.config.get( 'wgEtherEditorPadUrl' );
		_this.padId = mw.config.get( 'wgEtherEditorPadName' );
		_this.padUrl = 'http://' + _this.hostname;
		_this.dbId = mw.config.get( 'wgEtherEditorDbId' );
		_this.sessionId = mw.config.get( 'wgEtherEditorSessionId' );
		_this.iframe = null;
		_this.iframetimeout = null;
		_this.iframeready = false;
		if ( !_this.padId || !_this.sessionId ) {
			return false; // there was an error, clearly, so let's quit
		}
		_this.initializeControls();
	};

	remoteEditor.prototype = {
		/**
		 * Get the hostname for the Etherpad Lite instance
		 */
		getHostName: function () {
			var hostname = mw.config.get( 'wgEtherEditorApiHost' );
			if ( !hostname ) {
				hostname = 'localhost';
			}
			var port = mw.config.get( 'wgEtherEditorApiPort' );
			if ( !port ) {
				port = '9001';
			}
			if ( port != '80' ) {
				hostname = hostname + ':' + port;
			}
			return hostname;
		},
		/**
		 * Send a message to the iframe below.
		 */
		sendMessage: function ( msg ) {
			var _this = this;
			if ( _this.iframeready ) {
				_this.iframe.contentWindow.postMessage( msg, _this.padUrl );
			}
		},
		/**
		 * Signal to the iframe that we're ready, and wait for its response
		 */
		signalReady: function () {
			var _this = this;
			if ( _this.iframetimeout === null ) {
				window.addEventListener( 'message', function ( event ) {
					if ( event.data !== 'ethereditor-init' || event.origin != _this.padUrl ) {
						return;
					}
					_this.iframeready = true;
					_this.initializeFormattingControls();
					if ( _this.iframetimeout !== null ) {
						clearTimeout( _this.iframetimeout );
					}
				}, false );
			}
			_this.iframe.contentWindow.postMessage( 'ethereditor-init', _this.padUrl );
			_this.iframetimeout = setTimeout( function () {
				_this.signalReady()
			}, 200 );
		},
		/**
		 * Enables the collaborative editor, and starts up a bunch of processes
		 */
		enableEther: function () {
			var _this = this;
			_this.hasSubmitted = false;

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

			_this.initializePad();
			_this.initializePadList();
			_this.initializeAdminControls();
			_this.initializeContribs();
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
					contribstr += ',';
				} else {
					break;
				}
			}
			var oldsmry = $smry.val();
			var newsmry = mw.msg( 'ethereditor-summary-message', contribstr );
			var sumregex = new RegExp( mw.msg( 'ethereditor-summary-message' ).replace( '$1.', '[^\\.]*(,[^\\.]*)*\\.' ), '' );
			if ( oldsmry.match( sumregex ) !== null ) {
				oldsmry = oldsmry.replace( sumregex, newsmry );
			} else {
				oldsmry += newsmry;
			}
			$smry.val( oldsmry );
		},
		/**
		 * Adds some controls to the form specific to the extension.
		*/
		initializeControls: function () {
			var _this = this;
			_this.$ctrls = $( '<div></div>' );
			_this.$ctrls.attr( 'id', 'ethereditor-ctrls' );
			_this.$ctrls.css( 'float', 'right' );
			var $toolbar = $( '#wikiEditor-ui-toolbar' );
			if ( $toolbar.length == 0 ) {
				$toolbar = $( '#toolbar' );
				$toolbar.append( _this.$ctrls );
			} else {
				$( '.tabs', $toolbar ).after( _this.$ctrls );
			}

			_this.initializeCollabControls();
		},
		/**
		 * Add events to each formatting button, see that they work properly.
		 */
		initializeFormattingControls: function () {
			var _this = this;

			var $bolds = $( 'a[rel=bold], #mw-editbutton-bold' );
			$bolds.click( function () {
				_this.sendMessage( 'ethereditor-bold' );
			} );

			var $italics = $( 'a[rel=italic], #mw-editbutton-italic' );
			$italics.click( function () {
				_this.sendMessage( 'ethereditor-italic' );
			} );

			var $ilinks = $( 'a[rel=ilink], #mw-editbutton-link' );
			$ilinks.click( function () {
				_this.sendMessage( 'ethereditor-ilink' );
			} );

			var $files = $( 'a[rel=file]' );
			$files.click( function () {
				_this.sendMessage( 'ethereditor-file' );
			} );

			var $elinks = $( 'a[rel=xlink], #mw-editbutton-extlink' );
			$elinks.click( function () {
				_this.sendMessage( 'ethereditor-elink' );
			} );

			var $nowikis = $( 'a[rel=nowiki], #mw-editbutton-nowiki' );
			$nowikis.click( function () {
				_this.sendMessage( 'ethereditor-nowiki' );
			} );

			var $signatures = $( 'a[rel=signature], #mw-editbutton-signature' );
			$signatures.click( function () {
				_this.sendMessage( 'ethereditor-signature' );
			} );

			var $uls = $( 'a[rel=ulist]' );
			$uls.click( function () {
				_this.sendMessage( 'ethereditor-ul' );
			} );

			var $ols = $( 'a[rel=olist]' );
			$ols.click( function () {
				_this.sendMessage( 'ethereditor-ol' );
			} );

			var $tables = $( 'a[rel=table]' );
			$tables.click( function () {
				_this.sendMessage( 'ethereditor-table' );
			} );

			var $inds = $( 'a[rel=indent]' );
			$inds.click( function () {
				_this.sendMessage( 'ethereditor-indent' );
			} );

			for ( var i = 2; i < 6; i++ ) {
				var $headings = $( 'a[rel=heading-' + i + ']' );
				$headings.click( ( 
					function( thisi ) {
						return function () {
							_this.sendMessage( { heading: thisi } );
						}
					})( i ) );
			}

			var $hrs = $( '#mw-editbutton-hr' );
			$hrs.click( function () {
				_this.sendMessage( 'ethereditor-hr' );
			} );

			var $headlines = $( '#mw-editbutton-headline' );
			$headlines.click( function () {
				_this.sendMessage( { heading: 2 } );
			} );
		},
		/**
		 * Adds the delete pad button and the kick field.
		 */
		initializeAdminControls: function () {
			var _this = this;
			var $actls = $( '<span></span>' );
			$actls.attr( 'id', 'ethereditor-admin-ctrls' );
			var $delbtn = $( '<button></button>' );
			$delbtn.attr( 'id', 'ethereditor-delete-button' );
			$delbtn.html( mw.msg( 'ethereditor-delete-button' ) );
			$delbtn.click( function () {
				_this.deletePad();
				return false;
			} );
			$actls.append( $delbtn );
			_this.$ctrls.prepend( $actls );
			_this.addKickField();
		},
		/**
		 * Initialize the various collaboration controls. This includes the pad
		 * list and the "collaborate" switch.
		 */
		initializeCollabControls: function () {
			var _this = this;
			var $turnOnCollab = $( '<input type="checkbox" />' );
			$turnOnCollab.click( function () {
				var $this = $( this );
				if ( $this.is( ':checked' ) ) {
					_this.enableEther();
				} else {
					_this.disableEther();
				}
			} );

			var $collabLabel = $( '<label></label>' );
			$collabLabel.html( mw.msg( 'ethereditor-collaborate-button' ) );
			$collabLabel.append( $turnOnCollab );
			_this.$ctrls.append( $collabLabel );
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
				_this.$ctrls.prepend( _this.$select );
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
			_this.$ctrls.prepend( $forkbtn );
		},
		/**
		 * Initializes the pad.
		*/
		initializePad: function () {
			var _this = this;
			$.cookie( 'sessionID', _this.sessionId, { domain: mw.config.get( 'wgEtherEditorApiHost' ), path: '/' } );
			_this.$textarea.pad( {
				padId: _this.padId,
				baseUrl: _this.baseUrl,
				hideQRCode: true,
				host: 'http://' + _this.hostname,
				showControls: false,
				showLineNumbers: false,
				showChat: true,
				noColors: false,
				useMonospaceFont: true,
				userName: _this.userName,
				height: _this.$textarea.height(),
				width: _this.$textarea.width(),
				border: 1,
				borderStyle: 'solid grey'
			} );
			_this.iframe = _this.$textarea.next( 'iframe' ).get(0);
			_this.signalReady();
			$( 'input[name=dbId]' ).remove();
			_this.$textarea.after( $( '<input type="hidden" name="dbId" value="' + _this.dbId + '" />' ) );
			if ( _this.isAdmin ) {
				$( '#ethereditor-admin-ctrls' ).show();
				_this.$kickfield.show();
			} else if ( _this.$kickfield && _this.$kickfield.length ) {
				$( '#ethereditor-admin-ctrls' ).hide();
				_this.$kickfield.hide();
			}
		},
		/**
		 * 
		 */
		disableEther: function () {
			var _this = this;
			_this.$textarea.show();
			var epframeid = 'epframe' + _this.$textarea.attr( 'id' );
			$( epframeid )
				.add( '#ethereditor-admin-ctrls' )
				.remove();
			
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
		var $elements = this;
		$.each( $elements, function( i, textarea ) {
			var editor = new remoteEditor( textarea );
		} );
	};

	$( '#wpTextbox1' ).remoteEditor();

} )( jQuery, mediaWiki );
