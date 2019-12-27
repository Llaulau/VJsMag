<?php get_header(); ?>

<!-- Row for main content area -->
<div id="content" class="<?php echo jwLayout::content_width(); ?> columns <?php echo jwLayout::sidebar_layout(); ?> archive" role="main">

    <div class="post-box">

        <?php if (is_day()) : ?>
            <h1><?php printf(__('Daily Archives: %s', 'jawtemplates'), get_the_date()); ?></h1><hr>
        <?php elseif (is_month()) : ?>
            <h1><?php printf(__('Monthly Archives: %s', 'jawtemplates'), get_the_date('F Y')); ?></h1><hr>
        <?php elseif (is_year()) : ?>
            <h1><?php printf(__('Yearly Archives: %s', 'jawtemplates'), get_the_date('Y')); ?></h1><hr>
        <?php else : ?>
            <?php
            if (jwOpt::get_option('blog_category') == '1') {
                ?>
                <h1>
                    <?php
                    single_cat_title();
                    ?>
                </h1>
                <hr>           
                <?php
            }
            $cat_desc = category_description();
            ?>
            <?php if (strlen($cat_desc) > 0) { ?>
                <div class="category_description">
                    <?php echo $cat_desc; ?>
                </div>
            <?php } ?>
        <?php endif; ?>


        <?php get_template_part('loop', 'category'); ?>
    </div>

    <?php echo jwRender::pagination(jwOpt::get_option('blog_pagination', 'number')); ?>
    
</div><!-- End Content row -->
<?php get_sidebar(); ?>

<?php get_footer(); ?>