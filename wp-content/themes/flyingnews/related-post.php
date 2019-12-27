<?php
if (jwOpt::get_option('post_relatedpost', '0')) {

    list($tagargs, $catargs) = jwRender::get_related_post(get_the_ID());
    $query = new WP_Query($tagargs);


    if (!($query->have_posts())) {
        wp_reset_query();
        $query = new WP_Query($catargs);
    }
 
    if ($query->have_posts()) { ?>

        <div id="related" class="tab-post-row">
            <h3><?php _e('Related Posts', 'jawtemplates'); ?></h3>

        <?php while ($query->have_posts()) : $query->the_post(); ?>
			    <div class="related-box">
			<?php    if (has_post_thumbnail()) {
                                    ?>

                                    <div class="tab-post-widget-img">
                                        <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(array(63, 63)); ?></a>
                                    </div>
                                    <div class="tab-post-widget-content">
                                          <h4> <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4> <?php echo jwUtils::crop_length(get_the_excerpt(), 95); ?>  
                                        
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="tab-post-widget-content">
                                        <h4><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h4>
                                       
                                    </div>    
                                <?php } ?>

                                <div class="clear"></div>
</div>
       
        <?php 
  
        endwhile; ?>

            <div class="clear"></div>
        </div>
    <?php
    } wp_reset_query();
}
?>
