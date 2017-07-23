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
		    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
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

                $overview_front_page_title_check = get_theme_mod( 'overview_front_page_title', '' );
                if ( '' !== $overview_front_page_title_check ){?>
                <h2 class="overview-front-page-title"><?php echo esc_textarea( $overview_front_page_title_check ); ?></h2>
            <?php  }?>
            <!-- overview POSTS main container START -->
            <div id="overview-front-page-posts-section-container" class="overview-single-box-container
                     <?php 
                     $overview_display_background_option = esc_attr( get_theme_mod( 'overview_display_bright_background', '' ) );
                     if ( ! $overview_display_background_option ){
                         echo 'overview-dark-display';
                     }
                     else {
                         echo 'overview-bright-display';
                     }
                     ?>
                     ">

                <!-- overview splash screen -->
                <div id="overview-front-page-posts-section-splash-screen" class="overview-single-box-container-splash-screen overview-splash-active"></div>

                <?php while ( have_posts() ) : the_post(); // Begin the Loop ?>

	            <!-- overview posts display (Backbone posts model element) -->
	            <div id="overview-front-page-section-content-container" class="overview-front-page-display-container"></div>

                <?php 
                endwhile; // End the loop.
                ?>
                
            </div>
            <!-- overview POSTS main container END -->

            <!-- overview POSTS navigation START -->
            <div class="overview-front-page-display-navigation-container">
                <div class="overview-front-page-display-navigation">
	            <div class="overview-front-page-display-navigation-prev">
	                <button id="overview-front-page-display-navigation-prev-button"><i class="fa fa-2x fa-angle-left" aria-hidden="true"></i></button>
	            </div>
	            <div class="overview-front-page-display-navigation-next">
	                <button id="overview-front-page-display-navigation-next-button"><i class="fa fa-2x fa-angle-right" aria-hidden="true"></i></button>
	            </div>
                </div>
            </div>
            <!-- overview POSTS navigation END -->

            <?php } ?>
            
	    <div id="content" class="site-content 
                     <?php 
                     if ( is_active_sidebar('sidebar-1') ){
                         echo 'overview-content-and-sidebar-layout'; 
                     }
                     ?>
                     ">
