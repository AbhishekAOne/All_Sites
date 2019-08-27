<?php
if (!defined('ABSPATH')) {
  die('-1');
}

if (!class_exists('QLWCDC_Products')) {

  class QLWCDC_Products extends QLWCDC {

    protected static $instance;
    var $product_fields;

    function add_section($sections = array()) {

      $sections['products'] = __('Products', 'woocommerce-direct-checkout');

      return $sections;
    }

    function add_fields($fields) {

      global $current_section;

      if ('products' == $current_section) {

        $fields = array(
            'section_title' => array(
                'name' => __('Products', 'woocommerce-direct-checkout'),
                'type' => 'title',
                'id' => 'qlwcdc_products_section_title'
            ),
            /*'add_product_cart' => array(
                'name' => __('Add to cart', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add to cart button behaviour in products pages.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_cart',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'no' => __('Reload', 'woocommerce-direct-checkout'),
                    'ajax' => __('Ajax', 'woocommerce-direct-checkout'),
                    'redirect' => __('Redirect', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_product_cart_ajax_button' => array(
                'name' => __('Added to cart button', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Show or hide the added to cart forward button.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_cart_ajax_button',
                'type' => 'select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_product_cart_ajax_message' => array(
                'name' => __('Added to cart alert', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Include the "added to cart" alert message in product archives and shop.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_cart_ajax_message',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'yes',
            ),
            'add_product_cart_redirect_page' => array(
                'name' => __('Added to cart redirect to', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Redirect to the cart or checkout page after successful addition.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_cart_redirect_page',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'cart' => __('Cart', 'woocommerce-direct-checkout'),
                    'checkout' => __('Checkout', 'woocommerce-direct-checkout'),
                    'url' => __('Custom URL', 'woocommerce-direct-checkout'),
                ),
                'default' => 'cart',
            ),
            'add_product_cart_redirect_url' => array(
                'name' => __('Added to cart redirect to custom url', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Redirect to the cart or checkout page after successful addition.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_cart_redirect_url',
                'type' => 'text',
                'placeholder' => wc_get_checkout_url(),
            ),*/
            'add_product_text' => array(
                'name' => __('Replace Add to cart text', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Replace "Add to cart" text.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_text',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_product_text_content' => array(
                'name' => __('Replace Add to cart text content', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Replace "Add to cart" text with this text.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_text_content',
                'type' => 'text',
                'default' => esc_html__('Purchase', 'woocommerce-direct-checkout')
            ),
            'add_product_quick_purchase' => array(
                'name' => __('Add quick purchase button', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add a quick purchase button to the products pages.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_quick_purchase',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'yes' => __('Yes', 'woocommerce-direct-checkout'),
                    'no' => __('No', 'woocommerce-direct-checkout'),
                ),
                'default' => 'no',
            ),
            'add_product_quick_purchase_class' => array(
                'name' => __('Add quick purchase class', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add a custom class to the quick purchase button.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_quick_purchase_class',
                'type' => 'text',
                'default' => ''
            ),
            'add_product_quick_purchase_to' => array(
                'name' => __('Redirect quick purchase to', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Redirect the quick purchase button to the cart or checkout page.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_quick_purchase_to',
                'type' => 'select',
                'class' => 'chosen_select',
                'options' => array(
                    'cart' => __('Cart', 'woocommerce-direct-checkout'),
                    'checkout' => __('Checkout', 'woocommerce-direct-checkout'),
                ),
                'default' => 'checkout',
            ),
            'add_product_quick_purchase_text' => array(
                'name' => __('Add quick purchase text', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add a custom text to the quick purchase button.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_quick_purchase_text',
                'type' => 'text',
                'default' => esc_html__('Purchase Now', 'woocommerce-direct-checkout')
            ),
            'add_product_default_attributes' => array(
                'name' => __('Add default attributes in variable products', 'woocommerce-direct-checkout'),
                'desc_tip' => __('Add default attributes in all variable products to avoid disabled Add to cart button.', 'woocommerce-direct-checkout'),
                'id' => 'qlwcdc_add_product_default_attributes',
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
                'id' => 'qlwcdc_products_section_end'
            )
        );
      }

      return $fields;
    }

    function add_product_fields() {

      global $thepostid;

      if ($this->product_fields)
        return;

      // Fields
      $this->product_fields = array(
          /*'start_group',
          array(
              'label' => __('Add to cart', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Add to cart behaviour for this product.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_cart',
              'type' => 'select',
              'options' => array(
                  'no' => __('Reload', 'woocommerce-direct-checkout'),
                  'ajax' => __('Ajax', 'woocommerce-direct-checkout'),
                  'redirect' => __('Redirect', 'woocommerce-direct-checkout'),
              ),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_cart', 'no'),
          ),
          array(
              'label' => __('Ajax added to cart button', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Display ajax added to cart button.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_cart_ajax_button',
              'type' => 'select',
              'options' => array(
                  'yes' => __('Yes', 'woocommerce-direct-checkout'),
                  'no' => __('No', 'woocommerce-direct-checkout'),
              ),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_cart_ajax_button', 'no'),
          ),
          array(
              'label' => __('Ajax added to cart alert', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Display ajax added to cart alert for this product.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_cart_ajax_message',
              'type' => 'select',
              'options' => array(
                  'yes' => __('Yes', 'woocommerce-direct-checkout'),
                  'no' => __('No', 'woocommerce-direct-checkout'),
              ),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_cart_ajax_message', 'no'),
          ),
          array(
              'label' => __('Added to cart redirect to', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Redirect to the cart or checkout page after successful addition.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_cart_redirect_page',
              'type' => 'select',
              'options' => array(
                  'cart' => __('Cart', 'woocommerce-direct-checkout'),
                  'checkout' => __('Checkout', 'woocommerce-direct-checkout'),
                  'url' => __('Custom URL', 'woocommerce-direct-checkout'),
              ),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_cart_redirect_page', 'cart'),
          ),
          array(
              'label' => __('Added to cart redirect to custom url', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Redirect to the cart or checkout page after successful addition.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_cart_redirect_url',
              'type' => 'text',
              'placeholder' => get_option('qlwcdc_add_product_cart_redirect_url'),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_cart_redirect_url'),
          ),
          'end_group',*/
          'start_group',
          array(
              'label' => __('Replace Add to cart text', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Replace "Add to cart" text.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_text',
              'type' => 'select',
              'options' => array(
                  'yes' => __('Yes', 'woocommerce-direct-checkout'),
                  'no' => __('No', 'woocommerce-direct-checkout'),
              ),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_text', 'no'),
          ),
          array(
              'label' => __('Replace Add to cart text content', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Replace "Add to cart" text with this text.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_text_content',
              'type' => 'text',
              'placeholder' => get_option('qlwcdc_add_product_text_content'),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_text_content'),
          ),
          'start_group',
          'end_group',
          array(
              'label' => __('Add quick purchase button', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Add quick purchase button to single product page.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_quick_purchase',
              'class' => 'short',
              'type' => 'select',
              'options' => array(
                  'yes' => __('Yes', 'woocommerce-direct-checkout'),
                  'no' => __('No', 'woocommerce-direct-checkout'),
              ),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_quick_purchase', 'no')
          ),
          array(
              'label' => __('Add quick purchase class', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Add quick purchase custom class.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_quick_purchase_class',
              'type' => 'text',
              'placeholder' => get_option('qlwcdc_add_product_quick_purchase_class'),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_quick_purchase_class'),
          ),
          array(
              'label' => __('Add quick purchase text', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Add quick purchase custom text.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_quick_purchase_text',
              'type' => 'text',
              'placeholder' => get_option('qlwcdc_add_product_quick_purchase_text'),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_quick_purchase_text'),
          ),
          array(
              'label' => __('Redirect quick purchase to', 'woocommerce-direct-checkout'),
              'desc_tip' => true,
              'description' => __('Redirect quick purchase to the cart or checkout page.', 'woocommerce-direct-checkout'),
              'id' => 'qlwcdc_add_product_quick_purchase_to',
              'type' => 'select',
              'options' => array(
                  'cart' => __('Cart', 'woocommerce-direct-checkout'),
                  'checkout' => __('Checkout', 'woocommerce-direct-checkout'),
              ),
              'value' => $this->get_product_option($thepostid, 'qlwcdc_add_product_quick_purchase_to', 'checkout'),
          ),
          'end_group',
      );
    }

    function add_product_tabs($tabs) {

      $tabs[QLWCDC_DOMAIN] = array(
          'label' => __('Direct Checkout', 'qlwdd'),
          'target' => 'qlwcdc_options',
      );

      return $tabs;
    }

    function add_setting_field($field) {

      if (!isset($field['id'])) {
        if ($field == 'start_group') {
          echo '<div class="options_group">';
        } elseif ($field == 'end_group') {
          echo '</div>';
        }
      } else {

        if (function_exists($function = 'woocommerce_wp_' . $field['type'])) {
          $function($field);
        } elseif (function_exists($function = 'woocommerce_wp_' . $field['type'] . '_input')) {
          $function($field);
        } else {
          woocommerce_wp_text_input($field);
        }
      }
    }

    function add_product_tab_content() {

      $this->add_product_fields();
      ?>
      <div id="qlwcdc_options" class="panel woocommerce_options_panel" style="display: none;">
        <?php
        foreach ($this->product_fields as $field) {
          $this->add_setting_field($field);
        }
        ?>
      </div>
      <?php
    }

    /*function added_to_cart_button() {

      global $product;

      if ('no' === $this->get_product_option($product->get_id(), 'qlwcdc_add_product_cart_ajax_button', 'no')) {
        ?>
        <style>
          .added_to_cart.wc-forward {
            display: none!important;
          }
        </style>
        <?php
      }
    }*/

    /*function add_to_cart_redirect($url) {

      //return 'https://1326';

      if (is_product()) {

        if ('redirect' === $this->get_product_option(get_queried_object_id(), 'qlwcdc_add_product_cart')) {

          if ('cart' === $this->get_product_option(get_queried_object_id(), 'qlwcdc_add_product_cart_redirect_page')) {
            $url = wc_get_cart_url();
          }

          if ('checkout' === $this->get_product_option(get_queried_object_id(), 'qlwcdc_add_product_cart_redirect_page')) {
            $url = wc_get_checkout_url();
          }

          if ('url' === $this->get_product_option(get_queried_object_id(), 'qlwcdc_add_product_cart_redirect_page')) {
            $url = $this->get_product_option(get_queried_object_id(), 'qlwcdc_add_product_cart_redirect_url');
          }
        }
      }

      return $url;
    }*/

    /*function added_to_cart_message_js() {

      global $product;

      if ('ajax' === $this->get_product_option($product->get_id(), 'qlwcdc_add_product_cart', 'no') && 'yes' === $this->get_product_option($product->get_id(), 'qlwcdc_add_product_cart_ajax_message', 'yes')) {
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
      if ('redirect' === $this->get_product_option($product->get_id(), 'qlwcdc_add_product_cart', 'no')) {
        ?>
        <script>
          (function ($) {
            $(document).bind('added_to_cart', function (e, cart) {
              if (wc_add_to_cart_params.cart_url !== undefined) {
                window.location = wc_add_to_cart_params.cart_url;
              }
            });
          })(jQuery);
        </script>
        <?php
      }
    }*/

    function add_product_text($text, $product) {

      if ('yes' === $this->get_product_option($product->get_id(), 'qlwcdc_add_product_text')) {
        $text = esc_html__($this->get_product_option($product->get_id(), 'qlwcdc_add_product_text_content'), $text);
      }

      return $text;
    }

    /*function add_product_cart_ajax_message() {

      global $wp_query;

      if (!check_ajax_referer('woocommerce-direct-checkout', 'nonce', false)) {
        wp_send_json_error(esc_html__('Please reload page.', 'woocommerce-direct-checkout'));
      }

      if (isset($_POST['queried_object_id'])) {

        $product_id = absint($_POST['queried_object_id']);

        $args = array(
            'p' => $product_id,
            'post_type' => 'any'
        );

        $wp_query = new WP_Query($args);
      }

      ob_start();

      woocommerce_output_all_notices();

      $data = ob_get_clean();

      wp_send_json($data);
    }*/

    /*function add_to_cart_class($class) {

      if (is_product() && get_option('qlwcdc_add_product_ajax')) {
        $class = str_replace(' add_to_cart_button', ' single_add_to_cart_button', $class);
        $class = str_replace('add_to_cart_button ', 'single_add_to_cart_button ', $class);
        $class = str_replace(' ajax_add_to_cart', '', $class);
        $class = str_replace('ajax_add_to_cart ', ' ', $class);
      }

      return $class;
    }*/

    /*function add_storefront_notices() {
      if (is_product() && 'yes' === $this->get_product_option(get_queried_object_id(), 'qlwcdc_add_product_cart_ajax_message', 'no')) {
        woocommerce_output_all_notices();
      }
    }*/

    function init() {
      //add_action('wp_ajax_qlwcdc_add_product_cart_ajax_message', array($this, 'add_product_cart_ajax_message'));
      //add_action('wp_ajax_nopriv_qlwcdc_add_product_cart_ajax_message', array($this, 'add_product_cart_ajax_message'));
      add_filter('qlwcdc_add_sections', array($this, 'add_section'));
      add_filter('qlwcdc_add_fields', array($this, 'add_fields'));
      //add_filter('woocommerce_add_to_cart_redirect', array($this, 'add_to_cart_redirect'));
      //add_filter('woocommerce_before_single_product', array($this, 'added_to_cart_button'));
      //add_filter('woocommerce_after_single_product', array($this, 'added_to_cart_message_js'));
      add_filter('woocommerce_product_data_tabs', array($this, 'add_product_tabs'));
      add_action('woocommerce_product_data_panels', array($this, 'add_product_tab_content'));
      add_filter('woocommerce_product_single_add_to_cart_text', array($this, 'add_product_text'), 10, 2);
      //add_filter('add_to_cart_class', array($this, 'add_to_cart_class'));
      //add_action('storefront_content_top', array($this, 'add_storefront_notices'));
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
      }
      return self::$instance;
    }

  }

  QLWCDC_Products::instance();
}