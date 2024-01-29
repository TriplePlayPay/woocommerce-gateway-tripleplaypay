<?php

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class WC_TriplePlayPay_Blocks_Support extends AbstractPaymentMethodType {

    protected $name = "tripleplaypay";

    public function initialize() {
        $this->settings = get_option('woocommerce_tripleplaypay_settings', []);
    }

    public function is_active() {
		$payment_gateways_class = WC()->payment_gateways();
		$payment_gateways = $payment_gateways_class->payment_gateways();

        if (!isset($payment_gateways['tripleplaypay'])) {
            return false;
        }
        
        return $payment_gateways['tripleplaypay']->is_available();
	}

    public function get_payment_method_script_handles() {

        $asset_path = WC_GATEWAY_TRIPLEPLAYPAY_PATH . "/build/index.asset.php";
        $version = WC_GATEWAY_TRIPLEPLAYPAY_VERSION;
        $dependencies = [];

		if (file_exists( $asset_path )) {
			$asset        = require $asset_path;
			$version      = is_array( $asset ) && isset( $asset['version'] )
				? $asset['version']
				: $version;
			$dependencies = is_array( $asset ) && isset( $asset['dependencies'] )
				? $asset['dependencies']
				: $dependencies;
		}

        wp_register_script(
			'wc-tripleplaypay-blocks-integration',
			WC_GATEWAY_TRIPLEPLAYPAY_URL . '/build/index.js',
			$dependencies,
			$version,
			true
		);

        return ['wc-tripleplaypay-blocks-integration'];
    }

    public function get_payment_method_data() {
        return [
            'apiKey' => $this->get_setting('api_key'),
            'env' => $this->get_setting('env'),
            'allowAch' => $this->get_setting('allow_ach'),
            'zipMode' => $this->get_setting('zip_mode')
        ];
    }
}