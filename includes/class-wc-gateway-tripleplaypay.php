<?php


class WC_Gateway_TriplePlayPay extends WC_Payment_Gateway {

    protected $api_key;
    public $version;

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
        $this->domain = $this->get_option_or('env', 'sandbox'); // default to sandbox if not selected
        $this->allow_ach = $this->get_option_or('allow_ach', 'no');
        $this->zip_mode = $this->get_option_or('zip_mode', 'required');
        $this->button_text = $this->get_option_or('button_text', '');
        
        add_action('woocommerce_receipt_' . $this->id, [$this, 'receipt_page']);
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
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
                'title' => 'Triple Play Pay API Key',
                'description' => 'The API Key for your Triple Play Pay account',
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
                    'yes' => 'Enable',
                    'no' => 'Disable'
                ],
                'default' => 'no'
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
            ],
            'button_text' => [
                'title' => 'Payment Button Custom Text',
                'description' => 'Edit the text content of the PAY button. use ${amount} to insert the price.',
                'type' => 'text',
                'default' => ''
            ]
        ];
    }

	public function receipt_page( $order_id ) {

        $order = wc_get_order($order_id);
        $amount = $order->get_total();

        $key = "tripleplaypay_payment_success";
        if (isset($_GET[$key]) && $_GET[$key] === 'true') {

            $order->payment_complete();
            $order->reduce_order_stock();
            
            WC()->cart->empty_cart();
            
            $url = $this->get_return_url($order);

            header("location: $url");
        }

        // HEREDOC so we can use syntax highlighting
        echo <<<HTML
            <style>
                #tripleplaypay-container {
                    margin: auto;
                    overflow: hidden;
                    width: fit-content;
                }
            </style>
            <div id="tripleplaypay-container">loading...</div>
            <script src="https://{$this->domain}.tripleplaypay.com/static/js/triple.js"></script>
            <script>
                const paymentOptions = ['credit_card'];
                if ('{$this->allow_ach}' === 'yes')
                    paymentOptions.push('bank');

                new Triple('{$this->api_key}')
                    .generatePaymentForm({
                        paymentOptions,
                        containerSelector: "#tripleplaypay-container",
                        amount: '{$amount}',
                        zipMode: '{$this->zip_mode}',
                        email: 'disabled',
                        payBtnText: '{$this->button_text}',
                        savePaymentToken: false,
                        styles: {
                        },
                        onSuccess: () => { console.log('nice!') },
                        onError: () => { console.log('oof!') }
                    });
            </script>
        HTML;

        // echo "
        //     <script src='https://$this->domain.tripleplaypay.com/static/js/triple.js'></script>
        //     <script>
        //         try {
        //             new Triple('$this->api_key').generatePaymentForm({
        //                 containerSelector: '#tripleplaypay-gateway',
        //                 paymentType: 'charge',
        //                 amount: '$amount',
        //                 paymentOptions: ['credit_card'],
        //                 phoneOption: false,
        //                 emailOption: 'disabled',
        //                 savePaymentToken: false,
        //                 onSuccess: () => { document.location += '&tripleplaypay_payment_success=true' },
        //                 onFailure: (error) => { document.location += '&tripleplaypay_payment_success=false' }
        //             });
        //         } catch (error) {
        //             document.getElementById('tripleplaypay-gateway').innerText = 'error rendering the Triple Play Pay iframe, please refresh and try again.';
        //         }
        //     </script>";
    }

    public function process_payment( $order_id ) {
        $order = wc_get_order( $order_id );
		return array(
			'result'   => 'success',
			'redirect' => $order->get_checkout_payment_url( true ),
		);
    }
}