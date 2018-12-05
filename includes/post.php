<?php
/**
 * Post functions
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

/**
 * Get ids of popular posts
 *
 * @param int $limit Maximum number of ids to return.
 *
 * @return array
 */
function bimber_get_popular_post_ids( $limit = 10 ) {
	$ids = array();

	$posts = get_posts( array(
		'posts_per_page'        => $limit,
		'post_type'             => 'any',
		'ignore_sticky_posts'   => true,
		'orderby'    => 'meta_value_num',
		'order'      => 'ASC',
		'meta_query' => array(
			array(
				'key'     => '_bimber_popular',
				'compare' => 'EXISTS',
			),
		),
	) );

	foreach ( $posts as $post ) {
		$ids[] = $post->ID;
	}

	// Empty array in post__in clause results in returning all posts.
	if ( empty( $ids ) ) {
		$ids[] = -1;
	}

	return apply_filters( 'bimber_popular_post_ids', $ids, $limit );
}

/**
 * Get ids of hot posts
 *
 * @param int $limit Maximum number of ids to return.
 *
 * @return array
 */
function bimber_get_hot_post_ids( $limit = 10 ) {
	$ids = array();

	$posts = get_posts( array(
		'posts_per_page'        => $limit,
		'post_type'             => 'any',
		'ignore_sticky_posts'   => true,
		'orderby'    => 'meta_value_num',
		'order'      => 'ASC',
		'meta_query' => array(
			array(
				'key'     => '_bimber_hot',
				'compare' => 'EXISTS',
			),
		),
	) );

	foreach ( $posts as $post ) {
		$ids[] = $post->ID;
	}

	// Empty array in post__in clause results in returning all posts.
	if ( empty( $ids ) ) {
		$ids[] = -1;
	}

	return apply_filters( 'bimber_hot_post_ids', $ids, $limit );
}

/**
 * Get ids of trending posts
 *
 * @param int $limit Maximum numbef of ids to return.
 *
 * @return mixed|void
 */
function bimber_get_trending_post_ids( $limit = 10 ) {
	$ids = array();

	$posts = get_posts( array(
		'posts_per_page'        => $limit,
		'post_type'             => 'any',
		'ignore_sticky_posts'   => true,
		'orderby'    => 'meta_value_num',
		'order'      => 'ASC',
		'meta_query' => array(
			array(
				'key'     => '_bimber_trending',
				'compare' => 'EXISTS',
			),
		),
	) );

	foreach ( $posts as $post ) {
		$ids[] = $post->ID;
	}

	// Empty array in post__in clause results in returning all posts.
	if ( empty( $ids ) ) {
		$ids[] = -1;
	}

	return apply_filters( 'bimber_trending_post_ids', $ids, $limit );
}
