<?php
/**
 * Plugin Name:       Single Shipping Product
 * Plugin URI:        https://themexpert.com/
 * Description:       Single shipping plugin for WooCommerce.
 * Version:           1.0.0
 * Author:            ThemeXpert
 * Author URI:        https://themexpert.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       tx-single-shipping
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// add_filter( 'woocommerce_quantity_input_args', 'tx_woocommerce_quantity_min_variation', 10, 2 );
if( ! function_exists('tx_woocommerce_quantity_min_variation') ){
    function tx_woocommerce_quantity_min_variation( $args, $product ) {
        if( is_product() ){
            if( is_single('507') ){
                $args['input_value'] = 1; // Start from this value (default = 1) 
                $args['max_value'] = 10; // Max quantity (default = -1)
                $args['min_value'] = 4; // Min quantity (default = 0)
                $args['step'] = 1; // Increment/decrement by this value (default = 1)
                $args['min_qty'] = 5;	
            }else{
                $args['input_value'] = 1; // Start from this value (default = 1) 
                  $args['max_value'] = 5; // Max quantity (default = -1)
                  $args['min_value'] = 4; // Min quantity (default = 0)
                  $args['step'] = 1; // Increment/decrement by this value (default = 1)
                $args['min_qty'] = 5;
            }
        }
           return $args;
    }
}


add_filter( 'woocommerce_add_to_cart_validation', 'tx_only_one_in_cart', 99, 2 );
/**
 * function for only one prudct 
 * in cart at a single time
 */
if( ! function_exists('tx_only_one_in_cart') ){
    function tx_only_one_in_cart( $passed, $added_product_id ) {
		if(WC()->cart->get_cart_contents_count() != 0): 
            echo "<script type='text/javascript'> alert('Previous cart item will be replaced');</script>";
        	wc_empty_cart();
			return $passed; 
		else:
			wc_empty_cart();
			return $passed; 
		endif;
    }
}

