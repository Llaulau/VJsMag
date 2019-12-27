<?php  get_header(); ?>

<!-- Row for main content area -->
<div id="content" class="<?php echo jwLayout::content_width(); ?> columns <?php echo jwLayout::sidebar_layout(); ?>" role="main">


    <?php get_template_part('loop', 'index'); ?>

    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php echo jwRender::pagination(jwOpt::get_option('blog_pagination', 'number')); ?>

</div><!-- End Content row -->



<?php get_sidebar(); ?>

<?php get_footer(); ?>
