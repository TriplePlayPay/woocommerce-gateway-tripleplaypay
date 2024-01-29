<?php

function tripleplaypay_iframe( $options, $amount ) {
    return <<<HTML
        <style>
            #tripleplaypay-sandbox-warning {
                text-align: center;
                font-style: italic;
                color: grey;
            }
            #tripleplaypay-container {
                border: 2px solid lightgrey;
                border-radius: 5px;
                margin: auto;
                overflow-x: hidden;
                overflow-y: scroll;
                width: fit-content;
                background: white;
                padding: 5px;
            }
        </style>

        <p id="tripleplaypay-sandbox-warning"></p>
        <div id="tripleplaypay-container">loading...</div>
        
        <script src="https://{$options->domain}.tripleplaypay.com/static/js/triple.js"></script>
        <script>

            const successfulTransaction = () => {
                const query = new URLSearchParams(window.location.search);
                query.set('tripleplaypay_iframe_status', true);
                window.location.search = query;
            };

            const paymentOptions = ['credit_card'];
            if ({$options->allow_ach})
                paymentOptions.push('bank');

            if ('{$options->domain}' == 'sandbox') {
                const element = document.getElementById('tripleplaypay-sandbox-warning');
                if (element)
                    element.innerText = 'Warning: Environment has been set to "sandbox". Payments will not be processed.';
            }

            new Triple('{$options->api_key}')
                .generatePaymentForm({
                    paymentOptions,
                    containerSelector: "#tripleplaypay-container",
                    amount: '{$amount}',
                    zipMode: '{$options->zip_mode}',
                    email: 'disabled',
                    payBtnText: '{$options->button_text}',
                    savePaymentToken: false,
                    onSuccess: () => successfulTransaction()
                });
        </script>
    HTML;
}