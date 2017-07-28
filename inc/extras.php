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
        '@'                  => 'at',
        'facebook.com'       => 'facebook-square',
        'github.com'         => 'github-square',
        'last.fm'            => 'lastfm-square',
        'linkedin.com'       => 'linkedin-square',
        'ok.ru'              => 'odnoklassniki-square',
        'plus.google'        => 'google-plus-square',
        'pinterest.com'      => 'pinterest-square',
        'reddit.com'         => 'reddit-square',
        'steam.com'          => 'steam-square',
        'tumblr.com'         => 'tumblr-square',
        'twitter.com'        => 'twitter-square',
        'xing.com'           => 'xing-square',
        'youtube.com'        => 'youtube-square',
        'amazon.com'         => 'amazon',
        'bandcamp.com'       => 'bandcamp',
        'codepen.com'        => 'codepen',
        'deviantart.com'     => 'deviantart',
        'digg.com'           => 'digg',
        'dribble.com'        => 'dribble',
        'etsy.com'           => 'etsy',
        'forumbee.com'       => 'forumbee',
        'foursquare.com'     => 'foursquare',
        'freecodecamp.com'   => 'free-code-camp',
        'flickr.com'         => 'flickr',
        'instagram.com'      => 'instagram',
        'paypal.com'         => 'paypal',
        'producthunt.com'    => 'producthunt',
        'quora.com'          => 'quora',
        'ravelry.com'        => 'ravelry',
        'renren.com'         => 'renren',
        'scribd.com'         => 'scribd',
        'sellsy.com'         => 'sellsy',
        'slack.com'          => 'slack',
        'soundcloud.com'     => 'soundcloud',
        'skype.com'          => 'skype',
        'snapchat.com'       => 'snapchat',
        'spotify.com'        => 'spotify',
        'stackexchange.com'  => 'stack-exchange',
        'stackoverflow.com'  => 'stackoverflow',
        'stumbleupon.com'    => 'stumbleupon-circle',
        'telegram.com'       => 'telegram',
        'trello.com'         => 'trello',
        'tripadvisor.com'    => 'tripadvisor',
        'twitch.com'         => 'twitch',
        'vk.com'             => 'vk',
        'viadeo.com'         => 'viadeo',
        'vimeo.com'          => 'vimeo',
        'vine.com'           => 'vine',
        'wechat.com'         => 'wechat',
        'weibo.com'          => 'weibo',
        'weixin.com'         => 'weixin',
        'whatsapp.com'       => 'whatsapp',
        'wordpress'          => 'wordpress',
        'wpbeginner.com'     => 'wpbeginner',
        'wpexplorer.com'     => 'wpexplorer',
        'yahoo'              => 'yahoo',
        'yelp.com'           => 'yelp'
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
