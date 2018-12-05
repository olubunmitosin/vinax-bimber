<?php
/**
 * The template part for displaying a newsletter sign-up form before the main collection.
 *
 * @package Bimber_Theme
 */
?>
<?php
	if ( ! bimber_can_use_plugin( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
		return;
	}

	$bimber_subtitle = bimber_get_theme_option( 'newsletter', 'before_collection_subtitle' );
	$bimber_title = bimber_get_theme_option( 'newsletter', 'before_collection_title' );
	$bimber_newsletter_avatar = bimber_get_theme_option( 'newsletter', 'before_collection_avatar' );

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

				<div class="g1-stripe-inner g1-light">
					<span class="g1-stripe-icon"></span>

					<div class="g1-stripe-body">
						<div class="g1-stripe-content">
							<?php if ( ! empty( $bimber_subtitle ) ) : ?>
								<h2 class="g1-zeta g1-zeta-2nd g1-stripe-label"><?php echo( wp_kses_post( $bimber_subtitle ) ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $bimber_title ) ) : ?>
								<h3 class="g1-stripe-title"><?php echo( wp_kses_post( $bimber_title ) ); ?></h3>
							<?php endif; ?>

						</div>

						<div class="g1-stripe-actions">
							<div class="g1-newsletter g1-newsletter-horizontal">
							<?php if ( ! empty( $bimber_newsletter_avatar ) ) : ?>

								<?php if (  $bimber_newsletter_avatar ) : ?>
									<div class="g1-newsletter-avatar"><?php echo bimber_mc4wp_render_avatar( $bimber_newsletter_avatar, false ); ?></div>
								<?php endif; ?>
							<?php endif; ?>
								<?php
								if ( shortcode_exists( 'mc4wp_form' ) ) {
									remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
									remove_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10 );

									echo do_shortcode( '[mc4wp_form]' );

									add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_avatar_before_form', 10, 2 );
									add_filter( 'mc4wp_form_before_fields', 'bimber_mc4wp_form_before_form', 10, 2 );
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
