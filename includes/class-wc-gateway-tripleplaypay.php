<?php


class WC_Gateway_TriplePlayPay extends WC_Payment_Gateway {

    public $version;

    public function __construct() {
        $this->version = WC_GATEWAY_TRIPLEPLAYPAY_VERSION;
        $this->id = 'tripleplaypay';
        $this->method_title = __("Triple Play Pay Gateway", 'woocommerce-gateway-tripleplaypay');
        $this->method_description = __('Take payments through the Triple Play Pay iframe', 'woocommerce-gateway-tripleplaypay');
        $this->icon = 'https://3playpay.com/wp-content/uploads/2022/05/TPP_logo_reversed_horz3.png';
        $this->available_countries = ['US'];

        $this->available_currencies = (array) apply_filters( 'woocommerce_gateway_payfast_available_currencies', [ 'USD' ] );
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

        $this->zip_mode = $this->get_option('zipmode');

        $this->payment_type = $this->get_option('paymenttype');
        $this->payment_options = "['credit_card']";
        
        add_action('woocommerce_receipt_' . $this->id, [$this, 'receipt_page']);
        add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
        //add_action('wp_enqueue_scripts', [$this, 'payment_scripts']);
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
                phoneOption: false,
                emailOption: "disabled",
                savePaymentToken: false,
                onSuccess: () => document.querySelector('#place_order').click(), // process the payment in woo
                onFailure: (error) => { alert(error); } // just to get it to work, need to figure out something more graceful
            });
        </script>
        <?php
        do_action('woocommerce_credit_card_form_end', $this->id);
    }

	public function receipt_page( $order_id ) {
        $order = wc_get_order($order_id);
        $amount = $order->get_total();

        $key = "tripleplaypay_payment_success";
        if (isset($_GET[$key]) && $_GET[$key] === 'true') {

            $status = (bool) $_GET["tripleplaypay_payment_success"];
            $order->payment_complete();
            $order->reduce_order_stock();
            
            WC()->cart->empty_cart();
            
            $url = $this->get_return_url($order);

            header("location: $url");
        }

        echo "
            <div id='tripleplaypay-gateway' style='padding: 25px; margin: auto; text-align: center;'>loading the Triple Play Pay iframe...</div>
            <script src='https://$this->domain.tripleplaypay.com/static/js/triple.js'></script>
            <script>
                try {
                    new Triple('$this->apikey').generatePaymentForm({
                        containerSelector: '#tripleplaypay-gateway',
                        paymentType: '$this->payment_type',
                        amount: '$amount',
                        paymentOptions: ['credit_card'],
                        zipMode: '$this->zip_mode',
                        phoneOption: false,
                        emailOption: 'disabled',
                        savePaymentToken: false,
                        onSuccess: () => { document.location += '&tripleplaypay_payment_success=true' },
                        onFailure: (error) => { document.location += '&tripleplaypay_payment_success=false' }
                    });
                } catch (error) {
                    document.getElementById('tripleplaypay-gateway').innerText = 'error rendering the Triple Play Pay iframe, please refresh and try again.';
                }
            </script>";
    }

    public function process_payment( $order_id ) {
        $order = wc_get_order( $order_id );
		return array(
			'result'   => 'success',
			'redirect' => $order->get_checkout_payment_url( true ),
		);
    }
}