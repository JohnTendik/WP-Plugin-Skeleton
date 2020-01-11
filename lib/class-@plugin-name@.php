<?php

/**
 * Fired during plugin activation
 *
 * @link       johntendik.com
 * @since      1.0.0
 *
 * @package    @plugin-name-pretty@
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    @plugin-name-pretty@
 * @author     John Tendik <johntendik@hotmail.com>
 */
class @plugin-className@ {

	/**
   * The unique instance of the plugin.
   *
   * @var @plugin-className@
   */
  private static $instance;

  /**
   * Gets an instance of our plugin.
   *
   * @return @plugin-className@
   */
  public static function get_instance() {
    if (null === self::$instance) {
      self::$instance = new self();
    }
    
    return self::$instance;
  }

  /**
   * Constructor.
   */
  private function __construct() {
    // Setup main class here such as
    // $this->AdminPage = new JT_Shipping_Admin_Page
    // $this->Options = new JT_Shipping_Options
    // $this->Shortcodes = new JT_Shipping_Shortcodes

    // Use the constructor to setup the main class files only
    // Do not add actions or filters here. They should happen in 
    // A separate static function within each class
  }

  public static function register_hooks() {
    // Register hooks here if needed.
    // Do not call this function from the constructor method
    // Instead, it should be done when you instantiate a class
  }
  
}
