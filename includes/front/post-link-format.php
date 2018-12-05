<?php
/**
 * Post Link format
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

add_filter( 'the_content',              'bimber_link_lading_page_content' );
add_filter( 'get_the_excerpt',          'bimber_remove_link_from_excerpt' );
add_filter( 'bimber_show_excerpt_more', 'bimber_hide_link_excerpt_more_link' );
add_filter( 'bimber_link_permalink',    'bimber_use_link_landing_page_permalink', 10, 2 );

/**
 * Add the link redirection content
 *
 * @param string $content       Page content.
 *
 * @return string
 */
function bimber_link_lading_page_content( $content ) {
	if ( ! bimber_is_link_landing_page() ) {
		return $content;
	}

	$landing_page_content = bimber_get_link_landing_page_content();

	if ( empty( $landing_page_content ) ) {
		return $content;
	}

	$landing_page_content_tag = apply_filters( 'bimber_link_landing_page_content_tag', '<!--bimber-link-landing-page-content-->' );

	if ( false !== strpos( $content, $landing_page_content_tag ) ) {
		$content = str_replace( $landing_page_content_tag, $landing_page_content, $content );
	} else {
		// Append to the content.
		$content .= $landing_page_content;
	}

	return $content;
}

/**
 * Remove a link from the post excerpt
 *
 * @param string $post_excerpt      Post excerpt.
 *
 * @return string
 */
function bimber_remove_link_from_excerpt( $post_excerpt ) {
	if ( 'link' === get_post_format() ) {
		$has_url = get_url_in_content( get_the_content() );

		if ( $has_url ) {
			// Url is sticked to the text.
			$post_excerpt = str_replace( $has_url, '', $post_excerpt );

			// Url is separated from text with a space.
			$post_excerpt = str_replace( $has_url . ' ', '', $post_excerpt );
		}
	}

	return $post_excerpt;
}

/**
 * Hide the excerpt more link for the Link format
 *
 * @param bool $show    If show or not the excerpt more link.
 *
 * @return bool
 */
function bimber_hide_link_excerpt_more_link( $show ) {
	if ( 'link' === get_post_format() ) {
		$show = false;
	}

	return $show;
}

/**
 * Change link url to the landing page
 *
 * @param string $url       Post url.
 * @param int    $post_id   Post id.
 *
 * @return string
 */
function bimber_use_link_landing_page_permalink( $url, $post_id ) {
	$landing_page_id = bimber_get_link_landing_page_id();

	if ( $landing_page_id > 0 ) {
		$url = get_permalink( $landing_page_id );

		$encoded_args = base64_encode( json_encode( array( 'p' => $post_id ) ) );

		$query_arg_id = bimber_get_link_query_arg_id();

		$url = add_query_arg( array(
			$query_arg_id => $encoded_args,
		), $url );
	}

	return $url;
}

/**
 * Return id of query url arg
 *
 * @return string
 */
function bimber_get_link_query_arg_id() {
	return apply_filters( 'bimber_link_query_arg_id', 'd' );
}

/**
 * Return link landing page id (0 is not set)
 *
 * @return int
 */
function bimber_get_link_landing_page_id() {
	return (int) bimber_get_theme_option( 'post', 'link_landing_page' );
}

/**
 * Check whether the current page is the landing page for a link
 *
 * @return bool
 */
function bimber_is_link_landing_page() {
	$landing_page_id = bimber_get_link_landing_page_id();

	if ( $landing_page_id > 0 && is_page() ) {
		$page = get_post();

		return $page->ID === $landing_page_id;
	}

	return false;
}

/**
 * Return time (in seconds) after link redirection will start
 *
 * @return int
 */
function bimber_get_link_redirection_delay() {
	return (int) bimber_get_theme_option( 'post', 'link_redirection_delay' );
}

/**
 * Return link landing page content
 *
 * @return string
 */
function bimber_get_link_landing_page_content() {
	global $bimber_link_data;

	$query_arg_id = bimber_get_link_query_arg_id();

	$link_data = filter_input( INPUT_GET, $query_arg_id, FILTER_SANITIZE_STRING );

	// Missing arg, skip.
	if ( empty( $link_data ) ) {
		return '';
	}

	$link_args = json_decode( base64_decode( $link_data ), true );

	// Invalid args, skip.
	if ( ! isset( $link_args['p'] ) ) {
		return '';
	}

	$delay      = bimber_get_link_redirection_delay();
	$target_url = bimber_get_link_target_url( $link_args['p'] );

	$bimber_link_data = array(
		'delay'      => $delay,
		'target_url' => $target_url,
		'post_id'    => $link_args['p'],
	);

	ob_start();
	get_template_part( 'template-parts/post/link-landing-page' );
	$html = ob_get_clean();

	return $html;
}

/**
 * Return link format target url
 *
 * @param int $post     Post id.
 *
 * @return string
 */
function bimber_get_link_target_url( $post = 0 ) {
	$post = get_post( $post );

	$has_url = get_url_in_content( $post->post_content );

	$url = $has_url ? $has_url : get_permalink();

	return $url;
}