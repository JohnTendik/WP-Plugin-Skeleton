<?php

/**
 *
 * @link              johntendik.com
 * @since             1.0.0
 * @package           @plugin-name-pretty@
 *
 * @wordpress-plugin
 * Plugin Name:       @plugin-name-pretty@
 * Plugin URI:        johntendik.com
 * Description:       @plugin-name-pretty@ description
 * Version:           1.0.0
 * Author:            John Tendik
 * Author URI:        johntendik.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       @plugin-slug@
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * @plugin-name-pretty@ version
 */
define( '@plugin-const@_VERSION', '1.0.0' );

 /**
 * @plugin-name-pretty@ path contant to be used throughout
 */
define( '@plugin-const@_PATH', plugin_dir_path( __FILE__ ) );

require @plugin-const@_PATH . 'lib/class-@plugin-name@.php';

function run_@plugin-slug@() {

	$plugin = @plugin-className@::get_instance();
	$plugin::register_hooks();
	
	$updaterAvailable = false;
	
	if ($updaterAvailable) {
		// This should only be run after creating the github repo otherwise you will see errors when you activate the plugin.

		if( ! class_exists( 'JT_Plugin_Updater' ) ){
			include_once( PLUGIN_NAME_PATH . 'inc/updater.php' );
		}
		
		$updater = new JT_Plugin_Updater( __FILE__ );
		$updater->set_username( 'github-username' );
		$updater->set_repository( 'github-repository-name' );
		$updater->authorize( 'github-user-token' ); // Your auth code goes here for private repos
		$updater->initialize();
	}
  
}

run_@plugin-slug@();
