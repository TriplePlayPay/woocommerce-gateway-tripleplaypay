<?php

function tripleplaypay_iframe( $options, $amount ) {
    return <<<HTML
        <style>
            #tripleplaypay-container {
                border-radius: 5px;
                border: 1px solid lightgrey;
                margin: auto;
                overflow-x: hidden;
                overflow-y: scroll;
                width: fit-content;
                height: fit-content;
            }
        </style>

        <div id="tripleplaypay-container">loading...</div>
        
        <script src="https://{$options->domain}.tripleplaypay.com/static/js/triple.js"></script>
        <script>

            const successfulTransaction = () => {
                const query = new URLSearchParams(window.location.search);
                query.set('tripleplaypay_iframe_status', true);
                window.location.search = query;
            };

            const paymentOptions = ['credit_card'];
            if ('{$options->allow_ach}')
                paymentOptions.push('bank');

            new Triple('{$options->api_key}')
                .generatePaymentForm({
                    paymentOptions,
                    containerSelector: "#tripleplaypay-container",
                    amount: '{$amount}',
                    zipMode: '{$options->zip_mode}',
                    email: 'disabled',
                    payBtnText: '{$options->button_text}',
                    savePaymentToken: false,
                    onSuccess: () => successfulTransaction(),
                    onError: (error) => document.getElementById('tpp_error').innerText = error,message;
                });
        </script>
    HTML;
}