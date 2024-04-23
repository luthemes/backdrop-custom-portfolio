<?php
/**
 * Boot the framework.
 *
 * @package   Backdrop Custom Portfolio
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-custom-portfolio
 */

# ----------------------------------------------------------------------------------
# Create a new application.
# ----------------------------------------------------------------------------------
#
# This code creates the one true instance of the Backdrop Core Application, which can
# be access via the `Backdrop\app();` function or the `Backdrop\App` static class after
# the application has been booted.

$bcp = Backdrop\booted() ? Backdrop\app() : new Backdrop\Core\Application();

# ------------------------------------------------------------------------------
# Register default service providers with the application.
# ------------------------------------------------------------------------------
#
# Here are the default service providers that are essential for the theme to function
# before booting the application. These service providers form the foundation for the
# theme.
$bcp->provider( BCP\Portfolio\Provider::class );
$bcp->provider( BCP\Portfolio\Taxonomies\Provider::class );

# ------------------------------------------------------------------------------
# Register additional service providers for the theme.
# ------------------------------------------------------------------------------
#
# These are the additional service providers that are crucial for the theme to
# operate before booting the application. These providers offer supplementary
# features to the theme.
if ( is_admin() ) {
	$bcp->provider( BCP\Portfolio\Manage\Provider::class );
	$bcp->provider( BCP\Portfolio\Settings\Provider::class );
}

# ------------------------------------------------------------------------------
# Perform bootstrap actions.
# ------------------------------------------------------------------------------
#
# This code creates an action hook that child themes or plugins can utilize to
# integrate their own binding into the bootstrap process before the app is booted.
# The action callback receives the application instance as a parameter.

do_action( 'bcp/bootstrap', $bcp );

# ------------------------------------------------------------------------------
# Bootstrap the application.
# ------------------------------------------------------------------------------
#
# The code invokes the `boot();` method of the application, which initiates the
# launch of the application. Congratulations on a job well done!

$bcp->boot();