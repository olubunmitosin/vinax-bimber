<?php
/**
 * Restrict Content Pro plugin functions
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_filter( 'the_excerpt',              'bimber_rcp_message_filter', 1, 1 );
add_filter( 'the_content',              'bimber_rcp_message_filter', 1, 1 );
add_filter( 'bimber_get_entry_flags',   'bimber_rcp_add_restricted_flag' );
add_filter( 'comments_open',            'bimber_rcp_comments_open', 1, 2 );
add_filter( 'get_comments_number',      'bimber_rcp_get_comments_number', 1, 2 );

/**
 * Add custom box to restricted content message.
 *
 * @param string $content           Original RCP message.
 *
 * @return string
 */
function bimber_rcp_message_filter( $content ) {
	// Execute only once.
	static $done = false;
	if ( is_singular() && ! $done ) {
		ob_start();
			get_template_part( 'template-parts/rcp/message', 'paid' );
		$paid_box = ob_get_clean();
		ob_start();
			get_template_part( 'template-parts/rcp/message', 'free' );
		$free_box = ob_get_clean();
		// Get RCP Options so we can know were we are. Simply $message is not enough.
		global $rcp_options;
		$paid = isset( $rcp_options['paid_message'] ) ? $rcp_options['paid_message'] : '';
		$free = isset( $rcp_options['free_message'] ) ? $rcp_options['free_message'] : '';
		$rcp_options['paid_message'] = $paid_box . $paid;
		$rcp_options['free_message'] = $free_box . $free;
		$done = true;
	}
	return $content;
}

function bimber_rcp_add_restricted_flag( $flags ) {
	if ( function_exists( 'rcp_is_paid_content' ) && rcp_is_paid_content( get_the_id() ) ) {
		$flags['members_only'] = array(
			'label' => sprintf( esc_html__( 'Members %s Only', 'bimber' ), '<br>' ),
			'url'   => get_the_permalink(),
			'title' => esc_html__( 'Members Only', 'bimber' ),
		);
	}

	return $flags;
}

function bimber_rcp_comments_open( $open, $post_id ) {
	if ( ! rcp_is_active() ) {
		$open = false;
	}

	return $open;
}

function bimber_rcp_get_comments_number( $count, $post_id ) {
	if ( ! rcp_is_active() ) {
		$count = 0;
	}

	return $count;
}