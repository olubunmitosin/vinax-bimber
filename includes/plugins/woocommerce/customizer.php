<?php
/**
 * WooCommerce Customizer integration
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

add_filter( 'bimber_customizer_defaults',       'bimber_wc_add_customizer_defaults' );
add_action( 'bimber_after_customize_register',  'bimber_wc_register_customizer_options', 10, 1 );


/**
 * Register plugin defaults
 *
 * @param array $defaults       Default values.
 *
 * @return array
 */
function bimber_wc_add_customizer_defaults( $defaults ) {
	$defaults['woocommerce_cart_visibility']        = 'always';
	$defaults['woocommerce_affiliate_link_target']  = '_blank';
	$defaults['woocommerce_single_product_sidebar'] = 'hide';

	return $defaults;
}

/**
 * Add plugin panel
 *
 * @param WP_Customize_Manager $wp_customize        Customizer instance.
 */
function bimber_wc_register_customizer_options( $wp_customize ) {

	$defaults    = bimber_get_customizer_defaults();
	$option_name = bimber_get_theme_id();

	/**
	 * Sections
	 */

	$wp_customize->add_section( 'bimber_woocommerce_section', array(
		'title'    => esc_html__( 'Bimber Setup', 'bimber' ),
		'panel'    => 'woocommerce',
		'priority' => 1000,
	) );

	/**
	 * Controls
	 */

	// Hide cart.
	$wp_customize->add_setting( $option_name . '[woocommerce_cart_visibility]', array(
		'default'           => $defaults['woocommerce_cart_visibility'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_woocommerce_cart_visibility', array(
		'label'    => esc_html__( 'Show cart in the navbar', 'bimber' ),
		'section'  => 'bimber_woocommerce_section',
		'settings' => $option_name . '[woocommerce_cart_visibility]',
		'type'     => 'select',
		'choices'  => array(
			'always'			=> esc_html__( 'always', 'bimber' ),
			'on_woocommerce'	=> esc_html__( 'on WooCommerce pages', 'bimber' ),
			'none'				=> esc_html__( 'no', 'bimber' ),
		),
	) );

	// Single product sidebar.
	$wp_customize->add_setting( $option_name . '[woocommerce_single_product_sidebar]', array(
		'default'           => $defaults['woocommerce_single_product_sidebar'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_woocommerce_single_product_sidebar', array(
		'label'    => esc_html__( 'Show sidebar on single product', 'bimber' ),
		'section'  => 'bimber_woocommerce_section',
		'settings' => $option_name . '[woocommerce_single_product_sidebar]',
		'type'     => 'select',
		'choices'  => array(
			'show'			=> esc_html__( 'Show', 'bimber' ),
			'hide'			=> esc_html__( 'Hide', 'bimber' ),
		),
	) );

	// Open in.
	$wp_customize->add_setting( $option_name . '[woocommerce_affiliate_link_target]', array(
		'default'           => $defaults['woocommerce_affiliate_link_target'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_woocommerce_affiliate_link_target', array(
		'label'    => esc_html__( 'Open affiliate links', 'bimber' ),
		'section'  => 'bimber_woocommerce_section',
		'settings' => $option_name . '[woocommerce_affiliate_link_target]',
		'type'     => 'select',
		'choices'  => array(
			'_blank'		=> esc_html__( 'in a new window', 'bimber' ),
			'_self'			=> esc_html__( 'in the same window', 'bimber' ),
		),
	) );
}
