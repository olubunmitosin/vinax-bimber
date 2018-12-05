<?php
/**
 * The Template Part for displaying "Link Landing Page".
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

global $bimber_link_data;
?>

<div id="g1-link-landing-page-content">

		<h1 class="g1-alpha g1-alpha-1st"><?php echo esc_html( sprintf( __( 'Redirecting you to "%s"'), get_the_title( $bimber_link_data['post_id'] ) ) ); ?></h1>

		<?php if ( $bimber_link_data['delay'] > 0 ) : ?>
		<p id="g1-link-countdown" class="g1-epsilon g1-epsilon-1st">
			<?php echo wp_kses_post( sprintf( _n( 'in <span id="g1-link-seconds-left">%s</span> second', 'in <span id="g1-link-seconds-left">%s</span> seconds', $bimber_link_data['delay'], 'bimber' ), $bimber_link_data['delay'] ) ); ?>
		</p>
		<?php endif; ?>
		<?php
			get_template_part( 'template-parts/ads/ad-link-exit' );
		?>
	<p id="g1-link-fallback">
		<?php echo wp_kses_post( sprintf( __( 'Please <a href="%s">click here</a> if you have not been redirected automatically.' ), $bimber_link_data['target_url'] ) ); ?>
	</p>
	<script>
		(function($) {
			var updateViewsAndRedirect = function() {
				g1.updatePostViews('<?php echo esc_attr( wp_create_nonce( 'wpp-token' ) ); ?>', <?php echo absint( $bimber_link_data['post_id'] ); ?>);
				window.location.href = '<?php echo esc_url( $bimber_link_data['target_url'] ); ?>';
			};
			var delay = parseInt(<?php echo absint( $bimber_link_data['delay'] ); ?>, 10);
			var singular = '<?php echo wp_kses_post( sprintf( _n( 'in <span id="g1-link-seconds-left">%s</span> second', 'in <span id="g1-link-seconds-left">%s</span> seconds', 1, 'bimber' ), 1 ) ); ?>';
			var interval = setInterval(function() {
				if ( delay > 0 ) {
					delay--;
					if (delay > 1) {
						$('#g1-link-seconds-left').text(delay);
					} else {
						$('#g1-link-countdown').html(singular);
					}
				} else {
					clearInterval(interval);
					updateViewsAndRedirect();
				}
			}, 1000);
			$('#g1-link-fallback a').on('click', function(e) {
				e.preventDefault();
				updateViewsAndRedirect();
			});
		})(jQuery);
	</script>
</div>
