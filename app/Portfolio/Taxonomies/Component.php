<?php
/**
 * Taxonomies component
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */

namespace BCP\Portfolio\Taxonomies;

use Backdrop\Contracts\Bootable;

class Component implements Bootable {

	public function boot() {

		// Register taxonomies on the 'init' hook with a priority of 9.
		add_action( 'init', [ $this, 'create_taxonomies' ], 9 );
	}

	/**
	 * Returns the labels for the portfolio category taxonomy.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function category_labels(): array {
		$labels = [
			'name'                       => __( 'Categories',                           'backdrop-custom-portfolio' ),
			'singular_name'              => __( 'Category',								'backdrop-custom-portfolio' ),
			'menu_name'                  => __( 'Categories',                           'backdrop-custom-portfolio' ),
			'name_admin_bar'             => __( 'Category',								'backdrop-custom-portfolio' ),
			'search_items'               => __( 'Search Categories',                    'backdrop-custom-portfolio' ),
			'popular_items'              => __( 'Popular Categories',                   'backdrop-custom-portfolio' ),
			'all_items'                  => __( 'All Categories',                       'backdrop-custom-portfolio' ),
			'edit_item'                  => __( 'Edit Category',						'backdrop-custom-portfolio' ),
			'view_item'                  => __( 'View Category',						'backdrop-custom-portfolio' ),
			'update_item'                => __( 'Update Category',						'backdrop-custom-portfolio' ),
			'add_new_item'               => __( 'Add New Category',						'backdrop-custom-portfolio' ),
			'new_item_name'              => __( 'New Category Name',					'backdrop-custom-portfolio' ),
			'not_found'                  => __( 'No Categories found.',                 'backdrop-custom-portfolio' ),
			'no_terms'                   => __( 'No Categories',                        'backdrop-custom-portfolio' ),
			'pagination'                 => __( 'Categories list navigation',           'backdrop-custom-portfolio' ),
			'list'                       => __( 'Categories list',                      'backdrop-custom-portfolio' ),

			// Non-hierarchical only.
			'separate_items_with_commas' => __( 'Separate Categories with commas',      'backdrop-custom-portfolio' ),
			'add_or_remove_items'        => __( 'Add or remove Categories',				'backdrop-custom-portfolio' ),
			'choose_from_most_used'      => __( 'Choose from the most used Categories',	'backdrop-custom-portfolio' ),
		];

		return apply_filters( 'bcp/portfolio/category/label', $labels );
	}

	/**
	 * Returns the labels for the portfolio tag taxonomy.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function tag_labels(): array {
		$labels = [
			'name'                       => __( 'Tags',                           'backdrop-custom-portfolio' ),
			'singular_name'              => __( 'Tag',                            'backdrop-custom-portfolio' ),
			'menu_name'                  => __( 'Tags',                           'backdrop-custom-portfolio' ),
			'name_admin_bar'             => __( 'Tag',                            'backdrop-custom-portfolio' ),
			'search_items'               => __( 'Search Tags',                    'backdrop-custom-portfolio' ),
			'popular_items'              => __( 'Popular Tags',                   'backdrop-custom-portfolio' ),
			'all_items'                  => __( 'All Tags',                       'backdrop-custom-portfolio' ),
			'edit_item'                  => __( 'Edit tag',                       'backdrop-custom-portfolio' ),
			'view_item'                  => __( 'View tag',                       'backdrop-custom-portfolio' ),
			'update_item'                => __( 'Update tag',                     'backdrop-custom-portfolio' ),
			'add_new_item'               => __( 'Add New tag',                    'backdrop-custom-portfolio' ),
			'new_item_name'              => __( 'New tag Name',                   'backdrop-custom-portfolio' ),
			'not_found'                  => __( 'No Tags found.',                 'backdrop-custom-portfolio' ),
			'no_terms'                   => __( 'No Tags',                        'backdrop-custom-portfolio' ),
			'pagination'                 => __( 'Tags list navigation',           'backdrop-custom-portfolio' ),
			'list'                       => __( 'Tags list',                      'backdrop-custom-portfolio' ),

			// Non-hierarchical only.
			'separate_items_with_commas' => __( 'Separate Tags with commas',      'backdrop-custom-portfolio' ),
			'add_or_remove_items'        => __( 'Add or remove Tags',             'backdrop-custom-portfolio' ),
			'choose_from_most_used'      => __( 'Choose from the most used Tags', 'backdrop-custom-portfolio' ),
		];

		return apply_filters( 'bcp/portfolio/tag/label', $labels );
	}

    /**
     * Registers post types needed by the plugin.
     *
     * @since  0.1.0
     * @access public
     * @return void
     */
    public function create_taxonomies() {

        // Set up the arguments for the portfolio project post type.
		$cat_args = [
			'labels'            => $this->category_labels(),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
		];

		$tag_args = [
			'labels'            => $this->tag_labels(),
			'public'            => true,
			'show_ui'           => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
		];

        // Register the post types.
        register_taxonomy( bcp_get_setting( 'portfolio_category' ),	bcp_get_setting( 'portfolio_type' ), $cat_args );
        register_taxonomy( bcp_get_setting( 'portfolio_tag' ), 		bcp_get_setting( 'portfolio_type' ), $tag_args );
    }
}
