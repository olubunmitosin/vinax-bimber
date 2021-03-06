<?php
/**
 * The Template for displaying ad before Comments section.
 *
 * @package Bimber_Theme 5.0
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
set_query_var( 'plugin_required_notice_slot_id', esc_html__( 'Before comments area', 'bimber' ) );
?>

<?php if ( bimber_can_use_plugin( 'quick-adsense-reloaded/quick-adsense-reloaded.php' ) && ( quads_has_ad( 'bimber_before_comments' ) ) ) : ?>
	<div class="g1-advertisement g1-advertisement-before-comments">
		<?php echo bimber_sanitize_ad( quads_ad( array( 'location' => 'bimber_before_comments', 'echo' => false ) ) ); ?>
	</div>
<?php endif;

if ( bimber_can_use_plugin( 'ad-ace/ad-ace.php' ) && ( adace_is_ad_slot( 'bimber_before_comments' ) ) ) : ?>
	<div class="g1-advertisement g1-advertisement-before-comments">
		<?php echo bimber_sanitize_ad( adace_get_ad_slot( 'bimber_before_comments' ) ); ?>
	</div>
<?php endif;
