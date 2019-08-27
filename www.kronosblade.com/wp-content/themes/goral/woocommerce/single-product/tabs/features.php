<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$features = get_post_meta( $post->ID, 'apus_product_features', true );
?>

<div class="features">
	<?php echo trim($features); ?>
</div>

<?php
$photos = get_post_meta( $post->ID, 'apus_product_user_photo', true );

if (!empty($photos)):
	?>
	<div class="user_photo">
		<div class="owl-carousel" data-items="1" data-carousel="owl" data-smallmedium="1" data-extrasmall="1" data-pagination="false" data-nav="true">
			<?php foreach ($photos as $photo) { ?>
				
				<a href="<?php echo esc_url($photo); ?>">
					<img src="<?php echo esc_url($photo); ?>" alt="">
				</a>
				
			<?php } ?>
		</div>
		<ul class="user_photo_thumbs">
			<?php foreach ($photos as $id => $photo) {
				$img = wp_get_attachment_image_src($id, 'thumbnail');
			?>
				<li>
					<a href="<?php echo esc_url($photo); ?>">
						<img src="<?php echo esc_url($img[0]); ?>" alt="">
					</a>
				</li>
			<?php } ?>
		</ul>
	</div>
	<?php
endif;
?>