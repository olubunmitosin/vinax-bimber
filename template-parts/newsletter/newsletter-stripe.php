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
	'g1-light',
	'g1-stripe',
	'g1-stripe-newsletter',
	) );
?>
<div class="<?php echo( join( ' ', array_map( 'sanitize_html_class', $bimber_classes ) ) ); ?>">
	<div class="g1-row-background">
	</div>

	<div class="g1-row-inner">
		<div class="g1-column">
			<div class="g1-stripe-csstodo">
				<div class="g1-stripe-background">
				</div>

				<?php

				?>
				<div class="g1-stripe-inner g1-light">
					<span class="g1-stripe-icon"></span>

					<div class="g1-stripe-body">
						<div class="g1-stripe-content">
							<?php if ( ! empty( $bimber_newsletter_subtitle ) ) : ?>
								<h2 class="g1-zeta g1-zeta-2nd g1-stripe-label"><?php echo( wp_kses_post( $bimber_newsletter_subtitle ) ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $bimber_newsletter_title ) ) : ?>
								<h3 class="g1-stripe-title"><?php echo( wp_kses_post( $bimber_newsletter_title ) ); ?></h3>
							<?php endif; ?>
						</div>

						<div class="g1-stripe-actions">
							<div class="g1-newsletter g1-newsletter-horizontal">
								<?php
								if ( shortcode_exists( 'mc4wp_form' ) ) {
									remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
									remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
									remove_filter( 'mc4wp_form_after_fields', 'bimber_mc4wp_form_after_form', 10, 2 );

									echo do_shortcode( '[mc4wp_form]' );

									add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
									add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
									add_filter( 'mc4wp_form_after_fields', 'bimber_mc4wp_form_after_form', 10, 2 );
								}
								?>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div><!-- g1-row -->
