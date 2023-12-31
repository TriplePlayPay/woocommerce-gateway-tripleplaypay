import { useEffect } from 'react';
import { __ } from '@wordpress/i18n';
import { registerPaymentMethod } from '@woocommerce/blocks-registry';

registerPaymentMethod({
    canMakePayment: () => true,
    name: "tripleplaypay",
    label: <img src="https://3playpay.com/wp-content/uploads/2022/05/TPP_logo_reversed_horz3.png" />,
    ariaLabel: __('Triple Play Pay Payment Method', 'woocommerce-gateway-tripleplaypay'),
    content: <></>,
    edit: <></>,
    supports: { features: ['products'] }
});