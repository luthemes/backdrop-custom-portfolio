<?php
/**
 * Plugin Name: Backdrop Custom Portfolio
 * Plugin URI:  https://luthemes.com/portfolio/backdrop-custom-portfolio
 * Description: A simple way to create custom portfolio.
 * Author:      Benjamin Lu
 * Author URI:  https://luthemes.com
 * Text Domain: backdrop-custom-portfolio
 * Domain Path: /languages
 * Version:     1.0.1
 * Requires CP: 1.0
 * Requires PHP: 7.0
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * 1.0 - Forbidden Access
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 2.0 - Required Files
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';
}