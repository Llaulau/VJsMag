<?php if (jwOpt::get_option('banner_postbottom_type', 'image') == 'image') { ?>
    <article class="type-ads element isotope-item one_col google_ads_bottom"  >
        <div class="box">
            <div class="post_banner">   
                <a href="<?php echo jwOpt::get_option('banner_postbottom_link', 'http://'); ?>"    target="<?php echo jwOpt::get_option('banner_postbottom_target', '_blank'); ?>">
                    <img src="<?php echo jwOpt::get_option('banner_postbottom', ''); ?>">
                </a>
            </div>
        </div>
    </article>  
<?php } else { ?>
<?php
    $google_ads = jwOpt::get_option('banner_postbottom_google', '#');
    if ($google_ads != "#") {
    ?>
         <article class="type-ads element isotope-item one_col google_ads_bottom"  >
   
            <div class="box">
                <div class="google_ads">
                    <?php echo $google_ads; ?>
                </div>
            </div>
        </article>
    <?php } ?>
<?php } ?>
