<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $woocommerce, $post;
		
echo '<div class="options_group">';

  woocommerce_wp_checkbox( 
    array( 
      'id'            => '_jt_limit_purchase', 
      'wrapper_class' => 'show_if_simple', 
      'label'         => __('Is this item limited per user?', 'woocommerce' ), 
      'description'   => __( 'Check only if this item should be limited per user per order', 'woocommerce' ) 
    )
  );

  ?>

  <p class="form-field custom_field_type">
    <label for="custom_field_type"><?php echo __( 'Limit per user', 'woocommerce' ); ?></label>
    <span class="wrap">
      <?php 
        $limit_purchase_quantity = (int)get_post_meta( $post->ID, '_jt_limit_purchase_quantity', true );
        if (empty($limit_purchase_quantity) || !is_numeric($limit_purchase_quantity)) {
          $limit_purchase_quantity = 1;
        }
      ?>	
      <input placeholder="<?php _e( 'Field One', 'woocommerce' ); ?>" class="" type="text" name="_jt_limit_purchase_quantity" value="<?php echo $limit_purchase_quantity ?>" />
    </span>
    <span class="description"><?php _e( 'Enter the max quantity a user can purchase per order', 'woocommerce' ); ?></span>
  </p>

  <?php

echo '</div>';