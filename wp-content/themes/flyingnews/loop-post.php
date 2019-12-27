<?php
/* Start loop */
global $content_width;
?>
<?php
while (have_posts()) : the_post();


    $post_meta = get_post_meta(get_the_id(), '');
    ?>
    <?php
    if (isset($post_meta['fw_rating_position']) && $post_meta['fw_rating_position'] != 'off') {
        $review = true;
    } else {
        $review = false;
    }
    ?>

    <?php if (get_the_post_thumbnail()): ?>
        <media:content url="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_id())); ?>" medium="image" />
    <?php endif; ?>


    <article  <?php post_class() ?> id="post-<?php the_ID(); ?>" <?php if ($review) { ?> itemscope itemtype="http://data-vocabulary.org/Review" <?php } ?> >

        <?php
        $categories = get_the_category(get_the_ID());

        if (sizeof($categories) > 0) {
            $cat_id = ($categories[0]->cat_ID );
            $cat_bg_color = jwOpt::get_option('cat_bg_color', 'template', 'category', $cat_id);
        } else {
            $cat_bg_color = 'template';
        }

        if ($cat_bg_color == 'custom') {
            $cat_bg_color = "post_title_custom_" . $cat_id;
        } else {
            $cat_bg_color = "post_title_" . $cat_bg_color;
        }
        ?>



        <header class="<?php echo $cat_bg_color ?>" >
            <h1 class="entry-title"  ><?php the_title(); ?></h1>
        </header>

        <?php
        $post_meta = get_post_meta(get_the_id(), '');
        if (!isset($post_meta['_use_featured'][0])) {
            $featured_img = jwOpt::get_option('post_use_featured', '0');
        } else if (isset($post_meta['_use_featured'][0])) {
            if ($post_meta['_use_featured'][0] == '-1') {
                $featured_img = jwOpt::get_option('post_use_featured', '0');
            } else {
                $featured_img = $post_meta['_use_featured'][0];
            }
        }

        if ($featured_img == '1') {
            $post_format = get_post_format(get_the_ID());
            if ($post_format == 'gallery') {
                $imgUrl = jwUtils::get_gallery_slider(get_the_ID(), 'large');
                echo '<div id="slider_gal" class="gallery_slider" >';
                foreach ((array) $imgUrl as $iu) {
                    if (jwOpt::get_option('post_pp_galery', '0') == '1') {
                        echo ("<a href='" . $iu['url'][0] . "'>");
                    } else {
                        echo ("<a href='" . get_permalink() . "'>");
                    }
                    echo "<img src=" . $iu['url'][0] . " itemprop='image' rel='media:thumbnail'! />";
                    //Caption on gallery
                    if (isset($iu['caption']) && $iu['caption'] != '') {
                        echo '<div class="captions"><span>' . $iu['caption'] . ' </span></div>';
                    }
                    echo "</a>";
                }
                echo '</div>';


                echo '<script> 
                                jQuery(document).ready(function() {
                                jQuery("#slider_gal").orbit({
                                                    animation: "fade",                  
                                                    animationSpeed: 800,                      
                                                    pauseOnHover: true,                
                                                    startClockOnMouseOut: true,        
                                                    startClockOnMouseOutAfter: 100,    
                                                    directionalNav: true,              
                                                    fluid: true,     
                                                    timer: true, 
                                                    resetTimerOnClick: false
                            });
                                }); 
                          </script>';
            } else if ($post_format == 'video') {
                if (isset($post_meta['_post_video_link'][0])) {
                    echo jwRender::get_video_player($post_meta['_post_video_link'][0], $content_width);
                }
            } else {
                echo '<span rel="media:thumbnail">';
                jwUtils::the_post_thumbnail('large');
                echo '</span>';
            }
        }
        ?>

        <?php
        if (jwOpt::get_option('banner_posttop_show', '0') == '1') {
            get_template_part('loop', 'top_banner');
        }


        $ratingPosition = get_post_meta(get_the_ID(), 'fw_rating_position');
        ?> 

        <div class="entry-content" >
                <?php if (jwOpt::get_option('post_date', '1') || jwOpt::get_option('post_author', '1')) { ?>
                <div class="meta">
                    <?php
                    if (jwOpt::get_option('post_author', '1')) {

                        echo '<span class="meta_posted_by">' . __('Posted by:', 'jawtemplates') . ' </span> <span class="author vcard"><a href="' . get_author_posts_url(get_the_author_meta('ID')) . '"  rel="author">' . get_the_author() . '</a></span> </span>';
                    }

                    if (jwOpt::get_option('post_date', '1')) {
                        if (jwOpt::get_option('post_author', '1')) {
                            printf(', ');
                        };
                        echo '<time class="entry-date" datetime="' . get_the_date('c') . '">' . get_the_date(jwOpt::get_option('blog_dateformat', 'F j, Y')) . '</time>';
                    }
                    ?>
                </div>
            <?php } ?>

            <?php
            if (isset($ratingPosition[0])) {
                if ($ratingPosition[0] == 'top') {
                    get_template_part('loop', 'rating_top');
                }
            }
            the_content();


            //PAGED post
            $args = array(
                'before' => '<nav id="page-nav">',
                'after' => '</nav>',
                'link_before' => '<span class="page-nav-one">',
                'link_after' => '</span>',
                'next_or_number' => 'number',
                'nextpagelink' => __('Next page', 'jawtemplates'),
                'previouspagelink' => __('Previous page', 'jawtemplates'),
                'pagelink' => '%',
                'echo' => 1
            );
            wp_link_pages($args);



            if (jwOpt::get_option('banner_postbottom_show', '0') == '1') {
                get_template_part('loop', 'bottom_banner');
            }


            if (isset($ratingPosition[0])) {
                if ($ratingPosition[0] == 'bottom') {
                    get_template_part('loop', 'rating_bottom');
                }
            }
            ?>


        </div>
        <div class="clear"></div>


        <footer>

            <p><?php the_tags(); ?></p>
        </footer>




    <?php if (jwOpt::get_option('post_share') == '1') { ?>
            <div class="share_post_arrow-up"></div>
            <div class="share_post" role="main">

                <div class="share_hearline">
        <?php _e("Share!", "jawtemplates"); ?>

                </div>

        <?php
        $img_pin = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
        // pokud neni featured vem logo stránky
        if ($img_pin == false) {
            $img_pin[0] = jwOpt::get_option('custom_logo', '');
        }
        ?>
                <div class="share_content">
                <?php if (jwOpt::get_option('post_share_tw') == '1') { ?>
                        <div class="social_button" style="width:100px"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a></div>
                    <?php }
                    if (jwOpt::get_option('post_share_fb') == '1') {
                        ?>
                        <div class="social_button" ><div class="fb-like" data-href="<?php echo get_permalink(); ?>" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div> </div>
                    <?php }
                    if (jwOpt::get_option('post_share_g') == '1') {
                        ?>
                        <div class="social_button" ><div class="g-plus" data-action="share" data-annotation="bubble"></div></div>
                    <?php }
                    if (jwOpt::get_option('post_share_li') == '1') {
                        ?>
                        <div class="social_button" ><script type="IN/Share" data-url="<?php echo get_permalink(); ?>" data-counter="right"></script> </div>
                    <?php }
                    if (jwOpt::get_option('post_share_pi') == '1') {
                        ?>
                        <div class="social_button" ><a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo $img_pin[0]; ?>"  class="pin-it-button" count-layout="horizontal" ><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>
        <?php } ?>
                    <!-- stumble upon  <div class="social_button" ><su:badge layout="1"></su:badge></div>   -->                      
                    <div class="clear"></div>
                </div>

            </div>

        <?php }
        ?>

    <?php if (jwOpt::get_option('blog_author') == '1') { ?>

            <div id="admin_info" role="main">
                <div class="about_author" itemtype="http://schema.org/Person" itemscope itemprop="author">
                    <h3 class="author_name"  itemprop="name"><?php echo get_the_author(); ?></h3>
                    <div class="author_link"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php _e('About the author', 'jawtemplates'); ?></a></div>
                    <a href="<?php echo get_the_author_meta('google'); ?>?rel=author" style="display:none"></a>
                    <div class="clear"></div>
                </div>

                <div class="author_info">
                    <div class="author_image">
        <?php echo get_avatar(get_the_author_meta('ID')); ?>
                    </div>
                    <div class="author_desc"><p><?php echo get_the_author_meta("description"); ?></p></div>
                </div>
                <div class="clear"></div>
            </div><!-- End Content row -->

        <?php } ?>
        <?php get_template_part('woocommerce/single-product/related'); ?>
    <?php get_template_part('related-post'); ?>    
    <?php comments_template(); ?>
    </article>
<?php endwhile; // End the loop 
?>
