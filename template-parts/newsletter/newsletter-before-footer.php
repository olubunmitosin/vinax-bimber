<?php
/**
 * The template part for displaying a newsletter sign-up form before the main collection.
 *
 * @package Bimber_Theme
 */
?>
<?php
	set_query_var( 'bimber_newsletter_avatar', bimber_get_theme_option( 'newsletter', 'before_footer_avatar' ) );
	set_query_var( 'bimber_newsletter_avatar_hdpi', bimber_get_theme_option( 'newsletter', 'before_footer_avatar_hdpi' ) );
	set_query_var( 'bimber_newsletter_subtitle', bimber_get_theme_option( 'newsletter', 'before_footer_subtitle' ) );
	set_query_var( 'bimber_newsletter_title', bimber_get_theme_option( 'newsletter', 'before_footer_title' ) );
	set_query_var( 'bimber_newsletter_color_scheme', bimber_get_theme_option( 'newsletter', 'before_footer_color_scheme' ) );

	get_template_part( 'template-parts/newsletter/newsletter', 'row' );
