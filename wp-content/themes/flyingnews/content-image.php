<?php
/**
 * The default template for displaying default/standard content
 */

?>

<?php
global $post;

$categories = get_the_category($post->ID);
$cat_id = ($categories[0]->cat_ID );

$cat_bg_color = jwOpt::get_option('cat_bg_color', 'default', 'category', $cat_id);

if ($cat_bg_color === 'custom') {
    $cat_bg_color .= "_" . $cat_id;
}

$score = -1;
$terms = get_the_category(); 

?>

<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'one_col', 'category_' . $cat_bg_color)); ?>   
         sort_name="<?php echo(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo (($post->rating > 0) ? ((int) ($post->rating*50)) : '0'); ?>" 
         sort_popular="<?php echo get_comments_number(); ?>"
         sort_category="<?php echo $terms[0]->slug ?>"
         sort_custom1="<?php echo (get_post_meta($post->ID,'_custom_sort1',true) ? get_post_meta($post->ID,'_custom_sort1',true) : '0' ); ?>"
         sort_custom2="<?php echo (get_post_meta($post->ID,'_custom_sort1',true) ? get_post_meta($post->ID,'_custom_sort1',true) : '0' ); ?>"
         >
  
    <div class="box">


<?php echo jwRender::metaCategory(); ?>

        <div class="image">     
                
                <?php

                $img = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ),"large" );
                
                // Když používám featured image z postu
                 if(!isset($img[0]) && jwOpt::get_option('post_image_featured','0') == '1'){
                     $img[0] = jwUtils::get_thumbnail_link();  
                 }
                 
                if(jwOpt::get_option('image_lightbox') == '1' && isset($img[0]) ){
                    echo  '<a href='.$img[0].' rel="prettyPhoto" title="'. get_the_title().' - '.get_post(get_post_thumbnail_id())->post_excerpt.'  ">';
                  }else{
                    echo '<a href="'. get_permalink().'" title="'. get_the_title().'">';  
                  }
                    jwUtils::the_post_thumbnail('post-size');       
  
                ?>
                </a>
            <?php echo jwRender::metaPost(); ?>

        </div>
      

    </div>
</article>

