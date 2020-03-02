<?php
/**
 * Wordpress server security tester
 * @package wp-servsec
 * 
 */

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 */
define( 'WPSERVSEC_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-svs-activator.php
 */
function activate_wpservsec() {
	require_once plugin_dir_path( WPSERVSEC_PLUGIN_FILE ).'/includes/class-svs-activator.php';
	SVS_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-svs-deactivator.php
 */
function deactivate_wpservsec() {
	require_once plugin_dir_path( WPSERVSEC_PLUGIN_FILE ).'/includes/class-svs-deactivator.php';
	SVS_Deactivator::deactivate();
}

register_activation_hook( WPSERVSEC_PLUGIN_FILE, 'activate_wpservsec' );
register_deactivation_hook( WPSERVSEC_PLUGIN_FILE, 'deactivate_wpservsec' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks
 */
require plugin_dir_path( WPSERVSEC_PLUGIN_FILE ) . '/includes/class-wp-servsec.php';


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpservsec() {

	$plugin = new Wp_Servsec();
	$plugin->run();

}

run_wpservsec();
