<?php
/**
 * The default template for displaying default/standard content
 */
?>

<?php
global $post;
$class_thumbnail = '';
$cat_bg_color = '';
if(!is_tax()){
$categories = get_the_category($post->ID);
$cat_id = ($categories[0]->cat_ID );

$cat_bg_color = jwOpt::get_option('cat_bg_color', 'default', 'category', $cat_id);

if ($cat_bg_color === 'custom') {
    $cat_bg_color .= "_" . $cat_id;
}

$class_thumbnail = "no-thumbnail";

if (jwUtils::has_post_thumbnail()) {
    $class_thumbnail = "has-thumbnail";
}
}


$terms = get_the_category(); 
?>



<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'one_col', 'category_' . $cat_bg_color, $class_thumbnail)); ?>   
         sort_name="<?php echo(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo (($post->rating > 0) ? ((int) ($post->rating*50)) : '0'); ?>" 
         sort_popular="<?php echo get_comments_number();     //if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }?>"
         sort_category="<?php echo $terms[0]->slug ?>"
         sort_custom1="<?php echo (get_post_meta($post->ID,'_custom_sort1',true) ? get_post_meta($post->ID,'_custom_sort1',true) : '0' ); ?>"
         sort_custom2="<?php echo (get_post_meta($post->ID,'_custom_sort1',true) ? get_post_meta($post->ID,'_custom_sort1',true) : '0' ); ?>"
         >
    
    <div class="box">
     <?php echo jwRender::metaCategory(); ?>
        <div class="image">

          
            
            <?php

            if(jwOpt::get_option('std_post_image_clickable','0') == '1'){
              echo  '<a href="'.get_permalink().'" title="'. get_the_title().'">';
            }
                jwUtils::the_post_thumbnail('post-size');               
            if(jwOpt::get_option('std_post_image_clickable','0') == '1'){
              echo  '</a>';
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

