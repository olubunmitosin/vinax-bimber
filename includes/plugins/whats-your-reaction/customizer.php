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

add_filter( 'bimber_customizer_defaults',       'bimber_wyr_add_customizer_defaults' );
add_action( 'bimber_after_customize_register',   'bimber_wyr_register_customizer_options', 10, 1 );

/**
 * Register plugin defaults
 *
 * @param array $defaults       Default values.
 *
 * @return array
 */
function bimber_wyr_add_customizer_defaults( $defaults ) {
	$defaults['wyr_show_reactions_in_header']       = 'standard';
	$defaults['wyr_show_entry_reactions']           = 'standard';
	$defaults['wyr_show_entry_reactions_single']    = 'standard';
	$defaults['wyr_fake_reaction_count_base']       = '';
	$defaults['wyr_fake_reactions_randomize']       = 'none';
	$defaults['wyr_fake_reactions_disable_for_new'] = 'standard';

	return $defaults;
}

/**
 * Add plugin panel
 *
 * @param WP_Customize_Manager $wp_customize        Customizer instance.
 */
function bimber_wyr_register_customizer_options( $wp_customize ) {

	$defaults    = bimber_get_customizer_defaults();
	$option_name = bimber_get_theme_id();

	/**
	 * Plugin main panel
	 */

	$wp_customize->add_panel( 'bimber_wyr_panel', array(
		'title'    => esc_html__( 'What\'s Your Reaction Plugin', 'bimber' ),
		'priority' => 800,
	) );

	/**
	 * General (section)
	 */

	$wp_customize->add_section( 'bimber_wyr_general_section', array(
		'title'    => esc_html__( 'General', 'bimber' ),
		'priority' => 10,
		'panel'    => 'bimber_wyr_panel',
	) );

	/**
	 * General (controls)
	 */

	// Hide reactions in header.

	$wp_customize->add_setting( $option_name . '[wyr_show_reactions_in_header]', array(
		'default'           => $defaults['wyr_show_reactions_in_header'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_wyr_show_reactions_in_header', array(
		'label'    => esc_html__( 'Show reactions in header', 'bimber' ),
		'section'  => 'bimber_wyr_general_section',
		'settings' => $option_name . '[wyr_show_reactions_in_header]',
		'type'     => 'select',
		'choices'  => array(
			'standard'	=> esc_html__( 'yes', 'bimber' ),
			'none'		=> esc_html__( 'no', 'bimber' ),
		),
	) );

	// Hide entry reactions.

	$wp_customize->add_setting( $option_name . '[wyr_show_entry_reactions]', array(
		'default'           => $defaults['wyr_show_entry_reactions'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_wyr_show_entry_reactions', array(
		'label'    => esc_html__( 'Show entry reactions in collections', 'bimber' ),
		'section'  => 'bimber_wyr_general_section',
		'settings' => $option_name . '[wyr_show_entry_reactions]',
		'type'     => 'select',
		'choices'  => array(
			'standard'	=> esc_html__( 'yes', 'bimber' ),
			'none'		=> esc_html__( 'no', 'bimber' ),
		),
	) );

	// Hide entry reactions.

	$wp_customize->add_setting( $option_name . '[wyr_show_entry_reactions_single]', array(
		'default'           => $defaults['wyr_show_entry_reactions_single'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'bimber_wyr_show_entry_reactions_single', array(
		'label'    => esc_html__( 'Show entry reactions on single post', 'bimber' ),
		'section'  => 'bimber_wyr_general_section',
		'settings' => $option_name . '[wyr_show_entry_reactions_single]',
		'type'     => 'select',
		'choices'  => array(
			'standard'	=> esc_html__( 'yes', 'bimber' ),
			'none'		=> esc_html__( 'no', 'bimber' ),
		),
	) );


	/**
	 * Fake Reactions (section)
	 */

	$wp_customize->add_section( 'bimber_wyr_fakes_section', array(
		'title'    => esc_html__( 'Fake Reactions', 'bimber' ),
		'priority' => 20,
		'panel'    => 'bimber_wyr_panel',
	) );

	/**
	 * Fake Reactions (controls)
	 */

	// Count base.

	$wp_customize->add_setting( 'wyr_fake_reaction_count_base', array(
		'default'           => $defaults['wyr_fake_reaction_count_base'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'wyr_fake_reaction_count_base', array(
		'label'    		=> esc_html__( 'Count base', 'bimber' ),
		'description' 	=>
			esc_html__( 'Fake reactions for a post are calculated based on this value and a post creation date (older posts\' reactions are closer to the count base).', 'bimber' ) .
			'<br />' .
			esc_html__( 'Leave empty to not use the "Fake reactions" feature.', 'bimber' ),
		'section'  		=> 'bimber_wyr_fakes_section',
		'settings' 		=> 'wyr_fake_reaction_count_base',
		'type'     		=> 'number',
		'input_attrs' => array(
			'class' => 'small-text',
		),
	) );

	// Randomize fake reactions?

	$wp_customize->add_setting( 'wyr_fake_reactions_randomize', array(
		'default'           => $defaults['wyr_fake_reactions_randomize'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'wyr_fake_reactions_randomize', array(
		'label'    => esc_html__( 'Randomize fake reactions?', 'bimber' ),
		'section'  => 'bimber_wyr_fakes_section',
		'settings' => 'wyr_fake_reactions_randomize',
		'type'     => 'select',
		'choices'  => array(
			'standard'	=> esc_html__( 'yes', 'bimber' ),
			'none'		=> esc_html__( 'no', 'bimber' ),
		),
	) );


	// Disable fake reactions for new submissions?

	if ( bimber_can_use_plugin( 'snax/snax.php' ) ) {
		$wp_customize->add_setting( 'wyr_fake_reactions_disable_for_new', array(
			'default'           => $defaults['wyr_fake_reactions_disable_for_new'],
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'wyr_fake_reactions_disable_for_new', array(
			'label'         => esc_html__( 'Disable for new submissions', 'bimber' ),
			'description' 	=> esc_html__( 'New users\' submitted posts won\'t be affected with fake reactions.', 'bimber' ),
			'section'       => 'bimber_wyr_fakes_section',
			'settings'      => 'wyr_fake_reactions_disable_for_new',
			'type'          => 'select',
			'choices'       => array(
				'standard'	=> esc_html__( 'yes', 'bimber' ),
				'none'		=> esc_html__( 'no', 'bimber' ),
			),
		) );
	}
}
