<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>

<div class="images">
  
  <div class="single-img p-relative">
    <?php 
        $sale = goral_show_percent_disount();
        if ($sale) { ?>
        <span class="percent-sale"><?php echo trim($sale); ?></span>
    <?php }else{ ?>
        <?php woocommerce_show_product_loop_sale_flash(); ?>
    <?php } ?>
    <?php
      if ( has_post_thumbnail() ) {
        $attachment_count = count( $product->get_gallery_image_ids() );
        $gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
        $props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
        $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
          'title'  => $props['title'],
          'alt'    => $props['alt'],
        ) );
        echo apply_filters(
          'woocommerce_single_product_image_html',
          sprintf(
            '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
            esc_url( $props['url'] ),
            esc_attr( $props['caption'] ),
            $gallery,
            $image
          ),
          $post->ID
        );
      } else {
        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'goral' ) ), $post->ID );
      }
    ?>
    <!-- video -->
    <?php
      $video = get_post_meta( $post->ID, 'apus_product_review_video', true );

      if (!empty($video)) {
        ?>
        <div class="video">
          <a href="<?php echo esc_url($video); ?>" class="popup-video">
            <i class="mn-icon-537"></i>
            <span><?php echo esc_html__('Watch video', 'goral'); ?></span>
          </a>
        </div>
        <?php
      }
    ?>
  </div>
  <div class="thumbnails-img">
    <?php do_action( 'woocommerce_product_thumbnails' ); ?>
  </div>
</div>