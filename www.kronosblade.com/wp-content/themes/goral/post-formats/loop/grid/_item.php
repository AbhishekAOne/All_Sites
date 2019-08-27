<?php
    $thumbsize = isset($thumbsize) ? $thumbsize : goral_get_blog_thumbsize();
    $nb_word = isset($nb_word) ? $nb_word : 25;
?>

<article <?php post_class('post post-grid'); ?>>
    <?php
    $thumb = goral_display_post_thumb($thumbsize);
    echo trim($thumb);
    ?>
    <div class="clearfix entry-content <?php echo !empty($thumb) ? '' : 'no-thumb'; ?>">
        <div class="entry-meta">
            <div class="date"><a href="<?php the_permalink(); ?>"> <span class="d"><?php the_time( 'd' ); ?></span> <?php the_time( 'M, Y' ); ?> </a> </div>
            <div class="info">
                
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
                <div class="meta">
                    <?php
                        printf( '<span class="post-author">%1$s<a href="%2$s">%3$s</a></span>',
                            _x( 'By ', 'Used before post author name.', 'goral' ),
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                            get_the_author()
                        );
                    ?> - 
                    <span class="comments">
                        <?php  
                        printf( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'goral' ), number_format_i18n( get_comments_number() ) );
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="info-bottom">
            <?php if (! has_excerpt()) { ?>
                <div class="entry-description"><?php echo goral_substring( get_the_content(), $nb_word, '...' ); ?></div>
            <?php } else { ?>
                <div class="entry-description"><?php echo goral_substring( get_the_excerpt(), $nb_word, '...' ); ?></div>
            <?php } ?>
        </div>
    </div>
</article>