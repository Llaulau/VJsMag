<?php
/*
Template Name: Blog or Category
*/
get_header(); ?>

		<!-- Row for main content area -->
		<div id="content" class="<?php echo jwLayout::content_width(); ?> columns <?php echo jwLayout::sidebar_layout(); ?> page" role="main">
	
                            <div class="post-box">
                            
                            
				<?php

                                get_template_part('loop', 'page'); ?>
			</div>

                            
				<?php 
                                global $wp_query;

                                    
                                
                                    $cat = get_post_meta(get_the_id(), '_page_blog_cat', true);
				    $posts = get_post_meta(get_the_id(), '_page_blog_post', true);
				    $authors = get_post_meta(get_the_id(), '_page_blog_author', true);
                                    $count = get_post_meta(get_the_id(), '_page_blog_postscount', true);
                                    $order = get_post_meta(get_the_id(), '_page_blog_order', true);
                                    $orderby = get_post_meta(get_the_id(), '_page_blog_orderby', true);
                                    $dateformat = get_post_meta(get_the_id(), '_page_blog_dateformat', true);
                                    $pagination = get_post_meta(get_the_id(), '_page_blog_pagination', true);
                                    $exerpt = get_post_meta(get_the_id(), '_page_blog_excerpt', true);
                                    $metaauthor = get_post_meta(get_the_id(), '_page_blog_metaauthor',true);
                                    $metacategory = get_post_meta(get_the_id(), '_page_blog_metacategory', true);
                                    $metadate = get_post_meta(get_the_id(), '_page_blog_metadate', true);
                                    $metacomments = get_post_meta(get_the_id(), '_page_blog_metacomments', true);
                                    $metaratings = get_post_meta(get_the_id(), '_page_blog_metaratings', true);
                                    $metacaption = get_post_meta(get_the_id(), '_page_blog_metacaption', true);
                                    $slider = get_post_meta(get_the_id(), '_page_blog_slider', true);
                                    $slider_source = get_post_meta(get_the_id(), '_page_slider_source', true);
                                    $slider_max = get_post_meta(get_the_id(), '_page_custom_max', true);
                                    $image_clickable = get_post_meta(get_the_id(), '_page_blog_image_clickable',true);
                                    $image_lightbox = get_post_meta(get_the_id(), '_page_blog_image_lightbox',true);
                                    
                                    
                                    if (isset($cat[0]) )
                                       $cat = implode(',', $cat);
                                    if (isset($authors[0]))
					$authors = implode(',', $authors);
				   
				    
                                    if(!isset($metacaption[0])){$metacaption[0] = null;}
                                    if(!isset($metaratings[0])){$metaratings[0] = null;}
                                    if(!isset($metacomments[0])){$metacomments[0] = null;}
                                    if(!isset($metadate[0])){$metadate[0] = null;}
                                    if(!isset($metacategory[0])){$metacategory[0] = null;}
                                    if(!isset($metaauthor[0])){$metaauthor[0] = null;}
                                    

                                    $pos = get_post_meta(get_the_ID(),'_page_slider_source','last');
                                    
                                    if(isset($pos) && $pos == 'sticky'){
                                        $post__not_in = get_option( 'sticky_posts');
                                    }

                                    $atts = array(
                                            'count' => $count,
                                            'cats' => $cat,
					    'author' => $authors,
					    'posts' =>$posts,
                                            'order' => $order,
                                            'orderby' => $orderby,
                                            'dateformat' => $dateformat,
                                            'pagination' => $pagination,
                                            'excerpt' => $exerpt,
                                            'metaauthor' => $metaauthor,
                                            'metacategory' => $metacategory,
                                            'metadate' => $metadate,
                                            'metacomments' => $metacomments,
                                            'ratings' => $metaratings,
                                            'metacaption' => $metacaption,
                                            'slider' => $slider,
                                            'slider_source' => $slider_source,
                                            'slider_max' => $slider_max,
                                            'image_clickable' => $image_clickable,
                                            'image_lightbox' => $image_lightbox,
                                            'post__not_in' => $post__not_in
                                                );
     
                                    echo theme_shortcode_blog($atts, null, null);
                                    
                                    ?>
                            
			

		</div><!-- End Content row -->
               
                
                
             
		
		<?php get_sidebar(); ?>
		
<?php get_footer(); ?>