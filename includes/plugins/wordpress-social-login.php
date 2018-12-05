<?php
/**
 * Wordpress Social Login plugin functions
 *
 * @package snax
 * @subpackage Plugins
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

remove_action( 'bp_before_account_details_fields', 'wsl_render_auth_widget_in_wp_login_form' );
add_action( 'bp_before_register_page', 'bimber_wsl_buddypress_registration_form', 10 );

function bimber_wsl_buddypress_registration_form() { ?>
	<div class="bp-register-wpsl">
	<?php if ( 'standard' === bimber_get_theme_option( 'bp', 'enable_sidebar' ) ) :?>
	<h3 class="g1-beta">Register with your social network:</h3>
	<?php else : ?>
	<h3 class="g1-beta">With social network:</h3>
	<?php endif;?>
	<?php wsl_render_auth_widget_in_wp_login_form(); ?>
	</div>
	<h3 class="g1-beta">Or register with your email:</h3><?php
}
