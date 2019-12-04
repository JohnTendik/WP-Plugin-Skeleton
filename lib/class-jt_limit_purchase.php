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
class JT_LIMIT_PURCHASE {

  function __construct() {    
    $this->init();
  }

  function init() {
    add_action( 'admin_init', array($this, 'do_admin') );

    add_filter( 'woocommerce_add_to_cart_validation', array($this, 'filter_woocommerce_add_to_cart_validation'), 10, 3 ); 

    // Validate country on checkout just in case we miss the add to cart validation
    add_action( 'woocommerce_after_checkout_validation', array($this, 'validate_checkout'), 10, 2 );
  }

  function do_admin() {
    include_once( JT_LIMIT_PURCHASE_PATH . 'lib/jt_limit_purchase_admin.php' );
    $this->admin = new JT_LIMIT_PURCHASE_ADMIN();
  }

  function can_purchase($product_id, $selectedQuantity) {
    $is_limited = get_post_meta($product_id,'_jt_limit_purchase',true);
    $limit_quantity = (int)get_post_meta($product_id,'_jt_limit_purchase_quantity',true);
    
    if($is_limited == "yes") {

      if(empty($limit_quantity) || !is_numeric($limit_quantity)) {
        return false;
      } else if ($selectedQuantity > $limit_quantity) {
        return false;
      } else {
        // product is limited so check cart items
        $canPurchase = true;
        foreach ( WC()->cart->get_cart() as $cart_item ) {
          $item_id = $cart_item['data']->get_id();
          $quantityInCart = $cart_item['quantity'];
          if ($item_id === $product_id) {
            if ($quantityInCart >= $limit_quantity) {
              $canPurchase = false;
            }
          }
        }

        return $canPurchase;
      }

      return false;
    }
    
    return true;
  }

  function filter_woocommerce_add_to_cart_validation($isValid, $product_id, $quantity) {
    if (!$this->can_purchase($product_id, $quantity)) {
      $isValid = false;
      wc_add_notice( __( 'There is a limit of 2 per person purchase limit for this product.', 'jt-group-breaks' ), 'error' );
    }
    
    return $isValid;
  }

  function validate_checkout($data, $errors) {
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
      // if a product is restricted to USA then add an error
      if ( ! $this->can_purchase($cart_item['data']->id, $cart_item['quantity']) ) {
        $errors->add('quantity', sprintf(__( 'There is a 2 per person purchase limit for %s.', 'woocommerce' ), $cart_item['data']->get_title()));
      }
    }
  }
  
}
