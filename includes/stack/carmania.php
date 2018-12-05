<?php
/**
 * Bimber Theme functions for the stack
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bimber_Theme 5.6
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

add_filter( 'bimber_render_section_title_args', 'bimber_carmania_apply_section_title_class', 10, 2 );

/**
 * Change section title class.
 *
 * @param  array   $args  Args.
 * @param boolean $additional_clases  Additional css classes.
 * @return array
 */
function bimber_carmania_apply_section_title_class( $args, $additional_clases ) {
	if ( is_array( $additional_clases ) && in_array( 'widgettitle', $additional_clases, true ) ){
		return $args;
	}
	$args['class'] = array(
		'g1-beta',
		'g1-beta-2nd',
	);
	return $args;
}
