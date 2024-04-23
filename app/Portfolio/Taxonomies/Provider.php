<?php
/**
 * Taxonomies service provider.
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */

/**
 * Define namespace
 */
namespace BCP\Portfolio\Taxonomies;

use Backdrop\Core\ServiceProvider;

/**
 * Attr provider class.
 *
 * @since  5.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds the implementation of the attributes contract to the container.
	 *
	 * @since  1..0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( 'bcp/portfolio/taxonomy', Component::class );

	}

	public function boot() {
		$this->app->resolve( 'bcp/portfolio/taxonomy' )->boot();
	}
}