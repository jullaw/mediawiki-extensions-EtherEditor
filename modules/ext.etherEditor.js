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
		_this.$pctrls = null;
		_this.$userlist = null;
		_this.$toolbar = null;
		_this.users = {};
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
					if ( event.data !== 'ethereditor-init' || event.origin != _this.padUrl || _this.iframeready ) {
						return true;
					}
					_this.iframeready = true;
					_this.initializeUserList();
					_this.initializeFormattingControls();
					if ( _this.iframetimeout !== null ) {
						clearTimeout( _this.iframetimeout );
					}
					_this.sendMessage( 'updateusers' );
				}, false );
			}
			if ( _this.iframe !== null ) {
				_this.iframe.contentWindow.postMessage( 'ethereditor-init', _this.padUrl );
				_this.iframetimeout = setTimeout( function () {
					_this.signalReady()
				}, 200 );
			}
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
			_this.$pctrls = $( '<span></span>' );
			_this.$pctrls.attr( 'id', 'ethereditor-pad-ctrls' );
			_this.$ctrls.append( _this.$pctrls );
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
		 * Add the hook for updating users.
		 */
		initializeUserList: function () {
			var _this = this;
			_this.$userlist = $( '#ethereditor-userlist' );
			if ( _this.$userlist.length == 0 ) {
				_this.$userlist = $( '<span></span>' );
				_this.$userlist.addClass( 'hidden' );
				var $ucontain = $( '<span></span>' );
				$ucontain.attr( 'id', 'ethereditor-userlist-contain' );
				_this.$userlist.attr( 'id', 'ethereditor-userlist' );
				$ucontain.append( _this.$userlist );
				_this.$pctrls.append( $ucontain );
				_this.$usercount = $( '<span></span>' );
				_this.$usercount.attr( 'id', 'ethereditor-usercount' );
				$ucontain.append( _this.$usercount );
				_this.$usercount.click( function () {
					_this.$userlist.toggleClass( 'hidden' );
				} );
			}
			if ( _this.isAdmin ) {
				_this.$userlist.removeClass( 'notadmin' );
			} else {
				_this.$userlist.addClass( 'notadmin' );
			}
			window.addEventListener( 'message', function ( event ) {
				var msg = event.data;
				if ( msg && msg.type && msg.type == 'userinfo' ) {
					for ( var ux in msg.users ) {
						_this.userJoinOrUpdate( msg.users[ux] );
					}
					_this.$usercount.html( $( '.ethereditor-username' ).length );
				}
			}, false );
		},
		/**
		 * Given user info, either create or update the relevant entry.
		 */
		userJoinOrUpdate: function ( user ) {
			var _this = this;
			console.log( user );
			if ( !user || !user.name || user.name == '' ) {
				setTimeout( function () {
					_this.sendMessage( 'updateusers' );
				}, 400 );
				return;
			}
			var doesexist = _this.users[user.name];
			_this.users[user.name] = true;
			var $user = $( '[data-username="' + user.id + '"]' );
			if ( !doesexist ) {
				$user = $( '<div></div>' );
				$user.attr( 'data-username', user.name );
				_this.$userlist.append( $user );
				$user.append( '<span class="ethereditor-usercolor">&nbsp;</span>');
				$user.append( '<span class="ethereditor-username"></span>');

				if ( user.name != mw.user.name() ) {
					var $userctrls = $( '<span class="userctrls"></span>' );
					var $kick = $( '<button></button>' );
					$kick.html( mw.msg( 'ethereditor-kick-button' ) );
					$kick.click( ( function ( username ) {
						return function () {
							_this.kickUser( username );
							return false;
						};
					} )( user.name ) );
					$userctrls.append( $kick );
					$user.append( $userctrls );
				}
			}
			$( '.ethereditor-username', $user ).html( user.name );
			$( '.ethereditor-usercolor', $user ).css( 'background-color', user.color );
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
		kickUser: function ( username ) {
			var _this = this;
			$.ajax( {
				url: mw.util.wikiScript( 'api' ),
				method: 'GET',
				data: {
					format: 'json', action: 'KickFromPad',
					padId: _this.dbId, user: username
				},
				success: function( data ) {
					$( '[data-username="' + username + '"]' ).remove();
					_this.$usercount.html( $( '.ethereditor-username' ).length );
					return 0;
				},
				dataType: 'json'
			} );
			return false;
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
			_this.$pctrls.prepend( $actls );
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
		 * Adds a list of other pads to the page, so you can have multiple.
		*/
		initializePadList: function () {
			var _this = this;
			var pads = mw.config.get( 'wgEtherEditorOtherPads' );
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
			_this.$pctrls.prepend( $forkbtn );
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
				_this.$pctrls.prepend( _this.$select );
			}
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
			_this.iframetimeout = null;
			_this.iframeready = false;
			_this.iframe = _this.$textarea.next( 'iframe' ).get(0);
			$( 'input[name=dbId]' ).remove();
			_this.$textarea.after( $( '<input type="hidden" name="dbId" value="' + _this.dbId + '" />' ) );
			if ( _this.isAdmin ) {
				$( '#ethereditor-admin-ctrls' ).show();
			}
			_this.signalReady();
		},
		/**
		 * 
		 */
		disableEther: function () {
			var _this = this;
			_this.$textarea.show();
			_this.iframe = null;
			_this.iframetimeout = null;
			_this.iframeready = false;
			var epframeid = '#epframe' + _this.$textarea.attr( 'id' );
			$( epframeid )
				.add( '#ethereditor-admin-ctrls' )
				.add( '#ethereditor-pad-ctrls' )
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
