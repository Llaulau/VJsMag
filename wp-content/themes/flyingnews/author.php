<?php get_header(); ?>



<?php
$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));


if (get_the_author_meta('description') == '') {
    global $wp_query;
    $curauthdesc = $wp_query->get_queried_object();
    if (isset($curauthdesc->description)) {
        $desc = $curauthdesc->description;
    }
} else {
    $desc = get_the_author_meta('description');
}
?>

<div id="content" class="<?php echo jwLayout::content_width(); ?> columns <?php echo jwLayout::sidebar_layout(); ?>" role="main">


    <div id="admin_info" role="main">
        <div class="about_author">
            <div class="author_name"><?php echo $curauth->nickname; ?></div>
            <div class="author_link"><a href="<?php echo get_author_posts_url($curauth->ID); ?>"><?php _e('About the author', 'jawtemplates'); ?></a></div>
            <div class="clear"></div>
        </div>

        <div class="author_info">
            <div class="author_image">

                <?php echo get_avatar($curauth->ID); ?>

            </div>
            <div class="author_desc"><p><?php echo $desc; ?></p></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>

        <div id="author-page">		

            <?php jwRender::get_author_social_icons($curauth->ID); ?>

            <div class="clear"></div>
        </div>

    </div><!-- End Content row -->	
    <?php get_template_part('loop', 'index'); ?>

    <?php /* Display navigation to next/previous pages when applicable */ ?>
    <?php echo jwRender::pagination(jwOpt::get_option('blog_pagination', 'number')); ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>