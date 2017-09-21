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

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
	'ov-menu-1'        => esc_html__( 'Primary', 'overview' ),
        'ov-social-menu-1' => esc_html__( 'Social', 'overview' )
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
	'default-color'      => 'ffffff',
	'default-image'      => '',
        'default-preset'     => 'fill',
        'default-size'       => 'cover',
        'default-position-x' => 'center',
        'default-position-y' => 'center',
        'default-repeat'     => 'no-repeat',
        'default-attachment' => 'fixed'
    ) ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /* OverView starter content */
    add_theme_support( 'starter_content', array(
        'posts' => array(
            'home' => array(
                'template' => 'overview-front-page.php'
            )
        ),
        'widgets' => array(
            'ov-sidebar-1' => array(
                'calendar',
                'search'
            ),
            'ov-footer-1' => array(
                'categories',
                'meta',
                'recent-posts'
            )
        ),
        'nav_menus' => array(
	    'ov-social-menu-1' => array(
	        'name'  => __( 'Social Menu', 'overview' ),
	        'items' => array(
		    'link_facebook',
		    'link_twitter',
                    'link_linkedin',
                    'link_youtube'
	        ),
	    )
        ),
        'theme_mods' => array(
            'overview_site_branding_description' => __( 'Use this space to describe your story, mission, branding and more in a longer form', 'overview' ),
	    'overview_front_page_title'          => __( 'Check here our latest activities!', 'overview' )
        )
    )
    );

}
endif;
add_action( 'after_setup_theme', 'overview_setup' );


/**
 * Set the content width in pixels, based on OverView's designs and stylesheets.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function overview_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'overview_content_width', 980 );
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
	'id'            => 'ov-sidebar-1',
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

/* check site title color for OverView color schemes default values */
function overview_custom_site_title_color_check(){
    /* OverView color schemes defaults */
    $overview_colors_schemes_title_hex_defaults = array(
        'iced_lake'           => '2369f2',
        'amazon_rainforest'   => '467658',
        'chessnuts_field'     => '817658',
        'terracotta_road'     => 'ad763c',
        'japanese_maple_hill' => 'bf3a3f',
        'sunset_desert'       => 'c3765e',
        'orchid_cliff'        => 'b676b0',
        'lavander_island'     => '8776bd',
        'mariana_trench'      => '455283',
        'countryside_oasis'   => '4f6124'
    );
    $ov_default_site_color = overview_get_site_title_color();
    $ov_site_title_color = get_theme_mod( 'header_textcolor', $ov_default_site_color );
    // check if color is scheme default
    $ov_site_title_color_default_check = false;
    // for all the color schemes
    foreach ( $overview_colors_schemes_title_hex_defaults as $ov_color_scheme => $ov_color_default ){
        // if a default color is found
        if ( $ov_color_default === $ov_site_title_color ){
            $ov_site_title_color_default_check = true;
        }
    }
    return $ov_site_title_color_default_check;
}

/* get site title custom color from OverView color scheme */
function overview_get_site_title_color(){
    $ov_chosen_color_scheme = get_theme_mod( 'overview_colors_theme', 'iced_lake' );
    switch ( $ov_chosen_color_scheme ) {
        case 'iced_lake':
            return '2369f2';
            break;
        case 'amazon_rainforest':
            return '467658';
            break;
        case 'chessnuts_field':
            return '817658';
            break;
        case 'terracotta_road':
            return 'ad763c';
            break;
        case 'terracotta_road':
            return 'ad763c';
            break;
        case 'japanese_maple_hill';
            return 'bf3a3f';
            break;
        case 'sunset_desert':
            return 'c3765e';
            break;
        case 'orchid_cliff':
            return 'b676b0';
            break;
        case 'lavander_island':
            return '8776bd';
            break;
        case 'mariana_trench':
            return '455283';
            break;
        case 'countryside_oasis':
            return '4f6124';
            break;
        default:
            return '2369f2';
    }
}

/* OverView custom font name */
function overview_get_custom_font_name($overview_font_name, $overview_pretty_print_check){
    $overview_font_name = trim( $overview_font_name );
    $overview_font_name = explode( " ", strtolower( $overview_font_name ) );
    // for each word in the font name
    for ( $wi = 0; $wi < count( $overview_font_name ); $wi++ ){
        // fonts exceptions
        if ( strlen( $overview_font_name[$wi] ) <= 2 ){
            // one-letter esceptions list
            if ( 'a' === $overview_font_name[$wi] ){
                $overview_font_name[$wi] = 'A';
            }
            // two-letters exceptions list
            else if ( 'do' === $overview_font_name[$wi] ){
                $overview_font_name[$wi] = 'Do';
            }
            else if ( 'by' === $overview_font_name[$wi] ){
                $overview_font_name[$wi] = 'By';
            }
            else if ( 'if' === $overview_font_name[$wi] ){
                $overview_font_name[$wi] = 'If';
            }
            else if ( '2p' === $overview_font_name[$wi] ){
                $overview_font_name[$wi] = '2P';
            }
            else if ( 'mr' === $overview_font_name[$wi] ){
                $overview_font_name[$wi] = 'Mr';
            }
            // default one/two letters exception
            else {
                $overview_font_name[$wi] = strtoupper( $overview_font_name[$wi] );
            }
        }
        // int exceptions
        else if ( $overview_font_name[$wi][0] === intval( $overview_font_name[$wi][0] ) ) {
            $overview_font_name[$wi] = $overview_font_name[$wi];
        }
        // ad-hoc exceptions
        else if ( 'abeezee' === $overview_font_name[$wi] ){
            $overview_font_name[$wi] = 'ABeeZee';
        }
        // if word lenght is => 3
        else {
            // three-letters exceptions
            if ( $overview_font_name[$wi] === 'the' ){
                $overview_font_name[$wi] = 'the';
            }
            else if ( $overview_font_name[$wi] === 'for' ){
                $overview_font_name[$wi] = 'for';
            }
            else if ( $overview_font_name[$wi] === 'ntr' ){
                $overview_font_name[$wi] = 'NTR';
            }
            else if ( $overview_font_name[$wi] === 'gfs' ){
                $overview_font_name[$wi] = 'GFS';
            }
            else if ( $overview_font_name[$wi] === 'vt323' ){
                $overview_font_name[$wi] = 'VT323';
            }
            else if ( $overview_font_name[$wi] === 'unifrakturmaguntia' ){
                $overview_font_name[$wi] = 'UnifrakturMaguntia';
            }
            // default font word output
            else {
                $overview_font_name[$wi] = strtoupper( mb_substr( $overview_font_name[$wi], 0, 1 ) ) . mb_substr( $overview_font_name[$wi], 1 );
            }
        }
    }
    // return desired output
    if ( 'pretty' === $overview_pretty_print_check ){
        return implode( " ", $overview_font_name );
    }
    else {
        return implode( "+", $overview_font_name );
    }
}

/* OverView Display check */
function overview_check_front_page_template(){
    $display_template_check = (
        is_page_template( 'overview-front-page.php' ) ||
        is_page_template( 'overview-front-no-content-page.php' ) ||
        is_page_template( 'overview-front-page-after-content.php' )
    ) ? true : false;
    return $display_template_check;
}

/* OverView copyright */
function overview_site_copyright(){
    $overview_copyright_years = ( mysql2date( 'Y', get_user_option('user_registered', 1 ) ) === date( 'Y' ) ) ? esc_attr( date( 'Y' ) ) : esc_attr( mysql2date( 'Y', get_user_option('user_registered', 1 ) ) ) . ' - ' . esc_attr( date( 'Y' ) );
    $overview_copyright_notice = ' ' . bloginfo( 'name' ) . $overview_copyright_years;
    echo esc_attr( $overview_copyright_notice );
}

/* OverView EXTRA HEAD STYLES */

/* OverView custom font */
function overview_custom_main_font_color(){
    $overview_custom_body_color = get_theme_mod( 'overview_custom_body_color', '#404040' );?>
    <style id="overview-custom-body-color-css">
     body, header#masthead div.site-branding p.site-description, header#masthead div.site-branding p.site-description, div.overview-indexed-content-main-container, article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img, div#comments, div.page-content, div.overview-sidebar-main-container section.widget {color: <?php echo esc_attr( $overview_custom_body_color ); ?>}
    </style>
<?php }
add_action( 'wp_head', 'overview_custom_main_font_color' );

/* OverView custom background / background color */
function overview_custom_background_styles(){
    $overview_custom_background_img = get_background_image();
    $overview_custom_body_color = get_theme_mod( 'overview_custom_body_color', '#404040' );
    $overview_custom_background_color = get_background_color();
    $overview_display_custom_background_check = get_theme_mod( 'overview_display_bright_background', '' );?>
    <style id="overview-custom-background-extra-css" type="text/css">
     body, header#masthead, .site-title, header#masthead div.site-branding p.site-description, div.overview-indexed-content-main-container, article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img, div#comments, div.page-content, div.overview-sidebar-main-container section.widget {background-color: #<?php echo esc_attr( $overview_custom_background_color ); ?>;}
     <?php if ( '' !== $overview_custom_background_img ){ ?>
     article.overview-standard-indexed-entry:not(.sticky),
     article.overview-standard-indexed-entry-no-featured-img:not(.sticky) {
         border-top: none;
         border-bottom: none;
         -webkit-box-shadow: 0 0 6px 0 #333;
         -moz-box-shadow: 0 0 6px 0 #333;
         -ms-box-shadow: 0 0 6px 0 #333;
         -o-box-shadow: 0 0 6px 0 #333;
         box-shadow: 0 0 6px 0 #333;
     }
     div.overview-sidebar-main-container {
         border-top: none;
         border-bottom: none;
     }
     .sticky {
         -webkit-box-shadow: 0 0 6px 0 #333 inset;
         -moz-box-shadow: 0 0 6px 0 #333 inset;
         -ms-box-shadow: 0 0 6px 0 #333 inset;
         -o-box-shadow: 0 0 6px 0 #333 inset;
         box-shadow: 0 0 6px 0 #333 inset;
     }
     <?php } ?>
    </style>
    <?php 
    // if OverView Display`s custom background is OFF
    if ( '' !== $overview_display_custom_background_check ){?>
        <style id="overview-custom-background-color-extra-css">
         div#overview-front-page-section-content-container, div#overview-front-page-posts-section-content {color: <?php echo esc_attr( $overview_custom_body_color ); ?>; background-color: #<?php echo esc_attr( $overview_custom_background_color ); ?>;}
        </style>
    <?php }
    // if OverView Display`s custom background is ON
    else {?>
        <style id="overview-custom-background-color-extra-css">
         div#overview-front-page-posts-section-content {color: #404040; background-color: #fff}
        </style>
    <?php }
    }
    // background extra CSS
    add_action( 'wp_head','overview_custom_background_styles' );

    /* site title color */
    function overview_custom_site_title_color(){
        $ov_default_site_color = overview_get_site_title_color();
        $ov_site_title_color = get_theme_mod( 'header_textcolor', $ov_default_site_color );
        $ov_site_title_color_default_check = overview_custom_site_title_color_check();
        if ( false === $ov_site_title_color_default_check ){?>
        <style id="overview-site-title-color-extra-css">
         header#masthead div.site-branding h1.site-title a, header#masthead div.site-branding p.site-title a,
         header#masthead div.site-branding h1.site-title a:hover, header#masthead div.site-branding p.site-title a:hover {
             color: #<?php echo esc_attr( $ov_site_title_color ); ?>;
         }
        </style>
    <?php }
    }
    add_action( 'wp_head', 'overview_custom_site_title_color' );
    
    /* custom font head extra style */
    function overview_add_custom_font_style() {
        if ( get_theme_mod( 'overview_custom_font', '' ) !== '' ){
            $overview_font_head_style = overview_get_custom_font_name( esc_attr( get_theme_mod( 'overview_custom_font', '' ) ), 'pretty'); ?>
        <style id="overview-custom-font-css" type="text/css">
         body {
             font-family: "<?php echo esc_attr( $overview_font_head_style ); ?>", sans-serif;
         }
        </style>
    <?php
    }
    }
    add_action( 'wp_head', 'overview_add_custom_font_style' );

    /* body font size */
    function overview_body_font_size() {
        if ( get_theme_mod( 'overview_body_font_size', '18px' ) !== '18px' ){ ?>
        <style id="overview-body-font-size" type="text/css">
         body {
             font-size: <?php echo esc_attr( get_theme_mod( 'overview_body_font_size', '18px' ) ); ?>;
         }
        </style>
    <?php
    }
    }
    add_action( 'wp_head','overview_body_font_size' );

    // OverView titles alignment
    function overview_titles_alignment(){
        $ov_titles_alignment = get_theme_mod( 'overview_titles_alignment', 'inherit' );
        if ( 'center' === $ov_titles_alignment ){?>
        <style type="text/css" id="overview-centered-titles">
         .entry-title {text-align:center;}
         <?php
         if ( is_single() || is_page() ){?>
         article.overview-standard-indexed-entry header.entry-header,
         article.overview-standard-indexed-entry-no-featured-img header.entry-header,
         .entry-header.overview-standard-indexed-entry-header {
             width: 100%;
         }
         .overview-single-post-entry-full-featured-image {
             text-align: center;
         }
         <?php }
         ?>
        </style>
    <?php }
    }
    add_action( 'wp_head', 'overview_titles_alignment' );
    
    // OverView left sidebar adjustments
    function overview_sidebar_extra_layout(){
        $overview_sidebar_side = get_theme_mod( 'overview_sidebar_layout', 'right' );
        if ( is_active_sidebar( 'ov-sidebar-1' ) && 'left' === $overview_sidebar_side ){ ?>
        <style type="text/css" id="overview-left-sidebar-adjustments">
         @supports (display: grid){
             @media screen and (min-width: 980px){
                 #content.overview-content-and-sidebar-layout {
                     grid-template-columns: 400px 1fr 1fr;
                     grid-template-areas: 'sidebar content content';
                 }   
             }
         }
        </style>
    <?php
    }
    }
    add_action( 'wp_head', 'overview_sidebar_extra_layout' );

    // OverView Displays extra adjustments
    function overview_displays_extra_adjustments(){
        $overview_display_check = overview_check_front_page_template();
        if ( $overview_display_check ){ ?>
        <style type="text/css" id="overview-display-extra-adjustments">
         <?php  
         if ( is_page_template( 'overview-front-page.php' ) ){ ?>
         
         article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img, div.overview-sidebar-main-container {
             border-top: none;
         }
         <?php }
         if ( is_page_template( 'overview-front-page-after-content.php' ) ){ ?>
         article.overview-standard-indexed-entry, article.overview-standard-indexed-entry-no-featured-img {
             border-bottom: none;
         }
         <?php } ?>
        </style>
    <?php }
    }
    add_action( 'wp_head', 'overview_displays_extra_adjustments' );

    /* OverView TinyMCE font */
    function overview_tinymce_custom_styles( $mceInit ) {
        $ov_custom_font_check = overview_get_custom_font_name( esc_attr( get_theme_mod( 'overview_custom_font', '' ) ), 'pretty');
        $overview_selected_font = ( $ov_custom_font_check ) === '' ? 'Muli' : $ov_custom_font_check;
        $overview_custom_body_color = get_theme_mod( 'overview_custom_body_color', '#404040' );
        $overview_selected_extra_styles = "body.mce-content-body { font-family: '" . $overview_selected_font . "', sans-serif; font-size: " . get_theme_mod( 'overview_body_font_size', '18px' ) . "; color: " . esc_attr( $overview_custom_body_color ) . "; background-color: #" . esc_attr( get_background_color() ) . ";}";
        if ( isset( $mceInit['content_style'] ) ) {
            $mceInit['content_style'] .= ' ' . $overview_selected_extra_styles . ' ';
        } else {
            $mceInit['content_style'] = $overview_selected_extra_styles . ' ';
        }
        return $mceInit;
    }
    add_filter('tiny_mce_before_init','overview_tinymce_custom_styles');

    /* OverView TinyMCE styles */
    function overview_add_editor_styles() {
        $ov_custom_font_check = overview_get_custom_font_name( esc_attr( get_theme_mod( 'overview_custom_font', '' ) ), 'not-pretty');
        $overview_selected_font = ( $ov_custom_font_check ) === '' ? 'Muli' : $ov_custom_font_check;
        $overview_selected_font_url = str_replace( ',', '%2C', 'https://fonts.googleapis.com/css?family=' . $overview_selected_font . ':300,400,500,600,700,800' );
        $ov_active_color_scheme = get_theme_mod( 'overview_colors_theme', 'iced_lake' );
        add_editor_style( array(
            $overview_selected_font_url,
            'style.css',
            '/css/color-schemes/overview-' . esc_attr( $ov_active_color_scheme ) . '.css',
            'css/overview-addons.css',
            'css/overview-editor-styles.css'
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
        $overview_custom_font_check = get_theme_mod( 'overview_custom_font', '' );
        $overview_custom_font_name = $overview_custom_font_check === '' ? 'Muli' : overview_get_custom_font_name( $overview_custom_font_check, 'not_pretty' );
        wp_enqueue_style( 'overview-google-font', 'https://fonts.googleapis.com/css?family=' . $overview_custom_font_name . ':400,500,600,700&effect=emboss|3d-float' );
        
        /* OverView styles */
        $ov_chosen_color_scheme = get_theme_mod( 'overview_colors_theme', 'iced_lake' );
        wp_enqueue_style( 'overview-style', get_template_directory_uri() . '/css/color-schemes/overview-' . esc_attr( $ov_chosen_color_scheme ) . '.css' );

        /* OverView addons styles */
        wp_enqueue_style( 'overview-style-addons', get_template_directory_uri() . '/css/overview-addons.css' );

        /* OverView Display addons */
        $overview_display_alt_img = get_theme_mod( 'overview_display_image_rotation', '1' );
        if ( '' !== $overview_display_alt_img ){
            wp_enqueue_style( 'overview-display-style-addons', get_template_directory_uri() . '/css/overview-display-alt-img.css' );
        }
        
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
        $overview_display_check = overview_check_front_page_template();
        if ( $overview_display_check ) {
            wp_enqueue_script( 'overview-display-scripts', get_template_directory_uri() . '/js/overview-display.js', array( 'jquery', 'underscore', 'backbone', 'wp-api' ) );
        }

        /* comments reply */
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        /* OverView Display templates resources */
        if ( $overview_display_check ){
            /* JS vars */
            $overview_JS_variables = array(
                /* site locale */
                'OVSiteLocale'        => get_locale(),
                /* custom logo url */
                'OVSiteLogo'          => overview_custom_logo(),
                /* set direction */
                'OVSiteDirection'     => is_rtl(),
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
            wp_localize_script( 'overview-scripts', 'OVAPIVars', $overview_JS_variables );
        }

        // admin
        if ( is_user_logged_in() && ! is_customize_preview() ){
            /* admin CSS */
            wp_enqueue_style( 'overview-admin-css', get_template_directory_uri() . '/css/overview-admin.css' );
        }
        
    }
    add_action( 'wp_enqueue_scripts', 'overview_scripts' );

    /**
     * Admin files
     */
    function overview_admin_files(){
        // admin JS
        wp_register_script( 'overview-admin-js', get_template_directory_uri() . '/js/admin/overview-admin.js', array( 'jquery', 'customize-controls' ) );
        // enqueue
        wp_enqueue_script( 'overview-admin-js' );
    }
    add_action( 'admin_enqueue_scripts', 'overview_admin_files' );

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
