<?php
/**
 * The default template for displaying default/standard content
 */
?>

<?php
global $post;
$categories = get_the_category($post->ID);
$cat_id = ($categories[0]->cat_ID );
$imgUrl = jwUtils::get_gallery_slider(get_the_ID(),'slidebar-big');
$cat_bg_color = jwOpt::get_option('cat_bg_color', 'default', 'category', $cat_id);

if ($cat_bg_color === 'custom') {
    $cat_bg_color .= "_" . $cat_id;
}

$score = -1;
$terms = get_the_category(); 
?>
<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'one_col', 'category_' . $cat_bg_color)); ?>   
         sort_name="<?php echo(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d g:i:s"); ?>" 
         sort_rating="<?php echo (($post->rating > 0) ? ((int) ($post->rating*50)) : '0'); ?>" 
         sort_popular="<?php echo get_comments_number(); ?>"
         sort_category="<?php echo $terms[0]->slug ?>"
         sort_custom1="<?php echo (get_post_meta($post->ID,'_custom_sort1',true) ? get_post_meta($post->ID,'_custom_sort1',true) : '0' ); ?>"
         sort_custom2="<?php echo (get_post_meta($post->ID,'_custom_sort1',true) ? get_post_meta($post->ID,'_custom_sort1',true) : '0' ); ?>"
         >
  

    <div class="box">


<?php echo jwRender::metaCategory(); ?>


        <div class="image">             
            <div id="featured_gellery" class="<?php echo get_the_ID()?>" >
     
                    <?php
                    if(jwOpt::get_option('image_lightbox') == '1'){
                        foreach ((array) $imgUrl as $iu){  
                                echo  ("<a href='".$iu['url'][0]."' rel='prettyPhoto' title='". get_the_title()."'>");
                                echo  "<img src='".  $iu['url'][0] ."' />";
                                echo  "</a>";
                         }   
                     }else{
                         foreach ((array) $imgUrl as $iu){  
                                echo  ("<a href='". get_permalink()."'>");
                                echo  "<img src=".  $iu['url'][0] ."  />";
                                echo  "</a>";   
                        }
                        
                      }
                    ?>
                </div>
            
            
            <?php 
            //>>>>> Range of speed gallery slider (on the main page)<<<<<
            $min_timer = 2000; //minimal speed time
            $max_timer = 5000; //maximal speed time
            $rand = mt_rand($min_timer,$max_timer);
            ?>
            
            
            <script >
           jQuery(document).ready(function() {
                 jQuery(".<?php echo get_the_ID(); ?>").orbit({animation: 'fade',animationSpeed: 800,pauseOnHover: true,startClockOnMouseOut: true,        
                            startClockOnMouseOutAfter: 100,directionalNav: true,fluid: true,timer: true,resetTimerOnClick: false, advanceSpeed:<?php echo $rand ?>} );}); 
            </script>
           
             <?php echo jwRender::metaPost(); ?>

        </div>
        <div class="content-box">
            <header>
                       
                <h2><a href="<?php the_permalink(); ?>" class="post_name"><?php the_title(); ?></a></h2>
                <?php    ?>
            </header>    

            <?php echo jwRender::get_the_excerpt(); ?>

        </div>

    </div>
</article>

