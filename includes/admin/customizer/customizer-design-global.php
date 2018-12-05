<?php
/**
 * WP Customizer panel section to handle general design options
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

$wp_customize->add_section( 'bimber_design_general_section', array(
	'title'    => esc_html__( 'General', 'bimber' ),
	'priority' => 10,
	'panel'    => 'bimber_design_panel',
) );
$wp_customize->add_section( 'bimber_design_colors_section', array(
	'title'    => esc_html__( 'Colors', 'bimber' ),
	'priority' => 11,
	'panel'    => 'bimber_design_panel',
) );


// Stack.
$wp_customize->add_setting( $bimber_option_name . '[global_stack]', array(
	'default'           => $bimber_customizer_defaults['global_stack'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$the_choices = array(
	'app' 			=> esc_html__( 'app', 'bimber' ),
	'bunchy'        => esc_html__( 'bunchy', 'bimber' ),
	'cards'         => esc_html__( 'cards', 'bimber' ),
	'carmania'		=> esc_html__( 'carmania', 'bimber' ),
	'fashion'  		=> esc_html__( 'fashion',  'bimber' ),
	'hardcore'      => esc_html__( 'hardcore', 'bimber' ),
	'miami'         => esc_html__( 'miami', 'bimber' ),
	'minimal'       => esc_html__( 'minimal', 'bimber' ),
	'music'         => esc_html__( 'music', 'bimber' ),
	'original'      => esc_html__( 'original', 'bimber' ),
	'original-2018' => esc_html__( 'original 2018', 'bimber' ),
);

if ( defined( 'BTP_DEV' ) && BTP_DEV ) {
	$the_choices['food'] = esc_html__( 'food',  'bimber' );
}

$wp_customize->add_control( 'bimber_global_stack', array(
	'label'    => esc_html__( 'Style', 'bimber' ),
	'section'  => 'bimber_design_general_section',
	'settings' => $bimber_option_name . '[global_stack]',
	'type'     => 'select',
	'choices'  => $the_choices,
) );


// Icon style.
$wp_customize->add_setting( $bimber_option_name . '[global_icon_style]', array(
	'default'           => $bimber_customizer_defaults['global_icon_style'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_global_icon_style', array(
	'label'    => esc_html__( 'Icon Style', 'bimber' ),
	'section'  => 'bimber_design_general_section',
	'settings' => $bimber_option_name . '[global_icon_style]',
	'type'     => 'select',
	'choices'  => array(
		'default'   => esc_html__( 'default', 'bimber' ),
		'solid'  	=> esc_html__( 'solid', 'bimber' ),
		'line'     	=> esc_html__( 'line', 'bimber' ),
	),
) );


// Skin.
$wp_customize->add_setting( $bimber_option_name . '[global_skin]', array(
	'default'           => $bimber_customizer_defaults['global_skin'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_global_skin', array(
	'label'    => esc_html__( 'Skin', 'bimber' ),
	'section'  => 'bimber_design_general_section',
	'settings' => $bimber_option_name . '[global_skin]',
	'type'     => 'select',
	'choices'  => array(
		'light'  => esc_html__( 'light', 'bimber' ),
		'dark'     => esc_html__( 'dark', 'bimber' ),
	),
) );

// Page layout.
$wp_customize->add_setting( $bimber_option_name . '[global_layout]', array(
	'default'           => $bimber_customizer_defaults['global_layout'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_global_layout', array(
	'label'    => esc_html__( 'Layout', 'bimber' ),
	'section'  => 'bimber_design_general_section',
	'settings' => $bimber_option_name . '[global_layout]',
	'type'     => 'select',
	'choices'  => array(
		'boxed'     => esc_html__( 'boxed', 'bimber' ),
		'stretched' => esc_html__( 'stretched', 'bimber' ),
	),
) );

// Background Color.
$wp_customize->add_setting( $bimber_option_name . '[global_background_color]', array(
	'default'           => $bimber_customizer_defaults['global_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_global_background_color', array(
	'label'    => esc_html__( 'Boxed Layout Background', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[global_background_color]',
) ) );


// Google Font Subset.
$wp_customize->add_setting( $bimber_option_name . '[global_google_font_subset]', array(
	'default'           => $bimber_customizer_defaults['global_google_font_subset'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_global_google_font_subset', array(
	'label'    => esc_html__( 'Google Font Subset', 'bimber' ),
	'section'  => 'bimber_design_general_section',
	'settings' => $bimber_option_name . '[global_google_font_subset]',
	'choices'  => array(
		'latin'        => esc_html__( 'Latin', 'bimber' ),
		'latin-ext'    => esc_html__( 'Latin Extended', 'bimber' ),
		'cyrillic'     => esc_html__( 'Cyrillic', 'bimber' ),
		'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'bimber' ),
		'greek'        => esc_html__( 'Greek', 'bimber' ),
		'greek-ext'    => esc_html__( 'Greek Extended', 'bimber' ),
		'vietnamese'   => esc_html__( 'Vietnamese', 'bimber' ),
	),
) ) );

// Breadcrumbs.
$wp_customize->add_setting( $bimber_option_name . '[breadcrumbs]', array(
	'default'           => $bimber_customizer_defaults['breadcrumbs'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( 'bimber_breadcrumbs', array(
	'label'    => esc_html__( 'Breadcrumbs', 'bimber' ),
	'section'  => 'bimber_design_general_section',
	'settings' => $bimber_option_name . '[breadcrumbs]',
	'type'     => 'select',
	'choices'  => array(
		'standard'  => esc_html__( 'show', 'bimber' ),
		'none'      => esc_html__( 'hide', 'bimber' ),
	),
) );

// Divider.
$wp_customize->add_setting( 'bimber_global_cs_1_divider', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_global_cs_1_divider', array(
	'section'  => 'bimber_design_colors_section',
	'settings' => 'bimber_global_cs_1_divider',
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'Basic Color Scheme', 'bimber' ) . '</h2>
		<p>' . esc_html__( 'Will be applied to buttons, badges.', 'bimber' ) . '</p>',
) ) );


// Background Color (cs1).
$wp_customize->add_setting( $bimber_option_name . '[content_cs_1_background_color]', array(
	'default'           => $bimber_customizer_defaults['content_cs_1_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_content_cs_1_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[content_cs_1_background_color]',
) ) );

// Accent 1 (cs1).
$wp_customize->add_setting( $bimber_option_name . '[content_cs_1_accent1]', array(
	'default'           => $bimber_customizer_defaults['content_cs_1_accent1'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_content_cs_1_accent1', array(
	'label'    => esc_html__( 'Accent', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[content_cs_1_accent1]',
) ) );

// Archive header background.
$wp_customize->add_setting( $bimber_option_name . '[archive_header_background_color]', array(
	'default'           => $bimber_customizer_defaults['archive_header_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_archive_header_background_color', array(
	'label'    => esc_html__( 'Archive header: Background', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[archive_header_background_color]',
) ) );

// Archive header gradient background.
$wp_customize->add_setting( $bimber_option_name . '[archive_header_background2_color]', array(
	'default'           => $bimber_customizer_defaults['archive_header_background2_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_archive_header_background2_color', array(
	'label'    => esc_html__( 'Archive header: Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[archive_header_background2_color]',
) ) );

// Trending Background Color.
$wp_customize->add_setting( $bimber_option_name . '[trending_background_color]', array(
	'default'           => $bimber_customizer_defaults['trending_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_trending_background_color', array(
	'label'    => esc_html__( 'Trending Background Color', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[trending_background_color]',
) ) );

// Trending Optional Background Gradient.
$wp_customize->add_setting( $bimber_option_name . '[trending_optional_gradient_color]', array(
	'default'           => $bimber_customizer_defaults['trending_optional_gradient_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_trending_optional_gradient_color', array(
	'label'    => esc_html__( 'Trending Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[trending_optional_gradient_color]',
) ) );

// Trending Text.
$wp_customize->add_setting( $bimber_option_name . '[trending_text_color]', array(
	'default'           => $bimber_customizer_defaults['trending_text_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_trending_text_color', array(
	'label'    => esc_html__( 'Trending Text', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[trending_text_color]',
) ) );

// Hot Background Color.
$wp_customize->add_setting( $bimber_option_name . '[hot_background_color]', array(
	'default'           => $bimber_customizer_defaults['hot_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_hot_background_color', array(
	'label'    => esc_html__( 'Hot Background Color', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[hot_background_color]',
) ) );

// Hot Optional Background Gradient.
$wp_customize->add_setting( $bimber_option_name . '[hot_optional_gradient_color]', array(
	'default'           => $bimber_customizer_defaults['hot_optional_gradient_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_hot_optional_gradient_color', array(
	'label'    => esc_html__( 'Hot Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[hot_optional_gradient_color]',
) ) );

// Hot Text.
$wp_customize->add_setting( $bimber_option_name . '[hot_text_color]', array(
	'default'           => $bimber_customizer_defaults['hot_text_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_hot_text_color', array(
	'label'    => esc_html__( 'Hot Text', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[hot_text_color]',
) ) );

// Popular Background Color.
$wp_customize->add_setting( $bimber_option_name . '[popular_background_color]', array(
	'default'           => $bimber_customizer_defaults['popular_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_popular_background_color', array(
	'label'    => esc_html__( 'Popular Background Color', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[popular_background_color]',
) ) );


// Popular Optional Background Gradient.
$wp_customize->add_setting( $bimber_option_name . '[popular_optional_gradient_color]', array(
	'default'           => $bimber_customizer_defaults['popular_optional_gradient_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_popular_optional_gradient_color', array(
	'label'    => esc_html__( 'Popular Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[popular_optional_gradient_color]',
) ) );

// Popular Text.
$wp_customize->add_setting( $bimber_option_name . '[popular_text_color]', array(
	'default'           => $bimber_customizer_defaults['popular_text_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_popular_text_color', array(
	'label'    => esc_html__( 'Popular Text', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[popular_text_color]',
) ) );

if ( bimber_can_use_plugin( 'restrict-content-pro/restrict-content-pro.php' ) ) {
	// Members Only Background Color.
	$wp_customize->add_setting( $bimber_option_name . '[members_only_background_color]', array(
		'default'           => $bimber_customizer_defaults['members_only_background_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_members_only_background_color', array(
		'label'    => esc_html__( 'Members Only Background Color', 'bimber' ),
		'section'  => 'bimber_design_colors_section',
		'settings' => $bimber_option_name . '[members_only_background_color]',
	) ) );


	// Members Only Optional Background Gradient.
	$wp_customize->add_setting( $bimber_option_name . '[members_only_optional_gradient_color]', array(
		'default'           => $bimber_customizer_defaults['members_only_optional_gradient_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_members_only_optional_gradient_color', array(
		'label'    => esc_html__( 'Members Only Optional Background Gradient', 'bimber' ),
		'section'  => 'bimber_design_colors_section',
		'settings' => $bimber_option_name . '[members_only_optional_gradient_color]',
	) ) );

	// Members Only Text.
	$wp_customize->add_setting( $bimber_option_name . '[members_only_text_color]', array(
		'default'           => $bimber_customizer_defaults['members_only_text_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_members_only_text_color', array(
		'label'    => esc_html__( 'Members Only Text', 'bimber' ),
		'section'  => 'bimber_design_colors_section',
		'settings' => $bimber_option_name . '[members_only_text_color]',
	) ) );
}

	// Coupon Inside Background Color.
	$wp_customize->add_setting( $bimber_option_name . '[coupon_inside_background_color]', array(
		'default'           => $bimber_customizer_defaults['coupon_inside_background_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_coupon_inside_background_color', array(
		'label'    => esc_html__( 'Coupon Inside Background Color', 'bimber' ),
		'section'  => 'bimber_design_colors_section',
		'settings' => $bimber_option_name . '[coupon_inside_background_color]',
	) ) );


	// Coupon Inside Optional Background Gradient.
	$wp_customize->add_setting( $bimber_option_name . '[coupon_inside_optional_gradient_color]', array(
		'default'           => $bimber_customizer_defaults['coupon_inside_optional_gradient_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_coupon_inside_optional_gradient_color', array(
		'label'    => esc_html__( 'Coupon Inside Optional Background Gradient', 'bimber' ),
		'section'  => 'bimber_design_colors_section',
		'settings' => $bimber_option_name . '[coupon_inside_optional_gradient_color]',
	) ) );

	// Coupon Inside Text.
	$wp_customize->add_setting( $bimber_option_name . '[coupon_inside_text_color]', array(
		'default'           => $bimber_customizer_defaults['coupon_inside_text_color'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_coupon_inside_text_color', array(
		'label'    => esc_html__( 'Coupon Inside Text', 'bimber' ),
		'section'  => 'bimber_design_colors_section',
		'settings' => $bimber_option_name . '[coupon_inside_text_color]',
	) ) );

// Divider.
$wp_customize->add_setting( 'bimber_global_cs_2_divider', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_HTML_Control( $wp_customize, 'bimber_global_cs_2_divider', array(
	'section'  => 'bimber_design_colors_section',
	'settings' => 'bimber_global_cs_2_divider',
	'html'     =>
		'<hr />
		<h2>' . esc_html__( 'Secondary Color Scheme', 'bimber' ) . '</h2>
		<p>' . esc_html__( 'Will be applied to buttons, badges &amp; flags', 'bimber' ) . '</p>',
) ) );


// Background Color (cs2).
$wp_customize->add_setting( $bimber_option_name . '[content_cs_2_background_color]', array(
	'default'           => $bimber_customizer_defaults['content_cs_2_background_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_content_cs_2_background_color', array(
	'label'    => esc_html__( 'Background', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[content_cs_2_background_color]',
) ) );

// Background Gradient Color (cs2).
$wp_customize->add_setting( $bimber_option_name . '[content_cs_2_background2_color]', array(
	'default'           => $bimber_customizer_defaults['content_cs_2_background2_color'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_content_cs_2_background2_color', array(
	'label'    => esc_html__( 'Optional Background Gradient', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[content_cs_2_background2_color]',
) ) );


// Text 1 (cs2).
$wp_customize->add_setting( $bimber_option_name . '[content_cs_2_text1]', array(
	'default'           => $bimber_customizer_defaults['content_cs_2_text1'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_hex_color',
) );

$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bimber_content_cs_2_text1', array(
	'label'    => esc_html__( 'Text', 'bimber' ),
	'section'  => 'bimber_design_colors_section',
	'settings' => $bimber_option_name . '[content_cs_2_text1]',
) ) );


$dev = defined( 'BTP_DEV' ) && BTP_DEV;
if ( ! $dev ) {
	return;
}

// Bending cat.
$wp_customize->add_setting( $bimber_option_name . '[bending_cat]', array(
	'default'           => $bimber_customizer_defaults['bending_cat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_bending_cat', array(
	'label'    => esc_html__( 'Enable Bending Cat', 'bimber' ),
	'section'  => 'bimber_design_general_section',
	'settings' => $bimber_option_name . '[bending_cat]',
	'type'     => 'checkbox',
) );

// Page width.
$wp_customize->add_setting( $bimber_option_name . '[page_width]', array(
	'default'           => $bimber_customizer_defaults['page_width'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'transport'  		=> 'postMessage',
) );
$wp_customize->add_control( new Bimber_Customize_Custom_Range_Control( $wp_customize, 'bimber_page_width', array(
	'label'    => esc_html__( 'Page Width', 'bimber' ),
	'section'  => 'bimber_design_general_section',
	'settings' => $bimber_option_name . '[page_width]',
	'input_attrs' => array(
		'min'   => 1024,
		'max'   => 1920,
	),
) ) );
