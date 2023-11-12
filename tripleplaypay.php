<?php
/*
 * Plugin Name: Triple Play Pay Gateway
 * Plugin URI: https://www.tripleplaypay.com/api
 * Description: Take payments through the Triple Play Pay iframe
 * Author: Triple Play Pay
 * Author URI: https://www.tripleplaypay.com/api
 * Version: 1.0.1
 */


add_filter('woocommerce_payment_gateways', 'tripleplaypay_add_gateway_class');
function tripleplaypay_add_gateway_class() {
    $gateways[] = 'WC_TriplePlayPay_Gateway';
    return $gateways;
}

add_action('plugins_loaded', 'tripleplaypay_init_gateway_class');
function tripleplaypay_init_gateway_class() {

    load_plugin_textdomain('wc-gateway-name', false, dirname( plugin_basename( __FILE__ ) ) . '/languages');

    class WC_TriplePlayPay_Gateway extends WC_Payment_Gateway {

        public function __construct() {
            $this->id = 'tripleplaypay';
            $this->icon = 'https://3playpay.com/wp-content/uploads/2022/05/TPP_logo_reversed_horz3.png';
            $this->has_fields = true;
            $this->method_title = 'Triple Play Pay Gateway';
            $this->method_description = 'Take payments through the Triple Play Pay iframe';

            $this->supports = ['products'];

            $this->init_form_fields();
            $this->init_settings();

            $this->apikey = $this->get_option('apikey');
            if ($this->apikey == NULL) {
                $this->apikey = 'TESTAPIKEY';
            }

            $this->domain = $this->get_option('environment'); // default to sandbox if not selected
            if ($this->domain == NULL) {
                $this->domain = 'sandbox';
            }

            $this->phone_option = $this->get_option('phoneoption');
            $this->full_name = $this->get_option('fullname');
            $this->address = $this->get_option('address');
            $this->zip_mode = $this->get_option('zipmode');

            $this->payment_type = $this->get_option('paymenttype');
            $this->payment_options = ['credit_card', 'digital'];

            if ($this->get_option('bank') == 'yes')
                array_push($this->payment_options, 'bank');
            
            $this->payment_options = '[\''.implode('\',\'', $this->payment_options).'\']';

            add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
            add_action('wp_enqueue_scripts', [$this, 'payment_scripts']);
        }

        public function init_form_fields() {
            $this->form_fields = [
                'enabled' => [
                    'title' => 'Enable/Disable',
                    'label' => 'Enable the Triple Play Pay Gateway',
                    'type' => 'checkbox',
                    'default' => 'no'
                ],
                'bank' => [
                    'title' => 'Bank / ACH Payments',
                    'description' => 'Allow the iframe to take banking info as payment',
                    'type' => 'checkbox',
                    'default' => 'no'
                ],
                'environment' => [
                    'title' => 'Gateway Environment',
                    'description' => 'Testing environment transactions will not be charged',
                    'type' => 'select',
                    'options' => [
                        'sandbox' => 'Testing (Development)',
                        'www' => 'Live (Production)'
                    ],
                    'default' => 'sandbox'
                ],
                'apikey' => [
                    'title' => 'Triple Play Pay API Key',
                    'type' => 'text',
                    'default' => '',
                ],
                'paymenttype' => [
                    'title' => 'Payment Type',
                    'description' => 'The type of transaction being run',
                    'type' => 'select',
                    'options' => [
                        'charge' => 'Charge',
                    ],
                    'default' => 'charge'
                ],
                'zipmode' => [
                    'title' => 'Enable ZipCode',
                    'description' => 'Choose whether to ask for a ZipCode or not',
                    'type' => 'select',
                    'options' => [
                        'required' => 'Required',
                        'disabled' => 'Disabled'
                    ],
                    'default' => 'disabled'
                ]
            ];
        }

        public function payment_fields() {
            do_action('woocommerce_credit_card_form_start', $this->id);
            
            if ($this->domain == 'sandbox') {
                echo '<center>This is a test transaction</center>';
            }

            ?>
            <div id="tripleplaypay-gateway" style="padding: 25px"></div>
            <script src="https://<?php echo $this->domain; ?>.tripleplaypay.com/static/js/triple.js"></script>
            <script>
                document.querySelector('#place_order').style.display = 'none'; // hide actual submit button
                new Triple("<?php echo $this->apikey; ?>").generatePaymentForm({
                    containerSelector: "#tripleplaypay-gateway",
                    paymentType: "<?php echo $this->payment_type; ?>",
                    amount: "<?php echo WC()->cart->cart_contents_total; ?>",
                    paymentOptions: <?php echo $this->payment_options; ?>,
                    zipMode: "<?php echo $this->zip_mode; ?>",
                    emailOption: "disabled",
                    savePaymentToken: false,
                    onSuccess: () => document.querySelector('#place_order').click(), // process the payment in woo
                    onFailure: (error) => { alert(error); } // just to get it to work, need to figure out something more graceful
                });
            </script>
            <?php
            do_action('woocommerce_credit_card_form_end', $this->id);
        }

        public function payment_scripts() {
            if (is_checkout()) { // putting them here makes it load BEFORE payment_fields renders, much cleaner
                ?>
                <script>
                    // scripts for the checkout page
                    document.addEventListener('DOMContentLoaded', () => {});
                </script>
                <?php
            }
        }

        public function process_payment( $order_id ) {

            // simply process the payment, should already be good in TPP backend.
            // TODO: make this sync with TPP to make sure it's good

            $order = wc_get_order($order_id);
            $order->payment_complete();
            $order->reduce_order_stock();
            $order->add_order_note('Thank you!', true);
            
            WC()->cart->empty_cart();
 
			return [
				'result' => 'success',
				'redirect' => $this->get_return_url($order),
            ];
        }
    }
}
