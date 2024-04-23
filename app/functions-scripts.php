<?php
/**
 * Default scripts
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */

namespace BCP;
use function Backdrop\Mix\pluginAsset;

add_action( 'admin_enqueue_scripts', function() {

    wp_enqueue_style( 'creativity-screen', pluginAsset( 'assets/css/screen.css' ), null, null );
} );

