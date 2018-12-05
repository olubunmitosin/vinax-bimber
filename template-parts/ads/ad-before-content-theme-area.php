<?php
/**
 * The Template for displaying ad after post content.
 *
 * @package Bimber_Theme 5.0
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
set_query_var( 'plugin_required_notice_slot_id', esc_html__( 'Before content theme area', 'bimber' ) );
?>

<?php if ( bimber_can_use_plugin( 'quick-adsense-reloaded/quick-adsense-reloaded.php' ) && ( quads_has_ad( 'bimber_before_content_theme_area' ) ) ) : ?>
	<?php $bimber_ad = quads_ad( array( 'location' => 'bimber_before_content_theme_area', 'echo' => false ) ); ?>
	<?php if ( ! empty( $bimber_ad ) ) : ?>
		<div class="g1-row g1-row-layout-page g1-advertisement g1-advertisement-before-content-theme-area">
			<div class="g1-row-inner">
				<div class="g1-column">

					<?php echo bimber_sanitize_ad( $bimber_ad ); ?>

				</div>
			</div>
			<div class="g1-row-background"></div>
		</div>
	<?php endif; ?>
<?php endif;

if ( bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) && ( adace_is_ad_slot( 'bimber_before_content_theme_area' ) ) ) : ?>
	<?php $bimber_ad = adace_get_ad_slot( 'bimber_before_content_theme_area' ); ?>
	<?php if ( ! empty( $bimber_ad ) ) : ?>
		<div class="g1-row g1-row-layout-page g1-advertisement g1-advertisement-before-content-theme-area">
			<div class="g1-row-inner">
				<div class="g1-column">

					<?php echo bimber_sanitize_ad( $bimber_ad ); ?>

				</div>
			</div>
			<div class="g1-row-background"></div>
		</div>
		<?php
		$slot = get_option( 'adace_slot_bimber_before_content_theme_area_options', false );
		if ( $slot ) {
			if ( isset( $slot['background_color'] ) && $slot['background_color'] ) {
				?>
				<style>
					.g1-advertisement-before-content-theme-area .g1-row-background{
						background-color:<?php echo esc_attr( $slot['background_color'] ); ?>!important;
					}
				</style>
			<?php }
		}?>
	<?php endif; ?>
<?php endif;