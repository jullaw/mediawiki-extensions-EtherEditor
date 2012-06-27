/**
 * Warn the user that other people are editing this page with EtherEditor
 *
 * @author Mark Holmquist
 * @license GPLv2+
 *
 */

( function( $, mw ) {
	var $warning = $( '<p></p>' );
	$warning.html( mw.msg( 'ethereditor-warn-others' ) );
	$( '#editform' ).before( $warning );
} )( jQuery, mediaWiki );
