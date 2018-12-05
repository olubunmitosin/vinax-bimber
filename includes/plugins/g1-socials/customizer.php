<?php
/**
 * G1 Socials Customizer integration
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

add_filter( 'bimber_customizer_defaults',       'bimber_g1_socials_add_customizer_defaults' );
add_action( 'bimber_after_customize_register',  'bimber_g1_socials_register_customizer_options', 10, 1 );

/**
 * Register plugin defaults
 *
 * @param array $defaults       Default values.
 *
 * @return array
 */
function bimber_g1_socials_add_customizer_defaults( $defaults ) {
	$defaults['instagram_username']     = '';
	$defaults['instagram_follow_text']  = esc_html__( 'Follow Me', 'bimber' );

	return $defaults;
}

/**
 * Add plugin panel
 *
 * @param WP_Customize_Manager $wp_customize        Customizer instance.
 */
function bimber_g1_socials_register_customizer_options( $wp_customize ) {

	$defaults    = bimber_get_customizer_defaults();
	$option_name = bimber_get_theme_id();

	/**
	 * PANEL: main
	 */

	$wp_customize->add_panel( 'bimber_g1_socials_panel', array(
		'title'    => esc_html__( 'G1 Socials Plugin', 'bimber' ),
		'priority' => 600,
	) );

	/**
	 * SECTION: Instagram
	 */

	$wp_customize->add_section( 'bimber_instagram_section', array(
		'title'    => esc_html__( 'Instagram', 'bimber' ),
		'panel'    => 'bimber_g1_socials_panel',
		'priority' => 10,
	) );

	/**
	 * CONTROLS: Instagram
	 */

	// Username.
	$wp_customize->add_setting( $option_name . '[instagram_username]', array(
		'default'           => $defaults['instagram_username'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_instagram_username',
	) );

	$wp_customize->add_control( 'bimber_instagram_username', array(
		'label'    => esc_html__( 'Username', 'bimber' ),
		'section'  => 'bimber_instagram_section',
		'settings' => $option_name . '[instagram_username]',
		'type'     => 'text',
	) );

	// Follow text.
	$wp_customize->add_setting( $option_name . '[instagram_follow_text]', array(
		'default'           => $defaults['instagram_follow_text'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_instagram_follow_text', array(
		'label'    => esc_html__( 'Follow Text', 'bimber' ),
		'section'  => 'bimber_instagram_section',
		'settings' => $option_name . '[instagram_follow_text]',
		'type'     => 'text',
	) );


}

