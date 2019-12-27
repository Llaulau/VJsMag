<?php if (jwOpt::get_option('banner_header_type', 'image') == 'image') { ?>
    <?php 
        $banner_link = jwOpt::get_option('header_banner_link', '#');
    ?>
    <?php if ( strlen($banner_link) <= 0 || $banner_link == 'http://' || $banner_link == 'https://' ) { ?>
        <div class="reverie-header-banner">
            <a href="#">
                <img src="<?php echo jwOpt::get_option('header_banner', ''); ?>">
            </a>
        </div>
    <?php } else { ?>
        <div class="reverie-header-banner">
            <a href="<?php echo jwOpt::get_option('header_banner_link', '#'); ?>"  target="<?php echo jwOpt::get_option('banner_head_link_target', '_blank'); ?>">
                <img src="<?php echo jwOpt::get_option('header_banner', ''); ?>">
            </a>
        </div>
    <?php } ?>
<?php } else { ?>
    <?php 
        $google_ads = jwOpt::get_option('header_banner_google', '#');
    ?>
    <?php if ( strlen($google_ads) > 0) { ?>
        <div class="reverie-header-banner">
            <div class="google_ads">
                <?php echo $google_ads; ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>
