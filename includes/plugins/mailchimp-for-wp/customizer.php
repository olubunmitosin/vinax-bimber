<?php
/**
 * Download Monitor Customizer integration
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

add_filter( 'bimber_customizer_defaults',       'bimber_mc4wp_customizer_defaults' );
add_action( 'bimber_after_customize_register',  'bimber_mc4wp_register_customizer_options', 10, 1 );

/**
 * Register plugin defaults
 *
 * @param array $defaults       Default values.
 *
 * @return array
 */
function bimber_mc4wp_customizer_defaults( $defaults ) {
	$newsletter_defaults = array(
		'newsletter_privacy'               		        => esc_html__( 'Don\'t worry, we don\'t spam', 'bimber' ),
		'newsletter_slideup'                           	=> false,
		'newsletter_slideup_title'                     	=> esc_html__( 'Don\'t miss out on new posts!', 'bimber' ),
		'newsletter_slideup_avatar'                    	=> '',
		'newsletter_popup'                             	=> false,
		'newsletter_popup_title'                       	=> esc_html__( 'Hey Friend!<br>Before You Go...', 'bimber' ),
		'newsletter_popup_subtitle'                    	=> esc_html__( 'Get the best viral stories straight into your inbox before everyone else!', 'bimber' ),
		'newsletter_popup_cover'                       	=> '',
		'newsletter_in_collection_title'               	=> esc_html__( 'Get the best viral stories straight into your inbox!', 'bimber' ),
		'newsletter_in_collection_subtitle'             => '',
		'newsletter_in_collection_avatar'              	=> '',
		'newsletter_before_collection_title'           	=> esc_html__( 'Want more stuff like this?', 'bimber' ),
		'newsletter_before_collection_subtitle'        	=> esc_html__( 'Get the best viral stories straight into your inbox!', 'bimber' ),
		'newsletter_before_collection_avatar' 			=> '',
		'newsletter_before_collection_avatar_hdpi' 	    => '',
		'newsletter_before_collection_invert'           	=> false,
		'newsletter_after_post_content_title'          	=> esc_html__( 'Want more stuff like this?', 'bimber' ),
		'newsletter_after_post_content_subtitle'       	=> esc_html__( 'Get the best viral stories straight into your inbox!', 'bimber' ),
		'newsletter_after_post_content_cover' 			=> '',
		'newsletter_before_footer_subtitle'             => '',
		'newsletter_before_footer_avatar'              	=> '',
		'newsletter_other_title'                       	=> esc_html__( 'Want more stuff like this?', 'bimber' ),
		'newsletter_other_avatar'                      	=> '',
	);

	$defaults = array_merge( $defaults, $newsletter_defaults );

	return $defaults;
}

/**
 * Register Customizer settings
 *
 * @param WP_Customize_Manager $wp_customize        Customizer instance.
 */
function bimber_mc4wp_register_customizer_options( $wp_customize ) {

	$defaults    = bimber_get_customizer_defaults();
	$option_name = bimber_get_theme_id();

	/**
	 * Plugin main panel
	 */

	$wp_customize->add_panel( 'bimber_newsletter_panel', array(
		'title'    => esc_html__( 'Mailchimp for WP Plugin', 'bimber' ),
		'priority' => 620,
	) );


	/**
	 * "General" panel
	 */

	$wp_customize->add_section( 'bimber_newsletter_general_section', array(
		'title'    => esc_html__( 'General', 'bimber' ),
		'priority' => 10,
		'panel'    => 'bimber_newsletter_panel',
	) );

	// Privacy.

	$wp_customize->add_setting( $option_name . '[newsletter_privacy]', array(
		'default'           => $defaults['newsletter_privacy'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'bimber_newsletter_privacy', array(
		'label'    => esc_html__( 'Privacy', 'bimber' ),
		'section'  => 'bimber_newsletter_general_section',
		'settings' => $option_name . '[newsletter_privacy]',
		'type'     => 'textarea',
	) );


	/**
	 * "Popup" panel
	 */

	$wp_customize->add_section( 'bimber_newsletter_popup_section', array(
		'title'    => esc_html__( 'Popup', 'bimber' ),
		'priority' => 20,
		'panel'    => 'bimber_newsletter_panel',
	) );

	// Enable popup.

	$wp_customize->add_setting( $option_name . '[newsletter_popup]', array(
		'default'           => $defaults['newsletter_popup'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'newsletter_popup', array(
		'label'    => esc_html__( 'Enable', 'bimber' ),
		'section'  => 'bimber_newsletter_popup_section',
		'settings' => $option_name . '[newsletter_popup]',
		'type'     => 'checkbox',
	) );

	// Popup title.

	$wp_customize->add_setting( $option_name . '[newsletter_popup_title]', array(
		'default'           => $defaults['newsletter_popup_title'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_popup_title', array(
		'label'       => esc_html__( 'Title', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_popup_section',
		'settings'    => $option_name . '[newsletter_popup_title]',
		'type'        => 'textarea',
	) );

	// Popup subtitle.

	$wp_customize->add_setting( $option_name . '[newsletter_popup_subtitle]', array(
		'default'           => $defaults['newsletter_popup_subtitle'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_popup_subtitle', array(
		'label'       => esc_html__( 'Subtitle', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_popup_section',
		'settings'    => $option_name . '[newsletter_popup_subtitle]',
		'type'        => 'textarea',
	) );

	// Popup cover.

	$wp_customize->add_setting( $option_name . '[newsletter_popup_cover]', array(
		'default'           => $defaults['newsletter_popup_cover'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_popup_cover', array(
		'label'    => esc_html__( 'Cover', 'bimber' ),
		'section'  => 'bimber_newsletter_popup_section',
		'settings' => $option_name . '[newsletter_popup_cover]',
	) ) );


	/**
	 * "Slide up" panel
	 */

	$wp_customize->add_section( 'bimber_newsletter_slideup_section', array(
		'title'    => esc_html__( 'Slide Up', 'bimber' ),
		'priority' => 30,
		'panel'    => 'bimber_newsletter_panel',
	) );

	// Enable slide up.

	$wp_customize->add_setting( $option_name . '[newsletter_slideup]', array(
		'default'           => $defaults['newsletter_slideup'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'newsletter_slideup', array(
		'label'    => esc_html__( 'Enable', 'bimber' ),
		'section'  => 'bimber_newsletter_slideup_section',
		'settings' => $option_name . '[newsletter_slideup]',
		'type'     => 'checkbox',
	) );

	// Slide up title.

	$wp_customize->add_setting( $option_name . '[newsletter_slideup_title]', array(
		'default'           => $defaults['newsletter_slideup_title'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_slideup_title', array(
		'label'       => esc_html__( 'Title', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_slideup_section',
		'settings'    => $option_name . '[newsletter_slideup_title]',
		'type'        => 'textarea',
	) );

	// Slide up avatar.

	$wp_customize->add_setting( $option_name . '[newsletter_slideup_avatar]', array(
		'default'           => $defaults['newsletter_slideup_avatar'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_slideup_avatar', array(
		'label'    => esc_html__( 'Avatar', 'bimber' ),
		'section'  => 'bimber_newsletter_slideup_section',
		'settings' => $option_name . '[newsletter_slideup_avatar]',
	) ) );


	/**
	 * "Before collection" panel
	 */

	$wp_customize->add_section( 'bimber_newsletter_before_collection_section', array(
		'title'    => esc_html__( 'Before Collection', 'bimber' ),
		'priority' => 40,
		'panel'    => 'bimber_newsletter_panel',
	) );

	// Before collection title.

	$wp_customize->add_setting( $option_name . '[newsletter_before_collection_title]', array(
		'default'           => $defaults['newsletter_before_collection_title'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_before_collection_title', array(
		'label'       => esc_html__( 'Title', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_before_collection_section',
		'settings'    => $option_name . '[newsletter_before_collection_title]',
		'type'        => 'textarea',
	) );

	// Before collection subtitle.

	$wp_customize->add_setting( $option_name . '[newsletter_before_collection_subtitle]', array(
		'default'           => $defaults['newsletter_before_collection_subtitle'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_before_collection_subtitle', array(
		'label'       => esc_html__( 'Subtitle', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_before_collection_section',
		'settings'    => $option_name . '[newsletter_before_collection_subtitle]',
		'type'        => 'textarea',
	) );

	// Before collection avatar.

	$wp_customize->add_setting( $option_name . '[newsletter_before_collection_avatar]', array(
		'default'           => $defaults['newsletter_before_collection_avatar'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_before_collection_avatar', array(
		'label'    => esc_html__( 'Avatar', 'bimber' ),
		'section'  => 'bimber_newsletter_before_collection_section',
		'settings' => $option_name . '[newsletter_before_collection_avatar]',
	) ) );

	/**
	 * "In collection" panel
	 */

	$wp_customize->add_section( 'bimber_newsletter_in_collection_section', array(
		'title'    => esc_html__( 'In Collection', 'bimber' ),
		'priority' => 50,
		'panel'    => 'bimber_newsletter_panel',
	) );

	// In collection title.

	$wp_customize->add_setting( $option_name . '[newsletter_in_collection_title]', array(
		'default'           => $defaults['newsletter_in_collection_title'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_in_collection_title', array(
		'label'       => esc_html__( 'Title', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_in_collection_section',
		'settings'    => $option_name . '[newsletter_in_collection_title]',
		'type'        => 'textarea',
	) );

	// In collection subtitle.

	$wp_customize->add_setting( $option_name . '[newsletter_in_collection_subtitle]', array(
		'default'           => $defaults['newsletter_in_collection_subtitle'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_in_collection_subtitle', array(
		'label'       => esc_html__( 'Subtitle', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_in_collection_section',
		'settings'    => $option_name . '[newsletter_in_collection_subtitle]',
		'type'        => 'textarea',
	) );

	// In collection avatar.

	$wp_customize->add_setting( $option_name . '[newsletter_in_collection_avatar]', array(
		'default'           => $defaults['newsletter_in_collection_avatar'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_in_collection_avatar', array(
		'label'    => esc_html__( 'Avatar', 'bimber' ),
		'section'  => 'bimber_newsletter_in_collection_section',
		'settings' => $option_name . '[newsletter_in_collection_avatar]',
	) ) );


	/**
	 * "After post content" panel
	 */

	$wp_customize->add_section( 'bimber_newsletter_after_post_content_section', array(
		'title'    => esc_html__( 'After Post Content', 'bimber' ),
		'priority' => 60,
		'panel'    => 'bimber_newsletter_panel',
	) );

	// After post content title.

	$wp_customize->add_setting( $option_name . '[newsletter_after_post_content_title]', array(
		'default'           => $defaults['newsletter_after_post_content_title'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_after_post_content_title', array(
		'label'       => esc_html__( 'Title', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_after_post_content_section',
		'settings'    => $option_name . '[newsletter_after_post_content_title]',
		'type'        => 'textarea',
	) );

	// After post content subtitle.

	$wp_customize->add_setting( $option_name . '[newsletter_after_post_content_subtitle]', array(
		'default'           => $defaults['newsletter_after_post_content_subtitle'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_after_post_content_subtitle', array(
		'label'       => esc_html__( 'Subtitle', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_after_post_content_section',
		'settings'    => $option_name . '[newsletter_after_post_content_subtitle]',
		'type'        => 'textarea',
	) );

	// After post content cover.

	$wp_customize->add_setting( $option_name . '[newsletter_after_post_content_cover]', array(
		'default'           => $defaults['newsletter_after_post_content_cover'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_after_post_content_cover', array(
		'label'    => esc_html__( 'Cover', 'bimber' ),
		'section'  => 'bimber_newsletter_after_post_content_section',
		'settings' => $option_name . '[newsletter_after_post_content_cover]',
	) ) );

	/**
	 * "Before footer" panel
	 */

	$wp_customize->add_section( 'bimber_newsletter_before_footer_section', array(
		'title'    => esc_html__( 'Before footer', 'bimber' ),
		'priority' => 70,
		'panel'    => 'bimber_newsletter_panel',
	) );

	// Before footer title.

	$wp_customize->add_setting( $option_name . '[newsletter_before_footer_title]', array(
		'default'           => $defaults['newsletter_before_footer_title'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_before_footer_title', array(
		'label'       => esc_html__( 'Title', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_before_footer_section',
		'settings'    => $option_name . '[newsletter_before_footer_title]',
		'type'        => 'textarea',
	) );

	// Before footer subtitle.

	$wp_customize->add_setting( $option_name . '[newsletter_before_footer_subtitle]', array(
		'default'           => $defaults['newsletter_before_footer_subtitle'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_before_footer_subtitle', array(
		'label'       => esc_html__( 'Subtitle', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_before_footer_section',
		'settings'    => $option_name . '[newsletter_before_footer_subtitle]',
		'type'        => 'textarea',
	) );

	// Before footer avatar.

	$wp_customize->add_setting( $option_name . '[newsletter_before_footer_avatar]', array(
		'default'           => $defaults['newsletter_before_footer_avatar'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_before_footer_avatar', array(
		'label'    => esc_html__( 'Avatar', 'bimber' ),
		'section'  => 'bimber_newsletter_before_footer_section',
		'settings' => $option_name . '[newsletter_before_footer_avatar]',
	) ) );

	/**
	 * "Widget" panel
	 */

	$wp_customize->add_section( 'bimber_newsletter_widget_section', array(
		'title'    => esc_html__( 'Widget', 'bimber' ),
		'priority' => 80,
		'panel'    => 'bimber_newsletter_panel',
	) );

	// Widget title.

	$wp_customize->add_setting( $option_name . '[newsletter_other_title]', array(
		'default'           => $defaults['newsletter_other_title'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'bimber_sanitize_section_title_allowed_tags',
	) );
	$wp_customize->add_control( 'bimber_newsletter_other_title', array(
		'label'       => esc_html__( 'Title', 'bimber' ),
		'description' => '',
		'section'     => 'bimber_newsletter_widget_section',
		'settings'    => $option_name . '[newsletter_other_title]',
		'type'        => 'textarea',
	) );

	// Widget avatar.

	$wp_customize->add_setting( $option_name . '[newsletter_other_avatar]', array(
		'default'           => $defaults['newsletter_other_avatar'],
		'type'              => 'option',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bimber_newsletter_other_avatar', array(
		'label'    => esc_html__( 'Avatar', 'bimber' ),
		'section'  => 'bimber_newsletter_widget_section',
		'settings' => $option_name . '[newsletter_other_avatar]',
	) ) );
}
