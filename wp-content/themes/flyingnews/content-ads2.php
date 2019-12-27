<?php if (jwOpt::get_option('banner_post_2_type', 'image') == 'image') { ?>
    <article class="type-ads element isotope-item one_col google_ads_box" 
             sort_name="<?php echo jwUtils::$glob_ad['title'][1] ?>"  
             sort_date="<?php echo jwUtils::$glob_ad['date'][1] ?>" 
             sort_popular="<?php echo jwUtils::$glob_ad['popular'][1] ?>" 
             sort_rating="<?php echo jwUtils::$glob_ad['rating'][1] ?>" 
             sort_category="pax"
            sort_custom1="0"
            sort_custom2="0"
         >
        
       <div class="box">
            <div class="post_banner">
                <a href="<?php echo jwOpt::get_option('banner_post_2_link', 'http://'); ?>" target="<?php echo jwOpt::get_option('banner_2_link_target', '_blank'); ?>">
                    <img src="<?php echo jwOpt::get_option('banner_post_2', ''); ?>">
                </a>
            </div>
        </div>
    </article>  
<?php } else { ?>
<?php
    $google_ads = jwOpt::get_option('banner_post_2_google', '#');
    if ($google_ads != "#") {
    ?>
        <article class="type-ads element isotope-item one_col google_ads_box" 
                 sort_name="<?php echo jwUtils::$glob_ad['title'][1] ?>"  
                 sort_date="<?php echo jwUtils::$glob_ad['date'][1] ?>" 
                 sort_popular="<?php echo jwUtils::$glob_ad['popular'][1] ?>" 
                 sort_rating="<?php echo jwUtils::$glob_ad['rating'][1] ?>" 
                 sort_category="pax"
                 sort_custom1="0"
                 sort_custom2="0"
         >
            
            
            <div class="box">
                <div class="google_ads">
                    <?php echo do_shortcode($google_ads); ?>
                </div>
            </div>
        </article>
    <?php } ?>
<?php } ?>

