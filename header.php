<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OverView
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="site">
	    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'overview' ); ?></a>

            <!-- OverView master header -->
	    <header id="masthead" class="site-header" role="banner">

                <!-- OverView site navigation -->
	        <nav id="site-navigation" class="main-navigation" role="navigation">
                    <!-- OverView site logo -->
                    <a id="overview-navbar-site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php
                        if ( get_theme_mod( 'custom_logo' ) ) {?>
                            <img alt="<?php esc_attr( __('site logo image', 'overview') ); ?>" src="<?php echo overview_custom_logo(); ?>" />
                        <?php }
                        else {?>
                            <p class="overview-navbar-nologo-fallback"><?php bloginfo( 'name' ); ?></p>
                        <?php }
                        ?></a>
		        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars fa-2x" aria-hidden="true" title="<?php esc_attr( __('Toggle Menu', 'overview') ); ?>"></i><?php //esc_html_e( 'Primary Menu', 'overview' ); //overview removed default ?></button>
		    <?php wp_nav_menu( array( 'theme_location' => 'ov-menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
                
                <!-- OverView header image -->
                <div id="overview-header-image-container">
                    <?php the_header_image_tag(); ?>
                </div>

                <!-- OverView site branding -->
	        <div class="site-branding">
                    <?php if ( is_front_page() && is_home() ) : ?>
		        <h1 class="site-title"><a class="overview-site-title-a" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		    <?php else : ?>
		        <p class="site-title"><a class="overview-site-title-a" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		    <?php
		    endif;

		    $description = get_bloginfo( 'description', 'display' );
		    if ( $description || is_customize_preview() ) : ?>
		        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
		    <?php
		    endif;
                    ?>
	        </div><!-- .site-branding -->

                <?php
                $overview_site_branding_description_text = get_theme_mod('overview_site_branding_description');
                if ( $overview_site_branding_description_text !== '' ){ ?>
                    <!-- OverView site branding description -->
                    <p class="site-branding-description-p">
                        <?php echo esc_textarea( get_theme_mod('overview_site_branding_description', '') ); ?>
                    </p>
                <?php }
                ?>
                
	    </header><!-- #masthead -->

<?php 
            if ( is_page_template('overview-front-page.php') || is_page_template('overview-front-no-content-page.php') ){
            get_template_part( 'template-parts/overview-display' );
            }
?>
            
	    <div id="content" class="site-content
                     <?php 
                     if ( is_active_sidebar('ov-sidebar-1') ){
                         echo ' overview-content-and-sidebar-layout'; 
                     }
                     ?>
                     ">
