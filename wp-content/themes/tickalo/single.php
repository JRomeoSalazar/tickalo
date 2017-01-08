<?php
/**
 * The template for displaying all single posts
 *
 * @subpackage Profit
 * @since Profit 1.0
 */
get_header();
?>
<?php
if (!(is_front_page())) :
    ?>
    <div class="page-header">
        <div class="container">
            <h2 class="page-title"><?php the_title(); ?></h2>
            <div class="breadcrumb-wrapper">
                <?php mp_profit_the_breadcrumb(array('show_post_tile' => false)); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="container main-container">
    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('content', 'single'); ?>
        <?php comments_template(); ?>
    <?php endwhile; ?>
    <?php get_footer(); ?>