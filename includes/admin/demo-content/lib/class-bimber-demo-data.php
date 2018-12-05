<?php
/**
 * Class for setting up demo data
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

if ( ! class_exists( 'Bimber_Demo_Data' ) ) {
	/**
	 * Class Bimber_Demo_Data
	 */
	class Bimber_Demo_Data {

		const DEFAULT_DEMO = 'original';

		/**
		 * Demo id
		 *
		 * @var string
		 */
		private $demo;

		/**
		 * Bimber_Demo_Data constructor.
		 *
		 * @param null $demo		Demo id.
		 */
		public function __construct( $demo = null ) {
			$this->demo = $demo ? $demo : self::DEFAULT_DEMO;
		}

		/**
		 * Import theme content, widgets and assigns menus
		 *
		 * @return array        Response: status, message
		 */
		public function import_content() {
			$this->update_image_sizes();

			require_once BIMBER_ADMIN_DIR . 'lib/class-bimber-import-export.php';

			$content_path = trailingslashit( get_template_directory() ) . 'dummy-data/' . $this->demo . '/dummy-data.xml';

			$importer_out = Bimber_Import_Export::import_content_from_file( $content_path, $this->demo );

			// Demo content imported successfully?
			if ( null !== $importer_out ) {
				$response = array(
					'status'  => 'success',
					'message' => $importer_out,
				);

				// Set up menus.
				$this->assign_menus();
				$this->assign_widget_menus();
				$this->fix_menus();

				$this->set_up_menu_items();

				// Set up pages.
				$this->assign_pages();

				// Set up posts.
				$this->set_up_posts();

				do_action( 'bimber_after_import_content' );
			} else {
				$response = array(
					'status'  => 'error',
					'message' => esc_html__( 'Failed to import content', 'bimber' ),
				);
			}

			return $response;
		}

		public function import_widgets() {
			require_once BIMBER_ADMIN_DIR . 'lib/class-bimber-import-export.php';

			// Import widgets.
			$widgets_path = trailingslashit( get_parent_theme_file_path() ) . 'dummy-data/' . $this->demo . '/widgets.txt';

			$imported = Bimber_Import_Export::import_widgets_from_file( $widgets_path, $this->demo );

			if ( $imported ) {
				$response = array(
					'status'  => 'success',
					'message' => esc_html__( 'Widgets imported successfully', 'bimber' ),
				);
			} else {
				$response = array(
					'status'  => 'error',
					'message' => esc_html__( 'Failed to import widgets', 'bimber' ),
				);
			}

			return $response;
		}

		/**
		 * Import theme options
		 *
		 * @return array            Response status and message
		 */
		public function import_theme_options() {

			require_once BIMBER_ADMIN_DIR . 'lib/class-bimber-import-export.php';

			$demo_options_path = trailingslashit( get_template_directory() ) . 'dummy-data/' . $this->demo . '/theme-options.txt';

			if ( Bimber_Import_Export::import_options_from_file( $demo_options_path ) ) {
				$response = array(
					'status'  => 'success',
					'message' => esc_html__( 'Theme options imported successfully.', 'bimber' ),
				);
			} else {
				$response = array(
					'status'  => 'error',
					'message' => esc_html__( 'Failed to import theme options', 'bimber' ),
				);
			}

			return $response;
		}

		/**
		 * Import theme options and content
		 *
		 * @return array        Response status and message
		 */
		public function import_all() {
			$theme_options_response = $this->import_theme_options();

			if ( 'error' === $theme_options_response['status'] ) {
				return $theme_options_response;
			}

			$widgets_response = $this->import_widgets();

			if ( 'error' === $widgets_response['status'] ) {
				return $widgets_response;
			}

			$content_response = $this->import_content();

			if ( 'error' === $content_response['status'] ) {
				return $content_response;
			}

			// If all goes well.
			$response = array(
				'status'  => 'success',
				'message' => esc_html__( 'Import completed successfully.', 'bimber' ),
			);

			return $response;
		}

		/**
		 * Update defined image sizes.
		 */
		protected function update_image_sizes() {
			if ( 'miami' === bimber_get_current_stack() ) {
				remove_image_size( 'bimber-grid-standard' );
				remove_image_size( 'bimber-grid-standard-2x' );

				add_image_size( 'bimber-grid-standard', 364, round( 364 * 3 / 4 ), true );
				add_image_size( 'bimber-grid-standard-2x', 364 * 2, round( 364 * 2 * 3 / 4 ), true );
			}
		}

		/**
		 * Assign menus to locations
		 */
		protected function assign_menus() {
			$menu_location = array(
				'bimber-demo-' . $this->demo . '-primary-menu'      => 'bimber_primary_nav',
				'bimber-demo-' . $this->demo . '-secondary-menu'    => 'bimber_secondary_nav',
				'bimber-demo-' . $this->demo . '-footer-menu'       => 'bimber_footer_nav',
				'bimber-demo-' . $this->demo . '-home-filters'      => 'bimber_home_filters',
			);

			$registered_locations = get_registered_nav_menus();
			$locations            = get_nav_menu_locations();

			foreach ( $menu_location as $menu => $location ) {
				if ( empty( $menu ) && isset( $locations[ $location ] ) ) {
					unset( $locations[ $location ] );
					continue;
				}

				$menu_obj = wp_get_nav_menu_object( $menu );

				if ( ! $menu_obj || is_wp_error( $menu_obj ) ) {
					continue;
				}

				if ( ! array_key_exists( $location, $registered_locations ) ) {
					continue;
				}

				$locations[ $location ] = $menu_obj->term_id;
			}

			set_theme_mod( 'nav_menu_locations', $locations );
		}

		/**
		 * Select menu in widget by title
		 */
		protected function assign_widget_menus() {
			$menus = get_option( 'widget_nav_menu' );
			$updated = false;

			foreach ( $menus as $menu_index => $menu ) {
				if ( ! is_array( $menu ) ) {
					continue;
				}

				if ( empty( $menu['title'] ) ) {
					continue;
				}

				$menu_title  = $menu['title'];
				$terms = get_terms( 'nav_menu', array( 'name' => $menu_title ) );

				if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
					$term = $terms[0];

					// Update menu id.
					$menus[ $menu_index ]['nav_menu'] = $term->term_id;
					$updated = true;
				}
			}

			if ( $updated ) {
				update_option( 'widget_nav_menu', $menus );
			}
		}

		// @todo - refactor!!!
		protected function fix_menus() {
			$items = wp_get_nav_menu_items( 'bimber-demo-relink-home-filters' );

			// Only the Home Filters on the reLink demo will be affected.
			if ( ! $items ) {
				return;
			}

			foreach ( $items as $item ) {
				$menu_item_url = get_post_meta( $item->ID, '_menu_item_url', true );

				$menu_item_url = str_replace( 'http://staging.bimber.bringthepixel.com/relink', home_url(), $menu_item_url );
				$menu_item_url = str_replace( 'http://staging.bimber.bringthepixel.com', home_url(), $menu_item_url );

				update_post_meta( $item->ID, '_menu_item_url', $menu_item_url );
			}
		}

		protected function set_up_menu_items() {
			// Get all menu items with title "Home".
			$nav_items = get_posts( array(
				'title'             => 'Home',
				'post_type'         => 'nav_menu_item',
				'posts_per_page'    => -1
			) );

			foreach( $nav_items as $nav_item ) {
				$post_id = $nav_item->ID;

				$menu_item_url = get_post_meta( $post_id, '_menu_item_url', true );

				// Replace all urls that point to bringthepixel domain.
				if ( strpos( $menu_item_url, 'bringthepixel.com' ) ) {
					update_post_meta( $post_id, '_menu_item_url', home_url() );
				}
			}
		}

		/**
		 * Assign pages
		 */
		protected function assign_pages() {
			$pages = array(
				'top-10'                => array( 'posts', 'top_page' ),
				'hot'                   => array( 'posts', 'hot_page' ),
				'popular'               => array( 'posts', 'popular_page' ),
				'trending'              => array( 'posts', 'trending_page' ),
			);

			// If VC page set, update its ID.
			$vc_page_id = (int) bimber_get_theme_option( 'home', 'vc_page_id' );

			if ( $vc_page_id ) {
				$pages['home-vc'] = array( 'home', 'vc_page_id' );
			}

			foreach ( $pages as $slug => $theme_option ) {
				$page = get_page_by_path( $slug );

				$base = $theme_option[0];
				$key  = $theme_option[1];

				// If page was found.
				if ( $page ) {
					$page_id = $page->ID;
				} else {
					// Reset otherwise.
					$page_id = '';
				}

				bimber_set_theme_option( $base, $key, $page_id );
			}
		}

		protected function set_up_posts() {
			// Set the "Hello World!" post to draft.
			$hello_world_post = get_page_by_path( 'hello-world', OBJECT, 'post' );

			if ( $hello_world_post ) {
				wp_update_post( array(
					'ID'            => $hello_world_post->ID,
					'post_status'   => 'draft',
				) );
			}
		}
	}
}
