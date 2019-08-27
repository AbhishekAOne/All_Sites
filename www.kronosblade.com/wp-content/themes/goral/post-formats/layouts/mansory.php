<?php
	$js_folder = goral_get_js_folder();
    $min = goral_get_asset_min();
    wp_enqueue_script( 'goral-isotope-js', $js_folder . '/isotope.pkgd'.$min.'.js', array( 'jquery' ) );
    $columns = goral_get_config('blog_columns', 1);
	$bcol = floor( 12 / $columns );
?>
<div class="row">
    <div class="isotope-items" data-isotope-duration="400">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="isotope-item col-md-<?php echo esc_attr($bcol); ?> col-sm-6 col-xs-12">
                <?php get_template_part( 'post-formats/content', get_post_format() ); ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>