<?php

if (!defined('ABSPATH')) {
  die('-1');
}

if (!class_exists('QLWCDC_Checkout')) {

  class QLWCDC_Checkout {

    protected static $instance;

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

    function add_section($sections) {

      $sections['checkout'] = __('Checkout', 'woocommerce-direct-checkout');

      return $sections;
    }

    function add_fields($settings) {

      global $current_section;

      if ('checkout' == $current_section) {

        $settings = array(
            'section_title' => array(
                'name' => __('Checkout', 'woocommerce-direct-checkout'),
                'type' => 'title',
                'id' => 'section_title'
            ),
            'add_checkout_cart' => array(
                'name' => __('Add cart to checkout', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Simplifies the checkout process including the shopping cart page inside checkout.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_checkout_cart',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_checkout_cart_fields' => array(
                'name' => __('Add cart to checkout fields', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Include this fields inside the checkout cart.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_checkout_cart_fields',
                'type' => 'multiselect',
                'class' => 'chosen_select',
                'options' => array(
                    'remove' => __('Remove', 'woocommerce-direct-checkout'),
                    'thumbnail' => __('Thumbnail', 'woocommerce-direct-checkout'),
                    'name' => __('Name', 'woocommerce-direct-checkout'),
                    'price' => __('Price', 'woocommerce-direct-checkout'),
                    'qty' => __('Quantity', 'woocommerce-direct-checkout'),
                ),
                'default' => array(
                    0 => 'remove',
                    1 => 'thumbnail',
                    2 => 'price',
                    3 => 'qty',
                )
            ),
            'remove_checkout_coupon_form' => array(
                'name' => __('Remove checkout coupon form', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Simplifies the checkout process removing the coupon form.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_remove_checkout_coupon_form',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'no' => __('Leave coupon form', 'woocommerce-direct-checkout'),
                    'remove' => __('Remove coupon form', 'woocommerce-direct-checkout'),
                    'toggle' => __('Remove coupon toggle', 'woocommerce-direct-checkout'),
                    'checkout' => __('Move to checkout order', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_checkout_cart_class' => array(
                'name' => __('Add custom class to cart table', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add a custom class to the cart table form in the checkot.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_checkout_cart_class',
                'type' => 'text',
                'default' => ''
            ),
            'remove_checkout_fields' => array(
                'name' => __('Remove checkout fields', 'qlwe'),
                'desc_tip' => __('Simplifies the checkout process removing the unnecessary checkout fields.', 'qlwe'),
                'id' => 'qlwcdc_remove_checkout_fields',
                'type' => 'multiselect',
                'class' => 'chosen_select',
                'options' => array(
                    'first_name' => __('First Name', 'qlwe'),
                    'last_name' => __('Last Name', 'qlwe'),
                    'country' => __('Country', 'qlwe'),
                    'state' => __('State', 'qlwe'),
                    'city' => __('City', 'qlwe'),
                    'postcode' => __('Postcode', 'qlwe'),
                    'address_1' => __('Address 1', 'qlwe'),
                    'address_2' => __('Address 2', 'qlwe'),
                    'company' => __('Company', 'qlwe'),
                    'phone' => __('Phone', 'qlwe'),
                ),
                'default' => array(
                    0 => 'phone',
                    1 => 'company',
                    2 => 'address_2',
                )
            ),
            'remove_checkout_shipping_address' => array(
                'name' => __('Remove checkout shipping address', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Simplifies the checkout process removing the shipping address.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_remove_checkout_shipping_address',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'remove_checkout_order_comments' => array(
                'name' => __('Remove checkout order comments', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Simplifies the checkout process removing the order notes.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_remove_checkout_order_comments',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'remove_checkout_privacy_policy_text' => array(
                'name' => __('Remove checkout policy text', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Simplifies the checkout process removing the policy text.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_remove_checkout_privacy_policy_text',
                'type' => 'select',
                'class' => 'chosen_select qlwcdc-premium-field',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'remove_checkout_terms_and_conditions' => array(
                'name' => __('Remove checkout terms and conditions', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Simplifies the checkout process removing the terms and conditions.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_remove_checkout_terms_and_conditions',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'remove_checkout_gateway_icon' => array(
                'name' => __('Remove checkout gateway icons', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Simplifies the checkout view by removing the payment gateway icons.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_remove_checkout_gateway_icon',
                'type' => 'select',
                'class' => 'chosen_select qlwcdc-premium-field',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'remove_checkout_columns' => array(
                'name' => __('Remove checkout columns', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Try to remove the columns and display the checkout form and order review in one column.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_remove_checkout_columns',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'remove_order_details_address' => array(
                'name' => __('Remove order details address', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Remove the billing address of the customer in the order received page.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_remove_order_details_address',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'section_end' => array(
                'type' => 'sectionend',
                'id' => 'wc_settings_tab_demo_section_end'
            )
        );
      }

      return $settings;
    }

    function remove_checkout_fields($fields) {

      if ($remove = get_option('qlwcdc_remove_checkout_fields', array())) {
        foreach ($remove as $id => $key) {
          unset($fields['billing']['billing_' . $key]);
          unset($fields['shipping']['shipping_' . $key]);
        }
      }

      return $fields;
    }

    function remove_checkout_order_commens($return) {

      if ('yes' === get_option('qlwcdc_remove_checkout_order_comments')) {
        $return = false;
      }

      return $return;
    }

    function remove_checkout_shipping_address($val) {

      if ('yes' === get_option('qlwcdc_remove_checkout_shipping_address')) {
        $val = 'billing_only';
      }

      return $val;
    }

    function init() {

      add_filter('qlwcdc_add_sections', array($this, 'add_section'));
      add_filter('qlwcdc_add_fields', array($this, 'add_fields'));
      add_filter('woocommerce_checkout_fields', array($this, 'remove_checkout_fields'));
      add_filter('woocommerce_enable_order_notes_field', array($this, 'remove_checkout_order_commens'));
      add_filter('option_woocommerce_ship_to_destination', array($this, 'remove_checkout_shipping_address'), 10, 3);

      if ('yes' === get_option('qlwcdc_remove_checkout_privacy_policy_text')) {
        remove_action('woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20);
      }

      if ('yes' === get_option('qlwcdc_remove_checkout_terms_and_conditions')) {
        add_filter('woocommerce_checkout_show_terms', '__return_false');
        remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);
      }
    }

  }

  QLWCDC_Checkout::instance();
}