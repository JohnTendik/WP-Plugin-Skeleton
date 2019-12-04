<?php

/**
 * Fired during plugin activation
 *
 * @link       johntendik.com
 * @since      1.0.0
 *
 * @package    JT Limit Purchase
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    JT Limit Purchase
 * @author     John Tendik <johntendik@hotmail.com>
 */
class JT_LIMIT_PURCHASE_ADMIN {

  function __construct() {    
    $this->init();
  }

  function init() {
    // Woocommerce product custom field hook
    add_action( 'woocommerce_product_options_general_product_data', array($this, 'woo_add_custom_general_fields') );
    add_action( 'woocommerce_process_product_meta', array($this, 'woo_add_custom_general_fields_save') );

  }

  function woo_add_custom_general_fields() {
    require_once( JT_LIMIT_PURCHASE_PATH . 'templates/Screens/Admin_Custom_Fields.php' );
  }

  function woo_add_custom_general_fields_save( $post_id ) {
    // Save the availablility date for restriction of usa sales
    $restrictionEndDate = $_POST['_jt_limit_purchase_quantity'];
    update_post_meta( $post_id, '_jt_limit_purchase_quantity', $restrictionEndDate );
      
    // Restriction of USA sales checkbox
    $woocommerce_checkbox = isset( $_POST['_jt_limit_purchase'] ) ? 'yes' : 'no';
    update_post_meta( $post_id, '_jt_limit_purchase', $woocommerce_checkbox );
  }
  
}
