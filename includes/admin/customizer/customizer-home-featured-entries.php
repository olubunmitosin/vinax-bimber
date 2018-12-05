<?php
/**
 * WP Customizer panel section to handle Home > Featured Entires options
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

$wp_customize->add_section( 'bimber_home_featured_entries_section', array(
	'title'    => esc_html__( 'Featured Entries', 'bimber' ),
	'priority' => 20,
	'panel'    => 'bimber_home_panel',
) );

// Type.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_featured_entries', array(
	'label'    => esc_html__( 'Type', 'bimber' ),
	'section'  => 'bimber_home_featured_entries_section',
	'settings' => $bimber_option_name . '[home_featured_entries]',
	'type'     => 'select',
	'choices'  => array(
		'most_shared' => esc_html__( 'most shared', 'bimber' ),
		'most_viewed' => esc_html__( 'most viewed', 'bimber' ),
		'recent'      => esc_html__( 'recent', 'bimber' ),
		'none'        => esc_html__( 'none', 'bimber' ),
	),
) );

// Title.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_title]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_featured_entries_title', array(
	'label'           => esc_html__( 'Title', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_title]',
	'type'            => 'text',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'Leave empty to use default', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) );

// Hide title.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_title_hide]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_title_hide'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_featured_entries_title_hide', array(
	'label'    => esc_html__( 'Hide Title', 'bimber' ),
	'section'  => 'bimber_home_featured_entries_section',
	'settings' => $bimber_option_name . '[home_featured_entries_title_hide]',
	'type'     => 'checkbox',
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) );

/**
 * Check whether featured entries are enabled for homepage
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_home_has_featured_entries( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	$type = $control->manager->get_setting( bimber_get_theme_id() . '[home_featured_entries]' )->value();

	return 'none' !== $type;
}

/**
 * Check whether featured entries can use gutter option
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_home_featured_can_use_gutter( $control ) {
	if ( ! bimber_customizer_home_has_featured_entries( $control ) ) {
		return false;
	}

	$template = $control->manager->get_setting( bimber_get_theme_id() . '[home_featured_entries_template]' )->value();

	return 'todo-music' !== $template;
}

/**
 * Check whether featured entries tag filter is supported
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_home_featured_entries_tag_is_active( $control ) {
	$has_featured_entries = bimber_customizer_home_has_featured_entries( $control );

	// Skip if home doesn't use the Featured Entries.
	if ( ! $has_featured_entries ) {
		return false;
	}

	$featured_entries_type = $control->manager->get_setting( bimber_get_theme_id() . '[home_featured_entries]' )->value();

	// The most viewed types doesn't support tag filter.
	if ( 'most_viewed' === $featured_entries_type ) {
		return false;
	}

	return apply_filters( 'bimber_customizer_home_featured_entries_tag_is_active', true );
}

// Template.
$bimber_featured_entries_uri = BIMBER_ADMIN_DIR_URI . 'images/templates/featured-entries/';
$bimber_featured_entries_template_choices = array(
	'1-sidebar' => array(
		'label' => esc_html__( '1 sidebar', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '1-sidebar.png',
	),
	'1-sidebar-bunchy' => array(
		'label' => esc_html__( '1 sidebar', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '1-sidebar-bunchy.png',
	),
	'2-2-boxed' => array(
		'label' => esc_html__( '2-2 boxed', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '2-2-boxed.png',
	),
	'2-2-stretched' => array(
		'label' => esc_html__( '2-2 stretched', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '2-2-stretched.png',
	),
	'3-3-3-boxed' => array(
		'label' => esc_html__( '3-3-3 boxed', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '3-3-3-boxed.png',
	),
	'3-3-3-stretched' => array(
		'label' => esc_html__( '3-3-3 stretched', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '3-3-3-stretched.png',
	),
	'2-4-4-boxed' => array(
		'label' => esc_html__( '2-4-4 boxed', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '2-4-4-boxed.png',
	),
	'2-4-4-stretched' => array(
		'label' => esc_html__( '2-4-4 stretched', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '2-4-4-stretched.png',
	),
	'2of3-3v-3v-boxed' => array(
		'label' => esc_html__( '2of-3v-3v-boxed', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '2of3-3v-3v-boxed.png',
	),
	'2of3-3v-3v-stretched' => array(
		'label' => esc_html__( '2of-3v-3v-stretched', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '2of3-3v-3v-stretched.png',
	),
	'4-4-4-4-boxed' => array(
		'label' => esc_html__( '4-4-4-4 boxed', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '4-4-4-4-boxed.png',
	),
	'4-4-4-4-stretched' => array(
		'label' => esc_html__( '4-4-4-4 stretched', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '4-4-4-4-stretched.png',
	),
	'todo-music' => array(
		'label' => esc_html__( 'TODO Music', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . 'todo-music.png',
	),
	'3-3v-3v-3v-3v-boxed' => array(
		'label' => esc_html__( '3-3v-3v-3v-3v boxed', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '3-3v-3v-3v-3v-boxed.png',
	),
	'3-3v-3v-3v-3v-stretched' => array(
		'label' => esc_html__( '3-3v-3v-3v-3v stretched', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '3-3v-3v-3v-3v-stretched.png',
	),
	'module-01'	=> array(
		'label' => esc_html__( 'module-01', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . '1-sidebar-bunchy.png',
	),
	'todo-fashion' => array(
		'label' => esc_html__( 'TODO Fashion', 'bimber' ),
		'path'  => $bimber_featured_entries_uri . 'todo-fashion.png',
	),
);


$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_template]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_template'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_home_featured_entries_template', array(
	'label'    => esc_html__( 'Template', 'bimber' ),
	'section'  => 'bimber_home_featured_entries_section',
	'settings' => $bimber_option_name . '[home_featured_entries_template]',
	'type'     => 'select',
	'columns'  => 3,
	'choices'  => $bimber_featured_entries_template_choices,
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) ) );

// Gutter.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_gutter]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_gutter'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_featured_entries_gutter', array(
	'label'    => esc_html__( 'Gutter', 'bimber' ),
	'section'  => 'bimber_home_featured_entries_section',
	'settings' => $bimber_option_name . '[home_featured_entries_gutter]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
	'active_callback' => 'bimber_customizer_home_featured_can_use_gutter',
) );

// Category.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_category]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_category'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_home_featured_entries_category', array(
	'label'           => esc_html__( 'Categories', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_category]',
	'choices'         => bimber_customizer_get_category_choices(),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) ) );

// Tag.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_tag]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_tag'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );
$wp_customize->add_control( new Bimber_Customize_Tag_Select_Control( $wp_customize, 'bimber_home_featured_entries_tag', array(
	'label'           => esc_html__( 'Tags', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_tag]',
	'active_callback' => 'bimber_customizer_home_featured_entries_tag_is_active',
) ) );

// Featured Entries Time range.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_time_range]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_time_range'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_featured_entries_time_range', array(
	'label'           => esc_html__( 'Time range', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_time_range]',
	'type'            => 'select',
	'choices'         => array(
		'day'   => esc_html__( 'last 24 hours', 'bimber' ),
		'week'  => esc_html__( 'last 7 days', 'bimber' ),
		'month' => esc_html__( 'last 30 days', 'bimber' ),
		'all'   => esc_html__( 'all time', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) );

// Hide Elements.
$wp_customize->add_setting( $bimber_option_name . '[home_featured_entries_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['home_featured_entries_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_home_featured_entries_hide_elements', array(
	'label'           => esc_html__( 'Hide Elements', 'bimber' ),
	'section'         => 'bimber_home_featured_entries_section',
	'settings'        => $bimber_option_name . '[home_featured_entries_hide_elements]',
	'choices'         => apply_filters( 'bimber_home_featured_entries_hide_elements_choices', array(
		'shares'        => esc_html__( 'Shares', 'bimber' ),
		'views'         => esc_html__( 'Views', 'bimber' ),
		'comments_link' => esc_html__( 'Comments Link', 'bimber' ),
		'categories'    => esc_html__( 'Categories', 'bimber' ),
	) ),
	'active_callback' => 'bimber_customizer_home_has_featured_entries',
) ) );
