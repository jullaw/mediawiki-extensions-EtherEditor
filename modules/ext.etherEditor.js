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
		// todo obtain config from...?
		this.config = {};
		this.$textarea = $( textarea );
		var userName = mw.config.get( 'wgUserName' );
		var hostname = mw.config.get( 'wgEtherEditorApiHost' );
		if ( hostname ) {
			hostname += ':' + ( mw.config.get( 'wgEtherEditorApiPort' ) || '9001' );
		} else {
			hostname = 'localhost:9001';
		}
		var baseUrl = mw.config.get( 'wgEtherEditorPadUrl' );
		var padId = mw.config.get( 'wgEtherEditorPadName' );
		var sessionId = mw.config.get( 'wgEtherEditorSessionId' );
		if ( !padId || !sessionId ) {
			return false; // there was an error, clearly, so let's quit
		}

		$.cookie( 'sessionID', sessionId, { domain: mw.config.get( 'wgEtherEditorApiHost' ), path: '/' } );

		this.hasSubmitted = false;

		this.$textarea.closest( 'form' ).submit( function ( e ) {
			if ( ! _this.hasSubmitted ) {
				e.preventDefault();
				e.stopPropagation();
				_this.hasSubmitted = true;
				var __this = this;
				_this.$textarea.pad( { getContents: true, callback: function ( data ) {
					_this.$textarea.html( data.ApiEtherEditor.text );
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
