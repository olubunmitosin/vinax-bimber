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

// Define section.
$wp_customize->add_section( 'bimber_home_before_main_collection_section', array(
	'title'    => esc_html__( 'Before Main Collection', 'bimber' ),
	'priority' => 29,
	'panel'    => 'bimber_home_panel',
) );

// Podcast.
//$wp_customize->add_setting( $bimber_option_name . '[podcast_above_collection]', array(
//	'default'           => $bimber_customizer_defaults['podcast_above_collection'],
//	'type'              => 'option',
//	'capability'        => 'edit_theme_options',
//	'sanitize_callback' => 'sanitize_text_field',
//) );
//$wp_customize->add_control( 'bimber_podcast_above_collection', array(
//	'label'    => esc_html__( 'Show Podcast', 'bimber' ),
//	'section'  => 'bimber_home_before_main_collection_section',
//	'settings' => $bimber_option_name . '[podcast_above_collection]',
//	'type'     => 'checkbox',
//) );

// Newsletter.
$wp_customize->add_setting( $bimber_option_name . '[newsletter_before_collection]', array(
	'default'           => $bimber_customizer_defaults['newsletter_before_collection'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_newsletter_before_collection', array(
	'label'       => esc_html__( 'Show Newsletter', 'bimber' ),
	'description' => bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ? '' : esc_html__( 'Activate the "Mailchimp for WordPress" plugin to use this option', 'bimber' ),
	'section'     => 'bimber_home_before_main_collection_section',
	'settings'    => $bimber_option_name . '[newsletter_before_collection]',
	'type'        => 'checkbox',
) );


// Patreon.
$wp_customize->add_setting( $bimber_option_name . '[patreon_above_collection]', array(
	'default'           => $bimber_customizer_defaults['patreon_above_collection'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_patreon_above_collection', array(
	'label'       => esc_html__( 'Show Patreon', 'bimber' ),
	'description' => bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ? '' : esc_html__( 'Activate the AdAce plugin to use this option', 'bimber' ),
	'section'     => 'bimber_home_before_main_collection_section',
	'settings'    => $bimber_option_name . '[patreon_above_collection]',
	'type'        => 'checkbox',
) );

// Instagram.
$wp_customize->add_setting( $bimber_option_name . '[instagram_above_collection]', array(
	'default'           => $bimber_customizer_defaults['instagram_above_collection'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_instagram_above_collection', array(
	'label'       => esc_html__( 'Show Instagram', 'bimber' ),
	'description' => bimber_can_use_plugin( 'g1-socials/g1-socials.php' ) ? '' : esc_html__( 'Activate the G1 Socials plugin to use this option', 'bimber' ),
	'section'     => 'bimber_home_before_main_collection_section',
	'settings'    => $bimber_option_name . '[instagram_above_collection]',
	'type'        => 'checkbox',
) );

// Links.
$wp_customize->add_setting( $bimber_option_name . '[links_above_collection]', array(
	'default'           => $bimber_customizer_defaults['links_above_collection'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_links_above_collection', array(
	'label'       => esc_html__( 'Show Links', 'bimber' ),
	'description' => bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ? '' : esc_html__( 'Activate the AdAce plugin to use this option', 'bimber' ),
	'section'     => 'bimber_home_before_main_collection_section',
	'settings'    => $bimber_option_name . '[links_above_collection]',
	'type'        => 'checkbox',
) );

// Promoted products.
$wp_customize->add_setting( $bimber_option_name . '[promoted_products_above_collection]', array(
	'default'           => $bimber_customizer_defaults['promoted_products_above_collection'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_promoted_products_above_collection', array(
	'label'       => esc_html__( 'Show Promoted Products', 'bimber' ),
	'description' => bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) ? '' : esc_html__( 'Activate the AdAce plugin to use this option', 'bimber' ),
	'section'     => 'bimber_home_before_main_collection_section',
	'settings'    => $bimber_option_name . '[promoted_products_above_collection]',
	'type'        => 'checkbox',
) );

// Promoted product.
$wp_customize->add_setting( $bimber_option_name . '[promoted_product_above_collection]', array(
	'default'           => $bimber_customizer_defaults['promoted_product_above_collection'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'bimber_promoted_product_above_collection', array(
	'label'       => esc_html__( 'Show Promoted Single Product', 'bimber' ),
	'description' => bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) && bimber_can_use_plugin( 'woocommerce/woocommerce.php' ) ? '' : esc_html__( 'Activate the AdAce and WooCommerce plugins to use this option', 'bimber' ),
	'section'     => 'bimber_home_before_main_collection_section',
	'settings'    => $bimber_option_name . '[promoted_product_above_collection]',
	'type'        => 'checkbox',
) );

// ---
// Elements order.
// ---

$bimber_order_controls = array(
//	'above_collection_podcast_order'           => esc_html__( 'Podcast', 'bimber' ),
	'above_collection_newsletter_order'        => esc_html__( 'Newsletter', 'bimber' ),
	'above_collection_patreon_order'           => esc_html__( 'Patreon', 'bimber' ),
	'above_collection_instagram_order'         => esc_html__( 'Instagram', 'bimber' ),
	'above_collection_links_order'             => esc_html__( 'Links', 'bimber' ),
	'above_collection_promoted_products_order' => esc_html__( 'Promoted Products', 'bimber' ),
	'above_collection_promoted_product_order'  => esc_html__( 'Promoted Single Product', 'bimber' ),
);

// Section order.
$wp_customize->add_setting( 'bimber_above_collection_settings_order', array(
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( new Bimber_Customize_Sortable_Control( $wp_customize, 'bimber_above_collection_settings_order', array(
	'label'             => esc_html__( 'Sections order', 'bimber' ),
	'description'       => esc_html__( 'Drag and drop to reorder', 'bimber' ),
	'section'           => 'bimber_home_before_main_collection_section',
	'settings'          => 'bimber_above_collection_settings_order',
	'sortable_controls' => $bimber_order_controls,
) ) );

// Podcast order.
//$wp_customize->add_setting( $bimber_option_name . '[above_collection_podcast_order]', array(
//	'default'           => $bimber_customizer_defaults['above_collection_podcast_order'],
//	'type'              => 'option',
//	'capability'        => 'edit_theme_options',
//	'sanitize_callback' => 'absint',
//) );
//$wp_customize->add_control( 'bimber_above_collection_podcast_order', array(
//	'label'    => $bimber_order_controls['above_collection_podcast_order'],
//	'section'  => 'bimber_home_before_main_collection_section',
//	'settings' => $bimber_option_name . '[above_collection_podcast_order]',
//	'type'     => 'text',
//) );

// Newsletter order.
$wp_customize->add_setting( $bimber_option_name . '[above_collection_newsletter_order]', array(
	'default'           => $bimber_customizer_defaults['above_collection_newsletter_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'bimber_above_collection_newsletter_order', array(
	'label'    => $bimber_order_controls['above_collection_newsletter_order'],
	'section'  => 'bimber_home_before_main_collection_section',
	'settings' => $bimber_option_name . '[above_collection_newsletter_order]',
	'type'     => 'text',
) );

// Patreon order.
$wp_customize->add_setting( $bimber_option_name . '[above_collection_patreon_order]', array(
	'default'           => $bimber_customizer_defaults['above_collection_patreon_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'bimber_above_collection_patreon_order', array(
	'label'    => $bimber_order_controls['above_collection_patreon_order'],
	'section'  => 'bimber_home_before_main_collection_section',
	'settings' => $bimber_option_name . '[above_collection_patreon_order]',
	'type'     => 'text',
) );

// Instagram order.
$wp_customize->add_setting( $bimber_option_name . '[above_collection_instagram_order]', array(
	'default'           => $bimber_customizer_defaults['above_collection_instagram_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'bimber_above_collection_instagram_order', array(
	'label'    => $bimber_order_controls['above_collection_instagram_order'],
	'section'  => 'bimber_home_before_main_collection_section',
	'settings' => $bimber_option_name . '[above_collection_instagram_order]',
	'type'     => 'text',
) );

// Links order.
$wp_customize->add_setting( $bimber_option_name . '[above_collection_links_order]', array(
	'default'           => $bimber_customizer_defaults['above_collection_links_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'bimber_above_collection_links_order', array(
	'label'    => $bimber_order_controls['above_collection_links_order'],
	'section'  => 'bimber_home_before_main_collection_section',
	'settings' => $bimber_option_name . '[above_collection_links_order]',
	'type'     => 'text',
) );

// Promoted Products order.
$wp_customize->add_setting( $bimber_option_name . '[above_collection_promoted_products_order]', array(
	'default'           => $bimber_customizer_defaults['above_collection_promoted_products_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'bimber_above_collection_promoted_products_order', array(
	'label'    => $bimber_order_controls['above_collection_promoted_products_order'],
	'section'  => 'bimber_home_before_main_collection_section',
	'settings' => $bimber_option_name . '[above_collection_promoted_products_order]',
	'type'     => 'text',
) );

// Promoted Product order.
$wp_customize->add_setting( $bimber_option_name . '[above_collection_promoted_product_order]', array(
	'default'           => $bimber_customizer_defaults['above_collection_promoted_product_order'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( 'bimber_above_collection_promoted_product_order', array(
	'label'    => $bimber_order_controls['above_collection_promoted_product_order'],
	'section'  => 'bimber_home_before_main_collection_section',
	'settings' => $bimber_option_name . '[above_collection_promoted_product_order]',
	'type'     => 'text',
) );
