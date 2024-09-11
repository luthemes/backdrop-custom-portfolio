<?php
/**
 * Settings component
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */

namespace BCP\Portfolio\Settings;

use Backdrop\Contracts\Bootable;

class Component implements Bootable {

	/**
	 * Settings page name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public $settings_page = '';

	/**
	 * Sets up custom admin menus.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function admin_menu() {

		// Create the settings page.
		$this->settings_page = add_submenu_page(
			'edit.php?post_type=' . 'portfolio',
			esc_html__( 'Portfolio Settings', 'backdrop-custom-portfolio' ),
			esc_html__( 'Settings',           'backdrop-custom-portfolio' ),
			'manage_options',
			'bcp-settings',
			array( $this, 'settings_page' )
		);

		if ( $this->settings_page ) {

			// Register settings.
			add_action( 'admin_init', array( $this, 'register_settings' ) );
		}
	}

	/**
	 * Registers the plugin settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	function register_settings() {

		// Register the setting.
		register_setting( 'bcp_settings', 'bcp_settings', array( $this, 'validate_settings' ) );

		/* === Settings Sections === */

		add_settings_section( 'general',    esc_html__( 'General Settings', 'backdrop-custom-portfolio' ), array( $this, 'section_general'    ), $this->settings_page );
		add_settings_section( 'permalinks', esc_html__( 'Permalinks',       'backdrop-custom-portfolio' ), array( $this, 'section_permalinks' ), $this->settings_page );

		/* === Settings Fields === */

		// General section fields
		add_settings_field( 'portfolio_title',       esc_html__( 'Title',       'backdrop-custom-portfolio' ), array( $this, 'field_portfolio_title'       ), $this->settings_page, 'general' );
		add_settings_field( 'portfolio_description', esc_html__( 'Description', 'backdrop-custom-portfolio' ), array( $this, 'field_portfolio_description' ), $this->settings_page, 'general' );

		// Permalinks section fields.
		add_settings_field( 'portfolio_rewrite_base', esc_html__( 'Portfolio Base', 'backdrop-custom-portfolio' ), array( $this, 'field_portfolio_rewrite_base' ), $this->settings_page, 'permalinks' );
	}

	/**
	 * Validates the plugin settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $settings
	 * @return array
	 */
	function validate_settings( array $settings ): array {

		// Text boxes.
		$settings['portfolio_title']        = $settings['portfolio_title']        ? strip_tags( $settings['portfolio_title'] ) : esc_html__( 'Portfolio', 'backdrop-custom-portfolio' );
		$settings['portfolio_rewrite_base'] = $settings['portfolio_rewrite_base'] ? trim( strip_tags( $settings['portfolio_rewrite_base'] ), '/' ) : 'portfolio';

		// Kill evil scripts.
		$settings['portfolio_description'] = stripslashes( wp_filter_post_kses( addslashes( $settings['portfolio_description'] ) ) );

		// Return the validated/sanitized settings.
		return $settings;
	}

	/**
	 * General section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function section_general() { ?>

		<p class="description">
			<?php esc_html_e( 'General portfolio settings for your site.', 'backdrop-custom-portfolio' ); ?>
		</p>
	<?php }

	/**
	 * Portfolio title field callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function field_portfolio_title() { ?>

		<label>
			<input type="text" class="regular-text" name="bcp_settings[portfolio_title]" value="<?php echo esc_attr( bcp_get_portfolio_title() ); ?>" />
			<br />
			<span class="description"><?php esc_html_e( 'The name of your portfolio. May be used for the portfolio page title and other places, depending on your theme.', 'backdrop-custom-portfolio' ); ?></span>
		</label>
	<?php }

	/**
	 * Portfolio description field callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function field_portfolio_description() {

		wp_editor(
			bcp_get_portfolio_description(),
			'bcp_portfolio_description',
			array(
				'textarea_name'    => 'bcp_settings[portfolio_description]',
				'drag_drop_upload' => true,
				'editor_height'    => 150
			)
		); ?>

		<p>
			<span class="description"><?php esc_html_e( 'Your portfolio description. This may be shown by your theme on the portfolio page.', 'backdrop-custom-portfolio' ); ?></span>
		</p>
	<?php }

	/**
	 * Permalinks section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function section_permalinks() { ?>

		<p class="description">
			<?php esc_html_e( 'Set up custom permalinks for the portfolio section on your site.', 'backdrop-custom-portfolio' ); ?>
		</p>
	<?php }

	/**
	 * Portfolio rewrite base field callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function field_portfolio_rewrite_base() { ?>

		<label>
			<code><?php echo esc_url( home_url( '/' ) ); ?></code>
			<input type="text" class="regular-text code" name="bcp_settings[portfolio_rewrite_base]" value="<?php echo esc_attr( bcp_get_portfolio_rewrite_base() ); ?>" />
		</label>
	<?php }

	/**
	 * Renders the settings page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings_page() {

		// Flush the rewrite rules if the settings were updated.
		if ( isset( $_GET['settings-updated'] ) )
			flush_rewrite_rules(); ?>

			<div class="wrap">
				<h1><?php esc_html_e( 'Portfolio Settings', 'backdrop-custom-portfolio' ); ?></h1>

				<?php settings_errors(); ?>

				<form method="post" action="options.php">
					<?php settings_fields( 'bcp_settings' ); ?>
					<?php do_settings_sections( $this->settings_page ); ?>
					<?php submit_button( esc_attr__( 'Update Settings', 'backdrop-custom-portfolio' ), 'primary' ); ?>
				</form>

			</div><!-- wrap -->
	<?php }

	public function boot(): void {

		// Custom columns on the edit portfolio items screen.
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}
}