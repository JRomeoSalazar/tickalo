<?php
/**
 * The default template for displaying content
 *
 * Used for single post.
 *
 * @subpackage Profit
 * @since Profit 1.0
 */
global $mpProfitPageTemplate;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">       
        <?php the_content(); ?>
        <div class="clearfix"></div>
        <?php wp_link_pages(array('before' => '<nav class="navigation paging-navigation wp-paging-navigation">', 'after' => '</nav>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
    </div><!-- .entry-content -->
</article><!-- #post -->
