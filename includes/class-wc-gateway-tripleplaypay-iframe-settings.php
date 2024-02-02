<?php

defined('ABSPATH') || exit;

class WC_Gateway_TriplePlayPay_Iframe_Settings {

    private static $tab_id = 'tripleplaypay_iframe_settings';

    public function __construct() {
        $this->id = self::$tab_id;
        add_filter('woocommerce_settings_tabs_array', [$this, 'add_settings_tab'], 21);
        add_action('woocommerce_settings_' . self::$tab_id, [$this, 'output']);
        add_action('woocommerce_update_options_' . self::$tab_id, [$this, 'save']);
    }

    public function add_settings_tab( $tabs ) {
        $tabs[self::$tab_id] = 'Triple Play Pay iframe';
        return $tabs;
    }

    public function output() {
        WC_Admin_Settings::output_fields( $this->get_settings() );
    }

    public function save() {
        WC_Admin_Settings::save_fields( $this->get_settings() );
    }

    public function get_settings() {
        return [
            [
                'name' => 'Iframe Settings',
                'type' => 'title',
                'desc' => 'Tweak the <i>Triple Play Pay</i> iframe to your liking'
            ],
            [
                'id' => 'tripleplaypay_border',
                'name' => 'Container Border',
                'type' => 'text',
                'default' => '1px solid lightgrey'
            ],
            [
                'id' => 'tripleplaypay_button_text',
                'name' => 'Pay Button Text',
                'type' => 'text',
                'default' => 'Pay ${amount}'
            ],
            ['type' => 'sectionend'],
            [
                'name' => 'Pay Button',
                'type' => 'title',
                'desc' => 'Custom CSS values for the PAY button'
            ],
            [
                'id' => 'tripleplaypay_button_background',
                'name' => 'Background',
                'type' => 'text',
                'default' => '',
            ],
            [
                'id' => 'tripleplaypay_button_color',
                'name' => 'Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_button_border_radius',
                'name' => 'Border Radius',
                'type' => 'text',
                'default'  => ''
            ],
            ['type' => 'sectionend'],
            [
                'name' => 'Active Pay Button',
                'type' => 'title',
                'desc' => 'Custom CSS values for when the user clicks on the PAY button'
            ],
            [
                'id' => 'tripleplaypay_active_button_background',
                'name' => 'Background',
                'type' => 'text',
                'default' => ''
            ],
            [
                'id' => 'tripleplaypay_active_button_color',
                'name' => 'Button Color',
                'type' => 'text',
                'default' => ''
            ],
            ['type' => 'sectionend'],
            [
                'name' => 'Hover Pay Button',
                'type' => 'title',
                'desc' => 'Custom CSS values for when the user hovers over the PAY button'
            ],
            [
                'id' => 'tripleplaypay_hover_button_background',
                'name' => 'Background',
                'type' => 'text',
                'default' => ''
            ],
            [
                'id' => 'tripleplaypay_hover_button_color',
                'name' => 'Button Color',
                'type' => 'text',
                'default' => ''
            ],
            ['type' => 'sectionend'],
            [
                'name' => 'Text Inputs',
                'type' => 'title',
                'desc' => 'Custom CSS values for iframe inputs'
            ],
            [
                'id' => 'tripleplaypay_input_background',
                'name' => 'Background',
                'type' => 'text',
                'default' => '',
            ],
            [
                'id' => 'tripleplaypay_input_color',
                'name' => 'Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_input_border_color',
                'name' => 'Border Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_input_border_width',
                'name' => 'Border Width',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_input_border_radius',
                'name' => 'Border Radius',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_input_height',
                'name' => 'Height',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_input_font_size',
                'name' => 'Font Size',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_input_font_weight',
                'name' => 'Font Weight',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'type' => 'sectionend'
            ],
            [
                'name' => 'Focused Text Inputs',
                'type' => 'title',
                'desc' => 'Custom CSS values for focused iframe inputs'
            ],
            [
                'id' => 'tripleplaypay_focus_input_color',
                'name' => 'Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_focus_input_border_color',
                'name' => 'Border Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_focus_input_background',
                'name' => 'Background',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'type' => 'sectionend'
            ],
            [
                'name' => 'Error Text Inputs',
                'type' => 'title',
                'desc' => 'Custom CSS values for iframe inputs with errors'
            ],
            [
                'id' => 'tripleplaypay_error_input_color',
                'name' => 'Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_error_input_border_color',
                'name' => 'Border Color',
                'type' => 'text',
                'default'  => ''
            ],
            ['type' => 'sectionend'],
            [
                'name' => 'Placeholders For Text Input',
                'type' => 'title',
                'desc' => 'Custom CSS values for the iframe input placeholders'
            ],
            [
                'id' => 'tripleplaypay_placeholder_input_color',
                'name' => 'Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_placeholder_input_font_size',
                'name' => 'Font Size',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_placeholder_input_font_weight',
                'name' => 'Font Weight',
                'type' => 'text',
                'default'  => ''
            ],
            ['type' => 'sectionend'],
            [
                'name' => 'Error Text',
                'type' => 'title',
                'desc' => 'Custom CSS values for the iframe error text'
            ],
            [
                'id' => 'tripleplaypay_error_text_input_color',
                'name' => 'Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_error_text_input_font_size',
                'name' => 'Font Size',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_error_text_input_font_weight',
                'name' => 'Font Weight',
                'type' => 'text',
                'default'  => ''
            ],
            ['type' => 'sectionend'],
            [
                'name' => 'Radio Buttons',
                'type' => 'title',
                'desc' => 'Custom CSS values for iframe radio buttons'
            ],
            [
                'id' => 'tripleplaypay_radio_background',
                'name' => 'Background',
                'type' => 'text',
                'default' => '',
            ],
            [
                'id' => 'tripleplaypay_radio_color',
                'name' => 'Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_radio_border_color',
                'name' => 'Border Color',
                'type' => 'text',
                'default'  => ''
            ],
            ['type' => 'sectionend'],
            [
                'name' => 'Checked Radio Buttons',
                'type' => 'title',
                'desc' => 'Custom CSS values for checked iframe radio buttons'
            ],
            [
                'id' => 'tripleplaypay_checked_radio_color',
                'name' => 'Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'id' => 'tripleplaypay_checked_radio_border_color',
                'name' => 'Border Color',
                'type' => 'text',
                'default'  => ''
            ],
            [
                'type' => 'sectionend'
            ]
        ];
    }
}

// initialize the custom class
return new WC_Gateway_TriplePlayPay_Iframe_Settings();