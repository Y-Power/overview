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

    // layouts
    $wp_customize->add_setting( 'overview_layout', array(
        'type'              => 'theme_mod',
        'capability'        => 'edit_theme_options',
        'default'           => 'fixed',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_textarea'
    ) );
    

    /* OverView WordPress customizer SECTIONS */
    
    // front page template
    $wp_customize->add_section( 'overview_options', array(
        'title' => __( 'OverView options', 'overview' ),
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
        'label' => __( 'Site branding description', 'overview' ),
        'description' => __( 'Describe your brand and/or mission', 'overview' ),
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
        'label' => __( 'Colors scheme', 'overview' ),
        'description' => __( 'Choose your website colors set', 'overview' ),
        'input_attrs' => array(
            'class' => 'overview-colors-themes',
            'style' => 'border: 1px solid gray;'
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

    // front page template display title
    $wp_customize->add_control( 'overview_front_page_title', array(
        'type' => 'textarea',
        'priority' => 30,
        'section' => 'overview_options',
        'label' => __( 'Describe the Display and/or its use', 'overview' ),
        'description' => '<strong>' . __('Set the OverView Display options', 'overview') . '</strong><br /><em>' . __( 'This section is only visible on pages with an activated "OverView Display" template: you can change templates in the specific page\'s editor.', 'overview' ) . '</em>',
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
        'label'       => __( 'Bright Display', 'overview' ),
        'description' => '<em>' . __('Save and refresh to continue testing the Display after switching.', 'overview') . '</em>',
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
        'label' => __( 'Choose layout', 'overview' ),
        'input_attrs' => array(
            'class' => 'overview-layouts',
            'style' => 'border: 1px solid gray;'
        ),
        'choices' => array(
            'fixed' => __( 'Fixed' , 'overview' ),
            'full'  => __( 'Full-width' , 'overview' )
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
