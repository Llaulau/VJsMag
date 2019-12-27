<?php

/**
 * Flickr Widget Class
 */
/* Last updated with phpFlickr 1.3.2
 *
 * This example file shows you how to call the 100 most recent public
 * photos.  It parses through them and prints out a link to each of them
 * along with the owner's name.
 *
 * Most of the processing time in this file comes from the 100 calls to
 * flickr.people.getInfo.  Enabling caching will help a whole lot with
 * this as there are many people who post multiple photos at once.
 *
 * Obviously, you'll want to replace the "<api key>" with one provided 
 * by Flickr: http://www.flickr.com/services/api/key.gne
 */
class jwRatingWidget extends jw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'ratings_title',
            'description' => 'Ratings title:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => 'Ratings'),
        1 => array('id' => 'ratings_categories',
            'description' => 'Exclude / include categories by id. E.g. 1,5,-8:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => ''),
        2 => array('id' => 'rats_num_of_posts',
            'description' => 'Number of rating`s posts to show:',
            'type' => 'text', // [[ text, check, select ]]
            'default' => '3'),
    );

    function jwRatingWidget() {
        $options = array('classname' => 'jwRatingWidget', 'description' => "widget na zobrazování ratingu");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('jwRatingWidget', 'Rating - J&W Widget', $options, $controls);
    }

    function widget($args, $instance) {
        global $post;
        
        $ratings = $this->_get_ratings_posts($instance);
            if (!empty($ratings)) {
                $feedData->ratings = $ratings;
            }
            
            
            ?>
            <article id="rating-widget" class="widget">
            <?php
            
            if (!empty($instance['ratings_title'])) {
            echo "<h2><strong>" . $instance['ratings_title'] . "</strong></h2>";
             }
        
        
            foreach ((array) $feedData->ratings as $post) { 
                           $ratingManager = ratingManager::getInstance();
                           $ratings = $ratingManager->getRatings($post->ID);
                           $totalrat = $ratingManager->getRatingsScore($ratings);
                           $total = round($totalrat * 100);
                           
 
       ?>

                
                         <div class="rating-widget-row">
                             <?php                                                   
                                if (has_post_thumbnail()) {
                                    ?>
                                    <div class="tab-post-widget-img">
                                        <a href="<?php the_permalink(); ?>"><?php echo the_post_thumbnail(array(50, 50)); ?></a>
                                    </div>
                                    <div class="tab-post-widget-content has_image">
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h3>

                                        
                                       <div class="jw-rating-row-overall-content "> 
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
                                        <h3><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h3>
                                        
                             
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
                                                    <div class="rating-top-percent-value"><span><?php echo $total; ?> %</span></div>
                                                </div>
                                            </div>
                                    <?php } ?>
                                         </div>
                                    </div>    
                                <?php } ?>
                                <div class="clear"></div>
                            </div>
      <?php } ?>
        </article>
<?php
        
        }
        
        
        
    private function _get_ratings_posts($instance) {
        $args = array('orderby' => 'post_date', 'order' => 'desc', 'numberposts' => $instance['rats_num_of_posts'], 'meta_key' => 'fw_rating_overal','meta_value'=> '1');
        if (!empty($instance['ratings_categories']))
            $args['category'] = $instance['ratings_categories'];
        $posts = get_posts($args);
        return $posts;
        }


}