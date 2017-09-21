<?php
/**
 * OverView Custom Header
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package OverView
 */

/**
 * Set up the WordPress core custom header feature.
 */
function overview_custom_header_setup() {
    $ov_default_site_color = overview_get_site_title_color();
    $ov_site_title_color_default_check = overview_custom_site_title_color_check();
    if ( true === $ov_site_title_color_default_check ) {
        // if it is a default value, update theme setting
        set_theme_mod( 'header_textcolor', $ov_default_site_color );
    }
    add_theme_support( 'custom-header', apply_filters( 'overview_custom_header_args', array(
	'default-image'          => '',
	'default-text-color'     => overview_get_site_title_color(),
	'width'                  => 1980,
	'height'                 => 480,
	'flex-height'            => true
    ) ) );
}
add_action( 'after_setup_theme', 'overview_custom_header_setup' );
