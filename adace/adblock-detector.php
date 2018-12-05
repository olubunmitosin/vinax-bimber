<?php
/**
 * Adace Adblock Detector.
 *
 * @package adace
 * @subpackage Frontend Slot
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
$title 			= get_option( 'adace_adblock_detector_title', adace_options_get_defaults( 'adace_adblock_detector_title' ) );
$description 	= get_option( 'adace_adblock_detector_description', adace_options_get_defaults( 'adace_adblock_detector_description' ) );
$page 			= get_option( 'adace_adblock_detector_page', adace_options_get_defaults( 'adace_adblock_detector_page' ) );
?>

<div class="adace-adi-popup-wrapper">
	<div class="adace-adi-popup">
		<div class="adace-adi-flag"></div>

		<h2 class="adace-adi-title g1-beta g1-beta-1st"><?php echo esc_html( $title );?></h2>
		<div class="adace-adi-content"><?php echo wp_kses_post( $description );?></div>
		<div class="adace-adi-buttons">
			<?php if ( '-1' !== $page ) :
				$page_url 		= get_the_permalink( $page );
			?>
				<a href="<?php echo esc_url( $page_url );?>" class="adace-adi-disable-button g1-button-solid g1-button g1-button-m"><?php echo esc_html__( 'How to disable?', 'adace' );?></a><br>
			<?php endif;?>
			<a  class="adace-adi-refresh-button g1-button-simple g1-button g1-button-m"><?php echo esc_html__( 'Refresh', 'adace' );?></a>
		</div>
	</div>
</div>
