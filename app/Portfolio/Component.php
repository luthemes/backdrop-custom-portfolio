<?php
/**
 * Portfolio component
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */
namespace BCP\Portfolio;

use Backdrop\Contracts\Bootable;

class Component implements Bootable {

	public function boot(): void {

		// Register custom post type on the 'init' hook.
		add_action( 'init', [ $this, 'register_post_type' ] );
	}

	/**
	 * Returns the labels for the portfolio post type.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function portfolio_labels(): array {
		$labels = [
			'name'                  => esc_html__( 'Portfolios',                    'backdrop-custom-portfolio' ),
			'singular_name'         => esc_html__( 'Portfolio',                     'backdrop-custom-portfolio' ),
			'menu_name'             => esc_html__( 'Portfolio',                     'backdrop-custom-portfolio' ),
			'name_admin_bar'        => esc_html__( 'Portfolio',                     'backdrop-custom-portfolio' ),
			'add_new'               => esc_html__( 'New Portfolio',                 'backdrop-custom-portfolio' ),
			'add_new_item'          => esc_html__( 'Add New Portfolio',             'backdrop-custom-portfolio' ),
			'edit_item'             => esc_html__( 'Edit Portfolio',                'backdrop-custom-portfolio' ),
			'new_item'              => esc_html__( 'New Portfolio',                 'backdrop-custom-portfolio' ),
			'view_item'             => esc_html__( 'View Portfolio',                'backdrop-custom-portfolio' ),
			'view_items'            => esc_html__( 'View Portfolios',               'backdrop-custom-portfolio' ),
			'search_items'          => esc_html__( 'Search Portfolios',             'backdrop-custom-portfolio' ),
			'not_found'             => esc_html__( 'No Portfolios found',           'backdrop-custom-portfolio' ),
			'not_found_in_trash'    => esc_html__( 'No Portfolios found in trash',  'backdrop-custom-portfolio' ),
			'all_items'             => esc_html__( 'Portfolios',                    'backdrop-custom-portfolio' ),
			'featured_image'        => esc_html__( 'Portfolio Image',               'backdrop-custom-portfolio' ),
			'set_featured_image'    => esc_html__( 'Set portfolio image',           'backdrop-custom-portfolio' ),
			'remove_featured_image' => esc_html__( 'Remove portfolio image',        'backdrop-custom-portfolio' ),
			'use_featured_image'    => esc_html__( 'Use as portfolio image',        'backdrop-custom-portfolio' ),
			'insert_into_item'      => esc_html__( 'Insert into portfolio',         'backdrop-custom-portfolio' ),
			'uploaded_to_this_item' => esc_html__( 'Uploaded to this portfolio',    'backdrop-custom-portfolio' ),
			'filter_items_list'     => esc_html__( 'Filter portfolios list',        'backdrop-custom-portfolio' ),
			'items_list_navigation' => esc_html__( 'Portfolios list navigation',    'backdrop-custom-portfolio' ),
			'items_list'            => esc_html__( 'Portfolios list',               'backdrop-custom-portfolio' ),
		];

		return apply_filters( 'bcp/portfolio/labels', $labels );
	}

	public function register_post_type() {

		$args = [
			'labels' => $this->portfolio_labels(),
			'public' => true,
			'has_archive'  => true,
			'menu_icon'    => 'dashicons-category',
			'show_ui'      => true,
			'show_in_rest' => true,
			'supports'     => [ 'title', 'editor', 'thumbnail', 'author' ],
			'rewrite'      => [ 'with_front' => false, 'slug' => bcp_get_portfolio_rewrite_slug() ]
		];

		register_post_type( bcp_get_setting( 'portfolio_type' ), apply_filters( 'bcp/portfolio/args', $args ) );
	}
}
