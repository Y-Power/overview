<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package OverView
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function overview_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
	$classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
	$classes[] = 'hfeed';
    }

    return $classes;
}
add_filter( 'body_class', 'overview_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function overview_pingback_header() {
    if ( is_singular() && pings_open() ) {
	echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'overview_pingback_header' );

/**
 * Assign icons to social menu links.
 */
function overview_social_nav_menu_icons( $item_output, $item, $depth, $args ) {
    /**
     * Define social icons.
     */
    $overview_social_icons_set = array(
        'facebook'       => 'facebook-square',
        'twitter'        => 'twitter-square',
        'youtube'        => 'youtube-square',
        'github'         => 'github-square',
        'google'         => 'google-plus-square',
        'linkedin'       => 'linkedin-square',
        'pinterest'      => 'pinterest-square',
        'reddit'         => 'reddit-square',
        'steam'          => 'steam-square',
        'tumblr'         => 'tumblr-square',
        'bandcamp'       => 'bandcamp',
        'flickr'         => 'flickr',
        'instagram'      => 'instagram',
        'trello'         => 'trello',
        'twitch'         => 'twitch',
        'slack'          => 'slack',
        'soundcloud'     => 'soundcloud',
        'skype'          => 'skype',
        'snapchat'       => 'snapchat',
        'spotify'        => 'spotify',
        'telegram'       => 'telegram',
        'stackexchange'  => 'stack-exchange',
        'stackoverflow'  => 'stackoverflow',
        'tripadvisor'    => 'tripadvisor',
        'viadeo'         => 'viadeo',
        'vimeo'          => 'vimeo',
        'yahoo'          => 'yahoo',
        'whatsapp'       => 'whatsapp',
        'wordpress'      => 'wordpress'
    );
    // check and setup menu
    if ( 'ov-social-menu-1' === $args->theme_location ) {
        // check service url and output the relevant icon
        foreach ( $overview_social_icons_set as $ov_social_link_attr => $ov_social_attr_value ) {
            if ( false !== strpos( $item_output, $ov_social_link_attr ) ) {
                $item_output = str_replace( $args->link_after, '<div class="overview-social-nav-icon"><i class="fa fa-3x fa-' . esc_attr( $ov_social_attr_value ) . '"></i></div>', $item_output  );
            }
        }        
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'overview_social_nav_menu_icons', 10, 4 );
