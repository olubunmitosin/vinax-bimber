<?php
/**
 * The template part for displaying a newsletter sign-up form before the main collection.
 *
 * @package Bimber_Theme
 */

if ( ! bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
	return;
}
?>
<?php
$bimber_classes = apply_filters( 'bimber_newsletter_before_main_collection_class', array(
	'g1-row',
	'g1-row-layout-page',
	'g1-row-with-newsletter',
	'g1-light',
) );
?>
<div class="<?php echo( join( ' ', array_map( 'sanitize_html_class', $bimber_classes ) ) ); ?>">
	<div class="g1-row-background">
	</div>

	<div class="g1-row-inner">
		<div class="g1-column">

			<div class="g1-newsletter g1-newsletter-horizontal g1-newsletter-fancy">

				<?php if ( ! empty( $bimber_newsletter_avatar ) ) : ?>
						<div class="g1-newsletter-avatar">
							<?php echo bimber_mc4wp_render_avatar( $bimber_newsletter_avatar, $bimber_newsletter_avatar_hdpi ); ?>
						</div>
				<?php endif; ?>

				<?php if ( ! empty( $bimber_newsletter_title ) ) : ?>
					<h3 class="g1-mega g1-mega-1st"><?php echo( wp_kses_post( $bimber_newsletter_title ) ); ?></h3>
				<?php endif; ?>

				<?php
					if ( shortcode_exists( 'mc4wp_form' ) ) {
						remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 5 );
						remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10 );

						echo do_shortcode( '[mc4wp_form]' );

						add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 5, 2 );
						add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
					}
				?>
			</div>
		</div>
	</div>
</div><!-- .g1-row -->
