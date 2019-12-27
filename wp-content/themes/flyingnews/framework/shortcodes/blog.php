<?php

function theme_shortcode_blog($atts, $content = null, $code) {
    $out = '';
    extract(shortcode_atts(array(
                'count' => 6,
                'cats' => '',
                'author' => '',
                'posts' => '',
                'paged' => 1,
                'order' => '',
                'orderby' => '',
                'dateformat' => '',
                'pagination' => '',
                'excerpt' => '15',
                'metaauthor' => '',
                'metacategory' => '',
                'metadate' => '',
                'metacomments' => '',
                'metacaption'   => '',
                'ratings' => '',
                'slider' => false,
                'slider_source' => '',
                'slider_max' => 3,
                'image_clickable' => '0',
                'image_lightbox' => '1',
                'post__not_in' => ''
                    ), $atts));

    $qs = array();
    if(is_front_page()){
        $qs['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
    }else{
        $qs['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }
    $qs['cat'] = $cats;

    $qs['posts_per_page'] = $count;
    $qs['post_type'] = 'post';
    
    $qs['order'] = $order;
    $qs['orderby'] = $orderby;
    $qs['dateformat'] = $dateformat;
    $qs['pagination'] = $pagination;
    $qs['excerpt'] = $excerpt;
    $qs['blog'] = true;
    $qs['slider'] = $slider;
    $qs['slider_source'] = $slider_source;
    $qs['slider_max'] = $slider_max;
    $qs['post__not_in'] = $post__not_in;

    
    if($author){
		$qs['author'] = $author;
	}
    if($posts){
		$qs['post__in'] = explode(',',$posts);
	}

    jwOpt::set_option('blog_dateformat', $dateformat);
    jwOpt::set_option('blog_excerpt', $excerpt);
    
    jwOpt::set_option('blog_metaauthor', $metaauthor);
    jwOpt::set_option('blog_metacategory', $metacategory);
    jwOpt::set_option('blog_metadate', $metadate);
    jwOpt::set_option('blog_metacomments', $metacomments);
    jwOpt::set_option('blog_metacaption', $metacaption);
    jwOpt::set_option('blog_ratings', $ratings);
    
    jwOpt::set_option('std_post_image_clickable',$image_clickable);
    jwOpt::set_option('image_lightbox',$image_lightbox);
  
  

    global $wp_query;
    $original_query = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query($qs);
    
    
    $out .= get_template_part('loop', 'index') ;
    $out .= jwRender::pagination($pagination);
    
    
    $wp_query = null;
    $wp_query = $original_query;
    wp_reset_postdata();
    return $out;
}

add_shortcode('blog', 'theme_shortcode_blog');

