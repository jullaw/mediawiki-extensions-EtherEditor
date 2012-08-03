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
		_this.uri = new mw.Uri( window.location.href );
		_this.pads = mw.config.get( 'wgEtherEditorOtherPads' );
		_this.$textarea = $( textarea );
		_this.$ctrls = null;
		_this.$pctrls = null;
		_this.$userlist = null;
		_this.$toolbar = null;
		_this.$sharelink = null;
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
		_this.initializeControls( function () {
			if ( _this.uri.query.collaborate ) {
				if ( _this.uri.query.padId ) {
					var thepad = false;
					for ( var px in _this.pads ) {
						if ( _this.pads[px].pad_id == _this.uri.query.padId ) {
							thepad = _this.pads[px];
							break;
						}
					}
					if ( thepad ) {
						_this.dbId = thepad.pad_id;
						_this.padId = thepad.ep_pad_id;
					}
				}
				_this.authenticateUser( function () {
					$( '#ethereditor-collab-switch' ).attr( 'checked', 'checked' );
					_this.enableEther();
				} );
			}
		} );
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
					if ( event.data == 'ethereditor-init' && event.origin == _this.padUrl && !_this.iframeready ) {
						_this.iframeready = true;
						_this.initializeUserList();
						_this.initializeFormattingControls();
						if ( _this.iframetimeout !== null ) {
							clearTimeout( _this.iframetimeout );
						}
						_this.sendMessage( 'updateusers' );
					}
				}, false );
			}
			if ( _this.iframe !== null && !_this.iframeready ) {
				_this.iframe.contentWindow.postMessage( 'ethereditor-init', _this.padUrl );
				_this.iframetimeout = setTimeout( function () {
					_this.signalReady();
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
					var $form = _this.$textarea.closest( 'form' );
					$.ajax( {
						url: mw.util.wikiScript( 'api' ),
						method: 'GET',
						data: { format: 'json', action: 'GetEtherPadText', padId: _this.dbId },
						success: function( data ) {
							_this.$textarea.html( data.GetEtherPadText.text );
							var origact = $form.attr( 'action' );
							var newact = origact + '&collaborate=true';
							if ( _this.padId ) {
								newact += '&padId=' + _this.dbId;
							}
							$form.attr( 'action', newact );
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
			var sumregex = new RegExp( mw.msg( 'ethereditor-summary-message' ).replace( '$1', '[^\\.]*(,[^\\.]*)*' ), '' );
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
		initializeControls: function ( cb ) {
			var _this = this;
			cb = cb || function () {};
			_this.$ctrls = $( '<div></div>' );
			_this.$ctrls.attr( 'id', 'ethereditor-ctrls' );
			_this.$ctrls.css( 'float', 'right' );
			var $toolbar = $( '#wikiEditor-ui-toolbar' );
			// When mw.config.get can't find a config variable, it returns null.
			// We use that fact to check whether WikiEditor needs to be loaded before we can continue.
			if ( !mw.config.exists( 'wgWikiEditorToolbarClickTracking' ) ) {
				$toolbar.append( _this.$ctrls );
			} else if ( $toolbar.length == 0 ) {
				// If we are using WikiEditor, and the toolbar hasn't loaded,
				// we wait until it is before we can load our controls.
				// This shouldn't take more than a few seconds, but there's no
				// better way to do it, at least not right now.
				setTimeout( function () {
					_this.initializeControls( cb );
				}, 400 );
				return;
			} else {
				$( '.tabs', $toolbar ).after( _this.$ctrls );
			}
			_this.initializeCollabControls();
			cb();
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
				var $uimg = $( '<img />' );
				// TODO add an icon for the user list
				// I'm adding in the img element with an alt attribute because the number isn't clear at all.
				$uimg.attr( 'src', 'placeholder' );
				$uimg.attr( 'alt', mw.msg( 'ethereditor-user-list' ) );
				$uimg.addClass( 'listicon' );
				$ucontain.append( $uimg );
				_this.$userlist.attr( 'id', 'ethereditor-userlist' );
				$ucontain.append( _this.$userlist );
				_this.$pctrls.append( $ucontain );
				_this.$usercount = $( '<span></span>' );
				_this.$usercount.attr( 'id', 'ethereditor-usercount' );
				$ucontain.append( _this.$usercount );
				_this.$usercount.add( $( '.listicon', $ucontain ) ).click( function () {
					if ( _this.$userlist.hasClass( 'hidden' ) && _this.$padlist !== null ) {
						_this.$padlist.addClass( 'hidden' );
					}
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
						if ( msg.users[ux].name == '' ) {
							msg.users[ux].name = mw.user.name();
						}
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

			var $refs = $( 'a[rel=reference]' );
			$refs.click( function () {
				_this.sendMessage( 'ethereditor-ref' );
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

			var $brs = $( 'a[rel=newline]' );
			$brs.click( function () {
				_this.sendMessage( 'ethereditor-br' );
			} );

			var $bigs = $( 'a[rel=big]' );
			$bigs.click( function () {
				_this.sendMessage( 'ethereditor-big' );
			} );

			var $smalls = $( 'a[rel=small]' );
			$smalls.click( function () {
				_this.sendMessage( 'ethereditor-small' );
			} );

			var $supers = $( 'a[rel=superscript]' );
			$supers.click( function () {
				_this.sendMessage( 'ethereditor-super' );
			} );

			var $subs = $( 'a[rel=subscript]' );
			$subs.click( function () {
				_this.sendMessage( 'ethereditor-sub' );
			} );

			var $redirs = $( 'a[rel=redirect]' );
			$redirs.click( function () {
				_this.sendMessage( 'ethereditor-redir' );
			} );

			var $specs = $( '.section-characters .page span' );
			$specs.click( function () {
				var $this = $( this );
				_this.sendMessage( { type: 'specialchar', char: $this.attr( 'rel' ) } );
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
		 * Initialize the various collaboration controls. This includes the pad
		 * list and the "collaborate" switch.
		 */
		initializeCollabControls: function () {
			var _this = this;
			var $turnOnCollab = $( '<input id="ethereditor-collab-switch" type="checkbox" />' );
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

			_this.$sharelink = $( '<input type="text" />' );
			_this.$ctrls.append( _this.$sharelink );

			var eventHandle = function () {
				this.selectionStart = 0;
				this.selectionEnd = $( this ).val().length;
				return false;
			};

			_this.$sharelink.focus( eventHandle );
			_this.$sharelink.click( eventHandle );
			_this.$sharelink.on( 'keyup', eventHandle );
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
			_this.$padlist = $( '#ethereditor-padlist' );
			if ( _this.$padlist.length == 0 ) {
				_this.$padlist = $( '<span></span>' );
				_this.$padlist.addClass( 'hidden' );
				var $pcontain = $( '<span></span>' );
				$pcontain.attr( 'id', 'ethereditor-padlist-contain' );
				var $pimg = $( '<img />' );
				// TODO add an icon for the pad list
				// I'm adding in the img element with an alt attribute because the number isn't clear at all.
				$pimg.attr( 'src', 'placeholder' );
				$pimg.attr( 'alt', mw.msg( 'ethereditor-pad-list' ) );
				$pimg.addClass( 'listicon' );
				$pcontain.append( $pimg );
				_this.$padlist.attr( 'id', 'ethereditor-padlist' );
				$pcontain.append( _this.$padlist );
				_this.$pctrls.append( $pcontain );
				_this.$padcount = $( '<span></span>' );
				_this.$padcount.attr( 'id', 'ethereditor-padcount' );
				_this.$padcount.html( _this.pads.length );
				$pcontain.append( _this.$padcount );
				_this.$padcount.add( $( '.listicon', $pcontain ) ).click( function () {
					if ( _this.$padlist.hasClass( 'hidden' ) && _this.$userlist !== null ) {
						_this.$userlist.addClass( 'hidden' );
					}
					_this.$padlist.toggleClass( 'hidden' );
				} );
			}
			if ( _this.isAdmin ) {
				_this.$padlist.removeClass( 'notadmin' );
			} else {
				_this.$padlist.addClass( 'notadmin' );
			}
			_this.updatePadList( false );
		},
		/**
		 * Update the list of pads.
		 * @param updateRemote Should we fetch the data from the API?
		 */
		updatePadList: function ( updateRemote ) {
			var _this = this;
			_this.$padlist.empty();
			var finishUpdate = function () {
				var isOdd = 1;
				for ( var px in _this.pads ) {
					var pad = _this.pads[px];
					var $pad = $( '<div></div>' );
					$pad.attr( 'data-padid', pad.pad_id );
					_this.$padlist.append( $pad );
					var $padname = $( '<span class="ethereditor-padname"></span>' );
					var ot = pad.time_created;
					var createtime = new Date(
						parseInt( ot.substr( 0, 4 ), 10 ),
						parseInt( ot.substr( 4, 2 ), 10 ) - 1,
						parseInt( ot.substr( 6, 2 ), 10 ),
						parseInt( ot.substr( 8, 2 ), 10 ),
						parseInt( ot.substr( 10, 2 ), 10 ),
						parseInt( ot.substr( 12, 2 ), 10 )
					);
					var timeago = new Date() - createtime;
					var tunits = {
						minutes: 60,
						hours: 60,
						days: 24
					};
					var curoff = 1000;
					timeago -= timeago % curoff;
					var timestring = mw.msg( 'seconds', timeago / curoff )
					for ( var tunit in tunits ) {
						curoff *= tunits[tunit];
						if ( timeago / curoff > 1 ) {
							timeago -= timeago % curoff;
							timestring = mw.msg( tunit, timeago / curoff );
						} else {
							break;
						}
					}
					var msg = mw.msg( 'ethereditor-session-created', mw.user.name(), mw.msg( 'ago', timestring ) );
					$padname.text( msg );
					$padname.append( '<br />' );
					$padname.append( mw.message( 'ethereditor-connected', pad.users_connected ).escaped() );
					$pad.append( $padname );

					var $padminctrls = $( '<span class="padminctrls"></span>' );

					var $copy = $( '<button></button>' );
					$copy.html( mw.msg( 'ethereditor-fork-button' ) );
					$copy.click( ( function ( padId ) {
						return function () {
							_this.forkPad( padId );
							return false;
						};
					} )( pad.pad_id ) );
					$padminctrls.append( $copy );

					if ( pad.admin_user == mw.user.name() ) {
						var $delete = $( '<button></button>' );
						$delete.html( mw.msg( 'ethereditor-delete-button' ) );
						$delete.click( ( function ( padId ) {
							return function () {
								_this.deletePad( padId );
								return false;
							};
						} )( pad.pad_id ) );
						$padminctrls.append( $delete );
					}

					$pad.append( $padminctrls );
					$pad.click( ( function ( thispad ) {
						return function () {
							_this.dbId = thispad.pad_id;
							_this.padId = thispad.ep_pad_id;
							_this.authenticateUser( function () {
								_this.initializePad();
							} );
						};
					} )( pad ) );
				}
			};
			if ( updateRemote ) {
			var pads = _this.pads;
			var $forkbtn = $( '<button></button>' );
			$forkbtn.html( mw.msg( 'ethereditor-fork-button' ) );
			$forkbtn.click( function () {
				$.ajax( {
					url: mw.util.wikiScript( 'api' ),
					method: 'GET',
					data: { format: 'json', action: 'GetOtherEtherpads', padId: _this.dbId },
					success: function ( data ) {
						_this.pads = data.GetOtherEtherpads.pads;
						finishUpdate();
					},
					dataType: 'json'
				} );
			} else {
				finishUpdate();
			}
		},
		/**
		 * Fork a pad into another.
		 */
		forkPad: function ( padId ) {
			var _this = this;
			$.ajax( {
				url: mw.util.wikiScript( 'api' ),
				method: 'GET',
				data: { format: 'json', action: 'ForkEtherPad', padId: padId },
				success: function( data ) {
					_this.padId = data.ForkEtherPad.padId;
					_this.dbId = data.ForkEtherPad.dbId;
					_this.sessionId = data.ForkEtherPad.sessionId;
					_this.isAdmin = true;
					_this.initializePad();
					_this.updatePadList( true );
					return 0;
				},
				dataType: 'json'
			} );
			return false;
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
			_this.updateShareLink();
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
		 * Update the share link to reflect the current pad's information
		 */
		updateShareLink: function () {
			var _this = this;
			var shareuri = new mw.Uri( window.location.href );
			shareuri.query.collaborate = true;
			shareuri.query.padId = _this.dbId;
			_this.$sharelink.val( shareuri.toString() );
		},
		/**
		 * Disable the collaborative editor
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
		 * @param padId optional, the ID of the pad to delete
		 */
		deletePad: function ( padId ) {
			var _this = this;
			$.ajax( {
				url: mw.util.wikiScript( 'api' ),
				method: 'GET',
				data: {
					format: 'json', action: 'DeleteEtherPad',
					padId: padId || _this.dbId
				},
				success: function( data ) {
					$( 'option[value=' + _this.dbId + ']', _this.$select ).remove();
					var px = -1;
					// The below line will loop until it finds the right pad index.
					while ( ++px < _this.pads.length && _this.pads[px].pad_id != padId ) { }
					_this.pads.splice( px, 1 );
					if ( padId == _this.dbId ) {
						var newPad = _this.pads[0];
						_this.dbId = newPad.pad_id;
						_this.padId = newPad.ep_pad_id;
						_this.isAdmin = mw.user.name() == newPad.admin_user;
						_this.authenticateUser( function () {
							_this.initializePad();
						} );
					}
					_this.updatePadList( true );
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
