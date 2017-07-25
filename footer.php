<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OverView
 */

?>

	</div><!-- #content -->

<?php 
        if ( is_page_template('overview-front-page-after-content.php') ){
            get_template_part( 'template-parts/overview-display' );
        }
?>
        
	<footer id="colophon" class="site-footer overview-footer-container" role="contentinfo">
            <?php 
            /* OverView social links menu */
            if ( has_nav_menu( 'ov-social-menu-1' ) ){
                wp_nav_menu( array(
                    'theme_location' => 'ov-social-menu-1',
                    'menu_id'        => 'ov-social-menu',
                    'before'         => '<div class="overview-social-nav-link">',
                    'link_after'     => '<div class="overview-default-social-icon"><i class="fafa-share-alt fa-3x"></i></div>',
                    'after'          => '</div>'
                )
                );
            }
            /* OverView footer widgets */
            if ( is_active_sidebar( 'ov-footer-1' ) ){?>
                <div class="overview-footer-widgets-container">
                    <?php dynamic_sidebar( 'ov-footer-1' ); ?>
                </div>
            <?php }
            ?>
	    <div class="site-info">
                <div class="overview-footer-info-separator"></div>
		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'overview' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'overview' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'overview' ), 'OverView', '<a href="http://ypower.nouveausiteweb.fr/" rel="designer">_Y_Power</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
