/*
    Copyright (C) 2017 _Y_Power ( http://ypower.nouveausiteweb.fr )

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
        subMenusFormatSetup();
        overviewSocialNavSettings();
        /* re-adjust on window resize */
        jQ(window).resize(function(){
            overviewNavbarAdjust();
            subMenusFormatSetup();
        });

        /* WordPress Widgets */

        /* add tag-cloud link title */
        var overviewAllTagCloudsLinks = jQ('a.tag-cloud-link');
        if ( overviewAllTagCloudsLinks && overviewAllTagCloudsLinks.length > 0 ){
            overviewAllTagCloudsLinks.each(function(){
                jQ(this).attr('title', jQ(this).attr('aria-label'));
            });
        }

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
            var overviewAllParentsMenuItems = jQ('nav#site-navigation div ul > li.page_item_has_children, nav#site-navigation div ul > li.menu-item-has-children');
            overviewAllParentsMenuItems.on('mouseenter', subMenuHovering);
            overviewAllParentsMenuItems.on('mouseleave', subMenuHovering);
            /* show mobile sub-menus on button click */
            var overviewSubMenusButtons = overviewAllParentsMenuItems.children('button');
            overviewSubMenusButtons.on('click', subMenuMobileClick);
            
            // add/remove navigation classes on li hovering in order to access sub-menu items
            function subMenuHovering(thisEl){
                var itemSubMenus = jQ(thisEl.delegateTarget).children('ul.sub-menu'),
                    //itemParentUl = jQ(thisEl).parent('ul.sub-menu'),
                    winWidth = jQ(window).innerWidth();

                /* if there are children sub-menus */
                if ( parseInt(itemSubMenus.length) > 0 ){
                    itemSubMenus.each(function(){
                        setupSubMenuHovering(jQ(this));
                    });
                }
            }

            /* check for submenu position and assign navigation classes if needed */
            function setupSubMenuHovering(thisElement){
                var thisSubMenu = thisElement,
                    subMenuWidth = thisSubMenu.outerWidth(),
                    subMenuOffset = thisSubMenu.offset(),
                    winWidth = jQ(window).innerWidth();
                /* if sub-menu X offset + width > window width */
                if (subMenuOffset.left + subMenuWidth > winWidth){
                        thisSubMenu.addClass('flipped-menu');
                }
                else {
                    if (thisSubMenu.hasClass('flipped-menu')){
                        thisSubMenu.removeClass('flipped-menu');
                    }
                }
            }
            
        }

        /* OverView EXTRA ADJUSTMENTS functions */
        
        /* show/hide mobile sub-menu on button click */
        function subMenuMobileClick(clickEvent){
            if ( 'block' === jQ('.menu-toggle').css('display') ){
                var thisButton = jQ(clickEvent.delegateTarget);
                thisButton.siblings('ul.sub-menu').slideToggle(200);
            }
        }
        
        /* _s navbar adjustments */
        function overviewNavbarAdjust(){
            var OVMenuHeight = jQ('nav#site-navigation div').height(),
                OVSiteLogoHeight = ( jQ('nav#site-navigation.toggled') ) ? '42px' : OVMenuHeight + 'px',
                OVNavbarHeight = jQ('nav#site-navigation').outerHeight() + 'px';
            /* navbar logo height */
            jQ('nav#site-navigation a#overview-navbar-site-logo').css({
                height: OVSiteLogoHeight
            });
            jQ('nav#site-navigation a#overview-navbar-site-logo img').css({
                maxWidth: jQ(this).parent('a#overview-navbar-site-logo').width() + 'px',
                maxHeight: OVSiteLogoHeight
            });
            /* body margin from navbar */
            var OVMenu = jQ('nav#site-navigation');
            if ( 'none' === jQ('.menu-toggle').css('display') ){
                jQ('body').css({
                    marginTop: OVNavbarHeight
                });
            }
            else {
                jQ('body').css({
                    marginTop: '72px'
                });
            }            
        }

        /* setup sub-menu styles according to mobile/full layout */
        function subMenusFormatSetup(){
            var allNavMenuSubMenus = jQ('nav#site-navigation ul.sub-menu');
            // if mobile layout
            if ( 'block' === jQ('.menu-toggle').css('display') ){
                allNavMenuSubMenus.addClass('overview-mobile-navbar-sub-menu').slideUp(0);
            }
            // if full layout
            else {
                allNavMenuSubMenus.removeClass('overview-mobile-navbar-sub-menu').slideDown(0);
            }
        }
        
        /* OverView social nav menu */
        function overviewSocialNavSettings(){
            var allSocialLinks = jQ('ul#ov-social-menu > li > div > a');
            // hide all icons labels
            allSocialLinks.each(function(){
                jQ(this).context.title = jQ(this).context.childNodes[0].data;
                jQ(this).context.childNodes[0].data = '';
            });
        }
        
    });
    
    /* document ready END */
    
})();
