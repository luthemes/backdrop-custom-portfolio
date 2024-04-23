<?php
/**
 * Default Rewrites
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */

/**
 * Returns the project rewrite slug used for single projects.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function bcp_get_portfolio_rewrite_slug(): string {

	$slug = bcp_get_portfolio_rewrite_base();

	return apply_filters( 'bcp_get_project_rewrite_slug', $slug );
}
