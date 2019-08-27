<?php
/**
 * Plugin Name: WooCommerce Direct Checkout
 * Description: Simplifies the checkout process to improve your sales rate.
 * Version: 2.1.1
 * Author: QuadLayers
 * Author URI: https://www.quadlayers.com
 * Copyright:   2018 QuadLayers (https://www.quadlayers.com)
 * Text Domain: woocommerce-direct-checkout
 */

if (!defined('ABSPATH')) {
  die('-1');
}
if (!defined('QLWCDC_PLUGIN_NAME')) {
  define('QLWCDC_PLUGIN_NAME', 'WooCommerce Direct Checkout');
}
if (!defined('QLWCDC_PLUGIN_VERSION')) {
  define('QLWCDC_PLUGIN_VERSION', '2.1.1');
}
if (!defined('QLWCDC_PLUGIN_FILE')) {
  define('QLWCDC_PLUGIN_FILE', __FILE__);
}
if (!defined('QLWCDC_PLUGIN_DIR')) {
  define('QLWCDC_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR);
}
if (!defined('QLWCDC_DOMAIN')) {
  define('QLWCDC_DOMAIN', 'qlwcdc');
}
if (!defined('QLWCDC_WORDPRESS_URL')) {
  define('QLWCDC_WORDPRESS_URL', 'https://wordpress.org/plugins/woocommerce-direct-checkout/');
}
if (!defined('QLWCDC_REVIEW_URL')) {
  define('QLWCDC_REVIEW_URL', 'https://wordpress.org/support/plugin/woocommerce-direct-checkout/reviews/?filter=5#new-post');
}
if (!defined('QLWCDC_DEMO_URL')) {
  define('QLWCDC_DEMO_URL', 'https://quadlayers.com/portfolio/woocommerce-direct-checkout/?utm_source=qlwcdc_admin');
}
if (!defined('QLWCDC_PURCHASE_URL')) {
  define('QLWCDC_PURCHASE_URL', QLWCDC_DEMO_URL);
}
if (!defined('QLWCDC_SUPPORT_URL')) {
  define('QLWCDC_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=qlwcdc_admin');
}
if (!defined('QLWCDC_GROUP_URL')) {
  define('QLWCDC_GROUP_URL', 'https://www.facebook.com/groups/quadlayers');
}

if (!class_exists('QLWCDC')) {

  class QLWCDC {

    protected static $instance;

    function ajax_dismiss_notice() {

      if ($notice_id = ( isset($_POST['notice_id']) ) ? sanitize_key($_POST['notice_id']) : '') {

        update_user_meta(get_current_user_id(), $notice_id, true);

        wp_send_json($notice_id);
      }

      wp_die();
    }

    function add_notices() {

      if (!get_transient('qlwcdc-first-rating') && !get_user_meta(get_current_user_id(), 'qlwcdc-user-rating', true)) {
        ?>
        <div id="qlwcdc-admin-rating" class="qlwcdc-notice notice is-dismissible" data-notice_id="qlwcdc-user-rating">
          <div class="notice-container" style="padding-top: 10px; padding-bottom: 10px; display: flex; justify-content: left; align-items: center;">
            <div class="notice-image">
              <img style="border-radius:50%;max-width: 90px;" src="<?php echo plugins_url('/assets/img/logo.jpg', QLWCDC_PLUGIN_FILE); ?>" alt="<?php echo esc_html(QLWCDC_PLUGIN_NAME); ?>>">
            </div>
            <div class="notice-content" style="margin-left: 15px;">
              <p>
                <?php printf(esc_html__('Hello! Thank you for choosing the %s plugin!', 'woocommerce-direct-checkout'), QLWCDC_PLUGIN_NAME); ?>
                <br/>
                <?php esc_html_e('Could you please give it a 5-star rating on WordPress? We know its a big favor, but we\'ve worked very much and very hard to release this great product. Your feedback will boost our motivation and help us promote and continue to improve this product.', 'woocommerce-direct-checkout'); ?>
              </p>
              <a href="<?php echo esc_url(QLWCDC_REVIEW_URL); ?>" class="button-primary" target="_blank">
                <?php esc_html_e('Yes, of course!', 'woocommerce-direct-checkout'); ?>
              </a>
              <a href="<?php echo esc_url(QLWCDC_SUPPORT_URL); ?>" class="button-secondary" target="_blank">
                <?php esc_html_e('Report a bug', 'woocommerce-direct-checkout'); ?>
              </a>
            </div>
          </div>
        </div>
        <script>
          (function ($) {
            $('.qlwcdc-notice').on('click', '.notice-dismiss', function (e) {
              e.preventDefault();
              var notice_id = $(e.delegateTarget).data('notice_id');
              $.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {
                  notice_id: notice_id,
                  action: 'qlwcdc_dismiss_notice',
                },
                success: function (response) {
                  console.log(response);
                },
              });
            });
          })(jQuery);
        </script>
        <?php
      }
    }    

    function get_product_option($product_id = null, $meta_key = null, $default = null) {

      if (!$meta_key) {
        return null;
      }

      if ($product_id && metadata_exists('post', $product_id, $meta_key)) {
        return get_post_meta($product_id, $meta_key, true);
      }

      return get_option($meta_key, $default);
    }

    function add_action_links($links) {

      $links[] = '<a target="_blank" href="' . QLWCDC_PURCHASE_URL . '">' . esc_html__('Premium', 'woocommerce-direct-checkout') . '</a>';
      $links[] = '<a href="' . admin_url('admin.php?page=wc-settings&tab=' . sanitize_title(QLWCDC_DOMAIN)) . '">' . esc_html__('Settings', 'woocommerce-direct-checkout') . '</a>';

      return $links;
    }

    function add_sections($sections = array()) {

      global $current_section;

      $sections = apply_filters('qlwcdc_add_sections', array());

      echo '<ul class="subsubsub">';

      $array_keys = array_keys($sections);

      foreach ($sections as $id => $label) {
        echo '<li><a href="' . admin_url('admin.php?page=wc-settings&tab=qlwcdc&section=' . sanitize_title($id)) . '" class="' . ( $current_section == $id ? 'current' : '' ) . '">' . $label . '</a> ' . ( end($array_keys) == $id ? '' : '|' ) . ' </li>';
      }

      echo '</ul><br class="clear" />';
    }

    function add_tab($settings_tabs) {
      $settings_tabs[QLWCDC_DOMAIN] = __('Direct Checkout', 'woocommerce-direct-checkout');
      return $settings_tabs;
    }

    function add_settings() {
      woocommerce_admin_fields($this->get_settings());
    }

    function save_settings() {
      woocommerce_update_options($this->get_settings());
    }

    function get_settings() {

      $fields = apply_filters('qlwcdc_add_fields', array());

      return $fields;
    }

    function add_frontend_scripts() {
      wp_enqueue_style(QLWCDC_DOMAIN, plugins_url('/assets/qlwcdc.min.css', QLWCDC_PLUGIN_FILE), null, QLWCDC_PLUGIN_VERSION, 'all');
      wp_enqueue_script(QLWCDC_DOMAIN, plugins_url('/assets/qlwcdc.min.js', QLWCDC_PLUGIN_FILE), array('jquery'), QLWCDC_PLUGIN_VERSION, true);
      wp_localize_script(QLWCDC_DOMAIN, QLWCDC_DOMAIN, array(
          'nonce' => wp_create_nonce(QLWCDC_DOMAIN),
          //'queried_object_id' => get_queried_object_id(),
          //'add_product_cart' => $this->get_product_option(get_queried_object_id(), 'qlwcdc_add_product_cart', 'no'),
          'delay' => 200,
          'timeout' => null)
      );
    }

    function remove_premium() {
      ?>
      <script>
        (function ($) {
          'use strict';
          $(window).on('load', function (e) {
            $('#qlwcdc_options').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_checkout_cart]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_checkout_cart_fields]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_checkout_cart_class]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_remove_checkout_columns]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_remove_checkout_coupon_form]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_remove_order_details_address]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_product_quick_purchase]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_product_quick_purchase_to]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_product_quick_purchase_qty]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_product_quick_purchase_class]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_product_quick_purchase_text]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_product_default_attributes]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
            $('label[for=qlwcdc_add_archive_quick_view]').closest('tr').addClass('qlwcdc-premium-field').css({'opacity': '0.5', 'pointer-events': 'none'});
          });
        }(jQuery));
      </script>
      <?php
    }

    function add_footer_js() {
      ?>
      <script>
        (function ($) {
          'use strict';
          $(window).on('load', function (e) {
            // General
            // -----------------------------------------------------------------
            $('select#qlwcdc_add_to_cart_redirect_page').change(function () {
              if ('url' === $(this).val() && 'yes' == $('select#qlwcdc_add_to_cart_redirect').val()) {
                $('input#qlwcdc_add_to_cart_redirect_url').closest('tr, p').fadeIn();
              } else {
                $('input#qlwcdc_add_to_cart_redirect_url').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
            });
            $('select#qlwcdc_add_to_cart_redirect').change(function () {
              if ('yes' === $(this).val()) {
                $('select#qlwcdc_add_to_cart_redirect_page').change();
                $('select#qlwcdc_add_to_cart_redirect_page').closest('tr, p').fadeIn();
              } else {
                $('select#qlwcdc_add_to_cart_redirect_page').change();
                $('select#qlwcdc_add_to_cart_redirect_page').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
            }).change();
            $('select#qlwcdc_add_to_cart_redirect_page').change(function () {
              if ('url' === $(this).val() && 'redirect' == $('select#qlwcdc_add_to_cart').val()) {
                $('input#qlwcdc_add_to_cart_redirect_url').closest('tr, p').fadeIn();
              } else {
                $('input#qlwcdc_add_to_cart_redirect_url').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
            });
            $('select#qlwcdc_add_to_cart').change(function () {
              if ('ajax' === $(this).val()) {
                $('select#qlwcdc_add_to_cart_ajax_button').closest('tr, p').fadeIn();
                $('select#qlwcdc_add_to_cart_ajax_message').closest('tr, p').fadeIn();
              } else {
                $('select#qlwcdc_add_to_cart_ajax_button').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
                $('select#qlwcdc_add_to_cart_ajax_message').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
              if ('redirect' === $(this).val()) {
                $('select#qlwcdc_add_to_cart_redirect_page').closest('tr, p').fadeIn();
              } else {
                $('select#qlwcdc_add_to_cart_redirect_page').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
              $('select#qlwcdc_add_to_cart_redirect_page').change();
            }).change();
            // Archive
            // -----------------------------------------------------------------
            /*$('select#qlwcdc_add_archive_cart_redirect_page').change(function () {
             if ('url' === $(this).val() && 'redirect' == $('select#qlwcdc_add_archive_cart').val()) {
             $('input#qlwcdc_add_archive_cart_redirect_url').closest('tr, p').fadeIn();
             } else {
             $('input#qlwcdc_add_archive_cart_redirect_url').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
             }
             });
             $('select#qlwcdc_add_archive_cart').change(function () {
             if ('ajax' === $(this).val()) {
             $('select#qlwcdc_add_archive_cart_ajax_button').closest('tr, p').fadeIn();
             $('select#qlwcdc_add_archive_cart_ajax_message').closest('tr, p').fadeIn();
             } else {
             $('select#qlwcdc_add_archive_cart_ajax_button').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
             $('select#qlwcdc_add_archive_cart_ajax_message').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
             }
             if ('redirect' === $(this).val()) {
             $('select#qlwcdc_add_archive_cart_redirect_page').closest('tr, p').fadeIn();
             } else {
             $('select#qlwcdc_add_archive_cart_redirect_page').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
             }
             $('select#qlwcdc_add_archive_cart_redirect_page').change();
             }).change();*/
            $('select#qlwcdc_add_archive_text').change(function () {
              if ('yes' === $(this).val()) {
                $('select#qlwcdc_add_archive_text_in').closest('tr, p').fadeIn();
                $('input#qlwcdc_add_archive_text_content').closest('tr, p').fadeIn();
              } else {
                $('select#qlwcdc_add_archive_text_in').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
                $('input#qlwcdc_add_archive_text_content').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
            }).change();
            // Product
            // -----------------------------------------------------------------
            /*$('select#qlwcdc_add_product_cart_redirect_page').change(function () {
             if ('url' === $(this).val() && 'redirect' == $('select#qlwcdc_add_product_cart').val()) {
             $('input#qlwcdc_add_product_cart_redirect_url').closest('tr, p').fadeIn();
             } else {
             $('input#qlwcdc_add_product_cart_redirect_url').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
             }
             });
             $('select#qlwcdc_add_product_cart').change(function () {
             if ('ajax' === $(this).val()) {
             $('select#qlwcdc_add_product_cart_ajax_button').closest('tr, p').fadeIn();
             $('select#qlwcdc_add_product_cart_ajax_message').closest('tr, p').fadeIn();
             } else {
             $('select#qlwcdc_add_product_cart_ajax_button').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
             $('select#qlwcdc_add_product_cart_ajax_message').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
             }
             if ('redirect' === $(this).val()) {
             $('select#qlwcdc_add_product_cart_redirect_page').closest('tr, p').fadeIn();
             } else {
             $('select#qlwcdc_add_product_cart_redirect_page').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
             }
             $('select#qlwcdc_add_product_cart_redirect_page').change();
             }).change();*/
            $('select#qlwcdc_add_product_quick_purchase').change(function () {
              if ('yes' === $(this).val()) {
                $('select#qlwcdc_add_product_quick_purchase_to').closest('tr, p').fadeIn();
                $('input#qlwcdc_add_product_quick_purchase_class').closest('tr, p').fadeIn();
                $('input#qlwcdc_add_product_quick_purchase_text').closest('tr, p').fadeIn();
              } else {
                $('select#qlwcdc_add_product_quick_purchase_to').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
                $('input#qlwcdc_add_product_quick_purchase_class').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
                $('input#qlwcdc_add_product_quick_purchase_text').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
            }).change();
            $('select#qlwcdc_add_product_text').change(function () {
              if ('yes' === $(this).val()) {
                $('input#qlwcdc_add_product_text_content').closest('tr, p').fadeIn();
              } else {
                $('input#qlwcdc_add_product_text_content').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
            }).change();
            // Checkout
            // -----------------------------------------------------------------
            $('select#qlwcdc_add_checkout_cart').change(function () {
              if ('yes' === $(this).val()) {
                $('select#qlwcdc_add_checkout_cart_fields').closest('tr, p').fadeIn();
                $('input#qlwcdc_add_checkout_cart_class').closest('tr, p').fadeIn();
              } else {
                $('select#qlwcdc_add_checkout_cart_fields').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
                $('input#qlwcdc_add_checkout_cart_class').closest('tr:not(.qlwcdc-premium-field), p').fadeOut();
              }
            }).change();
          });
        }(jQuery));
      </script>
      <?php
    }

    function add_menu_page() {
      add_submenu_page('woocommerce', esc_html__('Direct Checkout', 'woocommerce-direct-checkout'), esc_html__('Direct Checkout', 'woocommerce-direct-checkout'), 'manage_options', admin_url('admin.php?page=wc-settings&tab=' . sanitize_title(QLWCDC_DOMAIN)));
    }

    /* function woocommerce_cart_redirect_after_add($val) {
      return 'no';
      } */

    function languages() {
      load_plugin_textdomain('woocommerce-direct-checkout', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    function includes() {
      require_once('includes/general.php');
      require_once('includes/archives.php');
      require_once('includes/products.php');
      require_once('includes/checkout.php');
      require_once('includes/purchase.php');
    }

    function init() {
      add_action('wp_ajax_qlwcdc_dismiss_notice', array($this, 'ajax_dismiss_notice'));
      add_action('wp_enqueue_scripts', array($this, 'add_frontend_scripts'));
      add_action('admin_notices', array($this, 'add_notices'));
      add_action('admin_menu', array(&$this, 'add_menu_page'));
      add_action('admin_footer', array($this, 'remove_premium'));
      add_action('admin_footer', array($this, 'add_footer_js'));
      add_filter('woocommerce_settings_tabs_array', array($this, 'add_tab'), 50);
      add_filter('woocommerce_sections_qlwcdc', array($this, 'add_sections'));
      add_action('woocommerce_sections_qlwcdc', array($this, 'add_settings'));
      add_action('woocommerce_settings_save_qlwcdc', array($this, 'save_settings'));
      //add_filter('option_woocommerce_cart_redirect_after_add', array($this, 'woocommerce_cart_redirect_after_add'));
      add_filter('plugin_action_links_' . plugin_basename(QLWCDC_PLUGIN_FILE), array($this, 'add_action_links'));
    }

    public static function do_import() {

      global $wpdb;

      if (!get_option('qlwcdc_wcd_imported2')) {

        if (get_option('direct_checkout_pro_enabled', get_option('direct_checkout_enabled'))) {

          $url = get_option('direct_checkout_pro_cart_redirect_url', get_option('direct_checkout_cart_redirect_url'));

          if ($url === wc_get_cart_url()) {
            $val = 'cart';
          } elseif (filter_var($url, FILTER_VALIDATE_URL) !== false && $url != wc_get_checkout_url()) {
            $val = 'url';
          } else {
            $val = 'checkout';
          }

          /* add_option('qlwcdc_add_product_cart', 'redirect');
            add_option('qlwcdc_add_product_cart_redirect_page', $val);
            add_option('qlwcdc_add_product_cart_redirect_url', $url);

            add_option('qlwcdc_add_archive_cart', 'redirect');
            add_option('qlwcdc_add_archive_cart_redirect_page', $val);
            add_option('qlwcdc_add_archive_cart_redirect_url', $url); */

          add_option('qlwcdc_add_to_cart', 'redirect');
          add_option('qlwcdc_add_to_cart_redirect_page', $val);
          add_option('qlwcdc_add_to_cart_redirect_url', $url);
        }

        if ($text = get_option('direct_checkout_cart_button_text', get_option('direct_checkout_cart_button_text'))) {
          add_option('qlwcdc_add_product_text', 'yes');
          add_option('qlwcdc_add_product_text_content', $text);
          add_option('qlwcdc_add_archive_text', 'yes');
          add_option('qlwcdc_add_archive_text_content', $text);
          add_option('qlwcdc_add_archive_text_in', array(
              'simple',
              'grouped',
              'virtual',
              'variable',
              'downloadable'
          ));
        }

        if (count($keys = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->postmeta} WHERE meta_key = %s", '_direct_checkout_pro_enabled')))) {
          foreach ($keys as $key) {
            if ($key->meta_value == 'yes') {
              if ($text = get_post_meta($key->post_id, '_direct_checkout_pro_cart_button_text', true)) {
                add_post_meta($key->post_id, 'qlwcdc_add_product_text', 'yes', true);
                add_post_meta($key->post_id, 'qlwcdc_add_product_text_content', $text, true);
              }
            }
          }
        }

        delete_option('qlwcdc_wcd_imported');
        update_option('qlwcdc_wcd_imported2', true);
      }
    }

    public static function do_activation() {

      set_transient('qlwcdc-first-rating', true, MONTH_IN_SECONDS);

      if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
        add_option('qlwcdc_add_to_cart', 'redirect');
        add_option('qlwcdc_add_to_cart_redirect_page', 'cart');
        /* add_option('qlwcdc_add_product_cart', 'redirect');
          add_option('qlwcdc_add_product_cart_redirect_page', 'cart');
          add_option('qlwcdc_add_archive_cart', 'redirect');
          add_option('qlwcdc_add_archive_cart_redirect_page', 'cart'); */
      }

      /* if ('yes' === get_option('woocommerce_enable_ajax_add_to_cart')) {
        add_option('qlwcdc_add_archive_cart', 'ajax');
        } */
    }

    public static function instance() {
      if (!isset(self::$instance)) {
        self::$instance = new self();
        self::$instance->init();
        self::$instance->includes();
        self::$instance->languages();
      }
      return self::$instance;
    }

  }

  add_action('wp_loaded', array('QLWCDC', 'do_import'));
  add_action('plugins_loaded', array('QLWCDC', 'instance'));

  register_activation_hook(QLWCDC_PLUGIN_FILE, array('QLWCDC', 'do_activation'));
}


