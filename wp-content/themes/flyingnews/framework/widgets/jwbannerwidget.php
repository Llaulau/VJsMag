<?php

class jwBannerWidget extends jw_default_widget {
    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'custom_banner',
            'description' => 'Banner',
            'type' => 'select',
            'values' => array(
                array('name' => 'Custom Banner 1', 'value' => '1'),
                array('name' => 'Custom Banner 2', 'value' => '2')
            ),
            'default' => 'custom_banner_1',
        ),
    );

    /**
     * Registering the widget to the wordpress
     */
    function jwBannerWidget() {
        $options = array('classname' => 'jwBannerWidget', 'description' => "The widget for displaying your custom Banner");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('jwBannerWidget', 'Custom Banner - J&W Widget', $options, $controls);
    }

    function widget($args, $instance) {
        $custom_banner = $instance['custom_banner'];        
        ?>
        <?php if (jwOpt::get_option('banner_custom_'.$custom_banner.'_type', 'image') == 'image') { ?>
            <?php 
            $image_banner = jwOpt::get_option('banner_custom_'.$custom_banner, '');
            if ( $image_banner != "" ) {
            ?>
            <article class="type-ads element isotope-item one_col google_ads_box">
                <div class="box">
                    <div class="post_banner">
                        <a href="<?php echo jwOpt::get_option('banner_custom_'.$custom_banner.'_link', 'http://'); ?>"  target="<?php echo jwOpt::get_option('banner_w_'.$custom_banner.'_link_target', '_blank'); ?>">
                            <img src="<?php echo $image_banner; ?>">
                        </a>
                    </div>
                </div>
            </article>
            <?php } ?>
        <?php } else { ?>
            <?php
            $google_ads = jwOpt::get_option('banner_custom_'.$custom_banner.'_google', '');
            if ($google_ads != "") {
                ?>
                <article class="type-ads element isotope-item one_col google_ads_box">
                    <div class="box">
                        <div class="google_ads">
                            <?php echo $google_ads; ?>
                        </div>
                    </div>
                </article>
            <?php } ?>
        <?php } ?>
        <?php
    }
}
?>