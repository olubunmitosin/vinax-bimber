<?php
/**
 * WP Customizer panel section to handle homepage options
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

$wp_customize->add_section( 'bimber_home_main_collection_section', array(
	'title'    => esc_html__( 'Main Collection', 'bimber' ),
	'priority' => 30,
	'panel'    => 'bimber_home_panel',
) );

// Title.
$wp_customize->add_setting( $bimber_option_name . '[home_title]', array(
	'default'           => $bimber_customizer_defaults['home_title'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_title', array(
	'label'           => esc_html__( 'Title', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_title]',
	'type'            => 'text',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'Leave empty to use default', 'bimber' ),
	),
) );

// Hide title.
$wp_customize->add_setting( $bimber_option_name . '[home_title_hide]', array(
	'default'           => $bimber_customizer_defaults['home_title_hide'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_title_hide', array(
	'label'    => esc_html__( 'Hide title', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_title_hide]',
	'type'     => 'checkbox',
) );

// Template.
$wp_customize->add_setting( $bimber_option_name . '[home_template]', array(
	'default'           => $bimber_customizer_defaults['home_template'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Radio_Control( $wp_customize, 'bimber_home_template', array(
	'label'           => esc_html__( 'Template', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_template]',
	'type'            => 'select',
	'choices'         => bimber_get_home_templates(),
	'columns'         => 3,
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) ) );

// Sidebar.
$wp_customize->add_setting( $bimber_option_name . '[home_sidebar_location]', array(
	'default'           => $bimber_customizer_defaults['home_sidebar_location'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_sidebar_location', array(
	'label'       => esc_html__( 'Sidebar location', 'bimber' ),
	'section'     => 'bimber_home_main_collection_section',
	'settings'    => $bimber_option_name . '[home_sidebar_location]',
	'type'        => 'select',
	'choices'     => array(
		'left'          => esc_html__( 'left', 'bimber' ),
		'standard'      => esc_html__( 'right', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_home_is_template_with_sidebar',
) );

/**
 * Check whether there are many comment types active
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_home_is_template_with_sidebar( $control ) {
	$template = bimber_get_theme_option( 'home', 'template' );
	return strpos( $template, 'sidebar' ) > -1 || strpos( $template, 'bunchy' ) > -1;
}

// Posts Per Page.
$wp_customize->add_setting( 'posts_per_page', array(
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_posts_per_page', array(
	'label'    => esc_html__( 'Entries per page', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => 'posts_per_page',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
) );

// Category.
$wp_customize->add_setting( $bimber_option_name . '[home_main_collection_excluded_categories]', array(
	'default'           => $bimber_customizer_defaults['home_main_collection_excluded_categories'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_home_main_collection_excluded_categories', array(
	'label'           => esc_html__( 'Exclude categories', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_main_collection_excluded_categories]',
	'choices'         => bimber_customizer_get_category_choices(),
) ) );

// Pagination.
$wp_customize->add_setting( $bimber_option_name . '[home_pagination]', array(
	'default'           => $bimber_customizer_defaults['home_pagination'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_pagination', array(
	'label'    => esc_html__( 'Pagination', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_pagination]',
	'type'     => 'select',
	'choices'  => array(
		'load-more'                 => esc_html__( 'Load More', 'bimber' ),
		'infinite-scroll'           => esc_html__( 'Infinite Scroll', 'bimber' ),
		'infinite-scroll-on-demand' => esc_html__( 'Infinite Scroll (first load via click)', 'bimber' ),
		'pages'                     => esc_html__( 'Prev/Next Pages', 'bimber' ),
	),
) );

// Hide Elements.
$wp_customize->add_setting( $bimber_option_name . '[home_hide_elements]', array(
	'default'           => $bimber_customizer_defaults['home_hide_elements'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Checkbox_Control( $wp_customize, 'bimber_home_hide_elements', array(
	'label'    => esc_html__( 'Hide Elements', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_hide_elements]',
	'choices'  => apply_filters( 'bimber_home_hide_elements_choices', array(
		'featured_media' => esc_html__( 'Featured Media', 'bimber' ),
		'shares'         => esc_html__( 'Shares', 'bimber' ),
		'views'          => esc_html__( 'Views', 'bimber' ),
		'comments_link'  => esc_html__( 'Comments Link', 'bimber' ),
		'categories'     => esc_html__( 'Categories', 'bimber' ),
		'summary'        => esc_html__( 'Summary', 'bimber' ),
		'author'         => esc_html__( 'Author', 'bimber' ),
		'avatar'         => esc_html__( 'Avatar', 'bimber' ),
		'date'           => esc_html__( 'Date', 'bimber' ),
	) ),
) ) );

// Inject embeds.
$wp_customize->add_setting( $bimber_option_name . '[home_inject_embeds]', array(
	'default'           => $bimber_customizer_defaults['home_inject_embeds'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_inject_embeds', array(
	'label'    => esc_html__( 'Use embeds instead of featured images', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_inject_embeds]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
) );

// Highlight items.
$wp_customize->add_setting( $bimber_option_name . '[home_highlight_items]', array(
	'default'           => $bimber_customizer_defaults['home_highlight_items'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_highlight_items', array(
	'label'    => esc_html__( 'Highlight items', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_highlight_items]',
	'type'     => 'select',
	'choices'  => bimber_get_yes_no_options(),
	'active_callback' => 'bimber_customizer_is_home_list_template_selected',
) );

/**
 * Check whether home template is a list
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_home_list_template_selected( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	$template = $control->manager->get_setting( bimber_get_theme_id() . '[home_template]' )->value();
	$list_templates = array(
		'list-sidebar',
		'list-s-sidebar',
		'upvote-sidebar',
	);

	return in_array( $template, $list_templates );
}

// Highlight items offset.
$wp_customize->add_setting( $bimber_option_name . '[home_highlight_items_offset]', array(
	'default'           => $bimber_customizer_defaults['home_highlight_items_offset'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_highlight_items_offset', array(
	'label'    => esc_html__( 'Highlight item at position', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_highlight_items_offset]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_highlight_items_selected',
) );

// Highlight items repeat.
$wp_customize->add_setting( $bimber_option_name . '[home_highlight_items_repeat]', array(
	'default'           => $bimber_customizer_defaults['home_highlight_items_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_highlight_items_repeat', array(
	'label'    => esc_html__( 'Repeat highlighted item after each X positions', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings' => $bimber_option_name . '[home_highlight_items_repeat]',
	'type'     => 'number',
	'input_attrs' => array(
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_highlight_items_selected',
) );

/**
 * Check whether home highlight items selected
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_home_highlight_items_selected( $control ) {
	if ( ! bimber_customizer_is_home_list_template_selected( $control ) ) {
		return false;
	}

	return $control->manager->get_setting( bimber_get_theme_id() . '[home_highlight_items]' )->value() === 'standard';
}

// Newsletter.
$wp_customize->add_setting( $bimber_option_name . '[home_newsletter]', array(
	'default'           => $bimber_customizer_defaults['home_newsletter'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_newsletter', array(
	'label'           => esc_html__( 'Newsletter', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_newsletter]',
	'type'            => 'select',
	'choices'         => array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) );

$wp_customize->add_setting( $bimber_option_name . '[home_newsletter_after_post]', array(
	'default'           => $bimber_customizer_defaults['home_newsletter_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_newsletter_after_post', array(
	'label'           => esc_html__( 'Inject newsletter at position', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_newsletter_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 2', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_newsletter_checked',
) );

$wp_customize->add_setting( $bimber_option_name . '[home_newsletter_repeat]', array(
	'default'           => $bimber_customizer_defaults['home_newsletter_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_newsletter_repeat', array(
	'label'           => esc_html__( 'Repeat newsletter after each X positions', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_newsletter_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'min'         => 0,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_newsletter_checked',
) );

/**
 * Check whether newsletter is enabled for homepage
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_home_newsletter_checked( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	return $control->manager->get_setting( bimber_get_theme_id() . '[home_newsletter]' )->value() === 'standard';
}


// Ad.
$wp_customize->add_setting( $bimber_option_name . '[home_ad]', array(
	'default'           => $bimber_customizer_defaults['home_ad'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_ad', array(
	'label'           => esc_html__( 'Ad', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_ad]',
	'type'            => 'select',
	'choices'         => array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) );

$wp_customize->add_setting( $bimber_option_name . '[home_ad_after_post]', array(
	'default'           => $bimber_customizer_defaults['home_ad_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_ad_after_post', array(
	'label'           => esc_html__( 'Inject ad at position', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_ad_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 4', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_ad_checked',
) );

$wp_customize->add_setting( $bimber_option_name . '[home_ad_repeat]', array(
	'default'           => $bimber_customizer_defaults['home_ad_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_ad_repeat', array(
	'label'           => esc_html__( 'Repeat ad after each X positions', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_ad_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'min'         => 0,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_ad_checked',
) );

/**
 * Check whether ad is enabled for homepage
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_home_ad_checked( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	return $control->manager->get_setting( bimber_get_theme_id() . '[home_ad]' )->value() === 'standard';
}

// Product.
$wp_customize->add_setting( $bimber_option_name . '[home_product]', array(
	'default'           => $bimber_customizer_defaults['home_product'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_product', array(
	'label'           => esc_html__( 'Product', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_product]',
	'type'            => 'select',
	'choices'         => array(
		'standard' => esc_html__( 'inject into post collection', 'bimber' ),
		'none'     => esc_html__( 'hide', 'bimber' ),
	),
	'active_callback' => 'bimber_customizer_is_posts_page_selected',
) );

// Product at position.
$wp_customize->add_setting( $bimber_option_name . '[home_product_after_post]', array(
	'default'           => $bimber_customizer_defaults['home_product_after_post'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_product_after_post', array(
	'label'           => esc_html__( 'Inject product at position', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_product_after_post]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 6', 'bimber' ),
		'min'         => 1,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_product_checked',
) );

// Product repeat.
$wp_customize->add_setting( $bimber_option_name . '[home_product_repeat]', array(
	'default'           => $bimber_customizer_defaults['home_product_repeat'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_home_product_repeat', array(
	'label'           => esc_html__( 'Repeat product after each X positions', 'bimber' ),
	'section'  => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_product_repeat]',
	'type'            => 'number',
	'input_attrs'     => array(
		'placeholder' => esc_html__( 'eg. 12', 'bimber' ),
		'min'         => 0,
		'class' => 'small-text',
	),
	'active_callback' => 'bimber_customizer_is_home_product_checked',
) );

// Product category.
$wp_customize->add_setting( $bimber_option_name . '[home_product_category]', array(
	'default'           => $bimber_customizer_defaults['home_product_category'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'bimber_sanitize_multi_choice',
) );
$wp_customize->add_control( new Bimber_Customize_Multi_Select_Control( $wp_customize, 'bimber_home_product_category', array(
	'label'           => esc_html__( 'Inject products from category', 'bimber' ),
	'description'     => esc_html__( 'you can choose many', 'bimber' ),
	'section'         => 'bimber_home_main_collection_section',
	'settings'        => $bimber_option_name . '[home_product_category]',
	'choices'         => bimber_customizer_get_product_category_choices(),
	'active_callback' => 'bimber_customizer_is_home_product_checked',
) ) );

/**
 * Check whether product is enabled for homepage
 *
 * @param WP_Customize_Control $control     Control instance for which this callback is executed.
 *
 * @return bool
 */
function bimber_customizer_is_home_product_checked( $control ) {
	if ( ! bimber_customizer_is_posts_page_selected( $control ) ) {
		return false;
	}

	return $control->manager->get_setting( bimber_get_theme_id() . '[home_product]' )->value() === 'standard';
}
