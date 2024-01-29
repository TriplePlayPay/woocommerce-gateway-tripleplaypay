<?php

function render_tripleplaypay_iframe( $options ) {
    return <<<HTML
        <style>
            #tripleplaypay-container {
                margin: auto;
                overflow: hidden;
                width: fit-content;
            }
        </style>

        <div id="tripleplaypay-container">loading...</div>
        
        <script src="https://{$options->domain}.tripleplaypay.com/static/js/triple.js"></script>
        <script>
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
                    styles: {},
                    onSuccess: () => { console.log('nice!') },
                    onError: () => { console.log('oof!') }
                });
        </script>
    HTML;
}