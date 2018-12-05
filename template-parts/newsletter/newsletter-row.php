<?php
/**
 * The Template for displaying podcast.
 *
 * @package Bimber_Theme
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
if ( ! bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) )  {
	return;
}
global $bimber_newsletter_section_positon;
$section_classes   = apply_filters( 'bimber_newsletter_large_class', array(
	'g1-row',
	'g1-row-layout-page',
	'g1-newsletter',
	'g1-newsletter-horizontal',
	'g1-newsletter-as-row',
	'g1-newsletter-as-row-' . $bimber_newsletter_section_positon,
) );
$section_classes[] = 'g1-' . $bimber_newsletter_color_scheme;
?>
	<div class="<?php echo implode( ' ', array_map( 'sanitize_html_class', $section_classes ) ); ?>">
		<div class="g1-row-background g1-row-background-csstodo">
		</div>

		<div class="g1-row-inner">
			<div class="g1-column">
				<div class="g1-newsletter-icon">
				</div>

				<?php if ( ! empty( $bimber_newsletter_avatar ) ) : ?>

					<?php if (  $bimber_newsletter_avatar ) : ?>
						<div class="g1-newsletter-avatar"><?php echo bimber_mc4wp_render_avatar( $bimber_newsletter_avatar, $bimber_newsletter_avatar_hdpi ); ?></div>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( ! empty( $bimber_newsletter_subtitle ) ) : ?>
					<h2 class="g1-zeta g1-zeta-2nd"><?php echo( wp_kses_post( $bimber_newsletter_subtitle ) ); ?></h4>
				<?php endif; ?>
				<?php if ( ! empty( $bimber_newsletter_title ) ) : ?>
					<h3 class="g1-newsletter-title g1-mega g1-mega-1st"><?php echo( wp_kses_post( $bimber_newsletter_title ) ); ?></h3>
				<?php endif; ?>

				<?php
					if ( shortcode_exists( 'mc4wp_form' ) ) {
						remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
						remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );

						echo do_shortcode( '[mc4wp_form]' );

						add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 5, 2 );
						add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
					}
				?>
			</div>
		</div>
	</div>
<?php
