import { registerPaymentMethod } from '@woocommerce/blocks-registry';
import { getSetting } from '@woocommerce/settings';
import { useEffect } from 'react';
import Triple from './triple.js';

//const logoSrc = "https://3playpay.com/wp-content/uploads/2022/05/TPP_logo_reversed_horz3.png";
const logoSrc = "https://www.tripleplaypay.com/dist/api/images/TPP_logo_white_icon.png";
const data = getSetting('tripleplaypay_data');

const Label = () => {

    const tabStyle = {
        border: '1px solid grey',
        borderRadius: '5px',
        marginRight: '16px',
        padding: '16px',
        width: '100%',
    };

    const imgStyle = { 
        borderRadius: '5px',
        background: 'orange',
        border: '1px solid grey',
        float: 'right'
    };

    return (
        <div style={tabStyle}>
            <span>Triple Play Pay</span>
            <img src={logoSrc} style={imgStyle} />
        </div>
    );
};

const Content = () => {

    const tripleConfig = {
        containerSelector: '#tripleplaypay-gateway',
        paymentMethods: ['credit_card', 'bank'],
        email: 'disabled',
        styles: {
            button: {
                background: 'transparent',
                color: 'transparent',
                height: '0px',
                display: 'none'
            }
        },
        amount: 1,
    };

    useEffect(() => {
        new Triple(data.apiKey).generatePaymentForm(tripleConfig);
    }, [])

    return <div id="tripleplaypay-gateway" style={{textAlign: 'center'}}>Loading...</div>;
};

registerPaymentMethod({
    canMakePayment: () => true,
    name: "tripleplaypay",
    label: <Label />,
    ariaLabel: 'Triple Play Pay',
    content: <Content />,
    edit: <Content />,
    supports: { features: ['products'] }
});