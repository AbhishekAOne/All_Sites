<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;
	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) ) {
		$woocommerce_loop['loop'] = 0;
	}

	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) ) {
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
	}
$columns = 12/$woocommerce_loop['columns'];

$woo_display = goral_woocommerce_get_display_mode();
if ( $woo_display == 'list' ) { 
	$classes[] = 'col-xs-12 list';	
?>
	<div <?php wc_product_class( $classes ); ?>>
	 	<?php wc_get_template_part( 'item-product/inner-list' ); ?>
	</div>
<?php 
} else {
	$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-6 '.' col-xs-6 list';
	// Ensure visibility
	if ( ! $product || ! $product->is_visible() ) {
		return;
	}
	 
	// Extra post classes
	$classes = array();
	if($woocommerce_loop['columns'] == 5) {
		$columns = 'cus-5';
	} else {
		$columns = 12/$woocommerce_loop['columns'];
	}
	$classes[] = 'col-lg-'.$columns.' col-md-'.$columns.' col-sm-6 col-xs-6'.' grid product';
	?>

	<div <?php wc_product_class( $classes ); ?>>
		 	<?php wc_get_template_part( 'item-product/inner' ); ?>
	</div>

<?php } ?>