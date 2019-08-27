<?php
/**
 * goral functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Goral
 * @since Goral 1.6
 */
add_action('woocommerce_after_shop_loop_item','replace_add_to_cart');
function replace_add_to_cart() {
global $product;
$link = $product->get_permalink();
global $product;
$product_id = $product->id;
echo do_shortcode('<a href="//www.kronosblade.com/id'.$product_id.'" class="button product_type_simple add_to_cart_button ajax_add_to_cart btn product_type_simple"">DETAILED VIEW</a>');
}

define( 'GORAL_THEME_VERSION', '1.6' );
define( 'GORAL_DEMO_MODE', false );
define( 'GORAL_DEV_MODE', true );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'goral_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Goral 1.0
 */
function goral_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on goral, use a find and replace
	 * to change 'goral' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'goral', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'goral' ),
		'topmenu'  => esc_html__( 'Top Menu', 'goral' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce" );
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = goral_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'goral_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	goral_get_load_plugins();
}
endif; // goral_setup
add_action( 'after_setup_theme', 'goral_setup' );


/**
 * Load Google Front
 */
function goral_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $dosis = _x( 'on', 'dosis font: on or off', 'goral' );
    $oswald    = _x( 'on', 'oswald font: on or off', 'goral' );
 
    if ( 'off' !== $dosis || 'off' !== $oswald ) {
        $font_families = array();
 
        if ( 'off' !== $dosis ) {
            $font_families[] = 'Dosis:200,300,400,500,600,700';
        }
        if ( 'off' !== $oswald ) {
            $font_families[] = 'Oswald:300,400,700';
        }
 
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

function goral_full_fonts_url() {  
	$protocol = is_ssl() ? 'https:' : 'http:';
	wp_enqueue_style( 'goral-theme-fonts', goral_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'goral_full_fonts_url');

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Goral 1.1
 */
function goral_javascript_detection() {
	wp_add_inline_script( 'goral-typekit', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );
}
add_action( 'wp_enqueue_scripts', 'goral_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Goral 1.0
 */
function goral_scripts() {
	// Load our main stylesheet.
	$css_folder = goral_get_css_folder();
	$js_folder = goral_get_js_folder();
	$min = goral_get_asset_min();
	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap-rtl'.$min.'.css', array(), '3.2.0' );
	}else{
		wp_enqueue_style( 'bootstrap', $css_folder . '/bootstrap'.$min.'.css', array(), '3.2.0' );
	}
	$css_path = $css_folder . '/template'.$min.'.css';
	wp_enqueue_style( 'goral-template', $css_path, array(), '3.2' );
	wp_enqueue_style( 'goral-style', get_template_directory_uri() . '/style.css', array(), '3.2' );
	//load font awesome
	wp_enqueue_style( 'font-awesome', $css_folder . '/font-awesome'.$min.'.css', array(), '4.5.0' );

	//load font monia
	wp_enqueue_style( 'font-monia', $css_folder . '/font-monia'.$min.'.css', array(), '1.8.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate-style', $css_folder . '/animate'.$min.'.css', array(), '3.5.0' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_style( 'perfect-scrollbar', $css_folder . '/perfect-scrollbar'.$min.'.css', array(), '2.3.2' );

	wp_enqueue_script( 'bootstrap', $js_folder . '/bootstrap'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_enqueue_script( 'owl-carousel', $js_folder . '/owl.carousel'.$min.'.js', array( 'jquery' ), '2.0.0', true );
	wp_enqueue_script( 'perfect-scrollbar-jquery', $js_folder . '/perfect-scrollbar.jquery'.$min.'.js', array( 'jquery' ), '2.0.0', true );

	wp_enqueue_script( 'jquery-magnific-popup', $js_folder . '/magnific/jquery.magnific-popup'.$min.'.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'magnific-popup', $js_folder . '/magnific/magnific-popup'.$min.'.css', array(), '1.1.0' );
	
	// lazyload image
	wp_enqueue_script( 'jquery-unveil', $js_folder . '/jquery.unveil'.$min.'.js', array( 'jquery' ), '20150330', true );

	wp_register_script( 'goral-functions', $js_folder . '/functions'.$min.'.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'goral-functions', 'goral_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
	wp_enqueue_script( 'goral-functions' );

	if ( goral_get_config('header_js') != "" ) {
		wp_add_inline_script( 'goral-header', goral_get_config('header_js') );
	}
}


add_action( 'wp_enqueue_scripts', 'goral_scripts', 100 );

function goral_footer_scripts() {
	if ( goral_get_config('footer_js') != "" ) {
		wp_add_inline_script( 'goral-footer', goral_get_config('footer_js') );
	}
}
add_action('wp_footer', 'goral_footer_scripts');
/**
 * Display descriptions in main navigation.
 *
 * @since Goral 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function goral_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'goral_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Goral 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function goral_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'goral_search_form_modify' );

/**
 * Function for remove srcset (WP4.4)
 *
 */
function goral_disable_srcset( $sources ) {
    return false;
}
add_filter( 'wp_calculate_image_srcset', 'goral_disable_srcset' );

/**
 * Function get opt_name
 *
 */
function goral_get_opt_name() {
	return 'goral_theme_options';
}
add_filter( 'apus_themer_get_opt_name', 'goral_get_opt_name' );

function goral_register_demo_mode() {
	if ( defined('GORAL_DEMO_MODE') && GORAL_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_themer_register_demo_mode', 'goral_register_demo_mode' );

function goral_get_demo_preset() {
	$preset = '';
    if ( defined('GORAL_DEMO_MODE') && GORAL_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_themer_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_themer_preset_default' );
        }
    }
    return $preset;
}

function goral_get_config($name, $default = '') {
	global $goral_options;
    if ( isset($goral_options[$name]) ) {
        return $goral_options[$name];
    }
    return $default;
}

function goral_get_global_config($name, $default = '') {
	$options = get_option( 'goral_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function goral_get_image_lazy_loading() {
	return goral_get_config('image_lazy_loading');
}

add_filter( 'apus_themer_get_image_lazy_loading', 'goral_get_image_lazy_loading');

function goral_register_sidebar() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'goral' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'goral' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog right sidebar', 'goral' ),
		'id'            => 'blog-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'goral' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product left sidebar', 'goral' ),
		'id'            => 'product-left-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'goral' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Product right sidebar', 'goral' ),
		'id'            => 'product-right-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'goral' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
}
add_action( 'widgets_init', 'goral_register_sidebar' );

/*
 * Init widgets
 */
function goral_widgets_init($widgets) {
	$widgets = array_merge($widgets, array( 'woo-price-filter', 'woo-product-sorting', 'vertical_menu' ));
	return $widgets;
}
add_filter( 'apus_themer_register_widgets', 'goral_widgets_init' );

function goral_get_load_plugins() {
	// framework
	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Themer For Themes', 'goral' ),
        'slug'                     => 'apus-themer',
        'required'                 => true,
        'source'				   => get_template_directory() . '/inc/plugins/apus-themer.zip'
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Cmb2', 'goral' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	));
	
	$plugins[] =(array(
		'name'                     => esc_html__('King Composer - Page Builder', 'goral'),
	    'slug'                     => 'kingcomposer',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Revolution Slider', 'goral' ),
        'slug'                     => 'revslider',
        'required'                 => true,
        'source'				   => get_template_directory() . '/inc/plugins/revslider.zip'
	));

	// for woocommerce
	$plugins[] =(array(
		'name'                     => esc_html__( 'WooCommerce', 'goral' ),
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'YITH WooCommerce Wishlist', 'goral' ),
	    'slug'                     => 'yith-woocommerce-wishlist',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'YITH WooCommerce Compare', 'goral' ),
        'slug'                     => 'yith-woocommerce-compare',
        'required'                 => false,
	));

	// for other plugins
	$plugins[] =(array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'goral' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Contact Form 7', 'goral' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	));

	$plugins[] =(array(
		'name'                     => esc_html__( 'Apus Compare Device', 'goral' ),
        'slug'                     => 'apus-compare-device',
        'required'                 => true,
        'source'				   => get_template_directory() . '/inc/plugins/apus-compare-device.zip'
	));
	
	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';


if ( defined( 'APUS_THEMER_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'GORAL_REDUX_THEMER_ACTIVED', true );
}
if( in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	require get_template_directory() . '/inc/vendors/cmb2/product.php';
	define( 'GORAL_CMB2_ACTIVED', true );
}
if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	require get_template_directory() . '/inc/vendors/woocommerce/woo-custom.php';
	define( 'GORAL_WOOCOMMERCE_ACTIVED', true );
}
if( in_array( 'kingcomposer/kingcomposer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	require get_template_directory() . '/inc/vendors/kingcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/kingcomposer/maps.php';
	define( 'GORAL_KINGCOMPOSER_ACTIVED', true );
}
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
function wooc_extra_register_fields() {?>
<p class="form-row form-row-first">
       <label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="account_first_name" id="account_first_name" value="<?php if ( ! empty( $_POST['account_first_name'] ) ) esc_attr_e( $_POST['account_first_name'] ); ?>" />
       </p>
       <p class="form-row form-row-last">
       <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
       </p>
       <p class="form-row form-row-first">
       <label for="reg_billing_phone"><?php _e( 'Country Code', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
       </p>
       <p class="form-row form-row-last">
       <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?><span class="required">*</span></label>
       <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
       <div class="clear"></div>
       <?php
 }
 add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );
 
 // ----- validate password match on the registration page
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
	global $woocommerce;
	extract( $_POST );
	if ( strcmp( $password, $password2 ) !== 0 ) {
		return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
	}
	return $reg_errors;
}
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10,3);

// ----- add a confirm password fields match on the registration page
function wc_register_form_password_repeat() {
	?>
	<p class="form-row form-row-wide">
		<label for="reg_password2"><?php _e( 'Confirm Password', 'woocommerce' ); ?> <span class="required">*</span></label>
		<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
	</p>
	<?php
}
add_action( 'woocommerce_register_form', 'wc_register_form_password_repeat' );

// ----- Validate confirm password field match to the checkout page
function lit_woocommerce_confirm_password_validation( $posted ) {
    $checkout = WC()->checkout;
    if ( ! is_user_logged_in() && ( $checkout->must_create_account || ! empty( $posted['createaccount'] ) ) ) {
        if ( strcmp( $posted['account_password'], $posted['account_confirm_password'] ) !== 0 ) {
            wc_add_notice( __( 'Passwords do not match.', 'woocommerce' ), 'error' ); 
        }
    }
}
add_action( 'woocommerce_after_checkout_validation', 'lit_woocommerce_confirm_password_validation', 10, 2 );

// ----- Add a confirm password field to the checkout page
function lit_woocommerce_confirm_password_checkout( $checkout ) {
    if ( get_option( 'woocommerce_registration_generate_password' ) == 'no' ) {

        $fields = $checkout->get_checkout_fields();

        $fields['account']['account_confirm_password'] = array(
            'type'              => 'password',
            'label'             => __( 'Confirm password', 'woocommerce' ),
            'required'          => true,
            'placeholder'       => _x( 'Confirm Password', 'placeholder', 'woocommerce' )
        );

        $checkout->__set( 'checkout_fields', $fields );
    }
}
add_action( 'woocommerce_checkout_init', 'lit_woocommerce_confirm_password_checkout', 10, 1 );

add_filter( 'gettext', 'change_woocommerce_return_to_shop_text', 20, 3 );
function change_woocommerce_return_to_shop_text( $translated_text, $text, $domain ) {
       switch ( $translated_text ) {
                      case 'Return to shop' :
   $translated_text = __( 'Continue Shopping', 'woocommerce' );
   break;
  }
 return $translated_text; 

}

function sv_remove_product_page_skus( $enabled ) {
    if ( ! is_admin() && is_product() ) {
        return false;
    }

    return $enabled;
}
add_filter( 'wc_product_sku_enabled', 'sv_remove_product_page_skus' );

add_filter( 'woocommerce_min_password_strength', 'reduce_min_strength_password_requirement' );
function reduce_min_strength_password_requirement( $strength ) {
    // 3 => Strong (default) | 2 => Medium | 1 => Weak | 0 => Very Weak (anything).
    return 1; 
}

add_filter('gettext', 'change_lost_password' );
function change_lost_password($translated) { 
  $translated = str_ireplace('Lost your Password', 'Forgot Password?', $translated);
  return $translated; 
}

add_filter( 'woocommerce_default_address_fields', 'customise_postcode_fields' );
function customise_postcode_fields( $address_fields ) {
    $address_fields['postcode']['required'] = false;

    return $address_fields;
}

add_filter( 'woocommerce_billing_fields', 'woo_filter_state_billing', 10, 1 );
add_filter( 'woocommerce_shipping_fields', 'woo_filter_state_shipping', 10, 1 );
function woo_filter_state_billing( $address_fields ) { 
  $address_fields['billing_state']['required'] = false;
	return $address_fields;
}
function woo_filter_state_shipping( $address_fields ) { 
	$address_fields['shipping_state']['required'] = false;
	return $address_fields;
}

/**
 * Bypass logout confirmation.
 */
function iconic_bypass_logout_confirmation() {
	global $wp;

	if ( isset( $wp->query_vars['customer-logout'] ) ) {
		wp_redirect( str_replace( '&amp;', '&', wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) );
		exit;
	}
}

add_action( 'template_redirect', 'iconic_bypass_logout_confirmation' );

add_filter( 'woocommerce_order_button_text', 'bbloomer_rename_place_order_button' );
 
function bbloomer_rename_place_order_button() {
   return ''; 
}

add_action( 'woocommerce_before_checkout_form', function() {
    echo '<p style="font-size: 20px; text-align: center;">We do not pay for your countries customs charges. It’s your country your custom and taxes! We will not pay for returns or accept products returned to us due to non-payment of taxes or custom charges. By purchasing from us you accept these Terms and Conditions</p>';
});

add_action( 'woocommerce_after_checkout_form', function() {
    echo '<p style="font-size: 20px; text-align: center;">We do not pay for your countries customs charges. It’s your country your custom and taxes! We will not pay for returns or accept products returned to us due to non-payment of taxes or custom charges. By purchasing from us you accept these Terms and Conditions</p>';
});


require get_template_directory() . '/inc/custom-styles.php';