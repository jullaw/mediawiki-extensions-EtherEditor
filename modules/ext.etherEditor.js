/**
 * Library to create a remote editor (particularly an instance of the modified etherpad editor pad-mediawiki)
 *
 * dependencies: mediawiki.uri
 *
 * @author Neil Kandalgaonkar
 * @license same terms as MediaWiki itself
 *
 */

( function( $, mw ) { 

	var rules = {
		br: function ( ctx ) {
			return { start: "\n", end: "" };
		},
		em: function ( ctx ) {
			return { start: "''", end: "''"};
		},
		u: function ( ctx ) {
			return { start: "<ins>", end: "</ins>" };
		},
		strong: function ( ctx ) {
			return { start: "'''", end: "'''"};
		},
		ul: function ( ctx, $ele ) {
			return { start: "", end: "", ctx: $ele.is( '.indent' ) ? undefined : "ul" };
		},
		ol: function ( ctx, $ele ) {
			return { start: "", end: "", ctx: $ele.is( '.indent' ) ? undefined : "ol" };
		},
		li: function ( ctx ) {
			var lctx = false;
			var j = ctx.length;
			var start = '';
			while ( j-- > 0 ) {
				if ( ctx[j] == 'ol' || ctx[j] == 'ul' ) {
					lctx = ctx[j];
					start += ctx[j] == 'ol' ? '#' : '*';
				} else if ( ctx[j] == 'ind' ) {
					lctx = 'ind';
					start += ':';
				}
			}
			if ( lctx ) {
				if ( lctx == 'ol' ) {
					return { absstart: "\n", start: start, end: "" };
				} else if ( lctx == 'ul' ) {
					return { absstart: "\n", start: start, end: "" };
				} else {
					return { absstart: "\n", start: start, end: "" };
				}
			} else {
				return { start: "", end: "" };
			}
		},
		'.indent': function ( ctx ) {
			return { start: "", end: "", ctx: "ind" };
		},
	};

	var compileDomToWikitext = function( dom, ctx ) {
		ctx = ctx || [];
		var wt = '';
		$.each( dom, function () {
			if ( this.nodeName == '#text' ) {
				wt += this.textContent;
			} else {
				var $this = $( this );
				var prewt = '';
				var haslist = false;
				$.each( rules, function ( j, rule ) {
					if ( $this.is( j ) ) {
						var newrule = rule( ctx, $this );
						if ( newrule.absstart ) {
							prewt = newrule.absstart + prewt;
						}
						prewt += newrule.start;
						wt += prewt;
						if ( newrule.ctx ) {
							ctx.push( newrule.ctx );
						}
					}
				} );

				wt += compileDomToWikitext( this.childNodes, ctx );

				$.each( rules, function ( j, rule ) {
					if ( $this.is( j ) ) {
						var newrule = rule( ctx, $this );
						wt += newrule.end;
						if ( newrule.ctx ) {
							ctx.pop();
						}
					}
				} );
			}
		} );
		return wt;
	};

	var compileHtmlToWikitext = function( html ) {
		var doc = document.createElement( 'span' );
		doc.innerHTML = html;
		var result = compileDomToWikitext( [doc] );
		var doSomethingUseful = 'squirtle';
		return result;
	};

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
		// todo obtain config from...?
		this.config = {};
		this.$textarea = $( textarea );
		var userName = mw.config.get( 'wgUserName' );
		var hostname = this.config.hostname || 'localhost:9001';
		var baseUrl = '/p/';
		var padId = mw.config.get( 'wgEtherEditorPadName' );
		var sessionId = mw.config.get( 'wgEtherEditorSessionId' );
		if ( !padId || !sessionId ) {
			return false; // there was an error, clearly, so let's quit
		}

		$.cookie( 'sessionID', sessionId, { domain: mw.config.get( 'wgEtherEditorApiUrl' ), path: '/' } );

		this.hasSubmitted = false;

		this.$textarea.closest( 'form' ).submit( function ( e ) {
			if ( ! _this.hasSubmitted ) {
				e.preventDefault();
				e.stopPropagation();
				_this.hasSubmitted = true;
				var __this = this;
				_this.$textarea.pad( { getContents: true, callback: function ( data ) {
					_this.$textarea.html( compileHtmlToWikitext( data.ApiEtherEditor.html ) );
					$( __this ).submit();
					return 0;
				} } );
				return 0;
			}
		} );

		this.$textarea.pad( {
			padId: padId,
			hideQRCode: true,
			host: 'http://' + hostname,
			showControls: true,
			showLineNumbers: false,
			noColors: true,
			useMonospaceFont: true,
			userName: userName,
			height: this.$textarea.height(),
			width: this.$textarea.width(),
			border: 1,
			borderStyle: 'solid grey'
		} );
	};
	
	remoteEditor.prototype = {
		// this stuff was removed to test the jquery plugin, presumably it can do
		// everything we need, so no need to mess around with this stuff.
	};

	$.fn.remoteEditor = function() {
		var $elements = this;
		$.each( $elements, function( i, textarea ) {
			var editor = new remoteEditor( textarea );
		} );
	};
	
	$( '#wpTextbox1' ).remoteEditor();

} )( jQuery, mediaWiki );


