<?php
    $post_format = get_post_format();
    $thumbsize = isset($thumbsize) ? $thumbsize : goral_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 50;
?>

<article <?php post_class('post post-list'); ?>>
    <div class="no-margin row">
        <?php
        $thumb = goral_display_post_thumb($thumbsize);
        if (!empty($thumb)) {
            ?>
            <div class="no-padding col-md-6">
                <?php echo trim($thumb); ?>
            </div>
            <?php
        }
        ?>

        <div class="no-padding col-md-<?php echo !empty($thumb) ? '6' : '12'; ?>">
            <div class="entry-content">
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
                <div class="meta">
                    <span class="entry-date"><?php the_time( 'M d ,Y' ); ?></span>
                </div>
                <?php if (! has_excerpt()) { ?>
                    <div class="entry-description"><?php echo goral_substring( get_the_content(), $nb_word, '...' ); ?></div>
                <?php } else { ?>
                    <div class="entry-description"><?php echo goral_substring( get_the_excerpt(), $nb_word, '...' ); ?></div>
                <?php } ?>

                <a class="btn radius-0 btn-theme" href="<?php the_permalink(); ?>"><?php esc_html_e('VIEW MORE','goral') ?></a>
            </div>
        </div>
    </div>
</article>