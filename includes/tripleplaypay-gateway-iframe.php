<?php

function tripleplaypay_iframe( $options, $amount ) {

    // messy, but i didn't have much time to implement a more efficient solution :/
    $button_text = get_option('tripleplaypay_button_text');
    $border = get_option('tripleplaypay_border');

    // button styles
    $button_background = get_option('tripleplaypay_button_background');
    $button_color = get_option('tripleplaypay_button_color');
    $button_border_radius = get_option('tripleplaypay_button_border_radius');
    $button_font_size = get_option('tripleplaypay_button_font_size');

    // active button
    $active_button_background = get_option('tripleplaypay_active_button_background');
    $active_button_color = get_option('tripleplaypay_active_button_color');

    // hover button
    $hover_button_background = get_option('tripleplaypay_hover_button_background');
    $hover_button_color = get_option('tripleplaypay_hover_button_color');

    // input styles
    $input_background = get_option('tripleplaypay_input_background');
    $input_color = get_option('tripleplaypay_input_color');
    $input_border_color = get_option('tripleplaypay_input_border_color');
    $input_border_width = get_option('tripleplaypay_input_border_width');
    $input_border_radius = get_option('tripleplaypay_input_border_radius');
    $input_height = get_option('tripleplaypay_input_height');
    $input_font_size = get_option('tripleplaypay_input_font_size');
    $input_font_weight = get_option('tripleplaypay_input_font_weight');

    // focused input sytles
    $focus_input_color = get_option('tripleplaypay_focus_input_color');
    $focus_input_border_color = get_option('tripleplaypay_focus_input_border_color');
    $focus_input_background = get_option('tripleplaypay_focus_input_background');

    // error field colors
    $error_input_color = get_option('tripleplaypay_error_input_color');
    $error_input_border_color = get_option('tripleplaypay_error_input_border_color');
    $error_input_background = get_option('tripleplaypay_focus_input_background');

    // placeholders
    $placeholder_input_color = get_option('tripleplaypay_placeholder_input_color');
    $placeholder_input_font_size = get_option('tripleplaypay_placeholder_font_size');
    $placeholder_input_font_weight = get_option('tripleplaypay_placeholder_font_weight');

    // error text
    $error_text_input_color = get_option('tripleplaypay_error_text_input_color');
    $error_text_input_font_size = get_option('tripleplaypay_error_text_font_size');
    $error_text_input_font_weight = get_option('tripleplaypay_error_text_font_weight');

    // radio styles
    $radio_background = get_option('tripleplaypay_radio_background');
    $radio_color = get_option('tripleplaypay_radio_color');
    $radio_border_color = get_option('tripleplaypay_radio_border_color');

    // checked radio
    $checked_radio_border_color = get_option('tripleplaypay_checked_radio_border_color');
    $checked_radio_color = get_option('tripleplaypay_checked_radio_color');

    if ($options->domain == "sandbox") {
        $scriptSource = '<script src="https://tripleplaypay.com/static/js/sandbox.js"></script>';
    } else {
        $scriptSource = '<script src="https://tripleplaypay.com/static/js/triple.js"></script>';
    }

    return <<<HTML
        <style>
            #tripleplaypay-sandbox-warning {
                text-align: center;
                font-style: italic;
                color: grey;
            }
            #tripleplaypay-container {
                border-radius: 5px;
                margin: auto;
                overflow-x: hidden;
                overflow-y: scroll;
                width: 100%;
                background: white;
                padding: 5px;
            }
        </style>

        <p id="tripleplaypay-sandbox-warning"></p>
        <div id="tripleplaypay-container">loading...</div>
        
        '{$scriptSource}'
        <script>

            const container = document.getElementById('tripleplaypay-container');
            container.style.border = '{$border}';

            const successfulTransaction = () => {
                const query = new URLSearchParams(window.location.search);
                query.set('tripleplaypay_iframe_status', true);
                window.location.search = query;
            };

            const paymentOptions = [];
            
            if ({$options->allow_card})
                paymentOptions.push('credit_card');
                        
            if ({$options->allow_ach})
                paymentOptions.push('bank');
            
            if ({$options->allow_crypto})
                paymentOptions.push('crypto');

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
                    phoneOption: false,
                    emailOption: '{$options->email_mode}',
                    payBtnText: '{$options->button_text}',
                    savePaymentToken: false,
                    styles: {
                        radio: {
                            background: '{$radio_background}',
                            color: '{$radio_color}',
                            borderColor: '{$radio_border_color}',
                            checked: {
                                color: '{$checked_radio_color}',
                                borderColor: '{$checked_radio_border_color}',
                            },
                        },
                        button: {
                            color: '{$button_color}',
                            background: '{$button_background}',
                            borderRadius: '{$button_border_radius}',
                            fontSize: '{$button_font_size}',
                            active: {
                                color: '{$active_button_color}',
                                background: '{$active_button_background}',
                            },
                            hover: {
                                color: '{$hover_button_color}',
                                background: '{$hover_button_background}',
                            },
                        },
                        input: {
                            color: '{$input_color}',
                            background: '{$input_background}',
                            borderColor: '{$input_border_color}',
                            borderWidth: '{$input_border_width}',
                            borderRadius: '{$input_border_radius}',
                            height: '{$input_height}',
                            fontSize: '{$input_font_size}',
                            fontWeight: '{$input_font_weight}',
                            focus: {
                                color: '{$focus_input_color}',
                                borderColor: '{$focus_input_border_color}',
                                background: '{$focus_input_background}'
                            },
                            error: {
                                color: '{$error_input_color}',
                                borderColor: '{$error_input_border_color}',
                            },
                            placeholder: {
                                color: '{$placeholder_input_color}',
                                fontSize: '{$placeholder_input_font_size}',
                                fontWeight: '{$placeholder_input_font_weight}',
                            },
                            errorText: {
                                color: '{$error_text_input_color}',
                                fontSize: '{$error_text_input_font_size}',
                                fontWeight: '{$error_text_input_font_weight}',
                            }
                        }
                    },
                    onSuccess: () => successfulTransaction()
                });
        </script>
    HTML;
}