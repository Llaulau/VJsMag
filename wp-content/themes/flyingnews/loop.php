
<?php
global $wp_query;
jwUtils::ads_position();

if (!have_posts()) :
    ?>
    <div class="notice">
        <p class="bottom"><?php _e('We are sorry, no results were found. You can try to find some related posts using the search function.','jawtemplates'); ?></p>
    </div>
    <?php get_search_form();
    ?>	
<?php endif; ?>

<?php
if(!isset($wp_query->query_vars['blog'])){
    if(jwOpt::get_option('cat_custom_slider', '0', 'category', get_cat_id( single_cat_title("",false))) == '1'){
        echo '<div class="clear"></div>';
        $catSlider = new jwSlider('category');
        $catSlider->getSlides();
    }
}else{
     $post_meta = get_post_meta(get_the_id(), '');
     if(isset($post_meta['_page_blog_slider'][0] )){
        if ($post_meta['_page_blog_slider'][0] == '1') {
            echo '<div class="clear"></div>';
            $blogSlider = new jwSlider('blog');
            $blogSlider->getSlides();
        }
     }
}

if(jwUtils::woocommerce_activate() == true && jwOpt::get_option('woo_display_on_main','1') == '1'){

    $shop_args = array(
    'post_type' => 'product',
    );
    $post_in = jwOpt::get_option('woo_choose_product');
    if(isset($post_in)){
        $shop_args['post__in'] = $post_in;
    }



    $shop_post = new WP_Query( $shop_args );
    $shop_count = sizeof($shop_post->posts);
}



?>

<div id="elements_iso" class="">
    
        <?php /* Start loop */   
        ?>
        <?php $count = 1;
        
 
        ?>
        <?php while (have_posts()){  
             
           the_post();
      
        ?>
    
            <?php 
            $content_type = '';
            if(get_post_format() != false){
                $content_type = get_post_format();
            }else if(get_post_type() != 'post'){
                $content_type = get_post_type();
            }
       
            get_template_part('content', $content_type); 
            
            
            ?>
            
            <?php
            if((( jwOpt::get_option('blog_pagination') != 'infinite') || !(is_paged() && ( jwOpt::get_option('blog_pagination') == 'infinite'))) && (( jwOpt::get_option('blog_pagination') != 'ajax') || !(is_paged() && ( jwOpt::get_option('blog_pagination') == 'ajax'))) && (( jwOpt::get_option('blog_pagination') != 'infinitemore') || !(is_paged() && ( jwOpt::get_option('blog_pagination') == 'infinitemore')))){
                
                //AD
                if ($count == 1) {
                    if (jwOpt::get_option('banner_post_1_show', '0')=='1') {
                        get_template_part('content', 'ads1');
                    }
                }

                if ($count == 3) {
                    if (jwOpt::get_option('banner_post_2_show', '0')=='1') {
                        get_template_part('content', 'ads2');
                    }
                }
                if ($count == 5) {
                    if (jwOpt::get_option('banner_post_3_show', '0')=='1') {
                        get_template_part('content', 'ads3');
                    }
                }
                
                //WOO
                if(jwUtils::woocommerce_activate() == true && jwOpt::get_option('woo_display_on_main','1') == '1'){
                    if ($count%(jwOpt::get_option('woo_fequency_display_on_main','4')-1) == 0 && $shop_count > 0) {
                       if ( $shop_post->have_posts() ) {
                            $shop_post->the_post();
                           woocommerce_get_template_part( 'content', 'product' );
                           $shop_count--;
                       }
                   }
                }
 
            }
            
                
                
                
            $count++;

        }  ?>
  
</div>
<div class="clear"></div>





