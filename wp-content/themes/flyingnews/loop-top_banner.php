<?php if (jwOpt::get_option('banner_posttop_type', 'image') == 'image') { ?>
    <article class="type-ads element isotope-item one_col google_ads_top"  >
        <div class="box">
            <div class="post_banner">   
                <a href="<?php echo jwOpt::get_option('banner_posttop_link', 'http://'); ?>"    target="<?php echo jwOpt::get_option('banner_posttop_target', '_blank'); ?>">
                    <img src="<?php echo jwOpt::get_option('banner_posttop', ''); ?>">
                </a>
            </div>
        </div>
    </article>  
<?php } else { ?>
<?php
    $google_ads = jwOpt::get_option('banner_posttop_google', '#');
    if ($google_ads != "#") {
    ?>
         <article class="type-ads element isotope-item one_col google_ads_top"  >
   
            <div class="box">
                <div class="google_ads">
                    <?php echo $google_ads; ?>
                </div>
            </div>
        </article>
    <?php } ?>
<?php } ?>
