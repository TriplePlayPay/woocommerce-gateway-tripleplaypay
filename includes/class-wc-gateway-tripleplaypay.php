<?php

define("IFRAME_STATUS", "tripleplaypay_iframe_status");

class WC_Gateway_TriplePlayPay extends WC_Payment_Gateway {

    private function get_option_or($option, $default) {
        $value = $this->get_option($option);
        return $value == NULL ? $default : $value;
    }

    public function __construct() {
        // WooCommerce Meta
        $this->version = WC_GATEWAY_TRIPLEPLAYPAY_VERSION;
        $this->id = 'tripleplaypay';
        $this->icon = 'https://3playpay.com/wp-content/uploads/2022/05/TPP_logo_reversed_horz3.png';

        // Text that displays on the settings card
        $this->method_title = 'Triple Play Pay Gateway';
        $this->method_description = 'Take payments through the Triple Play Pay iframe';
        
        // only supporting simple sales for offered products
        $this->supports = ['products'];

        $this->init_form_fields(); // initialize the field schema
        $this->init_settings(); // retrieve the settings' values

        $this->api_key = $this->get_option_or('api_key', 'testapikey');
        $this->allow_ach = $this->get_option_or('allow_ach', false);
        $this->domain = $this->get_option_or('env', 'sandbox'); // default to sandbox if not selected
        $this->zip_mode = $this->get_option_or('zip_mode', 'required');
        $this->button_text = $this->get_option_or('button_text', 'Pay ${amount}');
        $this->use_experimental_form = $this->get_option_or('use_expierimental_form', false);
        
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
        add_action('woocommerce_receipt_' . $this->id, [$this, 'receipt_page']);
    }

    public function init_form_fields() {
        $this->form_fields = [
            'enabled' => [
                'title' => 'Enable/Disable',
                'label' => 'Enable the Triple Play Pay Gateway',
                'type' => 'checkbox',
                'default' => 'no'
            ],
            'api_key' => [
                'title' => 'Triple Play Pay Client API Key',
                'description' => 'The API Key is required to use the iframe',
                'type' => 'text',
                'default' => ''
            ],
            'env' => [
                'title' => 'Payment Processing Environment',
                'description' => 'Testing environment transactions will not be charged',
                'type' => 'select',
                'options' => [
                    'sandbox' => 'Testing (Development)',
                    'www' => 'Live (Production)',
                ],
                'default' => 'sandbox'
            ],
            'allow_ach' => [
                'title' => 'ACH',
                'description' => 'Enable / Disable ACH transactions',
                'type' => 'select',
                'options' => [
                    true => 'Enable',
                    false => 'Disable'
                ],
                'default' => false
            ],
            'zip_mode' => [
                'title' => 'ZIP Code Input',
                'description' => 'Display ZIP Code input on the payment form',
                'type' => 'select',
                'options' => [
                    'required' => 'Enabled',
                    'disabled' => 'Disabled',
                ],
                'default' => 'required'
            ]
        ];
    }

	public function receipt_page( $order_id ) {

        $status_key = "tripleplaypay_iframe_status";
        $order = wc_get_order($order_id); // get the customer's order

        if (isset($_GET[$status_key]) && $_GET[$status_key] === "true") {
            // iframe returned a successful transaction so handle the cart logic
            $order->payment_complete();
            $order->reduce_order_stock();
            WC()->cart->empty_cart();

            // Go to the completed order page
            wp_redirect($this->get_return_url($order));
        }

        
        echo tripleplaypay_iframe($this, $order->get_total());
    }

    public function process_payment( $order_id ) {
        $order = wc_get_order( $order_id );
		return array(
			'result'   => 'success',
			'redirect' => $order->get_checkout_payment_url( true ),
		);
    }
}