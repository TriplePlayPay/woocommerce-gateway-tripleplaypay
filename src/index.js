import { registerPaymentMethod } from '@woocommerce/blocks-registry';
import { getSetting } from '@woocommerce/settings';
import { useEffect } from 'react';
import Triple from './triple.js';

//const logoSrc = "https://3playpay.com/wp-content/uploads/2022/05/TPP_logo_reversed_horz3.png";
const logoSrc = "https://www.tripleplaypay.com/dist/api/images/TPP_logo_white_icon.png";

const Label = () => {

    const imgStyle = { 
        border: '1px solid black',
        background: 'orange',
        display: 'block',
        height: '128px',
        marginLeft: '16px',
        borderRadius: '5px',
        active: {
            background: 'black'
        }
    };

    return (
        <div style={{ width: '100%', marginRight: '16px' }}>
            <img src={logoSrc} style={imgStyle} />
        </div>
    );
};

const Content = () => {

    useEffect(() => {
        console.log('apikey:', getSetting('woocommerce_tripleplaypay_settings', null));
        new Triple('testapikey')
            .generatePaymentForm({
                containerSelector: '#tripleplaypay-gateway',
                amount: 1,
            });
    }, [])

    return <div id="tripleplaypay-gateway">Loading...</div>;
};

registerPaymentMethod({
    canMakePayment: () => true,
    name: "tripleplaypay",
    label: <Label />,
    ariaLabel: 'hello',
    content: <Content />,
    edit: <Content />,
    supports: { features: ['products'] }
});