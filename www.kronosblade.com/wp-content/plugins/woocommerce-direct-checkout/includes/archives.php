<?php

if (!defined('ABSPATH')) {
  die('-1');
}

if (!class_exists('QLWCDC_Archives')) {

  class QLWCDC_Archives extends QLWCDC {

    protected static $instance;

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

    function add_section($sections) {

      $sections['archives'] = __('Archives', 'woocommerce-direct-checkout');

      return $sections;
    }

    function add_fields($fields) {

      global $current_section;

      if ('archives' == $current_section) {

        $fields = array(
            'qlwcdc_section_title' => array(
                'name' => __('Archives', 'woocommerce-direct-checkout'),
                'type' => 'title',
                'id' => 'qlwcdc_archives_section_title'
            ),
            /*'add_archive_cart' => array(
                'name' => __('Add to cart', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add to cart button behaviour for single products in archives.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_cart',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'no' => __('Reload', 'woocommerce-direct-checkout'),
                    'ajax' => __('Ajax', 'woocommerce-direct-checkout'),
                    'redirect' => __('Redirect', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_archive_cart_ajax_button' => array(
                'name' => __('Added to cart button', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Show or hide the added to cart forward button.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_cart_ajax_button',
                'type' => 'select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_archive_cart_ajax_message' => array(
                'name' => __('Added to cart alert', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Include the "added to cart" alert message in product archives and shop.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_cart_ajax_message',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'yes',
            ),
            'add_archive_cart_redirect_page' => array(
                'name' => __('Added to cart redirect to', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Redirect to the cart or checkout page after successful addition.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_cart_redirect_page',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'cart' => __('Cart', 'woocommerce-direct-checkout'),
                    'checkout' => __('Checkout', 'woocommerce-direct-checkout'),
                    'url' => __('Custom URL', 'woocommerce-direct-checkout'),
                ),
                'default' => 'cart',
            ),
            'add_archive_cart_redirect_url' => array(
                'name' => __('Added to cart redirect to custom url', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Redirect to the cart or checkout page after successful addition.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_cart_redirect_url',
                'type' => 'text',
                'placeholder' => wc_get_checkout_url(),
            ),*/
            'add_archive_text' => array(
                'name' => __('Replace Add to cart text', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Replace "Add to cart" text.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_text',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_archive_text_in' => array(
                'name' => __('Replace Add to cart text in', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Replace "Add to cart" text in product types.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_text_in',
                'type' => 'multiselect',
                'class' => 'chosen_select',
                'options' => array(
                    'simple' => __('Simple Products', 'woocommerce-direct-checkout'),
                    'grouped' => __('Grouped Products', 'woocommerce-direct-checkout'),
                    'virtual' => __('Virtual Products', 'woocommerce-direct-checkout'),
                    'variable' => __('Variable Products', 'woocommerce-direct-checkout'),
                    'downloadable' => __('Downloadable Products', 'woocommerce-direct-checkout'),
                ),
                'default' => array('simple'),
            ),
            'add_archive_text_content' => array(
                'name' => __('Replace Add to cart text content', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Replace "Add to cart" text with this text.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_text_content',
                'type' => 'text',
                'default' => esc_html__('Purchase', 'woocommerce-direct-checkout'),
            ),
            'add_archive_quick_view' => array(
                'name' => __('Add quick view button', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add product quick view modal button.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_archive_quick_view',
                'type' => 'select',
                'class' => 'chosen_select qlwcdc-premium-field',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'qlwcdc_section_end' => array(
                'type' => 'sectionend',
                'id' => 'qlwcdc_archives_section_end'
            )
        );
      }

      return $fields;
    }

    function add_settings() {

      global $current_section;

      if ('' == $current_section) {
        woocommerce_admin_fields($this->add_fields());
      }
    }

    /*function add_to_cart_redirect($url) {

      if (is_shop() || is_product_category() || is_product_tag()) {

        if ('redirect' === get_option('qlwcdc_add_archive_cart')) {

          if ('cart' === get_option('qlwcdc_add_archive_cart_redirect_page')) {
            $url = wc_get_cart_url();
          }

          if ('checkout' === get_option('qlwcdc_add_archive_cart_redirect_page')) {
            $url = wc_get_checkout_url();
          }

          if ('url' === get_option('qlwcdc_add_archive_cart_redirect_page')) {
            $url = get_option('qlwcdc_add_archive_cart_redirect_url');
          }
        }
      }

      return $url;
    }*/

    /*function added_to_cart_button() {
      if (!is_product() && 'no' === get_option('qlwcdc_add_archive_cart_ajax_button', 'no')) {
        ?>
        <style>
          .added_to_cart.wc-forward {
            display: none!important;
          }
        </style>
        <?php

      }
    }*/

    /*function added_to_cart_message($product_id) {

      if (!is_product() && 'ajax' === get_option('qlwcdc_add_archive_cart', 'no') && 'yes' === get_option('qlwcdc_add_archive_cart_ajax_message', 'yes')) {

        $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);

        wc_add_to_cart_message(array($product_id => $quantity), true);
      }
    }*/

    /*function added_to_cart_message_js($product_id) {

      if (!is_product() && 'ajax' === get_option('qlwcdc_add_archive_cart') && 'yes' === get_option('qlwcdc_add_archive_cart_ajax_message')) {
        ?>
        <script>
          (function ($) {
            $(document).bind('added_to_cart', function (e, cart) {
              $(document.body).trigger('added_to_cart_message', [e, cart]);
            });
          })(jQuery);
        </script>
        <?php

      }
    }*/

    function add_archive_text($text, $product) {

      if ('yes' === get_option('qlwcdc_add_archive_text')) {
        if ($product->is_type(get_option('qlwcdc_add_archive_text_in', array()))) {
          $text = esc_html__(get_option('qlwcdc_add_archive_text_content'));
        }
      }

      return $text;
    }

    /*function woocommerce_enable_ajax_add_to_cart($val) {

      if ('no' !== get_option('qlwcdc_add_archive_cart', 'no')) {
        $val = 'yes';
      } else {
        $val = 'no';
      }

      return $val;
    }*/

    /*function woocommerce_cart_redirect_after_add($val) {

      if (is_shop() || is_product_category() || is_product_tag()) {
        if ('redirect' === get_option('qlwcdc_add_archive_cart', 'no')) {
          $val = 'yes';
        } else {
          $val = 'no';
        }
      }

      return $val;
    }*/

    function init() {
      add_filter('qlwcdc_add_sections', array($this, 'add_section'));
      add_filter('qlwcdc_add_fields', array($this, 'add_fields'));
      //add_filter('woocommerce_add_to_cart_redirect', array($this, 'add_to_cart_redirect'));
      //add_filter('woocommerce_before_shop_loop', array($this, 'added_to_cart_button'));
      //add_filter('woocommerce_after_shop_loop', array($this, 'added_to_cart_message_js'));
      //add_action('woocommerce_ajax_added_to_cart', array($this, 'added_to_cart_message'));
      add_filter('woocommerce_product_add_to_cart_text', array($this, 'add_archive_text'), 10, 2);
      //add_filter('option_woocommerce_enable_ajax_add_to_cart', array($this, 'woocommerce_enable_ajax_add_to_cart'));
      //add_filter('option_woocommerce_cart_redirect_after_add', array($this, 'woocommerce_cart_redirect_after_add'));
    }

  }

  QLWCDC_Archives::instance();
}