<?php

/**
 *
 * @link              johntendik.com
 * @since             1.0.0
 * @package           JT Limit Purchase
 *
 * @wordpress-plugin
 * Plugin Name:       JT Limit Purchase
 * Plugin URI:        johntendik.com
 * Description:       JT Limit Purchase description
 * Version:           1.0.1
 * Author:            John Tendik
 * Author URI:        johntendik.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jt_limit_purchase
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * JT Limit Purchase version
 */
 define( 'JT_LIMIT_PURCHASE_VERSION', '1.0.1' );

 /**
 * JT Limit Purchase path contant to be used throughout
 */
 define( 'JT_LIMIT_PURCHASE_PATH', plugin_dir_path( __FILE__ ) );

 /**
 * 
 */
function activate_jt_limit_purchase() {
	require_once JT_LIMIT_PURCHASE_PATH . 'inc/jt_limit_purchase-activation.php';
}

register_activation_hook( __FILE__, 'activate_jt_limit_purchase' );

 /**
 * 
 */
 function deactivate_jt_limit_purchase() {
	require_once JT_LIMIT_PURCHASE_PATH . 'inc/jt_limit_purchase-deactivation.php';
}

register_deactivation_hook( __FILE__, 'deactivate_jt_limit_purchase' );

require JT_LIMIT_PURCHASE_PATH . 'lib/class-jt_limit_purchase.php';

function run_jt_limit_purchase() {

	$plugin = new JT_LIMIT_PURCHASE();

}
run_jt_limit_purchase();