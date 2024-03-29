<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<div class="cross-sells">

		<h2><?php esc_html_e( 'You may be interested in&hellip;', 'goral' ) ?></h2>

		<?php woocommerce_product_loop_start(); ?>
			<div class="container-fluid">
			<?php wc_get_template( 'layout-products/carousel.php',array( 'loop'=>$products,'columns_count'=> 3,'class_column'=>'', 'posts_per_page'=> $products->post_count ) ); ?>
			</div>
		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_query();
