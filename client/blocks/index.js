import { registerPaymentMethod } from '@woocommerce/blocks-registry';
import { getSetting } from '@woocommerce/settings';

import Triple from './triple.js';

import { useState, useEffect } from 'react';

const logoSrc = "https://www.tripleplaypay.com/dist/api/images/TPP_logo_white_icon.png";
const data = getSetting('tripleplaypay_data');

const Label = () => {

    const tabStyle = {
        paddingRight: '16px',
        borderRadius: '5px',
        width: '100%',
    };

    const imgStyle = { 
        borderRadius: '5px',
        background: '#F8951F',
        border: '1px solid lightgrey',
        float: 'right'
    };

    return (
        <div style={tabStyle}>
            <span>Triple Play Pay</span>
            <img src={logoSrc} style={imgStyle} />
        </div>
    );
};

const Content = (props) => {

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
            amount: price || '0.00'
        };
    
        useEffect(() => { // wait until everything is mounted
            triple.generatePaymentForm(tripleConfig);
        }, []);
    
        return <div id="tripleplaypay-gateway" style={{textAlign: 'center'}}>Loading...</div>;
    }

    // if not using the embedded form, use the "separate payment page" option
    return <span>Complete Your Payment Here</span>;
};

registerPaymentMethod({
    canMakePayment: () => {
        return true;
    },
    name: "tripleplaypay",
    label: <Label />,
    ariaLabel: 'Triple Play Pay',
    content: <Content />,
    edit: <></>,
    supports: { features: ['products'] }
});