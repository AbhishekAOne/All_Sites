<?php 
global $product;
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id($product->get_id() ), 'blog-thumbnails' );
?>
<div class="product-block grid" data-product-id="<?php echo esc_attr($product->get_id()); ?>">
    <div class="block-inner">
        <figure class="image">
            <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
                <?php
                    /**
                    * woocommerce_before_shop_loop_item_title hook
                    *
                    * @hooked woocommerce_show_product_loop_sale_flash - 10
                    * @hooked woocommerce_template_loop_product_thumbnail - 10
                    */
                    goral_swap_images();
                ?>
            </a>
        </figure>
        <div class="groups-button clearfix">
            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
    </div>
    <div class="caption">
        <div class="meta">
            <div class="infor">

                <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php
                    /**
                    * woocommerce_after_shop_loop_item_title hook
                    *
                    * @hooked woocommerce_template_loop_rating - 5
                    * @hooked woocommerce_template_loop_price - 10
                    */
                    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
                    do_action( 'woocommerce_after_shop_loop_item_title');
                ?>
            </div>
        </div>    
    </div>
    <input autocomplete="off" checked type="checkbox" class="accessory-add-product" data-id="<?php echo esc_attr($product->get_id()); ?>" data-price="<?php echo esc_attr($product->get_price()); ?>" />
</div>