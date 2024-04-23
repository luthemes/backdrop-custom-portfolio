<?php
/**
 * Default options
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */

/**
 * Returns the portfolio title.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function bcp_get_portfolio_title(): string {
	return apply_filters( 'bcp_get_portfolio_title', bcp_get_setting( 'portfolio_title' ) );
}

/**
 * Returns the portfolio description.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function bcp_get_portfolio_description(): string {
	return apply_filters( 'bcp_get_portfolio_description', bcp_get_setting( 'portfolio_description' ) );
}

/**
 * Returns the portfolio rewrite base. Used for the project archive and as a prefix for taxonomy,
 * author, and any other slugs.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function bcp_get_portfolio_rewrite_base(): string {

	return apply_filters( 'bcp_get_portfolio_rewrite_base', bcp_get_setting( 'portfolio_rewrite_base' ) );
}

/**
 * Returns a plugin setting.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $setting
 * @return string
 */
function bcp_get_setting( string $setting ): string {

	$defaults = bcp_get_default_settings();
	$settings = wp_parse_args( get_option( 'bcp_settings', $defaults ), $defaults );

	return $settings[$setting] ?? false;
}

/**
 * Returns the default settings for the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return array
 */
function bcp_get_default_settings(): array {

	return [
		'portfolio_title'			=> esc_html__( 'Portfolio', 'backdrop-custom-portfolio' ),
		'portfolio_description'		=> '',
		'portfolio_rewrite_base'	=> 'portfolio',
		'portfolio_type' 			=> 'portfolio',
		'portfolio_category'		=> 'portfolio-category',
		'portfolio_tag'				=> 'portfolio-tag'
	];
}
