<?php if (jwOpt::get_option('banner_post_1_type', 'image') == 'image') { ?>
    <article class="type-ads element isotope-item one_col google_ads_box" 
             sort_name="<?php echo jwUtils::$glob_ad['title'][0] ?>"  
             sort_date="<?php echo jwUtils::$glob_ad['date'][0] ?>" 
             sort_popular="<?php echo jwUtils::$glob_ad['popular'][0] ?>" 
             sort_rating="<?php echo jwUtils::$glob_ad['rating'][0] ?>" 
             sort_category="cut"
            sort_custom1="0"
            sort_custom2="0"
         >
        <div class="box">
            <div class="post_banner">   
                <a href="<?php echo jwOpt::get_option('banner_post_1_link', 'http://'); ?>"    target="<?php echo jwOpt::get_option('banner_1_link_target', '_blank'); ?>">
                    <img src="<?php echo jwOpt::get_option('banner_post_1', ''); ?>">
                </a>
            </div>
        </div>
    </article>  
<?php } else { ?>
<?php
    $google_ads = jwOpt::get_option('banner_post_1_google', '#');
    if ($google_ads != "#") {
    ?>
         <article class="type-ads element isotope-item one_col google_ads_box" 
                  sort_name="<?php echo jwUtils::$glob_ad['title'][0] ?>"  
                  sort_date="<?php echo jwUtils::$glob_ad['date'][0] ?>" 
                  sort_popular="<?php echo jwUtils::$glob_ad['popular'][0] ?>" 
                  sort_rating="<?php echo jwUtils::$glob_ad['rating'][0] ?>" 
                  sort_category="cut"
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
