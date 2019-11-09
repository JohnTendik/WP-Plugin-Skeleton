<?php

/**
 *
 * @link              johntendik.com
 * @since             1.0.0
 * @package           @plugin-name@
 *
 * @wordpress-plugin
 * Plugin Name:       @plugin-name@
 * Plugin URI:        johntendik.com
 * Description:       @plugin-name@ description
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
 * @plugin-name@ version
 */
 define( '@plugin-const@_VERSION', '1.0.0' );

 /**
 * @plugin-name@ path contant to be used throughout
 */
 define( '@plugin-const@_PATH', plugin_dir_path( __FILE__ ) );

 /**
 * 
 */
function activate_@plugin-name@() {
	require_once @plugin-const@_PATH . 'inc/@plugin-name@-activation.php';
}

register_activation_hook( __FILE__, 'activate_@plugin-name@' );

 /**
 * 
 */
 function deactivate_@plugin-name@() {
	require_once @plugin-const@_PATH . 'inc/@plugin-name@-deactivation.php';
}

register_deactivation_hook( __FILE__, 'deactivate_@plugin-name@' );

require @plugin-const@_PATH . 'lib/class-@plugin-name@.php';

function run_@plugin-name@() {

	$plugin = new @plugin-name@();
	$plugin->run();

}
run_@plugin-name@();