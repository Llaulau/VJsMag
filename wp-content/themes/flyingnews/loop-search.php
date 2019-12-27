<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
    <div class="notice">
        <p class="bottom"><?php _e('We are sorry, no results were found. You can try to find some related posts using the search function.','jawtemplates'); ?></p>
    </div>
    <?php get_search_form(); ?>	
<?php endif; ?>
<div id="elements_iso" class="">
    <?php /* Start loop */ ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php
        global $post;

        
        $categories = get_the_category($post->ID);        
        
        if ( count($categories) > 0 ) { 
            $cat_id = ($categories[0]->cat_ID );
            $cat_bg_color = jwOpt::get_option('cat_bg_color', 'template', 'category', $cat_id);
        } else {
            $cat_bg_color = 'tempalte';
        }
        
        $class_thumbnail = "no-thumbnail";

        if (jwUtils::has_post_thumbnail()) {
            $class_thumbnail = "has-thumbnail";
        }

        if ($cat_bg_color === 'custom') {
            $cat_bg_color .= "_" . $cat_id;
        }
        ?>


        <article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'one_col', 'category_' . $cat_bg_color, $class_thumbnail)); ?>   sort_name="<?php echo(StrToLower(get_the_title())); ?>"  sort_date="<?php the_time("Y-m-d H:i:s"); ?>" sort_rating="<?php echo $post->rating; ?>" sort_popular="<?php echo get_comments_number(); ?>">
            <div class="box">
                <?php echo jwRender::metaCategory(); ?>
                <div class="image">



                    <?php
                    if (jwOpt::get_option('std_post_image_clickable') == '1') {
                        echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                    }
                    jwUtils::the_post_thumbnail('post-size');   


                    if (jwOpt::get_option('std_post_image_clickable') == '1') {
                        echo '</a>';
                    }
                    ?>
                    

                   
                    <?php echo jwRender::metaPost(); ?> 
                          
                </div>

                <div class="content-box">
                    <header>
                        <h2><a href="<?php the_permalink(); ?>" class="post_name"><?php the_title(); ?></a></h2>
                    </header>    

                    
            <?php echo jwRender::get_the_excerpt(); ?>

                </div>
            </div>
        </article>

    <?php endwhile; // End the loop   ?>
</div>
