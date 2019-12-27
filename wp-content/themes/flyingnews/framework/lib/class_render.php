<?php
/**
 * This is main themplate builder class. This class render item of theme.
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class video_info {

    public $id;
    public $domain;
    public $thumbnails = array();

}

class jwRender {

    public static function replace_readmore($text) {
        return str_replace("[...]", "", $text);
        //readmore je zakázaný
        //return str_replace("[...]", "<a href='".get_permalink()."'>[Read more]</a>", $text);
    }

    public static function get_the_excerpt() {
        // todo prepsat na lepsi s get the content a osetrenim

        global $post;
        $text = get_the_excerpt();

        $text = strip_shortcodes($text); // optional, recommended
        $text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

        $text = self::replace_readmore($text);

        return apply_filters('the_excerpt', $text);
    }
    
    public static function get_the_content(){
         global $post;
        $text = get_the_content();

        $text = strip_shortcodes($text); // optional, recommended
        $text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

        $text = self::replace_readmore($text);

        return apply_filters('the_content', $text);
        
    }
    
    public static function get_slidebar_excerpt($text, $charlength = 100) {
            if (strlen($text) > $charlength) {
                $str = mb_substr($text, 0, $charlength - 5, 'UTF-8');
                $exwords = explode(" ", $str);
                $excut = -(strlen($exwords[count($exwords) - 1]));
                if ($excut < 0) {
                    $text = mb_substr($str, 0, $excut, 'UTF-8');
                } else {
                    $text = $str;
                }
                $text .= "...";
            }

        return $text;
    }

    public static function metaPost() {
        global $post;

        $ratingManager = ratingManager::getInstance();

        ob_start();



        $class_toggle = "";
        if (jwOpt::get_option('blog_metacaption', "toggle") == "toggle") {
            $class_toggle = "caption_toggle";
        } else if (jwOpt::get_option('blog_metacaption', "toggle") == "fadeEffect") {
            $class_toggle = "caption_fadeeffect";
        }


        if (jwOpt::get_option('blog_ratings', '1') == '1' ||
                jwOpt::get_option('blog_metadate', '1') == '1' ||
                jwOpt::get_option('blog_metacomments', '1') == '1' ||
                jwOpt::get_option('blog_metaauthor', '0') == '1') {
            ?>

            <div class="caption <?php echo $class_toggle; ?>">
                <div class="caption-content">
                    <?php if (jwOpt::get_option('blog_metadate', '1') == '1'  && get_post_type() != 'product') { ?>
                        <span class="date">
                            <?php echo get_the_time(jwOpt::get_option('blog_dateformat')); ?>
                        </span>
                    <?php
                    }

                    if (jwOpt::get_option('blog_metacomments', '1') == '1') {
                        ?>
                        <a href="<?php echo get_permalink(); ?>#comments"><span class="rt-comment">
                                <?php
                                echo get_comments_number() . ' ';
                                // if(jwOpt::get_option('fbcomments_switch','0')=='0'){echo get_comments_number(); }else{echo jwFacebook::get_fb_comments_count(get_the_ID()); }  ;
                                // echo ' ';
                                switch (get_comments_number()) {
                                    case 0: _e('Comments', 'jawtemplates');
                                        break;
                                    case 1: _e('Comment', 'jawtemplates');
                                        break;
                                    default: _e('Comments', 'jawtemplates');
                                        break;
                                }
                                ?>
                            </span> </a>
                    <?php
                    }
                    if (jwOpt::get_option('blog_metaauthor', '0') == '1') {
                        ?>
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><span><?php echo get_the_author(); ?></span></a>
                    <?php } ?>

                    <?php if (jwOpt::get_option('blog_ratings', '1') == '1') { ?> 
                  
                        <?php if(get_post_type() == 'product'){ ?>
                             <?php $product = get_product(get_the_ID()); ?>
                        
                             <?php if ($product->get_average_rating() != 0){ ?>
                                <div class="jw-rating-row-overall-content">     
                             
                                    <div class="jw-rating-area-stars">
                                             <div class="ratig-background-stars">    
                                             <div class="rating-top-stars" style="width:<?php echo  $product->get_average_rating()*20; ?>px"></div>
                                            </div>
                                     </div>
                                  </div>
                            <?php }?>
                        <?php }else{ ?>
                        
                        
                        
                        <?php if ($post->rating >= 0) { ?>
                            <!-- TOTAL RATING -->
                                <?php if ($ratingManager->getRatignsShowOverall(get_the_ID())) { ?>
                                    <?php if ($post->rating >= 0 && $ratingManager->getRatignsShowOverall(get_the_ID())) { ?>
                                    <div class="jw-rating-row-overall-content">                    
                                        <?php
                                        $total = round($post->rating * 100);
                                        ?>
                            <?php if ($ratingManager->getOverllRatignType(get_the_ID()) == "stars") { ?>
                                            <div class="jw-rating-area-stars">
                                                <div class="ratig-background-stars">    
                                                         <div class="rating-top-stars" style="width:<?php echo $total; ?>px"></div>
                                                </div>
                                            </div>
                            <?php } else if ($ratingManager->getOverllRatignType(get_the_ID()) == "percent") { ?>
                                            <div class="jw-rating-area-percent">
                                                <div class="ratig-background-percent">
                                                        <div class="rating-top-percent" style="width:<?php echo $total; ?>px"></div>
                                                        <div class="rating-top-percent-value"><span><?php _e('Rating:', 'jawtemplates'); ?> <?php echo $total; ?> %</span></div>
                                                </div>
                                            </div>
                                    <?php } ?>
                                        <div class="clear"></div>
                                    </div>
                                <?php } ?>
                                <div class="clear"></div>
                            <?php } ?>
                            <!-- END TOTAL RATING -->
                <?php } ?>    
               <?php } ?>              
            <?php } ?>    
                </div>
            </div>
            <?php
        }


        return ob_get_clean();
    }

//        if (strlen(get_the_excerpt()) > jwOpt::get_option('blog_excerpt', 200)){
//            return '<p>'.mb_substr(get_the_excerpt(), 0, jwOpt::get_option('blog_excerpt', 200), 'UTF-8').'</p>' ;  
//        } else {
//            return '<p>'.get_the_excerpt().'</p>';
//        }        
//    }
//    
    public static function the_metadata() {
        if (jwOpt::get_option('blog_metadate', '0') == '1' || jwOpt::get_option('blog_metacomments', '0') == '1') {
            ob_start();
            ?>
            <div class="caption">

                <span class="date"><?php the_time(jwOpt::get_option('blog_dateformat', null)); ?></span>
                <a href="<?php the_permalink(); ?>#comments">
                    <span class="rt-comment"><?php echo get_comments_number() ?> <?php comments_number('Coments', 'Comment', 'Comments') ?></span>
                </a>  

            </div>

            <?php
            return ob_get_flush();
        }
        else
            return '';
    }

    public static function sidebar($post_id = null) {

        //  if (is_page() || is_post()){
        //    $layout = get_post_meta($post_id,'_layout', true);
        //} else {
        $layout = jwOpt::get_option('blog_layout', 'right');

        $right = jwOpt::get_option('blog_sidebar_right');
        $left = jwOpt::get_option('blog_sidebar_left');
        //  }

        if ($layout !== 'fullwidth') {
            if ($layout == 'right' && $right)
                dynamic_sidebar($right);
            else if ($layout == 'left' && $left)
                dynamic_sidebar($left);
        }
    }

    public static function metaCategory() {

        $out = '';
        if (jwOpt::get_option('blog_metacategory', '1') == '1') {
            $out .='<span class="categories">';
            if(get_post_type() == 'product'){
                $terms = get_the_terms(get_the_ID() , 'product_cat' );
                if(!empty($terms)){
                    $terms = array_shift(array_values($terms));
                    $out .='<a href="' . get_term_link($terms,'product_cat') . '">' . $terms->name . '</a>';
                    
                    $out .='<span class="meta-kosik">';
                    //$out .= '<img src="'.THEME_URI.'/images/icons/cart-white.png" />';
                    $out .='</span>';
                }
            }else{
                 $terms = get_the_category();
                 if(isset($terms[0])){
                    $out .='<a href="' . get_category_link($terms[0]->term_id) . '">' . $terms[0]->name . '</a>'; 
                 }
            }
            $out .='</span>';
            
            
            return $out;
        } else {
            return null;
        }
    }

    public static function post($post) {
        switch (get_post_type($post)) {
            case 'image':
                break;
            case 'link':
                break;
            case 'video':
                break;
            case 'audio':
                break;
            default:




                break;
        }
    }

    // Pagination
    public static function pagination($styl = 'number') {   
        $out = '';
        global $wp_query;
        $infinity_script = '      
                    var infinite_scroll = {  
                        nextSelector: "#post-nav-infinite .post-previous-infinite a",
                        navSelector: "#post-nav-infinite",
                        itemSelector: "article.element",
                        contentSelector: "#elements_iso",
                        debug        : false,
                       appendCallback	: true,  
                        loading : {
				msgText         : " ",
				finishedMsg     : "<h6>' . __('No additional posts.', 'jawtemplates') . '</h6>",
				img             : " ' . THEME_URI . '/images/ajax-loader.gif",
                                speed           : 1000,
                                selector        : "#infinite_load"
                        }, 
                        animate      : true 

                    };

                   ';
        
        $out .= '<div id="infinite_load" class="row ' . $styl . '"> ';
        
        
        
        // ========= NUMBER PAGINATION ===========================================
        if ($styl == 'number') {

            $big = 999999999; // This needs to be an unlikely integer
            // For more options and info view the docs for paginate_links()
            // http://codex.wordpress.org/Function_Reference/paginate_links
            $paginate_links = paginate_links(array(
                'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                'current' => max(1, get_query_var('paged')),
                'total' => $wp_query->max_num_pages,
                'mid_size' => 5,
                'prev_next' => True,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
                'type' => 'list'
                    ));
            // Display the pagination if more than one page is found
            if ($paginate_links) {
                $out .= '<div class="template-pagination">';
                $out .= $paginate_links;
                $out .= '</div><!--// end .pagination -->';
            }
            $out .= '</div>'; //konec infinite_load
            
            
            
            // ========= WORDPRESS PAGINATION ===========================================
        } else if ($styl == 'wordpress') {
            $out .= '<div id="post-nav" class="wordpress">';
            $out .= '<div class="post-previous">' . get_next_posts_link(__("PREVIOUS", "jawtemplates")) . '</div>';
            $out .= '<div class="post-next">' . get_previous_posts_link(__("NEXT", "jawtemplates")) . '</div>';
            $out .= '<div class="clear"></div>';
            $out .= '</div>';
            $out .= '</div>';
            
            
            
            
            // ========= INFINITY LIST ===========================================
        } else if ($styl == 'infinite') {
            $out .= '<div id="post-nav-infinite">';
            $out .= '<div class="post-previous-infinite" >';
            $out .= get_next_posts_link(__("PREVIOUS", "jawtemplates"));
            $out .= '</div>';
            $out .= '<div class="post-next-infinite">';
            $out .= get_previous_posts_link(__("NEXT", "jawtemplates"));
            $out .= '</div>';
            $out .= '</div>';
            $out .= '</div>'; //konec infinite_load

            $out .= '<script>  
              
                    ' . $infinity_script . '
                         var type = "infinite";
          
                    </script>';


            // ========= AJAX LIST ===========================================
        } else if ($styl == 'ajax') {
            $out .= '<div id="post-nav-infinite">';
            $out .= '<div class="post-previous-infinite" >';
            $out .= get_next_posts_link(__(" Older posts", "jawtemplates"));
            $out .= '</div>';
            $out .= '<div class="post-next-infinite">';
            $out .= get_previous_posts_link(__("Newer posts", "jawtemplates"));
            $out .= '</div>';
            $out .= '</div>';
            $out .= '</div>'; //konec infinite_load

            $out .= '<script>      
                
                   ' . $infinity_script . '
              
                    var type = "ajax";
                   
                    </script>';



            // ========= INFINITY MORE LIST ===========================================
        } else if ($styl == 'infinitemore') {
            $out .= '<div id="post-nav-infinite">';
            $out .= '<div class="post-previous-infinite" >';
            $out .= get_next_posts_link(__("Older posts", "jawtemplates"));
            $out .= '</div>';
            $out .= '<div class="post-next-infinite">';
            $out .= get_previous_posts_link(__("Newer posts", "jawtemplates"));
            $out .= '</div>';
            $out .= '</div>';
            $out .= '</div>'; //konec infinite_load
            $out .= '<script>   
             
                    ' . $infinity_script . '
                    var type = "infinitemore";
                    var more = "' . "<div class='morebutton'><h6>" . __('More', 'jawtemplates') . "</h6></div>" . '";
                   
                    </script>';
            $out .= '<div class="infinite_load_arrow"></div>';
        }else if ($styl == 'none') {
           $out .= '</div>'; //konec infinite_load
        }
        return $out;
    }
    
    
    
    
    

    public static function get_video_player($url, $width) {
        $out = '';
        $video = jwUtils::get_video_info($url);
        $height = (int) ($width / 1.78); //über konstanta

	if ($video->domain == 'youtube') {
	    $out .= '<iframe  itemscope itemtype="http://schema.org/VideoObject" width="100%" height="' . $height . '" src="http://www.youtube.com/embed/' . $video->id . '" frameborder="0" allowfullscreen>
                    <meta itemprop="thumbnailUrl" content="'.$video->thumbnails['thumbnail_medium'].'" />
                    <meta itemprop="embedURL" content="http://www.youtube.com/embed/' . $video->id . '" />                
                    </iframe>';
	} else  if ($video->domain == 'vimeo'){
	    $out .= '<iframe itemscope itemtype="http://schema.org/VideoObject" src="http://player.vimeo.com/video/' . $video->id . '" width="100%" height="' . $height . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen>
                    <meta itemprop="thumbnailUrl" content="'.$video->thumbnails['thumbnail_medium'].'" />
                    <meta itemprop="embedURL" content="http://player.vimeo.com/video/' . $video->id . '" />                
                    </iframe>';
	}
	return $out;
    }

    public static function get_bar($switch, $breadcrumbs = '0', $sort = '0', $search = '0', $class = '') {
        if ($switch == '1') {
            if ($breadcrumbs == '1') {
                $class .= ' breadcrumbs';
            }            
           echo '<div class="portfolio_categories '.$class.'">';
            if ($breadcrumbs == '1'){
                echo  '<div class="blog-items-sortby "  > ';
                new jwBreadcrumb();
                echo '</div>';
            }
            if ($sort == '1') {
                echo '<div class="blog-items-sortby">';

                echo '<ul class="blog-items-sortby-list">';
                echo '<li class="blog-items-sortby-title"><a >' . __("Sort:", "jawtemplates") . '</a> </li>';
                if(jwUtils::woocommerce_activate() == true && (is_shop() || is_search() || (function_exists('is_product_category') && is_product_category()))){
                    echo '<li><a href="#price" >' . __('Price', 'jawtemplates') . '</a></li>';
                    echo '<li><a href="#sales" >' . __('Best sellers', 'jawtemplates') . '</a></li>';
                }
                echo '<li><a href="#date" >' . __("Date", "jawtemplates") . '</a></li>';
                echo '<li><a href="#name" >' . __("Name", "jawtemplates") . '</a></li>';
                echo '<li><a href="#rating" >' . __('Rating', 'jawtemplates') . '</a></li>';
                echo '<li><a href="#popular" >' . __('Popular', 'jawtemplates') . '</a></li>';
                echo '<li><a href="#category" >' . __('Category', 'jawtemplates') . '</a></li>';
                if(jwOpt::get_option('custom_sort1','0') == '1'){
                   echo '<li><a href="#custom1" >' . jwOpt::get_option('custom_sort1_name','') . '</a></li>'; 
                }
                if(jwOpt::get_option('custom_sort2','0') == '1'){
                   echo '<li><a href="#custom2" >' . jwOpt::get_option('custom_sort2_name','') . '</a></li>'; 
                }
                echo '</ul>';
                echo '</div>';
                                
            }

            if ($search) {
                echo '<div class="blog-items-search">';
                echo '<div id="search_button"></div>';
                echo the_widget('WP_Widget_Search');
                echo '</div>';
                echo '<div class="clear"></div>';
            }
            echo '</div>';
        }
    }

    public static function get_related_post($id) {

        global $post;
        $orig_post = $post;
        $tagargs = $catargs= '';
        $catnames ='';
       $tagnames = '';
            $number = jwOpt::get_option('post_relatedpost_num', '4');
            if (!is_numeric($number))$number = '4';
            $tags = get_the_tags($id);

            if ($tags) {
                foreach ($tags as $tag) {
                    $tagnames .= $tag->name . ',';
                }
                $tagargs = array(
                    'ignore_sticky_posts' => 1,
                    'tag' => $tagnames,
                    'post__not_in' => array($id),
                    'showposts' => $number,
                    'orderby' => 'date'
                );
            }

            
            $post_cats = wp_get_post_categories($id);
            
            $catnames = implode(',', $post_cats);

            $catargs = array(
                'ignore_sticky_posts' => 1,
                'cat' => $catnames,
                'post__not_in' => array($id),
                'showposts' => $number,
                'orderby' => 'date'
            );
        
        
        return array($tagargs,$catargs);
    }
    
    
    public static function get_author_social_icons($auth){
        
        $all_meta_for_user = get_user_meta($auth);
            if (isset($all_meta_for_user['twitter'][0]) && !empty($all_meta_for_user['twitter'][0])) {
                $twitter = $all_meta_for_user['twitter'][0];
            } else {
                $twitter = "";
            }

            if (isset($all_meta_for_user['facebook'][0]) && !empty($all_meta_for_user['facebook'][0])) {
                $facebook = $all_meta_for_user['facebook'][0];
            } else {
                $facebook = "";
            }

            if (isset($all_meta_for_user['linkedin'][0]) && !empty($all_meta_for_user['linkedin'][0])) {
                $linkedin = $all_meta_for_user['linkedin'][0];
            } else {
                $linkedin = "";
            }

            if (isset($all_meta_for_user['youtube'][0]) && !empty($all_meta_for_user['youtube'][0])) {
                $youtube = $all_meta_for_user['youtube'][0];
            } else {
                $youtube = "";
            }

            if (isset($all_meta_for_user['google'][0]) && !empty($all_meta_for_user['google'][0])) {
                $google = $all_meta_for_user['google'][0];
            } else {
                $google = "";
            }

            if (isset($all_meta_for_user['vimeo'][0]) && !empty($all_meta_for_user['vimeo'][0])) {
                $vimeo = $all_meta_for_user['vimeo'][0];
            } else {
                $vimeo = "";
            }

            if (isset($all_meta_for_user['flickr'][0]) && !empty($all_meta_for_user['flickr'][0])) {
                $flickr = $all_meta_for_user['flickr'][0];
            } else {
                $flickr = "";
            }
            ?>

            <ul id="author-social-icons">

                <?php if ($twitter != '') { ?>
                    <li class="author-twitter"><a href="<?php echo $twitter; ?>"></a></li>
                <?php } ?>

                <?php if ($facebook != '') { ?>
                    <li class="author-facebook"><a href="<?php echo $facebook; ?>"></a></li>
                <?php } ?>

                <?php if ($google != '') { ?>
                    <li class="author-google"><a href="<?php echo $google; ?>"></a></li>
                <?php } ?>

                <?php if ($linkedin != '') { ?>
                    <li class="author-linkedin"><a href="<?php echo $linkedin; ?>"></a></li>
                <?php } ?>

                <?php if ($youtube != '') { ?>
                    <li class="author-youtube"><a href="<?php echo $youtube; ?>"></a></li>
                <?php } ?>

                <?php if ($vimeo != '') { ?>
                    <li class="author-vimeo"><a href="<?php echo $vimeo; ?>"></a></li>
                <?php } ?>

                <?php if ($flickr != '') { ?>
                    <li class="author-flickr"><a href="<?php echo $flickr; ?>"></a></li>
                <?php } ?>

            </ul> <?php
        
    }
    
    
    function woocommerce_header_add_to_cart_fragment( $fragments ) {
            global $woocommerce;
            ob_start();
            ?>
             <div class="top_cart">
                <div class="top_cart_icon">
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                       <img src="<?php echo THEME_URI.'/images/icons/cart.png' ?>" />
                   </a>
               </div>
               <div class="top_cart_items">
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                       <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> 
                   </a>
               </div>
               <div class="top_cart_price">
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                       <?php echo $woocommerce->cart->get_cart_total(); ?> 
                   </a>
               </div>

                <div class="top_cart_button">
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                       <?php _e('View cart', 'jawtemplates'); ?> 
                   </a>
               </div>
           </div>
            <?php
            $fragments['.top_cart'] = ob_get_clean();
            return $fragments;
       }
            
       
       function dynamic_meta_description() {
	$rawcontent = 	get_the_content();
	if(empty($rawcontent)) {
		$rawcontent = htmlentities(bloginfo('description'));
	} else {
		$rawcontent = apply_filters('the_content_rss', strip_tags($rawcontent));
		$rawcontent = preg_replace('/\[.+\]/','', $rawcontent);
		$chars = array("", "\n", "\r", "chr(13)",  "\t", "\0", "\x0B");
		$rawcontent = htmlentities(str_replace($chars, " ", $rawcontent));
	}
	if (strlen($rawcontent) < 155) {
		echo $rawcontent;
	} else {
		$desc = substr($rawcontent,0,155);
		return $desc;
	}
}

}
?>
