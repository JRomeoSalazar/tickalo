<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Profit
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
            <h2 class="page-title">
                <?php
                if (is_day()) :
                    printf(__('Daily Archives: %s',  'profit' ), get_the_date());
                elseif (is_month()) :
                    printf(__('Monthly Archives: %s',  'profit' ), get_the_date(_x('F Y', 'monthly archives date format',  'profit' )));
                elseif (is_year()) :
                    printf(__('Yearly Archives: %s',  'profit' ), get_the_date(_x('Y', 'yearly archives date format',  'profit' )));
                else :
                    _e('Archives',  'profit' );
                endif;
                ?>
            </h2>
            <div class="breadcrumb-wrapper">
                <?php mp_profit_the_breadcrumb(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="container main-container list-posts">
    <div class="row clearfix">
        <div class=" col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <?php if (have_posts()) : ?>             
                <?php /* The loop */ ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('content', get_post_format()); ?>
                <?php endwhile; ?>
                <?php
                $args = array(
                    'prev_next' => true
                );
                ?>
                <nav class="navigation paging-navigation">
                    <?php echo paginate_links($args); ?>
                </nav><!-- .navigation -->

            <?php else : ?>
                <?php get_template_part('content', 'none'); ?>
            <?php endif; ?>

        </div>
        <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
    <?php get_footer(); ?>
