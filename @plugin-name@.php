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

	$plugin = @plugin-className@()::get_instance();
  $plugin::register_hooks();
  
}

run_@plugin-slug@();
