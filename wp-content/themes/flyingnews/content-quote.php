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

<article id="post-<?php get_the_ID(); ?>"  <?php post_class(array('element', 'one_col', 'category_' . $cat_bg_color)); ?>   
         sort_name="<?php echo(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo (($post->rating > 0) ? ((int) ($post->rating*50)) : '0'); ?>" 
         sort_popular="<?php echo get_comments_number(); ?>"
         sort_category="<?php echo $terms[0]->slug ?>"
         sort_custom1="<?php echo (get_post_meta($post->ID,'_custom_sort1',true) ? get_post_meta($post->ID,'_custom_sort1',true) : '0' ); ?>"
         sort_custom2="<?php echo (get_post_meta($post->ID,'_custom_sort1',true) ? get_post_meta($post->ID,'_custom_sort1',true) : '0' ); ?>"
         >
  
    <div class="box">

        <div class="content-box">
 
            <div class="blockquote">
                
                <?php 
    
                    $mystring = " ".get_the_excerpt();
                    $findme   = '<blockquote>';
                    if(strpos($mystring, $findme)>0){
                        echo "<a href='".get_permalink()."'>";
                        echo jwRender::get_the_content();
                        echo "</a>";
                    }else{
                        echo "<blockquote>";  
                        echo "<a href='". get_permalink()."'>";
                        echo jwRender::get_the_content();
                        echo "</a>";
                        echo "</blockquote>";                 
                    }
                    
                   
                ?>
            </div>
        </div>
      

    </div>
</article>

