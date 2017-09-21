/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * Copyright (C) 2017 _Y_Power ( http://ypower.nouveausiteweb.fr )
 *
 * This file is part of the OverView WordPress theme package.
 */

( function( $ ) {

    // Site title and description.
    wp.customize( 'blogname', function( value ) {
	value.bind( function( to ) {
	    $( '.site-title a' ).text( to );
            /* OverView navbar logo fallback */
            $( 'a#overview-navbar-site-logo p' ).text( to );
	} );
    } );
    wp.customize( 'header_textcolor', function( value ) {
	value.bind( function( to ) {
	    $( '.site-title a' ).css({
                color:  to
            });
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

    // OverView custom font color
    wp.customize( 'overview_custom_body_color', function( value ) {
        value.bind( function( to ) {
            var OVAllContentEls = $( 'body, header#masthead div.site-branding p.site-description, header#masthead div.site-branding p.site-description, div.overview-indexed-content-main-container, article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img, div#comments, div.page-content, div.overview-sidebar-main-container section.widget' );
            OVAllContentEls.css({
                color: to
            });
            var OVDisplayContentEl = $( 'div#overview-front-page-posts-section-content' );
            if ( '1' === wp.customize.settings.values.overview_display_bright_background ){
                OVDisplayContentEl.css({
                    color: to,
                    backgroundColor: 'transparent'
                });
            }
            else {
                OVDisplayContentEl.css({
                    color: '#404040',
                    backgroundColor: '#ffffff'
                });
            }
        } );
    } );

    // OverView custom background color
    wp.customize( 'background_color', function( value ) {
        value.bind( function( to ) {
            var OVSiteContentElements = $( 'header#masthead, .site-title, header#masthead div.site-branding p.site-description, div.overview-indexed-content-main-container, article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img, div#comments, div.page-content, div.overview-sidebar-main-container section.widget' );
            OVSiteContentElements.css( 'background-color', to );
            // if OverView Display does NOT have the default background
            if ( '' !== wp.customize.settings.values.overview_display_bright_background ){
                var OVDisplayContentElements = $( 'div#overview-front-page-section-content-container, div#overview-front-page-posts-section-content' );
                OVDisplayContentElements.css({
                    backgroundColor: to
                });
            }
            // if OverView Display DOES HAVE the default background
            else {
                var OVDisplayContentElement = $( 'div#overview-front-page-posts-section-content' );
                OVDisplayContentElement.css({
                    color: '#404040',
                    backgroundColor: '#ffffff'
                });
            }
        } );
    } );

    // background image
    wp.customize( 'background_image', function( value ) {
        value.bind( function( to ) {
            var ovBackgroundImgCheck = ( '' !== to ) ? true : false;
            switch( ovBackgroundImgCheck ){
                //if there IS an img
            case true:
                $( 'article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img' ).removeClass('ov-background-switch-default').addClass('ov-background-switch-changes');
                $( 'div.overview-sidebar-main-container' ).removeClass('ov-background-switch-sidebar-default').addClass('ov-background-switch-sidebar-changes');
                $( '.sticky' ).removeClass('ov-background-switch-sticky-default').addClass('ov-background-switch-sticky-changes');
                break;
                // if there is NO img
            case false:
                $( 'article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img' ).removeClass('ov-background-switch-changes').addClass('ov-background-switch-default');
                $( 'div.overview-sidebar-main-container' ).removeClass('ov-background-switch-sidebar-changes').addClass('ov-background-switch-sidebar-default');
                $( '.sticky' ).removeClass('ov-background-switch-sticky-changes').addClass('ov-background-switch-sticky-default');
                break;
                // default: remove special (background img)
            default:
                $( 'article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img' ).removeClass('ov-background-switch-changes').addClass('ov-background-switch-default');
                $( 'div.overview-sidebar-main-container' ).removeClass('ov-background-switch-sidebar-changes').addClass('ov-background-switch-sidebar-default');
                $( '.sticky' ).removeClass('ov-background-switch-sticky-changes').addClass('ov-background-switch-sticky-default');
            }
        } );
    } );
    
    // body font size
    wp.customize( 'overview_body_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'body' ).css( 'font-size', to );
        } );
    } );

    // titles alignment
    wp.customize( 'overview_titles_alignment', function( value ) {
        value.bind( function( to ) {
            $( '.entry-title' ).css( 'text-align', to );
        } );
    } );

} )( jQuery );
