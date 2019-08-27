<?php

if (!defined('ABSPATH')) {
  die('-1');
}

if (!class_exists('QLWCDC_General')) {

  class QLWCDC_General {

    protected static $instance;

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

    function add_section($sections) {

      $sections[''] = __('General', 'woocommerce-direct-checkout');

      return $sections;
    }

    function add_fields($settings) {

      global $current_section;

      if ('' == $current_section) {

        $settings = array(
            'qlwcdc_section_title' => array(
                'name' => __('General', 'woocommerce-direct-checkout'),
                'type' => 'title',
                'desc' => __('Simplifies the checkout process.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_section_title'
            ),
            'add_to_cart_message' => array(
                'name' => __('Added to cart alert', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Replace "View Cart" alert with direct checkout.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_to_cart_message',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_to_cart_link' => array(
                'name' => __('Added to cart link', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Replace "View Cart" link with direct checkout.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_to_cart_link',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_to_cart' => array(
                'name' => __('Added to cart redirect', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add to cart button behaviour.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_to_cart',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'no' => __('No', 'woocommerce-direct-checkout'),
                    //'ajax' => __('Ajax', 'woocommerce-direct-checkout'),
                    'redirect' => __('Yes', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            /* 'add_to_cart_ajax_button' => array(
              'name' => __('Added to cart button', 'woocommerce-direct-checkout'),
              'desc_tip' => __('Show or hide the added to cart forward button.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_to_cart_ajax_button',
              'type' => 'select',
              'options' => array(
              'yes' => __('Yes', 'woocommerce-direct-checkout'),
              'no' => __('No', 'woocommerce-direct-checkout'),
              ),
              'default' => 'no',
              ), */
            /* 'add_to_cart_ajax_message' => array(
              'name' => __('Added to cart alert', 'woocommerce-direct-checkout'),
              'desc_tip' => __('Include the "added to cart" alert message in product archives and shop.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_to_cart_ajax_message',
              'type' => 'select',
              'class' => 'chosen_select',
              'options' => array(
              'yes' => __('Yes', 'woocommerce-direct-checkout'),
              'no' => __('No', 'woocommerce-direct-checkout'),
              ),
              'default' => 'yes',
              ), */
            'add_to_cart_redirect_page' => array(
                'name' => __('Added to cart redirect to', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Redirect to the cart or checkout page after successful addition.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_to_cart_redirect_page',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'cart' => __('Cart', 'woocommerce-direct-checkout'),
                    'checkout' => __('Checkout', 'woocommerce-direct-checkout'),
                    'url' => __('Custom URL', 'woocommerce-direct-checkout'),
                ),
                'default' => 'cart',
            ),
            'add_to_cart_redirect_url' => array(
                'name' => __('Added to cart redirect to custom url', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Redirect to the cart or checkout page after successful addition.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_to_cart_redirect_url',
                'type' => 'text',
                'placeholder' => wc_get_checkout_url(),
            ),
            'qlwcdc_section_end' => array(
                'type' => 'sectionend',
                'id' => 'qlwcdc_section_end'
            )
        );
      }

      return $settings;
    }

    function add_to_cart_params($params) {

      if ('yes' === get_option('qlwcdc_add_to_cart_link')) {
        $params['cart_url'] = wc_get_checkout_url();
        $params['i18n_view_cart'] = esc_html__('Checkout', 'woocommerce-direct-checkout');
      }

      return $params;
    }

    function add_to_cart_message($message) {

      if ('yes' === get_option('qlwcdc_add_to_cart_message')) {

        $message = str_replace(wc_get_page_permalink('cart'), wc_get_page_permalink('checkout'), $message);

        $message = str_replace(esc_html__('View cart', 'woocommerce'), esc_html__('Checkout', 'woocommerce'), $message);
      }

      return $message;
    }

    function add_to_cart_redirect($url) {

      if ('redirect' === get_option('qlwcdc_add_to_cart')) {
        if ('cart' === get_option('qlwcdc_add_to_cart_redirect_page')) {
          $url = wc_get_cart_url();
        } elseif ('url' === get_option('qlwcdc_add_to_cart_redirect_page')) {
          $url = get_option('qlwcdc_add_to_cart_redirect_url');
        } else {
          $url = wc_get_checkout_url();
        }
      }

      return $url;
    }

    function init() {
      add_filter('qlwcdc_add_sections', array($this, 'add_section'));
      add_filter('qlwcdc_add_fields', array($this, 'add_fields'));
      add_filter('woocommerce_get_script_data', array($this, 'add_to_cart_params'));
      add_filter('wc_add_to_cart_message_html', array($this, 'add_to_cart_message'));
      add_filter('woocommerce_add_to_cart_redirect', array($this, 'add_to_cart_redirect'));

      if ('redirect' === get_option('qlwcdc_add_to_cart')) {
        add_filter('option_woocommerce_enable_ajax_add_to_cart', '__return_false');
        add_filter('option_woocommerce_cart_redirect_after_add', '__return_false');
      }
    }

  }

  QLWCDC_General::instance();
}