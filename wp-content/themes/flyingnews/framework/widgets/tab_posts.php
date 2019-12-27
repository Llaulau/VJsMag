<?php

/**
 * Prints 4 types of feed:
 * Popular ( posts )
 * Recent ( posts )
 * Comments ( comment )
 * Tags ( in post table )
 * 
 * 
 * informace jsou ve funkci widget, doporucuju kazdou promenou vardumpnout
 */
class tab_posts_widget extends jw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        /*         * *************************************************************************** */
        /* POPULAR AREA
          /***************************************************************************** */
        0 => array('id' => 'time_format',
            'description' => 'Time format <a href="http://codex.wordpress.org/Formatting_Date_and_Time">help</a>',
            'type' => 'text', 
            'default' => 'F j, Y'),
        1 => array('id' => 'popular_show',
            'description' => 'Show popular posts ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        2 => array('id' => 'popular_title',
            'description' => 'Popular posts title:',
            'type' => 'text', // [[ text, check, select ]]

            'default' => 'Popular'),
        3 => array('id' => 'popular_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        4 => array('id' => 'popular_num_of_posts',
            'description' => 'Number of popular posts to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
        5 => array('id' => 'popular_title_length',
            'description' => 'Max length of title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '50'),
        /*         * *************************************************************************** */
        /* RECENT AREA
          /***************************************************************************** */

        6 => array('id' => 'recent_show',
            'description' => 'Show recent posts ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        7 => array('id' => 'recent_title',
            'description' => 'Recent posts title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Recent'),
        8 => array('id' => 'recent_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        9 => array('id' => 'recent_num_of_posts',
            'description' => 'Number of recent posts to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),

        /*         * *************************************************************************** */
        /* COMMENTS AREA 
          /***************************************************************************** */
        11 => array('id' => 'comments_show',
            'description' => 'Show recent comments ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        12 => array('id' => 'comments_title',
            'description' => 'recent comments title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Comments'),
        13 => array('id' => 'comments_num_of_posts',
            'description' => 'Number of recent comments to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
        /*         * *************************************************************************** */
        /* TAGS AREA
          /***************************************************************************** */
        15 => array('id' => 'tags_show',
            'description' => 'Show tags ',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        16 => array('id' => 'tags_title',
            'description' => 'tags title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Tags'),
        17 => array('id' => 'tags_num_of_posts',
            'description' => 'Number of tags to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '5'),
        18 => array('id' => 'tags_sort_by',
            'description' => 'Sort Tags by:',
            'type' => 'select', // [[ text, check, select ]]
            'default' => 'name',
            'values' => array(
                array('name' => 'name', 'value' => 'name'),
                array('name' => 'count', 'value' => 'count')
            )),
        
        /*         * *************************************************************************** */
        /* RATINGS AREA
          /***************************************************************************** */
        19 => array('id' => 'ratings_show',
            'description' => 'Show rating`s posts',
            'type' => 'checkbox', // [[ text, check, select ]]
            'default' => 1),
        20 => array('id' => 'ratings_title',
            'description' => 'Ratings title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Ratings'),
        21 => array('id' => 'ratings_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        22 => array('id' => 'rats_num_of_posts',
            'description' => 'Number of rating`s posts to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '3'),
        23 => array('id' => 'rats_title_length',
            'description' => 'Max length of title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '50'),
    );

    /**
     * Registering the widget to the wordpress
     */
    function tab_posts_widget() {
        $options = array('classname' => 'tab_posts_widget', 'description' => "Theme styled recent and popular posts, comments and tags to be displayed in a preview tabs");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('tab_posts', 'Tab Posts - J&W Widget', $options, $controls);
    }

    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */
    /* EDIT THIS FUNCTION
      /***************************************************************************** */
    /*     * *************************************************************************** */
    /*     * *************************************************************************** */

    private function _print_widget($args, $instnace, $feedData) {
        global $post;
        if(!isset($instnace["time_format"])){
            $instnace["time_format"] = 'F j, Y';
        }
        /*
         * data naleznes ve stdClass feedData.
         * Ma nasledujici attributy:
         * - popular_posts			// klasicky post
         * - recent_posts			// klasicky post
         * - recent_comments		// class comment
         * - tags					// class tag
         * 
         * !! V pripade ze tisknes post, je moznost ze se neaplikuji vsechny 
         * filtry ( napr na post content nebo excerpt). Pokud by to blblo, tak :
         * 
         * foreach( $feedData->popular_posts as $post ) {
         * 	setup_postdata( $post );
         * 	the_title(), the_content() || get_the_title(), get_the_content;
         * }
         * 
         * jinak presny struktury jednotlivych trid neznam, resil bych to stejne
         * jak ty var_dump, tak v tom neporadim :(
         * 
         * pokud nejsou zadna data, tak je promenna nastavena na null
         */
        ?>
        <div id="tab-post-widget">
            <dl class="tabs">
                <?php
                $active = 1;
                ?>
                <?php if (!is_null($feedData->popular_posts)) { ?>
                    <?php if ($active) { ?>
                        <dd class="active"><a href="#tab1"><?php echo $instnace["popular_title"]; ?></a></dd>
                        <?php $active = 0; ?>
                    <?php } else { ?>
                        <dd><a href="#tab1"><?php echo $instnace["popular_title"]; ?></a></dd>
                    <?php } ?>
                    <?php
                }
                if (!is_null($feedData->recent_posts)) {
                    ?>
                    <?php if ($active) { ?>
                        <dd class="active"><a href="#tab2"><?php echo $instnace["recent_title"]; ?></a></dd>
                        <?php $active = 0; ?>
                    <?php } else { ?>
                        <dd><a href="#tab2"><?php echo $instnace["recent_title"]; ?></a></dd>
                    <?php } ?>                    
                    <?php
                }
                if (!is_null($feedData->recent_comments)) {
                    ?>
                    <?php if ($active) { ?>
                        <dd class="active"><a href="#tab3"><?php echo $instnace["comments_title"]; ?></a></dd>
                        <?php $active = 0; ?>
                    <?php } else { ?>
                        <dd><a href="#tab3"><?php echo $instnace["comments_title"]; ?></a></dd>
                    <?php } ?>   
                    <?php
                }
                if (!is_null($feedData->tags)) {
                    ?>
                    <?php if ($active) { ?>
                        <dd class="active"><a href="#tab4"><?php echo $instnace["tags_title"]; ?></a></dd>
                        <?php $active = 0; ?>
                    <?php } else { ?>
                        <dd><a href="#tab4"><?php echo $instnace["tags_title"]; ?></a></dd>
                    <?php } ?>     
                <?php } 

                if (!is_null($feedData->ratings)) {
                    ?>
                    <?php if ($active) { ?>
                        <dd class="active"><a href="#tab5"><?php echo $instnace["ratings_title"]; ?></a></dd>
                        <?php $active = 0; ?>
                    <?php } else { ?>
                        <dd><a href="#tab5"><?php echo $instnace["ratings_title"]; ?></a></dd>
                    <?php } ?>     
                <?php } ?>
            </dl>
            <ul class="tabs-content">
                <?php
                $active = 1;
                ?>
                <?php if (!is_null($feedData->popular_posts)) { ?>
                    <?php if ($active) { ?>
                        <li class="active" id="tab1Tab">
                            <?php $active = 0; ?>
                        <?php } else { ?>
                        <li id="tab1Tab">    
                        <?php } ?>
                        <?php
                        foreach ($feedData->popular_posts as $post) {
                           if(get_post_meta($post->ID,'fw_rating_overal',true) == '1'){ 
                                $ratingManager = ratingManager::getInstance();
                                $ratings = $ratingManager->getRatings($post->ID);
                                $totalrat = $ratingManager->getRatingsScore($ratings);
                                $total = round($totalrat * 100);
                           }
                           if(!isset($instnace["popular_title_length"])){
                               $instnace["popular_title_length"] = 999;
                           }
                            setup_postdata($post);
                            ?>
                            <div class="tab-post-row">
                                <?php
                                if (has_post_thumbnail()) {
                                    ?>
                                    <div class="tab-post-widget-img">
                                        <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(array(50, 50)); ?></a>
                                    </div>
                                    <div class="tab-post-widget-content has_image">
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo jwUtils::crop_length(get_the_title(),$instnace["popular_title_length"]); ?></a></h3>
                                        
                                        <?php if(get_post_meta($post->ID,'fw_rating_overal',true) == '1'){ ?>
                                            <div class="jw-rating-row-overall-content"> 
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
                                                        <div class="rating-top-percent-value"><span> <?php echo $total; ?> %</span></div>
                                                    </div>
                                                </div>
                                        <?php } ?>
                                             </div>
                                      <?php }else{ ?>   
                                        
                                            <span><?php echo the_time($instnace["time_format"]); ?></span>
                                        <?php } ?>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="tab-post-widget-content">
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo  jwUtils::crop_length(get_the_title(),$instnace["popular_title_length"]); ?></a></h3>
                                        
                                        
                                        <?php if(get_post_meta($post->ID,'fw_rating_overal',true) == '1'){ ?>
                                            <div class="jw-rating-row-overall-content"> 
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
                                                        <div class="rating-top-percent-value"><span> <?php echo $total; ?> %</span></div>
                                                    </div>
                                                </div>
                                        <?php } ?>
                                             </div>
                                      <?php }else{ ?>   
                                        
                                            <span><?php echo the_time($instnace["time_format"]); ?></span>
                                        <?php } ?>  

                                    </div>    
                                <?php } ?>
                                <div class="clear"></div>
                            </div>
                            <?php
                        }
                        ?>
                    </li>
                <?php } ?>

                <?php if (!is_null($feedData->recent_posts)) { ?>
                    <?php if ($active) { ?>
                        <li class="active" id="tab2Tab">
                            <?php $active = 0; ?>
                        <?php } else { ?>
                        <li id="tab2Tab">    
                        <?php } ?>
                        <?php
                        if(!isset($instnace["recent_title_length"])){
                               $instnace["recent_title_length"] = 999;
                           }
                        foreach ($feedData->recent_posts as $post) {
                            setup_postdata($post);
                            ?>
                            <div class="tab-post-row">
                                <?php
                                if (has_post_thumbnail()) {
                                    ?>
                                    <div class="tab-post-widget-img">
                                        <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(array(50, 50)); ?></a>
                                    </div>
                                    <div class="tab-post-widget-content has_image">
                                        <h3>
                                            <a href="<?php the_permalink(); ?>">
                                            <?php 
                                            

                                                if (strlen(get_the_title()) > 50) { ?>
                                                    <?php echo mb_substr(get_the_title(), 0, 50, 'UTF-8') . ' ...'; ?>
                                                <?php } else { ?>
                                                    <?php echo get_the_title(); ?>
                                                <?php }   

                                            ?>
                                            </a>
                                        </h3>
                                        <span><?php echo the_time($instnace["time_format"]); ?></span>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="tab-post-widget-content">
                                        <h3>
                                            <a href="<?php the_permalink(); ?>">

                                                <?php 
                                                    if (strlen($post->post_title) > 50) { ?>
                                                        <?php echo mb_substr($post->post_title, 0, 50, 'UTF-8') . ' ...'; ?>
                                                    <?php } else { ?>
                                                        <?php echo $post->post_title; ?>
                                                    <?php } 
                                                ?>

                                            </a>
                                        </h3>
                                        <span><?php echo the_time($instnace["time_format"]); ?></span>
                                    </div>    
                                <?php } ?>
                                <div class="clear"></div>
                            </div>
                            <?php
                        }
                        ?>
                    </li>
                <?php } ?>

                <?php if (!is_null($feedData->recent_comments)) { ?>
                    <?php if ($active) { ?>
                        <li class="active" id="tab3Tab">
                            <?php $active = 0; ?>
                        <?php } else { ?>
                        <li id="tab3Tab">    
                        <?php } ?>
                            
                        <?php foreach ($feedData->recent_comments as $comment) { ?>
                            <div class="tab-post-row">
                                <div class="tab-post-widget-img">
                                    <a href="<?php echo get_comment_link($comment, $args) ?>"><?php echo get_avatar($comment->comment_author_email, 50); ?></a>
                                </div>
                                <div class="tab-post-widget-content">
                                    <h3>
                                        <a href="<?php echo get_comment_link($comment, $args) ?>">
                                            <?php 

                                                if (strlen($comment->comment_content) > 50) { ?>
                                                    <?php echo mb_substr($comment->comment_content, 0, 50, 'UTF-8') . ' ...'; ?>
                                                <?php } else { ?>
                                                    <?php echo $comment->comment_content; ?>
                                                <?php } 
 
                                            ?>
                                        </a>
                                    </h3>
                                    <span><?php comment_date(jwOpt::get_option('blog_dateformat', null), $comment->comment_ID); ?> </span>
                                </div>
                                <div class="clear"></div>
                            </div>
                        <?php } ?>
                    </li>
                <?php } ?>

                <?php if (!is_null($feedData->tags)) { ?>
                    <?php if ($active) { ?>
                        <li class="active" id="tab4Tab">
                            <?php $active = 0; ?>
                        <?php } else { ?>
                        <li id="tab4Tab">    
                        <?php } ?>
                        <div class="tagcloud">    
                            <?php foreach ($feedData->tags as $term) { ?>
                                <a href="<?php echo get_tag_link($term->term_id); ?>"><?php echo $term->name ?></a>
                            <?php } ?>
                        </div>
                    </li>
                <?php }  ?>  
                    
                   
               <?php if (!is_null($feedData->ratings)) { 
                 
                   ?>  
                   
                         <?php if ($active) { ?>
                        <li class="active" id="tab5Tab">
                            <?php $active = 0; ?>
                        <?php } else { ?>
                        <li id="tab5Tab">    
                        <?php } ?>
                            
                   <?php foreach ($feedData->ratings as $post) { 
                           $ratingManager = ratingManager::getInstance();
                           $ratings = $ratingManager->getRatings($post->ID);
                           $totalrat = $ratingManager->getRatingsScore($ratings);
                           $total = round($totalrat * 100);
                      // var_dump(get_post_meta($post->ID));
                           if(!isset($instnace["rats_title_length"])){
                               $instnace["rats_title_length"] = 999;
                           }
                       ?>
                         <div class="tab-post-row">
                             <?php                                                   
                                if (has_post_thumbnail()) {
                                    ?>
                                    <div class="tab-post-widget-img">
                                        <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(array(50, 50)); ?></a>
                                    </div>
                                    <div class="tab-post-widget-content has_image">
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo jwUtils::crop_length(get_the_title(),$instnace["rats_title_length"]); ?></a></h3>
                                        
                                       <div class="jw-rating-row-overall-content"> 
                                        <?php if ($ratingManager->getOverllRatignType(get_the_ID()) == "stars") { ?>
                                            <div class="jw-rating-area-stars">
                                                <div class="ratig-background-stars">                    
                                                    <div class="rating-top-stars" style="width:<?php echo $total; ?>px"></div>
                                                </div>
                                            </div>
                                     <?php } else if ($ratingManager->getOverllRatignType(get_the_ID()) == "percent") { ?>
                                            <div class="jw-rating-area-percent">
                                                <div class="ratig-background-percent">
                                                    <div class="rating-top-percent" style="width:<?php echo $total; ?>px">
                                                    </div>
                                                    <div class="rating-top-percent-value"><?php echo $total; ?> %</div>
                                                </div>
                                            </div>
                                    <?php } ?>
                                         </div>
                                        
                                        
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="tab-post-widget-content">
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo jwUtils::crop_length(get_the_title(),$instnace["rats_title_length"]); ?></a></h3>
                                        
                                     
                                        <div class="jw-rating-row-overall-content"> 
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
                                                    <div class="rating-top-percent-value"><span> <?php echo $total; ?> %</span></div>
                                                </div>
                                            </div>
                                    <?php } ?>
                                         </div>
                                    </div>    
                                <?php } ?>
                                <div class="clear"></div>
                            </div>
                            <?php
                        }
                        ?>
                       </li>
                    <?php
                    }
                        ?>
                    
                    
            </ul>
        </div>
        <?php
    }

    /**
     * Printing widget, called by wordpress
     */
    function widget($args, $instance) {
        $feedData = $this->_collect_data($instance);
        $this->_print_widget($args, $instance, $feedData);
    }

    /*     * *************************************************************************** */
    /* COLLECTING DATA
      /***************************************************************************** */

    private function _collect_data($instance) {
        $feedData = new stdClass();
        $feedData->number_of_sections = 0;
        $feedData->popular_posts = null;
        $feedData->recent_posts = null;
        $feedData->recent_comments = null;
        $feedData->tags = null;
        $feedData->ratings  = null;


        if (isset($instance['popular_show']) && $instance['popular_show'] == 1) {
            $popular_posts = $this->_get_popular_posts($instance);
            if (!empty($popular_posts)) {
                $feedData->popular_posts = $popular_posts;
                $feedData->number_of_sections++;
            }
        }

        if (isset($instance['recent_show']) && $instance['recent_show'] == 1) {
            $recent_posts = $this->_get_recent_posts($instance);
            if (!empty($recent_posts)) {
                $feedData->recent_posts = $recent_posts;
                $feedData->number_of_sections++;
            }
        }

        if (isset($instance['comments_show']) && $instance['comments_show'] == 1) {
            $recent_comments = $this->_get_recent_comments($instance);
            if (!empty($recent_comments)) {
                $feedData->recent_comments = $recent_comments;
                $feedData->number_of_sections++;
            }
        }

        if (isset($instance['tags_show']) && $instance['tags_show'] == 1) {
            $tags = $this->_get_tags($instance);
            if (!empty($tags)) {
                $feedData->tags = $tags;
                $feedData->number_of_sections++;
            }
        }
        if (isset($instance['ratings_show']) && $instance['ratings_show'] == 1) {
            $ratings = $this->_get_ratings_posts($instance);
            if (!empty($ratings)) {
                $feedData->ratings = $ratings;
                $feedData->number_of_sections++;
            }
        }

        return $feedData;
    }

    private function _get_tags($instance) {
        if(!isset($instance['tags_sort_by']))
            $instance['tags_sort_by'] = 'name';
                
        $args = array('orderby' =>  $instance['tags_sort_by'] ,'order'=> 'ASC', 'number' => $instance['tags_num_of_posts'] );
        $tags = get_tags($args);
        return $tags;
    }

    private function _get_recent_comments($instance) {
        $args = array('number' => $instance['comments_num_of_posts'], 'status' => 'approve');
        $comments = get_comments($args);
        return $comments;
    }

    private function _get_popular_posts($instance) {
        $args = array('orderby' => 'comment_count', 'order' => 'desc', 'numberposts' => $instance['popular_num_of_posts']);
        if (!empty($instance['popular_categories']))
            $args['category'] = $instance['popular_categories'];
        $posts = get_posts($args);
        return $posts;
    }

    private function _get_recent_posts($instance) {
        $args = array('orderby' => 'post_date', 'order' => 'desc', 'numberposts' => $instance['recent_num_of_posts']);
        if (!empty($instance['recent_categories']))
            $args['category'] = $instance['recent_categories'];
        $posts = get_posts($args);
        return $posts;
    }

     private function _get_ratings_posts($instance) {
        $args = array('orderby' => 'post_date', 'order' => 'desc', 'numberposts' => $instance['rats_num_of_posts'], 'meta_key' => 'fw_rating_overal','meta_value'=> '1');
        if (!empty($instance['ratings_categories']))
            $args['category'] = $instance['ratings_categories'];
        $posts = get_posts($args);
        return $posts;
    }

}
?>