import { __ } from '@wordpress/i18n';
import { getSetting } from '@woocommerce/settings';
import { registerPaymentMethod } from '@woocommerce/blocks-registry';

const data = getSetting("tripleplaypay_data", null);

registerPaymentMethod({
    canMakePayment: () => true,
    name: "tripleplaypay",
    label: <img src="https://3playpay.com/wp-content/uploads/2022/05/TPP_logo_reversed_horz3.png" />,
    ariaLabel: __('Triple Play Pay Payment Method', 'woocommerce-gateway-tripleplaypay'),
    content: <p>Pay via the Triple Play Pay iframe</p>,
    supports: { features: data?.supports || [] }
});