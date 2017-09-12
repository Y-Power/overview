<?php
/**
 * OverView Theme Customizer
 *
 * @package OverView
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function overview_customize_register( $wp_customize ) {

    /* OverView WordPress customizer SETTINGS */

    // site branding
    $wp_customize->add_setting( 'overview_site_branding_description', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => __( 'Use this space to describe your story, mission, branding and more in a longer form', 'overview' ),
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_textarea'
    ) );

    // body main color
    $wp_customize->add_setting( 'overview_custom_body_color', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '#404040',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );
    
    // colors themes
    $wp_customize->add_setting( 'overview_colors_theme', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => 'iced_lake',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );

    // layouts
    $wp_customize->add_setting( 'overview_layout', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => 'fixed',
        'transport'         => 'refresh',
        'sanitize_callback' => function( $overview_chosen_layout ){
            $overview_layout_options = [ 'fixed', 'full' ];
            $overview_chosen_layout = trim( $overview_chosen_layout );
            $overview_layout_ouput;
            for ( $ov_i = 0; $ov_i < 2; $ov_i++ ){
                if ( $overview_layout_options[$ov_i] === $overview_chosen_layout ){
                    $overview_layout_ouput = $overview_layout_options[$ov_i];
                }
            }
            if ( null === $overview_layout_ouput ){
                $overview_layout_ouput = 'fixed';
            }
            return $overview_layout_ouput;
        }
    ) );

    // sidebar layout
    $wp_customize->add_setting( 'overview_sidebar_layout', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => 'right',
        'transport'         => 'refresh',
        'sanitize_callback' => function( $overview_chosen_sidebar_layout ){
            $overview_sidebar_layout_options = [ 'right', 'left' ];
            $overview_chosen_sidebar_layout = trim( $overview_chosen_sidebar_layout );
            $overview_sidebar_layout_ouput;
            for ( $ov_i = 0; $ov_i < 2; $ov_i++ ){
                if ( $overview_sidebar_layout_options[$ov_i] === $overview_chosen_sidebar_layout ){
                    $overview_sidebar_layout_ouput = $overview_sidebar_layout_options[$ov_i];
                }
            }
            if ( null === $overview_sidebar_layout_ouput ){
                $overview_sidebar_layout_ouput = 'right';
            }
            return $overview_sidebar_layout_ouput;
        }
    ) );    
    
    // custom fonts
    $wp_customize->add_setting( 'overview_custom_font', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_textarea'
    ) );

    // body font size
    $wp_customize->add_setting( 'overview_body_font_size', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '18px',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_attr'
    ) );

    // entry titles alignment
    $wp_customize->add_setting( 'overview_titles_alignment', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => 'inherit',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );

    // front page template description
    $wp_customize->add_setting( 'overview_front_page_title', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_textarea'
    ) );

    // front page template display background
    $wp_customize->add_setting( 'overview_display_bright_background', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );

    // front page template image rotatation
    $wp_customize->add_setting( 'overview_display_image_rotation', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );

    // show WordPress credits
    $wp_customize->add_setting( 'overview_wp_credits', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );

    // show OverView credits
    $wp_customize->add_setting( 'overview_ov_credits', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );
    
    // OverView site copyright
    $wp_customize->add_setting( 'overview_site_copyright', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '1',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_attr'
    ) );    
    
    // OverView about
    $wp_customize->add_setting( 'overview_about', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_textarea'
    ) );    
    

    /* OverView WordPress customizer SECTIONS */
    
    // general options
    $wp_customize->add_section( 'overview_options', array(
        'title'       => __( 'OverView options', 'overview' ),
        'description' => '<em>' . __( 'Note: if the page you are previewing has an active OverView Display page template, the OverView Display settings will be shown below the footer copyright option', 'overview' ) . '</em>',
        'priority'    => 80,
        'capability'  => 'edit_theme_options'
    ) );

    // about ' . esc_url( 'https://wordpress.org/support/theme/handcraft-expo/reviews/#new-post' ) . '
    $wp_customize->add_section( 'overview_about_section', array(
        'title'       => __( 'About', 'overview' ),
        'description' => __( 'Thank you for using OverView, a completely free (as in FREEDOM) WordPress theme!', 'overview' ) . '<ul><br /><strong><em>' . __( 'Some useful links', 'overview' ) . '</em></strong><li><a href="' . esc_url( 'https://codex.wordpress.org/Themes' ) . '">' . __( 'using WordPress themes', 'overview' ) . '</a></li><li><a href="' . esc_url( 'https://wordpress.org/support/theme/overview' ) .'">' . __( 'OverView support forum', 'overview' ) . '</a></li><li><a href="' . esc_url( 'https://wordpress.org/support/' ) .'">' . __( 'WordPress support', 'overview' ) . '</a></li><li><a href="' . esc_url( 'https://codex.wordpress.org/Child_Themes' ) . '">' . __( 'WordPress child themes', 'overview' ) . '</a></li><li><a href="' . esc_url( 'https://wordpress.org/support/theme/overview/reviews/#new-post' ) . '">' . __( 'rate OverView', 'overview' ) . '</a></li></ul><br />' . __( 'You can learn more about the wonderful world of Free Software and why it matters to you by visting the', 'overview' ) . ' <a href="' . esc_url( 'http://www.fsf.org/about/what-is-free-software' ) . '">' . __( 'Free Software Foundation', 'overview' ) . '</a>.',
        'priority'    => 220,
        'capability'  => 'edit_theme_options'
    ) );
    
    /* OverView WordPress customizer CONTROLS */

    // site branding
    $wp_customize->add_control( 'overview_site_branding_description', array(
        'type'        => 'textarea',
        'priority'    => 40,
        'section'     => 'title_tagline',
        'label'       => __( 'Site branding description', 'overview' ),
        'description' => __( 'Describe your brand and/or mission', 'overview' ),
        'input_attrs' => array(
            'class'      => 'overview-site-branding-description-text',
            'style'      => 'border: 1px solid gray;'
        ),
    ) );

    // main body color
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overview_custom_body_color', array(
        'label'    => __( 'Font color', 'overview' ),
        'section'  => 'colors',
        'priority' => 5
    ) ) );
    
    // colors themes    
    $wp_customize->add_control( 'overview_colors_theme', array(
        'type'        => 'select',
        'priority'    => 10,
        'section'     => 'colors',
        'label'       => __( 'Colors scheme', 'overview' ),
        'description' => __( 'Choose your website colors set', 'overview' ),
        'input_attrs' => array(
            'class'      => 'overview-colors-themes',
            'style'      => 'border: 1px solid gray;'
        ),
        'choices' => array(
            'iced_lake'           => __( 'Iced Lake' , 'overview' ),
            'amazon_rainforest'   => __( 'Amazon Rainforest' , 'overview' ),
            'chessnuts_field'     => __( 'Chessnuts Field' , 'overview' ),
            'terracotta_road'     => __( 'Terracotta Road' , 'overview' ),
            'japanese_maple_hill' => __( 'Japanese Maple Hill' , 'overview' ),
            'sunset_desert'       => __( 'Sunset Desert' , 'overview' ),
            'orchid_cliff'        => __( 'Orchid Cliff' , 'overview' ),
            'lavander_island'     => __( 'Lavander Island' , 'overview' ),
            'mariana_trench'      => __( 'Mariana Trench' , 'overview' ),
            'countryside_oasis'   => __( 'Countryside Oasis' , 'overview' ),
        )
    ) );

    // custom font
    $wp_customize->add_control( 'overview_custom_font', array(
        'type'        => 'text',
        'priority'    => 20,
        'section'     => 'overview_options',
        'label'       => __( 'Google&reg; font', 'overview' ),
        'description' => '<a href="' . esc_url( 'https://fonts.google.com' ) . '" target="_blank">' . __( 'See all available Google fonts', 'overview' ) . '</a><br /><p><strong>' . __( 'Google is a registred trademark and belongs to its owners.', 'overview' ) . '</strong></p><p>' . __( 'OverView\'s default font is ', 'overview' ) . '<a href="' . esc_url( 'https://fonts.google.com/specimen/Muli' ) . '" target="_blank">Muli</a>. '. __( 'Enter the name of the Google font you have picked here:', 'overview' ) .'</p>',
        'input_attrs' => array(
            'id'         => 'overview-custom-font-text-input',
            'style'      => 'border: 1px solid gray;'
        ),
    ) );

    // layout
    $wp_customize->add_control( 'overview_layout', array(
        'type'        => 'radio',
        'priority'    => 10,
        'section'     => 'overview_options',
        'label'       => __( 'Choose layout', 'overview' ),
        'input_attrs' => array(
            'class'      => 'overview-layouts',
            'style'      => 'border: 1px solid gray;'
        ),
        'choices' => array(
            'fixed' => __( 'Fixed' , 'overview' ),
            'full'  => __( 'Full-width' , 'overview' )
        )
    ) );

    // sidebar layout
    $wp_customize->add_control( 'overview_sidebar_layout', array(
        'type'            => 'radio',
        'priority'        => 10,
        'section'         => 'overview_options',
        'label'           => __( 'Sidebar shown on', 'overview' ),
        'description'     => __( 'Note: older browsers may always show the sidebar on the right', 'overview' ),
        'input_attrs'     => array(
            'class'          => 'overview-layouts',
            'style'          => 'border: 1px solid gray;'
        ),
        'choices'         => array(
            'right'          => __( 'Right' , 'overview' ),
            'left'           => __( 'Left' , 'overview' )
        ),
        'active_callback' => function(){
            return is_active_sidebar( 'ov-sidebar-1' );
        }
    ) );
    
    // font-size
    $wp_customize->add_control( 'overview_body_font_size', array(
        'type'        => 'select',
        'priority'    => 15,
        'section'     => 'overview_options',
        'label'       => __( 'Main font size', 'overview' ),
        'description' => __( 'Note: OverView Display needs a page refresh after previewing changes', 'overview' ),
        'input_attrs' => array(
            'class'      => 'overview-main-font-size',
            'style'      => 'border: 1px solid gray;'
        ),
        'choices' => array(
            '14px' => __('14 Pixels', 'overview'),
            '15px' => __('15 Pixels', 'overview'),
            '16px' => __('16 Pixels', 'overview'),
            '17px' => __('17 Pixels', 'overview'),
            '18px' => __('18 Pixels', 'overview'),
            '19px' => __('19 Pixels', 'overview'),
            '20px' => __('20 Pixels', 'overview'),
            '21px' => __('21 Pixels', 'overview'),
            '22px' => __('22 Pixels', 'overview'),
            '23px' => __('23 Pixels', 'overview'),
            '24px' => __('24 Pixels', 'overview'),
        )
    ) );

    // 
    $wp_customize->add_control( 'overview_titles_alignment', array(
        'type'            => 'radio',
        'priority'        => 18,
        'section'         => 'overview_options',
        'label'           => __( 'Titles alignment', 'overview' ),
        'input_attrs'     => array(
            'class'          => 'overview-titles-alignment',
            'style'          => 'border: 1px solid gray;'
        ),
        'choices'         => array(
            'inherit'          => __( 'Standard' , 'overview' ),
            'center'           => __( 'Center' , 'overview' )
        )
    ) );

    // WordPress credits
    $wp_customize->add_control( 'overview_wp_credits', array(
        'type'        => 'checkbox',
        'priority'    => 23,
        'section'     => 'overview_options',
        'label'       => __( 'Show your support for WordPress!', 'overview' ),
        'input_attrs' => array(
            'class'       => 'overview-wp-credits-checkbox',
            'style'       => 'border: 1px solid gray;'
        )
    ) );

    // OverView credits
    $wp_customize->add_control( 'overview_ov_credits', array(
        'type'        => 'checkbox',
        'priority'    => 24,
        'section'     => 'overview_options',
        'label'       => __( 'Show your support for OverView!', 'overview' ),
        'input_attrs' => array(
            'class'       => 'overview-ov-credits-checkbox',
            'style'       => 'border: 1px solid gray;'
        )
    ) );

    // OverView site copyright
    $wp_customize->add_control( 'overview_site_copyright', array(
        'type'        => 'checkbox',
        'priority'    => 25,
        'section'     => 'overview_options',
        'label'       => __( 'Show footer copyright', 'overview' ),
        'input_attrs' => array(
            'class'       => 'overview-site-copyright-checkbox',
            'style'       => 'border: 1px solid gray;'
        )
    ) );

    
    // TEMPLATES ONLY CONTROLS
    
    // front page template display title
    $wp_customize->add_control( 'overview_front_page_title', array(
        'type'        => 'textarea',
        'priority'    => 30,
        'section'     => 'overview_options',
        'label'       => __( 'Detected an active "OverView Display" template for this page', 'overview' ),
        'description' => '<strong>' . __('Set the OverView Display\'s options', 'overview') . '</strong><br /><em>' . __( 'This section is only visible on pages with an active "OverView Display" template: you can change templates in the specific page\'s editor.', 'overview' ) . '</em><p>' . __( 'Display\'s title or description:', 'overview' ) . '</p>',
        'input_attrs' => array(
            'class'      => 'overview-front-template-title-text',
            'style'      => 'border: 1px solid gray;'
        ),
        'active_callback' => function () {
            return is_page_template( 'overview-front-page.php' ) || is_page_template( 'overview-front-no-content-page.php' ) || is_page_template( 'overview-front-page-after-content.php' );
        }
    ) );

    // front page template display background
    $wp_customize->add_control( 'overview_display_bright_background', array(
        'type'        => 'checkbox',
        'priority'    => 40,
        'section'     => 'overview_options',
        'label'       => __( 'Standard background', 'overview' ),
        'input_attrs' => array(
            'class'       => 'overview-front-template-bright-display-checkbox',
            'style'       => 'border: 1px solid gray;'
        ),
        'active_callback' => function () {
            return is_page_template( 'overview-front-page.php' ) || is_page_template( 'overview-front-no-content-page.php' ) || is_page_template( 'overview-front-page-after-content.php' );
        }
    ) );

    // overview_display_image_rotation
    $wp_customize->add_control( 'overview_display_image_rotation', array(
        'type'        => 'checkbox',
        'priority'    => 50,
        'section'     => 'overview_options',
        'label'       => __( 'Rotate featured images', 'overview' ),
        'description' => '<em>' . __('Note: NO rotation will be applied on smaller devices and effect changes angle at different screen sizes', 'overview') . '</em>',
        'input_attrs' => array(
            'class'       => 'overview-front-template-rotate-img-checkbox',
            'style'       => 'border: 1px solid gray;'
        ),
        'active_callback' => function () {
            return is_page_template( 'overview-front-page.php' ) || is_page_template( 'overview-front-no-content-page.php' ) || is_page_template( 'overview-front-page-after-content.php' );
        }
    ) );

    // about OverView
    $wp_customize->add_control( 'overview_about', array(
        'type'        => 'range',
        'priority'    => 10,
        'section'     => 'overview_about_section',
        'description' => '_Y_Power',
        'input_attrs' => array(
            'class'       => 'overview-hidden-about-control',
            'style'       => 'display: none;',
            'min'         => 1,
            'max'         => 1,
            'step'        => 1
        )
    ) );
    
    
    /* OverView WordPress customizer PARTIALS */
    
    // site branding
    $wp_customize->selective_refresh->add_partial( 'overview_site_branding_description', array(
        'selector' => '.site-branding-description-p',
        'container_inclusive' => false,
        'render_callback' => function() {
            echo get_theme_mod('overview_site_branding_description', __( 'Use this space to describe your story, mission, branding and more in a longer form', 'overview' ));
        }
    ) );
    
    // front page template title
    $wp_customize->selective_refresh->add_partial( 'overview_front_page_title', array(
        'selector' => '.overview-front-page-title',
        'container_inclusive' => false,
        'render_callback' => function() {
            echo get_theme_mod('overview_front_page_title', '');
        }
    ) );
    
    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
    $wp_customize->get_setting( 'background_image' )->transport  = 'postMessage';
    $wp_customize->get_control( 'custom_logo' )->description     = __( 'Note: OverView strongly suggests logos with a 16:9 ratio', 'overview' );
    //$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /* hide header color input */
    $wp_customize->remove_control('header_textcolor');
    
}
add_action( 'customize_register', 'overview_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function overview_customize_preview_js() {
    wp_enqueue_script( 'overview_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), 'jquery' );
}
add_action( 'customize_preview_init', 'overview_customize_preview_js' );
