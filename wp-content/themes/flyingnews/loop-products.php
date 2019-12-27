<?php

global $wp_query;

if(is_front_page() && jwUtils::woocommerce_activate() == true && jwOpt::get_option('woo_display_on_main','1') == '1'){
       $post_args = array(
        'post_type' => 'post',
        'posts_per_page' => 12
        );



        $post_woo = new WP_Query( $post_args );
        $post_count = sizeof($post_woo->posts);
        $i = 0;
}


if(function_exists('is_product') && !is_product()){
       

if ( have_posts() ) {
    ?> <div id="elements_iso" class="" > <?php
     
     
    $count = 1;
    while ( have_posts() ) : the_post();
    
    woocommerce_get_template_part( 'content', 'product' );
    
    if(is_front_page() && jwUtils::woocommerce_activate() == true && jwOpt::get_option('woo_display_on_main','1') == '1'){
        if ($count%4 == 0) {
                          if ($post_woo->have_posts() && $post_count > 0) {
                              $post_woo->the_post();
                              
                               $content_type = '';
                                if(get_post_format($post_woo->posts[$i]->ID) != false){
                                    $content_type = get_post_format($post_woo->posts[$i]->ID);
                                }else if(get_post_type($post_woo->posts[$i]->ID) != 'post'){
                                    $content_type = get_post_type($post_woo->posts[$i]->ID);
                                }
    
                                get_template_part('content', $content_type); 
                                $post_count--;
                                $i ++;
                          }
        }
     }
     $count++;

    endwhile;
} else {
?> <div id="elements_iso" class=""> <?php
echo __( 'No products found' ,'jawtemplates');
}


}else{
?> <div id="content" class="product-content" > <?php
woocommerce_content();
}
?>
</div>
<div class="clear"></div>
