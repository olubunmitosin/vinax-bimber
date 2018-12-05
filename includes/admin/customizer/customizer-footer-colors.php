<?php
/**
 * WP Customizer panel section to customize footer design options
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

$bimber_option_name = bimber_get_theme_id();

$wp_customize->add_section( 'bimber_footer_colors_section', array(
	'title'    => esc_html__( 'Colors', 'bimber' ),
	'priority' => 11,
	'panel'    => 'bimber_footer_panel',
) );

// Text 1 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_text1]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_text1'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_text1', array(
	'label'    => esc_html__( 'Headings &amp; Titles', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_text1]',
) ) );


// Text 2 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_text2]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_text2'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_text2', array(
	'label'    => esc_html__( 'Regular Text', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_text2]',
) ) );


// Text 3 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_text3]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_text3'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_text3', array(
	'label'    => esc_html__( 'Small Text Descriptions', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_text3]',
) ) );


// Accent 1 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_accent1]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_accent1'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_accent1', array(
	'label'    => esc_html__( 'Accent', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_accent1]',
) ) );


// Background Color (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_background_color]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_background_color', array(
	'label'    => esc_html__( 'Background Color', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_background_color]',
) ) );

// Background Color (cs1).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_gradient_color]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_gradient_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
	'transport'  		=> 'postMessage',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_1_gradient_color', array(
	'label'    => esc_html__( 'Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_gradient_color]',
) ) );

$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_background_image]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_1_background_image'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_footer_cs_1_background_image', array(
	'label'    => esc_html__( 'Background image', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_background_image]',
) ) );
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_background_repeat]', array(
	'default'               => $bimber_customizer_defaults['footer_cs_1_background_repeat'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );

$wp_customize->add_control( 'bimber_footer_cs_1_background_repeat', array(
	'label'    => esc_html__( 'Background image repeat', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_background_repeat]',
	'type'     => 'select',
	'choices'  => array(
		'no-repeat'      	=> esc_html__( 'no repeat', 'bimber' ),
		'repeat'      		=> esc_html__( 'repeat', 'bimber' ),
		'repeat-x'      	=> esc_html__( 'repeat x', 'bimber' ),
		'repeat-y'      	=> esc_html__( 'repeat y', 'bimber' ),
	),
) );
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_background_size]', array(
	'default'               => $bimber_customizer_defaults['footer_cs_1_background_size'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );
$wp_customize->add_control( 'bimber_footer_cs_1_background_size', array(
	'label'    => esc_html__( 'Background image size', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_background_size]',
	'type'     => 'select',
	'choices'  => array(
		'auto'      	=> esc_html__( 'auto', 'bimber' ),
		'cover'      	=> esc_html__( 'cover', 'bimber' ),
	),
) );
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_background_position]', array(
	'default'               => $bimber_customizer_defaults['footer_cs_1_background_position'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );

$wp_customize->add_control( 'bimber_footer_cs_1_background_position', array(
	'label'    => esc_html__( 'Background image position', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_background_position]',
	'type'     => 'select',
	'choices'  => array(
		'top left'      	=> esc_html__( 'top left', 'bimber' ),
		'top center'      	=> esc_html__( 'top center', 'bimber' ),
		'top right'      	=> esc_html__( 'top right', 'bimber' ),
		'center left'      	=> esc_html__( 'center left', 'bimber' ),
		'center center'     => esc_html__( 'center center', 'bimber' ),
		'center right'      => esc_html__( 'center right', 'bimber' ),
		'bottom left'      	=> esc_html__( 'bottom left', 'bimber' ),
		'bottom center'     => esc_html__( 'bottom center', 'bimber' ),
		'bottom right'      => esc_html__( 'bottom right', 'bimber' ),
	),
) );
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_1_background_opacity]', array(
	'default'               => $bimber_customizer_defaults['footer_cs_1_background_opacity'],
	'type'                  => 'option',
	'capability'            => 'edit_theme_options',
	'sanitize_callback'     => 'sanitize_text_field',
	'transport'  			=> 'postMessage',
) );

$wp_customize->add_control( new Bimber_Customize_Custom_Range_Control( $wp_customize, 'bimber_footer_cs_1_background_opacity', array(
	'label'    => esc_html__( 'Background image opacity', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_1_background_opacity]',
	'input_attrs' => array(
		'min'   => 0,
		'max'   => 100,
	),
) ) );

// Divider.
$wp_customize->add_setting( 'bimber_footer_cs_2_divider', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_footer_cs_2_divider', array(
	'section'  => 'bimber_footer_colors_section',
	'settings' => 'bimber_footer_cs_2_divider',
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'Secondary Color Scheme', 'bimber' ) . '</h2>
		<p>' . esc_html__( 'Will be applied to buttons, badges &amp; flags.', 'bimber' ) . '</p>',
) ) );


// Background Color (cs2).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_2_background_color]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_2_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_2_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_2_background_color]',
) ) );


// Text 1 (cs2).
$wp_customize->add_setting( $bimber_option_name . '[footer_cs_2_text1]', array(
	'default'           => $bimber_customizer_defaults['footer_cs_2_text1'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_footer_cs_2_text1', array(
	'label'    => esc_html__( 'Text', 'bimber' ),
	'section'  => 'bimber_footer_colors_section',
	'settings' => $bimber_option_name . '[footer_cs_2_text1]',
) ) );

