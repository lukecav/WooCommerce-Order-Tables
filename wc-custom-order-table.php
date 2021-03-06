<?php
/**
 * Plugin Name:          WooCommerce - Custom Order Tables
 * Plugin URI:           https://github.com/liquidweb/WooCommerce-Order-Tables
 * Description:          Store WooCommerce order data in a custom table.
 * Version:              1.0.0
 * Author:               Liquid Web
 * Author URI:           https://www.liquidweb.com
 * License:              GPL2
 * License URI:          https://www.gnu.org/licenses/gpl-2.0.html
 *
 * WC requires at least: 3.0.0
 * WC tested up to:      3.2.6
 *
 * @package WooCommerce_Custom_Order_Tables
 * @author  Liquid Web
 */

/* Define constants to use throughout the plugin. */
define( 'WC_CUSTOM_ORDER_TABLE_URL', plugin_dir_url( __FILE__ ) );
define( 'WC_CUSTOM_ORDER_TABLE_PATH', plugin_dir_path( __FILE__ ) );

/* Load includes via a PHP 5.2-compatible autoloader. */
if ( file_exists( WC_CUSTOM_ORDER_TABLE_PATH . 'vendor/autoload_52.php' ) ) {
	require( WC_CUSTOM_ORDER_TABLE_PATH . 'vendor/autoload_52.php' );
}

/**
 * Install the database tables upon plugin activation.
 */
register_activation_hook( __FILE__, array( 'WC_Custom_Order_Table_Install', 'activate' ) );

/**
 * Retrieve an instance of the WC_Custom_Order_Table class.
 *
 * If one has not yet been instantiated, it will be created.
 *
 * @global $wc_custom_order_table
 *
 * @return WC_Custom_Order_Table The global WC_Custom_Order_Table instance.
 */
function wc_custom_order_table() {
	global $wc_custom_order_table;

	if ( ! $wc_custom_order_table instanceof WC_Custom_Order_Table ) {
		$wc_custom_order_table = new WC_Custom_Order_Table;
		$wc_custom_order_table->setup();
	}

	return $wc_custom_order_table;
}

add_action( 'woocommerce_init', 'wc_custom_order_table' );
