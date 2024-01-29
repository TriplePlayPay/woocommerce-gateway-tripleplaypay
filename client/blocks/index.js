import { registerPaymentMethod } from '@woocommerce/blocks-registry';
import { getSetting } from '@woocommerce/settings';
import { useEffect } from 'react';
import Triple from './triple.js';

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

    if (data.useEmbeddedForm) {
        const triple = new Triple(data.apiKey);
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
            amount: 1, // still gotta figure out how to get this
        };
    
        useEffect(() => { // wait until everything is mounted
            triple.generatePaymentForm(tripleConfig);
        }, [])
    
        return <div id="tripleplaypay-gateway" style={{textAlign: 'center'}}>Loading...</div>;
    }

    // if not using the embedded form, use the "seperate payment page" option
    return <p>Use the <i>Triple Play Pay</i> iframe to complete the payment</p>; 
};

registerPaymentMethod({
    canMakePayment: ({ cart }) => {
        console.log(cart);
        return true;
    },
    name: "tripleplaypay",
    label: <Label />,
    ariaLabel: 'Triple Play Pay',
    content: <Content />,
    edit: <Content />,
    supports: { features: ['products'] }
});