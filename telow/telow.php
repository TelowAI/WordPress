<?php


/**
 * Include Reporter Class
 * @since	1.0.0
 */

 require plugin_dir_path( __FILE__ ) . 'includes/class-telow-reporter.php';


 function telowErrorHandler($errno, $errstr, $errfile = '', $errline = 0, $errcontext = array()){
     // Getting error type
     $errorType = array (
             E_ERROR            => 'ERROR',
             E_WARNING        => 'WARNING',
             E_PARSE          => 'PARSING ERROR',
             E_NOTICE         => 'NOTICE',
             E_CORE_ERROR     => 'CORE ERROR',
             E_CORE_WARNING   => 'CORE WARNING',
             E_COMPILE_ERROR  => 'COMPILE ERROR',
             E_COMPILE_WARNING => 'COMPILE WARNING',
             E_USER_ERROR     => 'USER ERROR',
             E_USER_WARNING   => 'USER WARNING',
             E_USER_NOTICE    => 'USER NOTICE',
             E_STRICT         => 'STRICT NOTICE',
             E_RECOVERABLE_ERROR  => 'RECOVERABLE ERROR'
             );
 
     if (array_key_exists($errno, $errorType)) {
         $err = $errorType[$errno];
     } else {
         $err = 'CAUGHT EXCEPTION';
     }
 
     $ERROR_URL = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 
     // Report Bugs to Telow Stream
     $reporter = new Telow_Reporter();
     $reporter->report("$errstr. Error on line $errline in $errfile", $err, $ERROR_URL, 'PHP', $errno);
 
 }
 
 set_error_handler('telowErrorHandler');


// require 'boy.php';


/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://telow.com
 * @since             1.0.0
 * @package           Telow
 *
 * @wordpress-plugin
 * Plugin Name:       Telow
 * Description:       Telow is a WordPress plugin for tracking all your WP bugs and reporting them to your Telow account. Which can help you solve your bugs with artificial intelligence (AI).
 * Version:           1.0.0
 * Author:            Telow
 * Author URI:        https://telow.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       telow
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TELOW_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-telow-activator.php
 */
function activate_telow() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-telow-activator.php';
	Telow_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-telow-deactivator.php
 */
function deactivate_telow() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-telow-deactivator.php';
	Telow_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_telow' );
register_deactivation_hook( __FILE__, 'deactivate_telow' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-telow.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_telow() {

	$plugin = new Telow();
	$plugin->run();

}
run_telow();