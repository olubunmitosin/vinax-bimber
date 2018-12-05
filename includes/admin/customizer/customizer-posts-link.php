<?php
/**
 * WP Customizer panel section to handle the Link post format options
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

$wp_customize->add_section( 'bimber_posts_link_section', array(
	'title'    => esc_html__( 'Single - Link Post Format', 'bimber' ),
	'priority' => 30,
	'panel'    => 'bimber_posts_panel',
) );

// Landing page.
$wp_customize->add_setting( $bimber_option_name . '[post_link_landing_page]', array(
	'default'           => $bimber_customizer_defaults['post_link_landing_page'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_post_link_landing_page', array(
	'label'         => esc_html__( 'Landing page', 'bimber' ),
	'description'   => esc_html__( 'Run an external link redirection from a separate page.', 'bimber' ),
	'section'  => 'bimber_posts_link_section',
	'settings' => $bimber_option_name . '[post_link_landing_page]',
	'type'     => 'dropdown-pages',
) );

// Delay.
$wp_customize->add_setting( $bimber_option_name . '[post_link_redirection_delay]', array(
	'default'           => $bimber_customizer_defaults['post_link_redirection_delay'],
	'type'              => 'option',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( 'bimber_post_link_redirection_delay', array(
	'label'         => esc_html__( 'Redirection delay (in seconds)', 'bimber' ),
	'description'   => esc_html__( 'Set to 0 to disable the delay counter.', 'bimber' ),
	'section'       => 'bimber_posts_link_section',
	'settings'      => $bimber_option_name . '[post_link_redirection_delay]',
	'type'          => 'number',
) );
