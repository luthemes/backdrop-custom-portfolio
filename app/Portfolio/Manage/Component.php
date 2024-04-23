<?php
/**
 * Manage component
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */

namespace BCP\Portfolio\Manage;

use Backdrop\Contracts\Bootable;

class Component implements Bootable {

	public function boot() {

		// Custom columns on the edit portfolio items screen.
		add_filter( "manage_edit-portfolio_columns",        [ $this, 'columns' ]            );
		add_action( "manage_portfolio_posts_custom_column", [ $this, 'custom_column'], 10, 2 );
	}

	public function columns( $columns ) {

		$new_columns = [
			'cb'    => $columns['cb'],
			'title' => esc_html__( 'Project', 'backdrop-custom-portfolio' )
		];

		if ( current_theme_supports( 'post-thumbnails' ) ) {

			$new_columns['thumbnail'] = esc_html__( 'Thumbnail', 'backdrop-custom-portfolio' );
		}

		$columns = array_merge( $new_columns, $columns );

		$columns['title'] = $new_columns['title'];

		return $columns;
	}

	public function custom_column( $column, $post_id ) {
		if ( 'thumbnail' === $column ) {

			if ( has_post_thumbnail() ) {

				the_post_thumbnail();
			}
		}
	}

}