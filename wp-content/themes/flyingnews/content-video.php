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
            
            
            
           

            $video_meta = get_post_meta($post->ID);
            
            if(isset($video_meta['_post_video_link'][0]) && (($video_meta['_post_video_link'][0]) != '')){
              $video_url = $video_meta['_post_video_link'][0];   
            }
  
            
                  if(jwOpt::get_option('image_lightbox') == '1' && isset($video_url) && $video_url != '' && preg_match('/^http(.*)/',$video_url)){
                       echo  '<a href='.$video_url.' rel="prettyPhoto" title="'. get_the_title().'">';
                  }else{
                       echo '<a href="'. get_permalink().'" title="'. get_the_title().'">';  
                  }
                  
            
                
                        echo '<span class="content_video_icon" ></span>';
                        if(jwUtils::has_post_thumbnail()){
                            //featured image
                           jwUtils::the_post_thumbnail('post-size');
                        }else if(isset($video_url)){
                            $video = jwUtils::get_video_info($video_url);
                            //obrázek videa
                            if(isset($video->thumbnails['thumbnail_medium'])){
                                echo '<img src="' . $video->thumbnails['thumbnail_medium'] . '"  width = "296" / >';
                            }
                           
                        }
                    
                    echo '</a>';
             
          echo jwRender::metaPost(); ?>

        </div>
        <div class="content-box">
            <header>
                      
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  
            </header>    

            <?php 
            echo "<p>";
            echo jwRender::get_the_excerpt(); 
            echo "</p>";    
            ?>
        </div>

    </div>
</article>

