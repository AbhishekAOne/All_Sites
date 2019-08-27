<?php

function goral_woocommerce_setup() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
        $catalog = array(
            'width'     => '330',   // px
            'height'    => '330',   // px
            'crop'      => 1        // true
        );

        $single = array(
            'width'     => '660',   // px
            'height'    => '660',   // px
            'crop'      => 1        // true
        );

        $thumbnail = array(
            'width'     => '130',    // px
            'height'    => '130',   // px
            'crop'      => 1        // true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }
}

add_action( 'init', 'goral_woocommerce_setup');

// cart modal
if ( !function_exists('goral_woocommerce_cart_modal') ) {
    function goral_woocommerce_cart_modal() {
        wc_get_template( 'content-product-cart-modal.php' , array( 'current_product_id' => (int)$_GET['product_id'] ) );
        die;
    }
}

add_action( 'wp_ajax_goral_add_to_cart_product', 'goral_woocommerce_cart_modal' );
add_action( 'wp_ajax_nopriv_goral_add_to_cart_product', 'goral_woocommerce_cart_modal' );


// hooks
if ( !function_exists('goral_woocommerce_enqueue_styles') ) {
    function goral_woocommerce_enqueue_styles() {
        $css_folder = goral_get_css_folder();
        $js_folder = goral_get_js_folder();
        $min = goral_get_asset_min();

        wp_enqueue_style( 'goral-woocommerce', $css_folder . '/woocommerce'.$min.'.css' , 'goral-woocommerce-front' , GORAL_THEME_VERSION, 'all' );
        
        if ( is_singular('product') ) {
            wp_enqueue_script( 'jquery-jcarousellite', $js_folder . '/jquery.jcarousellite'.$min.'.js', array( 'jquery' ), '20150330', true );
            wp_enqueue_script( 'jquery-prettyPhoto', $js_folder . '/prettyPhoto/jquery.prettyPhoto.min.js', array( 'jquery' ), '20150330', true );
            wp_enqueue_script( 'jquery-prettyPhoto-init', $js_folder . '/prettyPhoto/jquery.prettyPhoto.init.min.js', array( 'jquery' ), '20150330', true );
            wp_enqueue_style( 'jquery-prettyPhoto', $js_folder . '/prettyPhoto/prettyPhoto.css' , 'goral-woocommerce-front' , GORAL_THEME_VERSION, 'all' );
        }
        $alert_message = array(
            'success'       => sprintf( '<div class="woocommerce-message">%s <a class="button btn btn-primary btn-inverse wc-forward" href="%s">%s</a></div>', esc_html__( 'Products was successfully added to your cart.', 'goral' ), wc_get_cart_url(), esc_html__( 'View Cart', 'goral' ) ),
            'empty'         => sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'No Products selected.', 'goral' ) ),
            'no_variation'  => sprintf( '<div class="woocommerce-error">%s</div>', esc_html__( 'Product Variation does not selected.', 'goral' ) ),
        );
        wp_register_script( 'goral-woocommerce', $js_folder . '/woocommerce'.$min.'.js', array( 'jquery' ), '20150330', true );
        wp_localize_script( 'goral-woocommerce', 'goral_woo', $alert_message );
        wp_enqueue_script( 'goral-woocommerce' );

        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'goral_woocommerce_enqueue_styles', 99 );

// cart
if ( !function_exists('goral_woocommerce_header_add_to_cart_fragment') ) {
    function goral_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['#cart .count'] =  sprintf(_n(' <span class="count"> %d  </span> ', ' <span class="count"> %d </span> ', $woocommerce->cart->cart_contents_count, 'goral'), $woocommerce->cart->cart_contents_count);
        $fragments['#cart .mini-cart-total'] = trim( $woocommerce->cart->get_cart_total() );
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'goral_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('goral_woocommerce_breadcrumb_defaults') ) {
    function goral_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = goral_get_config('woo_breadcrumb_image');
        $breadcrumb_color = goral_get_config('woo_breadcrumb_color');
        $style = array();
        $breadcrumb_enable = goral_get_config('show_product_breadcrumbs');
        $archive = '';
        if ( !$breadcrumb_enable ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";

        if ( is_single() ) {
            $title = esc_html__('Product Detail', 'goral');
        } else {
            $title = esc_html__('Products List', 'goral');
            $archive ='woo-archive';
        }
        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb '.$archive.'"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner"><h2 class="bread-title">'.$title.'</h2><ol class="apus-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'goral_woocommerce_breadcrumb_defaults' );
add_action( 'goral_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('goral_woocommerce_display_modes') ) {
    function goral_woocommerce_display_modes(){
        global $wp;
        $current_url = goral_shop_page_link(true);

        $url_grid = add_query_arg( 'display_mode', 'grid', remove_query_arg( 'display_mode', $current_url ) );
        $url_list = add_query_arg( 'display_mode', 'list', remove_query_arg( 'display_mode', $current_url ) );

        $woo_mode = goral_woocommerce_get_display_mode();

        echo '<div class="display-mode">';
        echo '<a href="'.  $url_grid  .'" class=" change-view '.($woo_mode == 'grid' ? 'active' : '').'"><i class="mn-icon-99"></i>'.'</a>';
        echo '<a href="'.  $url_list  .'" class=" change-view '.($woo_mode == 'list' ? 'active' : '').'"><i class="mn-icon-105"></i>'.'</a>';
        echo '</div>'; 
    }
}
add_action( 'woocommerce_before_shop_loop', 'goral_woocommerce_display_modes' , 2 );

if ( !function_exists('goral_woocommerce_get_display_mode') ) {
    function goral_woocommerce_get_display_mode() {
        $woo_mode = goral_get_config('product_display_mode', 'grid');
        if ( isset($_COOKIE['goral_woo_mode']) && ($_COOKIE['goral_woo_mode'] == 'list' || $_COOKIE['goral_woo_mode'] == 'grid') ) {
            $woo_mode = $_COOKIE['goral_woo_mode'];
        }
        return $woo_mode;
    }
}

if(!function_exists('goral_shop_page_link')) {
    function goral_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }
        return $link;
    }
}


if(!function_exists('goral_filter_before')){
    function goral_filter_before(){
        echo '<div class="apus-filter clearfix">';
    }
}
if(!function_exists('goral_filter_after')){
    function goral_filter_after(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop', 'goral_filter_before' , 1 );
add_action( 'woocommerce_before_shop_loop', 'goral_filter_after' , 40 );

// set display mode to cookie
if ( !function_exists('goral_before_woocommerce_init') ) {
    function goral_before_woocommerce_init() {
        if( isset($_GET['display_mode']) && ($_GET['display_mode']=='list' || $_GET['display_mode']=='grid') ){  
            setcookie( 'goral_woo_mode', trim($_GET['display_mode']) , time()+3600*24*100,'/' );
            $_COOKIE['goral_woo_mode'] = trim($_GET['display_mode']);
        }
    }
}
add_action( 'init', 'goral_before_woocommerce_init' );

// Number of products per page
if ( !function_exists('goral_woocommerce_shop_per_page') ) {
    function goral_woocommerce_shop_per_page($number) {
        $value = goral_get_config('number_products_per_page');
        if ( is_numeric( $value ) && $value ) {
            $number = absint( $value );
        }
        return $number;
    }
}
add_filter( 'loop_shop_per_page', 'goral_woocommerce_shop_per_page' );

// Number of products per row
if ( !function_exists('goral_woocommerce_shop_columns') ) {
    function goral_woocommerce_shop_columns($number) {
        $value = goral_get_config('product_columns');
        if ( in_array( $value, array(2, 3, 4, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'goral_woocommerce_shop_columns' );

// share box
if ( !function_exists('goral_woocommerce_share_box') ) {
    function goral_woocommerce_share_box() {
        if ( goral_get_config('show_product_social_share') ) {
            get_template_part( 'page-templates/parts/sharebox-product' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'goral_woocommerce_share_box', 100 );

// quickview
if ( !function_exists('goral_woocommerce_quickview') ) {
    function goral_woocommerce_quickview() {
        $args = array(
            'post_type'=>'product',
            'product' => $_GET['productslug']
        );
        $query = new WP_Query($args);
        if ( $query->have_posts() ) {
            while ($query->have_posts()): $query->the_post(); global $product;
                wc_get_template_part( 'content', 'product-quickview' );
            endwhile;
        }
        wp_reset_postdata();
        die;
    }
}

if ( goral_get_global_config('show_quickview') ) {
    add_action( 'wp_ajax_goral_quickview_product', 'goral_woocommerce_quickview' );
    add_action( 'wp_ajax_nopriv_goral_quickview_product', 'goral_woocommerce_quickview' );
}

// swap effect
if ( !function_exists('goral_swap_images') ) {
    function goral_swap_images($size = 'shop_catalog') {
        global $post, $product, $woocommerce;
        
        $output = '';
        $class = 'image-no-effect unveil-image';
        if (has_post_thumbnail()) {
            $product_thumbnail_id = get_post_thumbnail_id();
            $product_thumbnail_title = get_the_title( $product_thumbnail_id );
            $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $size );
            $placeholder_image = goral_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

            if ( goral_get_config('show_swap_image') ) {
                $attachment_ids = $product->get_gallery_image_ids();
                if ($attachment_ids && isset($attachment_ids[0])) {
                    $class = 'image-hover';
                    $product_thumbnail_hover_title = get_the_title( $attachment_ids[0] );
                    $product_thumbnail_hover = wp_get_attachment_image_src( $attachment_ids[0], $size );
                    
                    if ( goral_get_config('image_lazy_loading') ) {
                        echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog unveil-image image-effect" />';
                    } else {
                        echo '<img src="' . esc_url( $product_thumbnail_hover[0] ) . '" width="' . esc_attr( $product_thumbnail_hover[1] ) . '" height="' . esc_attr( $product_thumbnail_hover[2] ) . '" alt="' . esc_attr( $product_thumbnail_hover_title ) . '" class="attachment-shop-catalog image-effect" />';
                    }
                }
            }
            
            if ( goral_get_config('image_lazy_loading') ) {
                echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog unveil-image '.esc_attr($class).'" />';
            } else {
                echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-shop-catalog '.esc_attr($class).'" />';
            }
        } else {
            $image_sizes = get_option('shop_catalog_image_size');
            $placeholder_width = $image_sizes['width'];
            $placeholder_height = $image_sizes['height'];

            $output .= '<img src="'.woocommerce_placeholder_img_src().'" alt="'.esc_html__('Placeholder' , 'goral').'" class="'.$class.'" width="'.$placeholder_width.'" height="'.$placeholder_height.'" />';
        }
        echo trim($output);
    }
}


// get image
if ( !function_exists('goral_product_get_image') ) {
    function goral_product_get_image($thumb = 'shop_thumbnail') {
        global $product;

        $product_thumbnail_id = get_post_thumbnail_id();
        $product_thumbnail_title = get_the_title( $product_thumbnail_id );
        $product_thumbnail = wp_get_attachment_image_src( $product_thumbnail_id, $thumb );
        
        $placeholder_image = goral_create_placeholder(array($product_thumbnail[1],$product_thumbnail[2]));

        echo '<div class="product-image">';
        if ( goral_get_config('image_lazy_loading') ) {
            echo '<img src="' . trim( $placeholder_image ) . '" data-src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image unveil-image" />';
        } else {
            echo '<img src="' . esc_url( $product_thumbnail[0] ) . '" width="' . esc_attr( $product_thumbnail[1] ) . '" height="' . esc_attr( $product_thumbnail[2] ) . '" alt="' . esc_attr( $product_thumbnail_title ) . '" class="attachment-'.esc_attr($thumb).' size-'.esc_attr($thumb).' wp-post-image" />';
        }
        echo '</div>';
    }
}

// layout class for woo page
if ( !function_exists('goral_woocommerce_content_class') ) {
    function goral_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( goral_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'goral_woocommerce_content_class', 'goral_woocommerce_content_class' );

// get layout configs
if ( !function_exists('goral_get_woocommerce_layout_configs') ) {
    function goral_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        $left = goral_get_config('product_'.$page.'_left_sidebar');
        $right = goral_get_config('product_'.$page.'_right_sidebar');

        switch ( goral_get_config('product_'.$page.'_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3'  );
                $configs['main'] = array( 'class' => 'col-md-9 ' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3' ); 
                $configs['main'] = array( 'class' => 'col-md-9 ' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3' ); 
                $configs['main'] = array( 'class' => 'col-md-6 ' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12' );
                break;
        }

        return $configs; 
    }
}

// Show/Hide related, upsells products
if ( !function_exists('goral_woocommerce_related_upsells_products') ) {
    function goral_woocommerce_related_upsells_products($located, $template_name) {
        $content_none = get_template_directory() . '/woocommerce/content-none.php';
        $show_product_releated = goral_get_config('show_product_releated');
        if ( 'single-product/related.php' == $template_name ) {
            if ( !$show_product_releated  ) {
                $located = $content_none;
            }
        } elseif ( 'single-product/up-sells.php' == $template_name ) {
            $show_product_upsells = goral_get_config('show_product_upsells');
            if ( !$show_product_upsells ) {
                $located = $content_none;
            }
        }

        return apply_filters( 'goral_woocommerce_related_upsells_products', $located, $template_name );
    }
}
add_filter( 'wc_get_template', 'goral_woocommerce_related_upsells_products', 10, 2 );

if ( !function_exists( 'goral_product_tabs' ) ) {
    function goral_product_tabs($tabs) {
        global $post;
        if ( goral_get_config('show_product_accessory', true) ) {
            $pids = Goral_Woo_Custom::get_accessories( $post->ID );
            if ( !empty($pids) ) {
                $accessory_tabs = array(
                    'accessory' => array(
                        'title' => esc_html__('Accessories', 'goral'),
                        'priority' => 5,
                        'callback' => 'goral_display_accessories'
                    )
                );
                $tabs = array_merge($accessory_tabs, $tabs);
            }
        }
        
        if (get_post_meta( $post->ID, 'apus_product_features', true )) {
            $tabs['specifications'] = array(
                'title' => esc_html__('Features', 'goral'),
                'priority' => 15,
                'callback' => 'goral_display_features'
            );
        }

        if ( !goral_get_config('show_product_review_tab') && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }
        unset( $tabs['additional_information'] ); 
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'goral_product_tabs', 90 );

if ( !function_exists( 'goral_minicart') ) {
    function goral_minicart() {
        $template = apply_filters( 'goral_minicart_version', '' );
        get_template_part( 'woocommerce/cart/mini-cart-button', $template ); 
    }
}
// Wishlist
add_filter( 'yith_wcwl_button_label', 'goral_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'goral_woocomerce_icon_wishlist_add' );
function goral_woocomerce_icon_wishlist( $value='' ){
    return '<i class="mn-icon-1246"></i>'.'<span class="sub-title">'.esc_html__('Add to Wishlist','goral').'</span>';
}

function goral_woocomerce_icon_wishlist_add(){
    return '<i class="mn-icon-2"></i>'.'<span class="sub-title">'.esc_html__('Wishlisted','goral').'</span>';
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );


function goral_woocommerce_get_ajax_products() {
    $categories = isset($_POST['categories']) ? $_POST['categories'] : '';
    $columns = isset($_POST['columns']) ? $_POST['columns'] : 4;
    $number = isset($_POST['number']) ? $_POST['number'] : 4;
    $product_type = isset($_POST['product_type']) ? $_POST['product_type'] : '';
    $layout_type = isset($_POST['layout_type']) ? $_POST['layout_type'] : '';

    $categories_id = !empty($categories) ? array($categories) : array();
    $loop = apus_themer_get_products( $categories_id, $product_type, 1, $number );
    if ( $loop->have_posts()) {
        wc_get_template( 'layout-products/'.$layout_type.'.php' , array( 'loop' => $loop, 'columns' => $columns, 'number' => $number ) );
    }
    exit();
}
add_action( 'wp_ajax_goral_get_products', 'goral_woocommerce_get_ajax_products' );
add_action( 'wp_ajax_nopriv_goral_get_products', 'goral_woocommerce_get_ajax_products' );


function goral_display_accessories() {
    get_template_part( 'woocommerce/single-product/tabs/accessories' );
}

function goral_display_features() {
    get_template_part( 'woocommerce/single-product/tabs/features' );
}

function goral_show_percent_disount() {
    global $product;
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();

    if ( !empty($sale_price) && $regular_price ) {
        $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

        return $percentage.esc_html__('%', 'goral');
    } else {
        return '';
    }
}
function goral_show_wooswatches() {
    return 'goral_show_wooswatches';
}
add_filter( 'apus-wooswatches-show-on-loop', 'goral_show_wooswatches' );

function goral_next_product_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'product') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    $product = wc_get_product( $post->ID );
    return '<div class="next-product product-nav">
        <a class="before-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            '.get_the_post_thumbnail( $post->ID,'shop_thumbnail' ).'
        </a>
        <a class="on-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            <span class="nav-product-title">'.$title.'</span>
            <span class="price">'.$product->get_price_html().'</span>
        </a>
        </div>';
}

add_filter( 'next_post_link', 'goral_next_product_link', 100, 5 );

function goral_previous_product_link($output, $format, $link, $post, $adjacent) {
    if (empty($post) || $post->post_type != 'product') {
        return $output;
    }
    $title = get_the_title( $post->ID );
    $product = wc_get_product( $post->ID );
    return '<div class="previous-product product-nav">
        <a class="before-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            '.get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ).'
        </a>
        <a class="on-hover" href="'.esc_url(get_permalink($post->ID)).'" title="'.esc_attr($title).'">
            <span class="nav-product-title">'.$title.'</span>
            <span class="price">'.$product->get_price_html().'</span>
        </a>
        </div>';
    
}
add_filter( 'previous_post_link', 'goral_previous_product_link', 100, 5 );
