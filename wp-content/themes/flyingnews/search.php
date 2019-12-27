<?php get_header(); ?>

<!-- Row for main content area -->
<div id="content" class="<?php echo jwLayout::content_width(); ?> columns <?php echo jwLayout::sidebar_layout(); ?>" role="main">

    <h1><?php _e('Search Results for', 'jawtemplates'); ?> "<?php echo get_search_query(); ?>"</h1>
    <?php 
    $content_type = 'search';

    if(get_post_type() == 'product'){
        $content_type = get_post_type();
     }
            
    get_template_part('loop', $content_type); ?>
    <?php  echo jwRender::pagination(jwOpt::get_option('blog_pagination', 'number')); ?>

</div><!-- End Content row -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>