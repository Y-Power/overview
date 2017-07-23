/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

    // Site title and description.
    wp.customize( 'blogname', function( value ) {
	value.bind( function( to ) {
	    $( '.site-title a' ).text( to );
            /* OverView navbar logo fallback */
            console.log($( '.overview-navbar-nologo-fallback' ));
            $( 'a#overview-navbar-site-logo p' ).text( to );
	} );
    } );
    wp.customize( 'blogdescription', function( value ) {
	value.bind( function( to ) {
	    $( '.site-description' ).text( to );
	} );
    } );

    // OverView site branding description
    wp.customize( 'overview_site_branding_description', function( value ) {
        value.bind( function( to ) {
            if ( '' === to ){
                $( '.site-branding-description-p' ).remove();
            }
        } );
    } );

} )( jQuery );
