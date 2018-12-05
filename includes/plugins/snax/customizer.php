<?php
/**
 * Snax Customizer integration
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

add_filter( 'bimber_customizer_defaults',       'bimber_snax_add_customizer_defaults' );
add_action( 'bimber_after_customize_register',   'bimber_snax_register_customizer_options', 10, 1 );

/**
 * Register plugin defaults
 *
 * @param array $defaults       Default values.
 *
 * @return array
 */
function bimber_snax_add_customizer_defaults( $defaults ) {
	$defaults['snax_votes_threshold'] = 10;

	return $defaults;
}

/**
 * Add plugin panel
 *
 * @param WP_Customize_Manager $wp_customize        Customizer instance.
 */
function bimber_snax_register_customizer_options( $wp_customize ) {

	$defaults = bimber_get_customizer_defaults();

	/**
	 * Sections
	 */

	$wp_customize->add_section( 'bimber_snax_general_section', array(
		'title'    => esc_html__( 'Snax Plugin', 'bimber' ),
		'priority' => 700,
	) );

	/**
	 * Controls
	 */

	$option_name = bimber_get_theme_id();

	// General > Threshold.
	$wp_customize->add_setting( $option_name . '[snax_votes_threshold]', array(
		'default'           => $defaults['snax_votes_threshold'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'bimber_snax_votes_threshold', array(
		'label'       => esc_html__( 'Hide votes', 'bimber' ),
		'description' => esc_html__( 'If you fill in any number here, the votes for a specific post are not shown until the vote count of this number is reached.', 'bimber' ),
		'section'     => 'bimber_snax_general_section',
		'settings'    => $option_name . '[snax_votes_threshold]',
		'type'        => 'number',
		'input_attrs' => array(
			'class' => 'small-text',
		),
	) );
}
