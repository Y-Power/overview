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
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'esc_textarea'
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
        'sanitize_callback' => 'esc_textarea'
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
        'sanitize_callback' => 'esc_textarea'
    ) );
    

    /* OverView WordPress customizer SECTIONS */
    
    // general options
    $wp_customize->add_section( 'overview_options', array(
        'title' => esc_html__( 'OverView options', 'overview' ),
        //'panel' => '',
        'priority' => 80,
        'capability' => 'edit_theme_options',
        //'theme_supports' => '',
    ) );

    
    /* OverView WordPress customizer CONTROLS */

    // site branding
    $wp_customize->add_control( 'overview_site_branding_description', array(
        'type' => 'textarea',
        'priority' => 40,
        'section' => 'title_tagline',
        'label' => esc_html__( 'Site branding description', 'overview' ),
        'description' => esc_html__( 'Describe your brand and/or mission', 'overview' ),
        'input_attrs' => array(
            'class' => 'overview-site-branding-description-text',
            'style' => 'border: 1px solid gray;'
        ),
    ) );

    // colors themes    
    $wp_customize->add_control( 'overview_colors_theme', array(
        'type' => 'select',
        'priority' => 10,
        'section' => 'colors',
        'label' => esc_html__( 'Colors scheme', 'overview' ),
        'description' => esc_html__( 'Choose your website colors set', 'overview' ),
        'input_attrs' => array(
            'class' => 'overview-colors-themes',
            'style' => 'border: 1px solid gray;'
        ),
        'choices' => array(
            'iced_lake'           => esc_html__( 'Iced Lake' , 'overview' ),
            'amazon_rainforest'   => esc_html__( 'Amazon Rainforest' , 'overview' ),
            'chessnuts_field'     => esc_html__( 'Chessnuts Field' , 'overview' ),
            'terracotta_road'     => esc_html__( 'Terracotta Road' , 'overview' ),
            'japanese_maple_hill' => esc_html__( 'Japanese Maple Hill' , 'overview' ),
            'sunset_desert'       => esc_html__( 'Sunset Desert' , 'overview' ),
            'orchid_cliff'        => esc_html__( 'Orchid Cliff' , 'overview' ),
            'lavander_island'     => esc_html__( 'Lavander Island' , 'overview' ),
            'mariana_trench'      => esc_html__( 'Mariana Trench' , 'overview' ),
            'countryside_oasis'   => esc_html__( 'Countryside Oasis' , 'overview' ),
        )
    ) );

    // custom font
    $wp_customize->add_control( 'overview_custom_font', array(
        'type' => 'text',
        'priority' => 20,
        'section' => 'overview_options',
        'label' => esc_html__( 'Google&reg; font', 'overview' ),
        'description' => '<a href="https://fonts.google.com" target="_blank">' . esc_html__( 'See all available Google fonts', 'overview' ) . '</a><br /><p><strong>' . esc_html__( 'Google is a registred trademark and belongs to its owners.', 'overview' ) . '</strong></p><p>' . esc_html__( 'OverView\'s default font is ', 'overview' ) . '<a href="https://fonts.google.com/specimen/Muli" target="_blank">Muli</a>. '. esc_html( 'Enter the name of the Google font you have picked here:', 'overview' ) .'</p>',
        'input_attrs' => array(
            'id' => 'overview-custom-font-text-input',
            'style' => 'border: 1px solid gray;'
        ),
    ) );
    
    // front page template display title
    $wp_customize->add_control( 'overview_front_page_title', array(
        'type' => 'textarea',
        'priority' => 30,
        'section' => 'overview_options',
        'label' => esc_html__( 'This page has an "OverView Display" template attached', 'overview' ),
        'description' => '<strong>' . esc_html__('Set the OverView Display options', 'overview') . '</strong><br /><em>' . esc_html__( 'This section is only visible on pages with an activated "OverView Display" template: you can change templates in the specific page\'s editor.', 'overview' ) . '</em>',
        'input_attrs' => array(
            'class' => 'overview-front-template-title-text',
            'style' => 'border: 1px solid gray;'
        ),
        'active_callback' => function () {
            return is_page_template( 'overview-front-page.php' ) || is_page_template( 'overview-front-no-content-page.php' );
        }
    ) );

    // front page template display background
    $wp_customize->add_control( 'overview_display_bright_background', array(
        'type'        => 'checkbox',
        'priority'    => 40,
        'section'     => 'overview_options',
        'label'       => esc_html__( 'Bright Display', 'overview' ),
        'description' => '<em>' . esc_html__('Save and refresh to continue testing the Display after switching.', 'overview') . '</em>',
        'input_attrs' => array(
            'class'       => 'overview-front-template-bright-display-checkbox',
            'style'     => 'border: 1px solid gray;'
        ),
        'active_callback' => function () {
            return is_page_template( 'overview-front-page.php' ) || is_page_template( 'overview-front-no-content-page.php' );
        }
    ) );

    // layout
    $wp_customize->add_control( 'overview_layout', array(
        'type' => 'select',
        'priority' => 10,
        'section' => 'overview_options',
        'label' => esc_html( __( 'Choose layout', 'overview' ) ),
        'input_attrs' => array(
            'class' => 'overview-layouts',
            'style' => 'border: 1px solid gray;'
        ),
        'choices' => array(
            'fixed' => esc_html( __( 'Fixed' , 'overview' ) ),
            'full'  => esc_html( __( 'Full-width' , 'overview' ) )
        )
    ) );

    // layout
    $wp_customize->add_control( 'overview_body_font_size', array(
        'type' => 'select',
        'priority' => 15,
        'section' => 'overview_options',
        'label' => esc_html( __( 'Main font size', 'overview' ) ),
        'input_attrs' => array(
            'class' => 'overview-main-font-size',
            'style' => 'border: 1px solid gray;'
        ),
        'choices' => array(
            '14px' => esc_html( __('14 Pixels', 'overview') ),
            '15px' => esc_html( __('15 Pixels', 'overview') ),
            '16px' => esc_html( __('16 Pixels', 'overview') ),
            '17px' => esc_html( __('17 Pixels', 'overview') ),
            '18px' => esc_html( __('18 Pixels', 'overview') ),
            '19px' => esc_html( __('19 Pixels', 'overview') ),
            '20px' => esc_html( __('20 Pixels', 'overview') ),
            '21px' => esc_html( __('21 Pixels', 'overview') ),
            '22px' => esc_html( __('22 Pixels', 'overview') ),
            '23px' => esc_html( __('23 Pixels', 'overview') ),
            '24px' => esc_html( __('24 Pixels', 'overview') ),
        )
    ) );
    
    
    /* OverView WordPress customizer PARTIALS */
    
    // site branding
    $wp_customize->selective_refresh->add_partial( 'overview_site_branding_description', array(
        'selector' => '.site-branding-description-p',
        'container_inclusive' => false,
        'render_callback' => function() {
            echo get_theme_mod('overview_site_branding_description', '');
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
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    //$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    /* hide header color input */
    $wp_customize->remove_control('header_textcolor');
    
}
add_action( 'customize_register', 'overview_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function overview_customize_preview_js() {
    wp_enqueue_script( 'overview_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'overview_customize_preview_js' );
