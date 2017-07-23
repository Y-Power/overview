<?php
/**
 * OverView functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OverView
 */

if ( ! function_exists( 'overview_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function overview_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on OverView, use a find and replace
     * to change 'overview' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'overview', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
	'menu-1' => esc_html__( 'Primary', 'overview' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
    ) );

    // Set up WordPress logo feature.
    add_theme_support( 'custom-logo', array(
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'overview_custom_background_args', array(
	'default-color' => 'ffffff',
	'default-image' => '',
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'overview_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function overview_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'overview_content_width', 640 );
}
add_action( 'after_setup_theme', 'overview_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function overview_widgets_init() {
    register_sidebar( array(
	'name'          => esc_html__( 'Sidebar', 'overview' ),
	'id'            => 'sidebar-1',
	'description'   => esc_html__( 'Add sidebar widgets here.', 'overview' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	'after_widget'  => '</section>',
	'before_title'  => '<h2 class="widget-title">',
	'after_title'   => '</h2>',
    ) );

    /* OverView footer widgets */
    register_sidebar( array(
	'name'          => esc_html__( 'Footer', 'overview' ),
	'id'            => 'ov-footer-1',
	'description'   => esc_html__( 'Add footer widgets here.', 'overview' ),
	'before_widget' => '<section id="%1$s" class="widget %2$s overview-footer-widget">',
	'after_widget'  => '</section>',
	'before_title'  => '<h2 class="widget-title footer-widget-title">',
	'after_title'   => '</h2>',
    ) );    
}
add_action( 'widgets_init', 'overview_widgets_init' );


/* retrieve logo */
function overview_custom_logo() {
    $overview_custom_logo_id = get_theme_mod( 'custom_logo' );
    $overview_custom_logo_image = wp_get_attachment_image_src( $overview_custom_logo_id , 'full' );
    return esc_url($overview_custom_logo_image[0]);
}

/* OverView TinyMCE styles */
function overview_add_editor_styles(){
    $ov_active_color_scheme = get_theme_mod( 'overview_colors_theme', 'iced_lake' );
    add_editor_style( array(
        'https://fonts.googleapis.com/css?family=Muli',
        'style.css',
        '/css/color-schemes/overview-' . esc_attr( $ov_active_color_scheme ) . '.css'
    ) );
}
add_action( 'admin_init', 'overview_add_editor_styles' );


/**
 * Enqueue scripts and styles.
 */
function overview_scripts() {
    
    /* Font Awesome */
    wp_enqueue_style( 'overview-font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css' ); // Font Awesome by Dave Gandy - http://fontawesome.io

    /* OverView core main styles (WP and _s) */
    wp_enqueue_style( 'overview-core-style', get_stylesheet_uri() );

    /* OverView Google font */
    wp_enqueue_style( 'overview-google-font', 'https://fonts.googleapis.com/css?family=Muli' );
    
    /* OverView styles */
    $ov_chosen_color_scheme = get_theme_mod( 'overview_colors_theme', 'iced_lake' );
    wp_enqueue_style( 'overview-style', get_template_directory_uri() . '/css/color-schemes/overview-' . esc_attr( $ov_chosen_color_scheme ) . '.css' );

    /* OverView addons styles */
    wp_enqueue_style( 'overview-style-addons', get_template_directory_uri() . '/css/overview-addons.css' );
    
    /* OverView Layout */
    $overview_layout_check = get_theme_mod( 'overview_layout', 'fixed' );
    if ( $overview_layout_check === 'fixed' ){
        wp_enqueue_style( 'overview-style-layout', get_template_directory_uri() . '/css/overview-fixed-layout.css' );
    }
    
    /* _s navigation script */
    wp_enqueue_script( 'overview-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    /* _s skip link focus fix */
    wp_enqueue_script( 'overview-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    /* OverView scripts */
    wp_enqueue_script( 'overview-scripts', get_template_directory_uri() . '/js/overview.js', array( 'jquery' ) );

    /* OverView Display scripts */
    if ( is_page_template('overview-front-page.php') || is_page_template('overview-front-no-content-page.php') ){
        wp_enqueue_script( 'overview-display-scripts', get_template_directory_uri() . '/js/overview-display.js', array( 'jquery', 'underscore', 'backbone', 'wp-api' ) );
    }

    /* comments reply */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
    }

    /* front page template check */
    if ( is_page_template('overview-front-page.php') || is_page_template('overview-front-no-content-page.php') ){
        /* JS vars */
        $overview_JS_variables = array(
            /* site locale */
            'OVSiteLocale'        => get_locale(),
            /* custom logo url */
            'OVSiteLogo'          => overview_custom_logo(),
            /* local language calendar */
            'OVLocalLangCalendar' => array(
                '01'                    => __('January', 'overview'),
                '02'                    => __('February', 'overview'),
                '03'                    => __('March', 'overview'),
                '04'                    => __('April', 'overview'),
                '05'                    => __('May', 'overview'),
                '06'                    => __('June', 'overview'),
                '07'                    => __('July', 'overview'),
                '08'                    => __('August', 'overview'),
                '09'                    => __('September', 'overview'),
                '10'                    => __('October', 'overview'),
                '11'                    => __('November', 'overview'),
                '12'                    => __('December', 'overview')
            )
        );
        wp_localize_script('overview-scripts', 'OVAPIVars', $overview_JS_variables);
    }

    // admin
    if ( is_user_logged_in() && ! is_customize_preview() ){
        /* admin JS */
        wp_enqueue_style( 'overview-admin-css', get_template_directory_uri() . '/css/overview-admin.css' );
    }
    
}
add_action( 'wp_enqueue_scripts', 'overview_scripts' );

/**
 * Custom Header
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * OverView custom template tags
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * OverView custom functions that act independently of the theme templates
 */
require get_template_directory() . '/inc/extras.php';

/**
 * OverView Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file
 */
require get_template_directory() . '/inc/jetpack.php';
