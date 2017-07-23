/*
    Copyright (C) 2017  _Y_Power

    This file is part of the OverView WordPress theme package.

    The JavaScript code in this page is free software: you can
    redistribute it and/or modify it under the terms of the GNU
    General Public License (GNU GPL) as published by the Free Software
    Foundation, either version 3 of the License, or (at your option)
    any later version.  The code is distributed WITHOUT ANY WARRANTY;
    without even the implied warranty of MERCHANTABILITY or FITNESS
    FOR A PARTICULAR PURPOSE.  See the GNU GPL for more details.

    As additional permission under GNU GPL version 3 section 7, you
    may distribute non-source (e.g., minimized or compacted) forms of
    that code without the copy of the GNU GPL normally required by
    section 4, provided you include this license notice and a URL
    through which recipients can access the Corresponding Source.
*/

(function(){

    var jQ = jQuery.noConflict();
    
    /* document ready START */
    jQ(document).ready(function(){
        
        /* OverView elements init */
        overviewNavbarSettings();
        overviewNavbarAdjust();
        /* re-adjust on window resize */
        jQ(window).resize(function(){
            overviewNavbarAdjust();
        });

        /* _s navbar settings */
        function overviewNavbarSettings(){

            /* WordPress menus and sub-menus */
            overviewNavabarMenus();

            /* create menus and sub-menus */
            function overviewNavabarMenus(){
                // http://www.jasong-designs.com/2016/06/30/hiding-and-showing-a-wordpress-menu-ii-javascript-only-please/
                /* Add buttons to the navigation menu */
                var windowWidth = window.innerWidth,
                    hasChildren = document.querySelectorAll( '.main-navigation .page_item_has_children' ),
                    hasChildrenLink = document.querySelectorAll( '.main-navigation .page_item_has_children > a' ),
                    customHasChildren = document.querySelectorAll( '.main-navigation .menu-item-has-children' ),
                    customHasChildrenLink = document.querySelectorAll( '.main-navigation .menu-item-has-children > a' );
                // For custom menus
                for ( var i = 0; i < customHasChildren.length; i++ ) {
                    // Add button HTML after each link that has the class .menu-item-has-children
                    customHasChildrenLink[i].insertAdjacentHTML( 'afterend', '<button class="overview-sub-menu-down-arrow"><i class="fa fa-sort-desc" aria-hidden="true"></i></button>' );
                }
                // For page menu fallback
                for ( var i2 = 0; i2 < hasChildren.length; i2++ ) {
                    // Add button HTML after each link that has the class .page_item_has_children
                    hasChildrenLink[i2].insertAdjacentHTML( 'afterend', '<button class="overview-sub-menu-down-arrow"><i class="fa fa-sort-desc" aria-hidden="true"></i></button>' );
                }
                
            }

            /* adjust sub-menu offsets on hover */
            jQ('li.page_item_has_children, li.menu-item-has-children').mouseenter(function(){
                subMenuHovering(this);
            }).mouseleave(function(){
                subMenuHovering(this);
            });
            // add/remove navigation classes on li hovering in order to access sub-menu items
            function subMenuHovering(thisEl){
                var itemSubMenus = jQ(thisEl).children('ul.sub-menu'),
                    //itemParentUl = jQ(thisEl).parent('ul.sub-menu'),
                    winWidth = jQ(window).innerWidth();

                /* if there are children sub-menus */
                if ( parseInt(itemSubMenus.length) > 0 ){
                    itemSubMenus.each(function(){
                        setupSubMenu(jQ(this));
                    });
                }

                /* check for submenu position and assign navigation classes if needed */
                function setupSubMenu(thisElement){
                    var thisSubMenu = thisElement,
                        subMenuWidth = thisSubMenu.outerWidth(),
                        subMenuOffset = thisSubMenu.offset();
                    /* if sub-menu X offset + width > window width */
                    if (subMenuOffset.left + subMenuWidth > winWidth){
                        //console.log('Total width:\n', subMenuOffset.left + subMenuWidth, '\nWin width:\n', winWidth, '\nElement:\n', thisSubMenu);
                        /* if navbar is NOT toggled */
                        if ( ! jQ('nav#site-navigation').hasClass('toggled')){
                            thisSubMenu.addClass('flipped-menu');
                            //jQ('head').append('<style id="overview-navigation-extra-styles">.flipped-menu{}</style>');
                        }
                        /* if navbar IS toggled */
                        else {
                            thisSubMenu.addClass('flipped-mobile-menu');
                        }
                    }
                    else {
                        if (thisSubMenu.hasClass('flipped-menu')){
                            thisSubMenu.removeClass('flipped-menu');
                        }
                        if (thisSubMenu.hasClass('flipped-mobile-menu')){
                            thisSubMenu.removeClass('flipped-mobile-menu');
                        }
                    }
                }
                
            }
            
            /*
            // reset focus on clicks outside navbar
            jQ('body *').click(function(el){
                var OVContainer, OVButton, OVMenu;
                OVContainer = document.getElementById( 'site-navigation' );
	        if ( ! OVContainer ) {
		    return;
	        }
	        OVButton = OVContainer.getElementsByTagName( 'button' )[0];
	        if ( 'undefined' === typeof OVButton ) {
		    return;
	        }
                OVMenu = OVContainer.getElementsByTagName( 'ul' )[0];

                // if toggled and target is NOT the menu-toggle switch
                if ( jQ('nav#site-navigation').hasClass('toggled') && el.target != OVContainer.getElementsByTagName( 'button' )[0] ){

                    // _s original function
		    if ( -1 !== OVContainer.className.indexOf( 'toggled' ) ) {
			OVContainer.className = OVContainer.className.replace( ' toggled', '' );
			OVButton.setAttribute( 'aria-expanded', 'false' );
			OVMenu.setAttribute( 'aria-expanded', 'false' );
		    } else {
			OVContainer.className += ' toggled';
			OVButton.setAttribute( 'aria-expanded', 'true' );
			OVMenu.setAttribute( 'aria-expanded', 'true' );
		    }

                    resetFocus();
                }
                // reset focus on menu toggle
                if ( el.target == OVContainer.getElementsByTagName( 'button' )[0] && ! jQ('nav#site-navigation').hasClass('toggled') ){
                    resetFocus();
                }

                // focus reset
                function resetFocus(){
                    var OVFocusReset = document.activeElement;
                    jQ(OVFocusReset).blur();
                }
            });
             */
            
        }
        
        /* _s navbar adjustments */
        function overviewNavbarAdjust(){
            var OVMenuHeight = jQ('nav#site-navigation div').height(),
                OVSiteLogoHeight = ( OVMenuHeight === 0 ) ? '42px' : OVMenuHeight + 'px',
                OVNavbarHeight = jQ('nav#site-navigation').outerHeight() +'px';
            /* navbar logo height */
            jQ('nav#site-navigation a#overview-navbar-site-logo').css({
                height: OVSiteLogoHeight
            });
            jQ('nav#site-navigation a#overview-navbar-site-logo img').css({
                maxWidth: jQ(this).parent('a#overview-navbar-site-logo').width() + 'px',
                maxHeight: OVSiteLogoHeight
            });
            /* body margin from navbar */
            jQ('body').css({
                marginTop: OVNavbarHeight
            });
            
        }
        
    });
    /* document ready END */
    
})();
