<?php
/* Plugin Name: WooCommerce Triple Play Pay Gateway
 * Plugin URI: https://www.tripleplaypay.com/api
 * Description: Make payments through the Triple Play Pay iframe in WooCommerce
 * Author: Triple Play Pay
 * Author URI: https://www.tripleplaypay.com/api
 * Version: 1.2.1
 * 
 * @package WooCommerce Gateway Triple Play Pay
 */

use Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry;

defined('ABSPATH') || exit;

define('WC_GATEWAY_TRIPLEPLAYPAY_VERSION', '1.2.1');
define('WC_GATEWAY_TRIPLEPLAYPAY_PATH', untrailingslashit(plugin_dir_path(__FILE__ )));
define('WC_GATEWAY_TRIPLEPLAYPAY_URL', untrailingslashit(plugins_url(basename(plugin_dir_path(__FILE__)), basename( __FILE__ ))));

add_action('plugins_loaded', 'woocommerce_tripleplaypay_init', 0);
function woocommerce_tripleplaypay_init() {
    if (! class_exists('WC_Payment_Gateway')) return; // WooCommerce Plugin must be installed    

    require_once plugin_basename('includes/class-wc-gateway-tripleplaypay-iframe-settings.php');
    require_once plugin_basename('includes/tripleplaypay-gateway-iframe.php');
    require_once plugin_basename('includes/class-wc-gateway-tripleplaypay.php');
    add_filter('woocommerce_payment_gateways', 'woocommerce_tripleplaypay_add_gateway');
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'woocommerce_tripleplaypay_action_links');
function woocommerce_tripleplaypay_action_links( $links ) {
    // add custom links to the plugin page
    
    $payments_settings_url = add_query_arg(
        [
            'page' => 'wc-settings',
            'tab' => 'checkout',
            'section' => 'wc_gateway_tripleplaypay'
        ],
        admin_url('admin.php')
    );

    $iframe_settings_url = add_query_arg(
        [
            'page' => 'wc-settings',
            'tab' => 'tripleplaypay_iframe_settings'
        ],
        admin_url('admin.php')
    );

    array_unshift( $links, '<a href="'.esc_url( $iframe_settings_url ).'">Setup iframe</a>' );
    array_unshift( $links, '<a href="'.esc_url( $payments_settings_url ).'">Settings</a>' );
    
    return $links;
}

add_action('woocommerce_blocks_loaded', 'woocommerce_tripleplaypay_blocks_support');
function woocommerce_tripleplaypay_blocks_support() {
    if (class_exists('Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType')) {
        
        require_once dirname(__FILE__).'/includes/class-wc-gateway-tripleplaypay-blocks-support.php';
        
        add_action(
            'woocommerce_blocks_payment_method_type_registration',
            function(Automattic\WooCommerce\Blocks\Payments\PaymentMethodRegistry $payment_method_registry) {
                $payment_method_registry->register(new WC_TriplePlayPay_Blocks_Support());
            }
        );
    }
}

// add gateway to global list
function woocommerce_tripleplaypay_add_gateway( $methods ) {
    $methods[] = 'WC_Gateway_TriplePlayPay';
    return $methods;
}