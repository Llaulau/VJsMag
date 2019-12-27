<?php

/**
 * Dynamic style
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class jwStyle {

    protected $instance = null;
    protected static $demo = false; // is demo site?
    protected static $preset = false;
    static $category_colors = array(
        "red" => array(
            "name" => "Red",
            "slug" => "red",
            "color" => "#d73300",
            "font" => "#ffffff"
        ),
        "blue" => array(
            "name" => "Blue",
            "slug" => "blue",
            "color" => "#20b1ea",
            "font" => "#ffffff"
        ),
        "green" => array(
            "name" => "Green",
            "slug" => "green",
            "color" => "#579b18",
            "font" => "#ffffff"
        ),
        "yellow" => array(
            "name" => "Yellow",
            "slug" => "yellow",
            "color" => "#f8c741",
            "font" => "#2f3033"
        ),
        "lime" => array(
            "name" => "Lime",
            "slug" => "lime",
            "color" => "#aec71e",
            "font" => "#ffffff"
        ),
        "orange" => array(
            "name" => "Orange",
            "slug" => "orange",
            "color" => "#ec5923",
            "font" => "#ffffff"
        ),
        "darkblue" => array(
            "name" => "Dark Blue",
            "slug" => "darkblue",
            "color" => "#2d5c88",
            "font" => "#ffffff"
        ),
        "cyan" => array(
            "name" => "Cyan",
            "slug" => "cyan",
            "color" => "#2997ab",
            "font" => "#ffffff"
        ),
        "darkgreen" => array(
            "name" => "Dark Green",
            "slug" => "darkgreen",
            "color" => "#719430",
            "font" => "#ffffff"
        ),
        "grunge" => array(
            "name" => "Grunge",
            "slug" => "grunge",
            "color" => "#85742e",
            "font" => "#ffffff"
        ),
        "lightblue" => array(
            "name" => "Light Blue",
            "slug" => "lightblue",
            "color" => "#8bbbe0",
            "font" => "#ffffff"
        ),
        "lightgreen" => array(
            "name" => "Light Green",
            "slug" => "lightgreen",
            "color" => "#8eccb3",
            "font" => "#ffffff"
        ),
        "navy" => array(
            "name" => "Navy",
            "slug" => "navy",
            "color" => "#435960",
            "font" => "#ffffff"
        ),
        "pink" => array(
            "name" => "Pink",
            "slug" => "pink",
            "color" => "#e44884",
            "font" => "#ffffff"
        ),
        "purple" => array(
            "name" => "Purple",
            "slug" => "purple",
            "color" => "#46424f",
            "font" => "#ffffff"
        ),
        "darkred" => array(
            "name" => "Dark Red",
            "slug" => "darkred",
            "color" => "#a81010",
            "font" => "#ffffff"
        ),
        "salmon" => array(
            "name" => "Salmon",
            "slug" => "salmon",
            "color" => "#FF717E",
            "font" => "#ffffff"
        ),
        "darkgrey" => array(
            "name" => "Dark Grey",
            "slug" => "darkgrey",
            "color" => "#464646",
            "font" => "#ffffff"
        ),
    );
    protected static $link_color = "#2f3033";

    function __construct() {

        add_action('wp_head', array($this, 'get_inline'));
        if ($this->isDemoSite()) {
            add_action('wp_footer', array(&$this, 'optionpanel'));
            $this->isPresets();
        }
    }

    public function isPresets() {
        if (isset($_COOKIE['preset']))
            self::$preset = true;
    }

    public function isDemoSite() {
        if (is_admin())
            return self::$demo = false;
        if ($_SERVER['SERVER_NAME'] == 'demo.jawtemplates.com')
            return self::$demo = true;
        return self::$demo = false;
    }

    function optionPanel() {
        require THEME_FRAMEWORK_LIB . 'class_frontoptionpanel.php';
        jwFrontOptionPanel::render();
    }

    public function get_static() {

        if (!is_admin()) {
            $css = '';

            $css .= self::get_custom_category_colors();
            if (1 == 1) {
                // do file stuff
                $filename = 'custom-styles.css';
                $css_path = THEME_DIR . '/css/';

                $cssFilePath = $css_path . $filename;

                if (file_exists($cssFilePath)) {

                    $cssFileContent = file_get_contents($cssFilePath);
                    if (!is_writable($css_path)) {
                        echo '<div id="message" class="updated below-h2"><p><strong>The css folder "' . get_template_directory() . '/css" is not writeable.</strong></p></div>';
                    }

                    if (is_writable($cssFilePath)) {

                        if ($cssFileContent != $css) {
                            $styles_file = fopen($cssFilePath, 'w');

                            fwrite($styles_file, $css);
                            fclose($styles_file);
                        }
                    } else {
                        add_action('admin_notices', 'jwStyle::error_write_file');
                        // _e('Unable to write "static-styles.css" in the "/css" folder.');
                    }
                } else {
                    // file missing, save it
                    if (is_writable($css_path)) {
                        $styles_file = fopen($cssFilePath, 'w');
                        fwrite($styles_file, $css);
                        fclose($styles_file);
                    } else {
                        add_action('admin_notices', 'jwStyle::error_write_folder');
                        // _e('Unable to write "static-styles.css" in the "' . $css_path . '" folder.');
                    }
                }
            }
        } else {
            $css_path = THEME_DIR . '/css/';
            if (!is_writable($css_path)) {
                add_action('admin_notices', 'jwStyle::error_write_folder');
            }
        }
    }

    static function error_write_folder() {
        echo '<div id="message" class="updated below-h2"><p><strong>The css folder "' . get_template_directory() . '/css" is not writeable.</strong></p></div>';
    }

    static function error_write_file() {
        echo '<div id="message" class="updated below-h2"><p><strong>The css file "' . get_template_directory() . '/css/custom-styles.css" is not writeable.</strong></p></div>';
    }

    private function get_custom_category_colors() {
        $css = "";

        $css .= "body {background: none repeat scroll 0 0 " . jwOpt::get_option('body_background_color', '#F1F4ED') . "}\n";

        $bg_images_url = get_template_directory_uri() . '/images/bg_texture/';

        if (jwOpt::get_option('background_texture', $bg_images_url . 'none.png') != $bg_images_url . 'none.png' && jwOpt::get_option('background_image', '') == '') {
            $css .= "body {background: url(\"" . jwOpt::get_option('background_texture', $bg_images_url . 'lil_fiber.png') . "\") repeat scroll 0 0 " . jwOpt::get_option('body_background_color', '#F1F4ED') . "}\n";
        }

        /*  FONTS  *********************************************************** */
        $nadpisy = jwOpt::get_option('body_font', 'Oswald');
        if(preg_match('/(.*?):.*/', $nadpisy,$matches)){
            $nadpisy = $matches[1];
        }
        if (strtolower((string) $nadpisy) == 'oswald') {
            $css .= ".top-bar-jw ul > li a:not(.button) {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= ".top-bar-jw ul > li a {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".mobile-menu ul > li a:not(.button) {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= "#slider_home h2 {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= "#slider_home h2 a {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= "#tab-post-widget dl.tabs dd a {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= "#slider_home .slides_list .text_holder h3 {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= "#slider_home .slides_list .text_holder h3 a {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= ".content-box h2 a {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= ".post-box .entry-title {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= ".element .categories a {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= ".contact_form h6, .contact_form h6 strong {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= ".jw-rating-row-title h6, .jw-rating-row-title h6 strong {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= ".content-box .content-price, .content-addtocart a {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
            $css .= ".shop_table th, .shop_table td.actions {font-family: 'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
        } else {
            $css .= ".top-bar-jw ul > li a:not(.button) {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".top-bar-jw ul > li a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".mobile-menu ul > li a:not(.button) {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;}\n";
            $css .= "#slider_home h2 {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#slider_home h2 a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#tab-post-widget dl.tabs dd a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#slider_home .slides_list .text_holder h3 {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#slider_home .slides_list .text_holder h3 a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".content-box h2 a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a{font-family: '" . $nadpisy . "' ,'Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".tab_container_login .user-submit {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".tab_container_login .rememberme label {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".share_hearline{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#related h3, #respond h3{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#related h4{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".contact_submit, #respond #commentform .form-submit #submit{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".post-box .meta{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#nav-single .nav-previous a{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#nav-single .nav-next a{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "h1, h2, h3, h4, h5, h6, h7{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#content .releated-product h3{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#infinite_load h6{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#elements_iso .content-box .content-addtocart a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".post-box .entry-title {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".element .categories a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".portfolio-item-details h2 {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".contact_form h6, .contact_form h6 strong {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".jw-rating-row-title h6, .jw-rating-row-title h6 strong {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".widget h2 * {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;}";

            $css .= "#elements_iso .content-box .price {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= "#elements_iso .button a{font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; }\n";
            $css .= ".content-box .content-price, .content-addtocart a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";

            $css .= ".shop_table th, .shop_table td.actions {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif}\n";
        }

        $post_text = jwOpt::get_option('small_font', array('face' => 'Droid Sans', 'style' => 'normal', 'size' => '13px', 'color' => '#2f3033'));

        $css .= ".captions > span {font-family: '" . $post_text['face'] . "','Droid Sans','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;}\n";
        $css .= ".post-box .entry-content, .post-box .entry-content p, .list > li {font-family: '" . $post_text['face'] . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-weight:" . $post_text['style'] . "; font-size: " . $post_text['size'] . "; color: " . $post_text['color'] . ";}\n";
        $css .= ".post-box .entry-content iframe {width: 100%;}\n";
        $css .= "#content .post-box .entry-content .content-box h2 a {font-family: '" . $nadpisy . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif; font-size: 22px ; font-weight: 700; }\n";
        $css .= "#content .element .caption-content span{font-size: 12px; padding-right: 5px; position: relative; color: #FFFFFF; }\n";
        $css .= "body {font-family: '" . $post_text['face'] . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;}\n";
        $css .= "#tab-post-widget h3 a {font-family: '" . $post_text['face'] . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;}\n";
        $css .= ".content-box {font-family: '" . $post_text['face'] . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;}\n";
        $css .= "#slider_home .slider_list .text_holder p {font-family: '" . $post_text['face'] . "','Oswald','Helvetica Neue','Helvetica',Helvetica,Arial,sans-serif;}\n";
        /* FONTS ************************************************************* */

        /* LOGO ************************************************************** */
        $template_logo = jwOpt::get_option('custom_logo', '');
        $size = false;
        if (strlen($template_logo) > 0) {
            $size = @getimagesize($template_logo);
        }

        if ($size && jwOpt::get_option('logo_retina_ready', '0')) {
            $css .= ".reverie-header,.reverie-header img {width: " . $size[0] / 2 . "px;}\n";
        }
        /* END LOGO ********************************************************** */

        $cats = get_all_category_ids();


        /* FILL PAGE MENU ITEMS */
        $menu_locations = get_nav_menu_locations();
        $items = wp_get_nav_menu_items($menu_locations['primary_navigation']);
        if ($items) {
            foreach ($items as $item) {
                if ($item->menu_item_parent == '0' && $item->object == 'page') {
                    $meta_page = get_post_meta($item->object_id);

                    if (!isset($meta_page['post_bg_color'][0]) || empty($meta_page['post_bg_color'][0])) {
                        $meta_page['post_bg_color'][0] = 'template';
                    }
                    if ($meta_page['post_bg_color'][0] == "custom") {
                        /* MENU */


                        $css .= ".top-bar-jw ul > li.has-dropdown .custom_menu_page_" . $item->object_id . " {background: none repeat scroll 0 0 " . $meta_page['post_custom_bg_color'][0] . " !important}\n";
                        $css .= ".top-bar-jw ul > li.has-dropdown .custom_menu_page_" . $item->object_id . " .dropdown {background: none repeat scroll 0 0 " . $meta_page['post_custom_bg_color'][0] . " !important}\n";
                        $css .= ".top-bar-jw ul > li.has-dropdown .custom_menu_page_" . $item->object_id . " li {background: none repeat scroll 0 0 " . $meta_page['post_custom_bg_color'][0] . " !important;border: 0px !important;}\n";
                        $css .= ".top-bar-jw ul > li.has-dropdown .custom_menu_page_" . $item->object_id . " li a:hover { background: " . $meta_page['post_custom_bg_color'][0] . " !important;}\n";
                        $css .= ".top-bar-jw ul > li.custom_menu_page_" . $item->object_id . ":hover, .top-bar-jw ul > li.active_custom_menu_" . $item->object_id . " { background: " . $meta_page['post_custom_bg_color'][0] . " !important;}\n";

                        /* END MENU */
                    }
                }
            }
        }
        /* FILL PAGE MENU ITEMS ********************************************** */

        /* TEMPLATE BASIC COLORS ********************************************* */

        /* TEMPLATE COLOR **************************************************** */

        $template_color = jwOpt::get_option('template_body_main_color', 'darkgrey');
        $body_main_color_link = jwOpt::get_option('body_main_color_link', '#2f3033');
        $body_main_color_link_hover = jwOpt::get_option('body_main_color_link_hover', '#CA181F');

        if ($template_color == 'custom') {
            $tempalte_main_color = jwOpt::get_option('body_main_color', '#46424f');
            $tempalte_main_font_color = jwOpt::get_option('body_main_font_color', '#ffffff');
            ;
        } else {
            $tempalte_main_color = self::$category_colors[$template_color]["color"];
            $tempalte_main_font_color = self::$category_colors[$template_color]["font"];
        }

        $css .= "\n";
        $css .= ".footer-content .widget li a,.footer-list li a,.top-bar-jw ul > li a:not(.button),.top-bar ul > li.has-dropdown .dropdown.template li a, .top-bar-jw ul > li:not(.name):hover .dropdown.template h2 a:not(.button) {color: " . $tempalte_main_font_color . "}\n";
        $css .= "a {color: " . $body_main_color_link . "}\n";
        $css .= "a:hover,.footer-content .widget .tagcloud a:hover,.footer-content .widget li a:hover,.footer-list li a:hover {color: " . $body_main_color_link_hover . "}\n";
        $css .= "#footer-content-info .widget h2 {color: " . $tempalte_main_font_color . " !important;}\n";
        $css .= ".widget_rss h6 a:hover, .morebutton h6:hover {color: " . $body_main_color_link_hover . " !important;}\n";
        $css .= ".footer-content .widget li a,.footer-list li a {}\n";
        $css .= "#footer-content h1,#footer-content h2,#footer-content h3,#footer-content h4,#footer-content h5,#footer-content h6, .blog-items-sortby, .blog-items-sortby-list li a {color: " . $tempalte_main_font_color . "}\n";
        $css .= ".blog-items-sortby-list li {border-right-color: " . $tempalte_main_font_color . "}\n";
        $css .= "\n";

        $css .= ".top-bar-jw {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar-jw ul > li:hover:not(.name), .top-bar-jw ul > li.active:not(.name) {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar-jw ul > li.has-dropdown .template {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar-jw ul > li.has-dropdown .template li {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar-jw ul > li.has-dropdown .template li a:hover { background: " . $tempalte_main_color . "; }\n";
        $css .= ".top-bar-jw ul > li:hover, .top-bar-jw ul > li.active { background: " . $tempalte_main_color . "; }\n";
        $css .= ".top-bar-jw ul > li.has-dropdown .template .dropdown {background: none repeat scroll 0 0 " . $tempalte_main_color . " !important;}\n";

        $css .= ".top-bar {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar ul > li:hover:not(.name), .top-bar ul > li.active:not(.name), .top-bar ul > li:focus:not(.name) {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar ul > li.has-dropdown .dropdown {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar ul > li.has-dropdown .dropdown li {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar ul > li.has-dropdown .dropdown li a:hover, .top-bar ul > li.has-dropdown .dropdown li a:focus {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar ul > li.has-dropdown.moved > .dropdown li a:hover {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".top-bar ul > li.active, .top-bar ul > li:hover {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".dropdown.template .contact_form .contact_form_arrow {border-left-color: " . $tempalte_main_color . "; border-right-color: " . $tempalte_main_color . " ;}\n";
        $css .= ".menu-box .menu-info {color: " . $tempalte_main_font_color . "}\n";
        $css .= ".top-bar-jw ul > li h1, .top-bar-jw ul > li h2, .top-bar-jw ul > li h3, .top-bar-jw ul > li h4, .top-bar-jw ul > li h5, .top-bar-jw ul > li h6 {color: " . $tempalte_main_font_color . "}\n";

        $css .= ".category_template .content-box {background-color: " . $tempalte_main_color . ";color:" . $tempalte_main_font_color . "}\n";
        $css .= ".category_template .content-box a {color:" . $tempalte_main_font_color . "}\n";
        $css .= ".category_template .content-box a:hover {color:" . $tempalte_main_font_color . "}\n";
        $css .= ".category_template .content-box blockquote, .category_template .content-box blockquote p {color: " . $tempalte_main_font_color . "}\n";
        $css .= "#elements_iso .category_template:hover .box {background-color: " . $tempalte_main_color . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}\n";
        $css .= ".woocommerce .category_template:hover .box {background-color: " . $tempalte_main_color . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}\n";
        $css .= "#elements_iso .category_template .categories {background-color: " . $tempalte_main_color . ";color:" . $tempalte_main_font_color . ";}\n";
        $css .= "#elements_iso .category_template .categories a {color:" . $tempalte_main_font_color . ";}\n";

        $css .= ".post_title_template {background: none repeat scroll 0 0 " . $tempalte_main_color . ";color:" . $tempalte_main_font_color . ";}\n";
        $css .= ".post_title_template h1 {color:" . $tempalte_main_font_color . ";}\n";

        //$css .= ".blog-items-search .widget_search input[type=\"text\"],blog-items-search .widget_search input[type=\"text\"]:focus {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color:" . $tempalte_main_font_color . ";}\n";

        $css .= ".grey .menu-box {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";

        $css .= "#wp-calendar caption {color: " . $tempalte_main_color . "}\n";
        $css .= ".footer-content #wp-calendar caption {color: " . $tempalte_main_font_color . "}\n";
        $css .= "#slider_home .slider_area .slider_list li .text_holder {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= "#slider_home .slider_area .slider_list li .text_holder h2 {color:" . $tempalte_main_font_color . "}\n";
        $css .= "#slider_home .slider_area .slider_list li .text_holder h2 a {color:" . $tempalte_main_font_color . "}\n";

        $css .= "#tab-post-widget dl.tabs dd.active {border-top: 3px solid " . $tempalte_main_color . ";}\n";

        $css .= ".portfolio_categories {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";

        $css .= ".slides_list li.template {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".slides_list li.template h3 {color:" . $tempalte_main_font_color . "}\n";
        $css .= ".slides_list li.template h3 a {color:" . $tempalte_main_font_color . "}\n";

        $css .= "#slider_home .slider_list .text_holder p {color:" . $tempalte_main_font_color . ";}\n";

        $css .= ".top_arrow,.bottom_arrow {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";

        $css .= ".tagcloud a {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color:" . $tempalte_main_font_color . ";}\n";
        $css .= ".tagcloud a:hover {color: " . $body_main_color_link_hover . "}\n";

        $css .= "#footer-content-info .row {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
        $css .= "ul.template-footer-menu li {border-color: " . $body_main_color_link . ";}\n";

        $css .= "#infinite_load {border-bottom: 3px solid " . $tempalte_main_color . "}\n";
        $css .= ".infinite_load_arrow {border-top-color: " . $tempalte_main_color . "}\n";

        /* WIDGET TITLES */
        $css .= ".widget_color_template .widget h2 {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";
        $css .= ".widget_color_template .widget h2 a {color: " . $tempalte_main_font_color . " }\n";

        $css .= ".category_color_template .share_post {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";
        $css .= ".category_color_template .share_post_arrow-up {border-bottom-color: " . $tempalte_main_color . ";}\n";
        $css .= ".category_color_template #nav-single .nav-previous a:after {border-right-color: " . $tempalte_main_color . "}\n";
        $css .= ".category_color_template #nav-single .nav-next a:after {border-left-color: " . $tempalte_main_color . "}\n";
        $css .= ".category_color_template .jw-rating-row-title h6, .jw-rating-row-title h6 strong {color: " . $tempalte_main_font_color . " }\n";

        $css .= ".category_color_template #respond #commentform .contact_form_button.active {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
        $css .= ".category_color_template #respond #commentform .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $tempalte_main_color . "}\n";
        $css .= ".category_color_template #respond #commentform .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";

        $css .= ".category_color_template #respond #commentform .form-submit.active {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " ;}\n";
        $css .= ".category_color_template #respond #commentform .form-submit.active #submit {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . ";}\n";
        $css .= ".category_color_template #respond #commentform .form-submit.active .contact_form_arrow {border-bottom-color: " . $tempalte_main_color . "}\n";


        /* PAGINATION */
        $css .= "ul.page-numbers li span.current {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";
        $css .= "ul.page-numbers li:hover a, ul.page-numbers li a:focus { background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";

        $css .= ".widget_color_template .contact_form .contact_form_button.active {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
        $css .= ".widget_color_template .contact_form .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $tempalte_main_color . "}\n";
        $css .= ".widget_color_template .contact_form .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";

        $css .= ".widget_color_template #login .contact_form_button.active {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
        $css .= ".widget_color_template #login .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $tempalte_main_color . "}\n";
        $css .= ".widget_color_template #login .contact_form_button.active .user-submit {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
        $css .= ".widget_color_template #login .contact_form_button.active label {color: " . $tempalte_main_font_color . "}\n";

        $css .= ".widget_color_template #respond #commentform .contact_form_button.active {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
        $css .= ".widget_color_template #respond #commentform .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $tempalte_main_color . "}\n";
        $css .= ".widget_color_template #respond #commentform .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";

        $css .= ".widget_color_template .widget_rss h6 a {color: " . $tempalte_main_font_color . "}\n";

        //$css .= ".widget_color_template .contact_form .contact_form_arrow {border-right-color: " . $tempalte_main_color . ";border-left-color: " . $tempalte_main_color . ";}\n";
        $css .= "#footer-content-info .contact_form .contact_form_button .contact_form_arrow {border-right-color: " . $tempalte_main_color . " !important;border-left-color: " . $tempalte_main_color . " !important;}\n";

        $css .= "#infinite_load.ajax a {color: " . $tempalte_main_color . "}\n";
        $css .= "#infinite_load.ajax a:hover {color: " . $body_main_color_link_hover . "}\n";
        $css .= "#infinite_load.ajax a:after,#post-nav.wordpress .post-next a:after {border-left-color: " . $tempalte_main_color . "}\n";
        $css .= "#infinite_load.ajax .post-previous-infinite a:after, #post-nav.wordpress .post-previous a:after {border-right-color: " . $tempalte_main_color . "}\n";
        $css .= "#infinite_load h6 {color: " . $tempalte_main_color . "}\n";

        /* paged post */
        $css .= "#page-nav .page-nav-one {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";
        $css .= "#page-nav a:hover .page-nav-one { background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";


        /* wooo */
        $css .= "#elements_iso a.button {color: " . $tempalte_main_font_color . "; }\n";
        $css .= "#related .related-box .tab-post-widget-add-tocart a{color: " . $tempalte_main_font_color . "; }\n";
        $css .= ".slider_price h4{color: " . $tempalte_main_font_color . "; }";
        $css .= "#main .button {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= "#elements_iso .button {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= "#related .related-box .tab-post-widget-add-tocart a{background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        $css .= ".reverie-header-banner a{color: " . $tempalte_main_color . ";}\n";


        $css .= "#totop {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
        /* END TEMPLATE COLORS ********************************************** */


        /* CATEGORY COLORS *********************************************************** */
        foreach (self::$category_colors as $color) {
            $css .= ".category_" . $color["slug"] . " .content-box  {background-color: " . $color["color"] . ";color: " . $color["font"] . ";}\n";
            $css .= ".category_" . $color["slug"] . " .content-box a {color: " . $color["font"] . ";}\n";
            $css .= ".category_" . $color["slug"] . " .content-box blockquote, .category_red .content-box blockquote p {color: " . $color["font"] . "}\n";
            $css .= "#elements_iso .category_" . $color["slug"] . ":hover .box {background-color: " . $color["color"] . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}\n";
            $css .= ".woocommerce .category_" . $color["slug"] . ":hover .box {background-color: " . $color["color"] . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}\n";
            //$css .= "#elements_iso .category_".$color["slug"].":hover .box {background-color: ".$color["color"].";}\n";
            $css .= "#elements_iso .category_" . $color["slug"] . " .categories {background-color: " . $color["color"] . ";}\n";
            $css .= "#elements_iso .category_" . $color["slug"] . " .categories a {color: " . $color["font"] . ";}\n";
            $css .= ".top-bar-jw ul > li.has-dropdown ." . $color["slug"] . " {background: none repeat scroll 0 0 " . $color["color"] . " !important;}\n";
            $css .= ".top-bar-jw ul > li.has-dropdown ." . $color["slug"] . " .dropdown {background: none repeat scroll 0 0 " . $color["color"] . " !important;}\n";
            $css .= ".top-bar-jw ul > li.has-dropdown ." . $color["slug"] . " li {background: none repeat scroll 0 0 " . $color["color"] . " !important;}\n";
            $css .= ".top-bar-jw ul > li.has-dropdown ." . $color["slug"] . " li a:hover { background: " . $color["color"] . " !important; }\n";
            $css .= ".top-bar-jw ul > li." . $color["slug"] . ":hover, .top-bar-jw ul > li.active_" . $color["slug"] . " { background: " . $color["color"] . " !important; }\n";
            $css .= ".top-bar-jw ul > li." . $color["slug"] . ":hover a, .top-bar-jw ul > li.active_" . $color["slug"] . " a { color: " . $color["font"] . " }\n";
            $css .= ".top-bar-jw ul > li." . $color["slug"] . " .menu-box .menu-info {color: " . $color["font"] . "}\n";
            $css .= ".dropdown." . $color["slug"] . " .contact_form .contact_form_arrow {border-left-color: " . $color["color"] . "; border-right-color: " . $color["color"] . " ;}\n";
            $css .= ".slides_list li." . $color["slug"] . " {background: none repeat scroll 0 0 " . $color["color"] . ";color:" . $color["font"] . ";}\n";
            $css .= ".slides_list li." . $color["slug"] . " h3 {color:" . $color["font"] . ";}\n";
            $css .= ".slides_list li." . $color["slug"] . " h3 a {color:" . $color["font"] . ";}\n";
            $css .= ".post_title_" . $color["slug"] . " {background: none repeat scroll 0 0 " . $color["color"] . "}\n";
            $css .= ".post_title_" . $color["slug"] . " h1 {color: " . $color["font"] . "}\n";
            $css .= ".breadcrumbs-bar-" . $color["slug"] . " {background: none repeat scroll 0 0 " . $color["color"] . "}\n";
            //$css .= ".breadcrumbs-bar-".$color["slug"]." .blog-items-search .widget_search input[type=\"text\"],.breadcrumbs-bar-".$color["slug"]." .blog-items-search .widget_search input[type=\"text\"]:focus {background: none repeat scroll 0 0 ".$color["color"].";color: ".$color["font"]."}\n";

            $css .= ".breadcrumbs-bar-" . $color["slug"] . " a {color: " . $color["font"] . ";border-right: 1px solid " . $color["font"] . "}\n";
            $css .= ".breadcrumbs-bar-" . $color["slug"] . " li a {color: " . $color["font"] . ";border-right: 0;}\n";

            $css .= ".breadcrumbs-bar-" . $color["slug"] . " a:hover,.breadcrumbs-bar-" . $color["slug"] . " span {color: " . $color["font"] . ";}\n";

            $css .= ".widget_color_" . $color["slug"] . " .widget h2 {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . " }\n";

            $css .= ".category_color_" . $color["slug"] . " .share_post {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . " }\n";
            $css .= ".category_color_" . $color["slug"] . " .share_post_arrow-up {border-bottom-color: " . $color["color"] . ";}\n";
            $css .= ".category_color_" . $color["slug"] . " #nav-single .nav-previous a:after {border-right-color: " . $color["color"] . "}\n";
            $css .= ".category_color_" . $color["slug"] . " #nav-single .nav-next a:after {border-left-color: " . $color["color"] . "}\n";
            $css .= ".category_color_" . $color["slug"] . " .jw-rating-row-title, .category_color_" . $color["slug"] . " .jw-rating-row-overall-box {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";
            $css .= ".category_color_" . $color["slug"] . " .jw-rating-row-title h6, .jw-rating-row-title h6 strong {color: " . $color["font"] . " }\n";

            $css .= ".category_color_" . $color["slug"] . " #respond #commentform .contact_form_button.active {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";
            $css .= ".category_color_" . $color["slug"] . " #respond #commentform .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $color["color"] . "}\n";
            $css .= ".category_color_" . $color["slug"] . " #respond #commentform .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";

            $css .= ".category_color_" . $color["slug"] . " #respond #commentform .form-submit.active {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";
            $css .= ".category_color_" . $color["slug"] . " #respond #commentform .form-submit.active #submit {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";
            $css .= ".category_color_" . $color["slug"] . " #respond #commentform .form-submit.active .contact_form_arrow {border-bottom-color: " . $color["color"] . "}\n";

            /* SEARCH BUTTON HOVER */
            $css .= ".widget_color_" . $color["slug"] . " .contact_form .contact_form_button.active {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";
            $css .= ".widget_color_" . $color["slug"] . " .contact_form .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $color["color"] . "}\n";
            $css .= ".widget_color_" . $color["slug"] . " .contact_form .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";

            /* LOGIN FORM HOVER */
            $css .= ".widget_color_" . $color["slug"] . " #login .contact_form_button.active {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";
            $css .= ".widget_color_" . $color["slug"] . " #login .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $color["color"] . "}\n";
            $css .= ".widget_color_" . $color["slug"] . " #login .contact_form_button.active .user-submit {background: none repeat scroll 0 0 " . $color["color"] . "; color: " . $color["font"] . "}\n";
            $css .= ".widget_color_" . $color["slug"] . " #login .contact_form_button.active label {color: " . $color["font"] . "}\n";

            $css .= ".widget_color_" . $color["slug"] . " .widget_rss h6 a {color: " . $color["font"] . "}\n";

            $css .= "\n\n";
        }

        $css .= "\n";

        foreach ($cats as $cat_id) {
            $cat_bg_color = jwOpt::get_option('cat_bg_color', 'template', 'category', $cat_id);
            if ($cat_bg_color == 'custom') {
                $cat_custom_bg_color = jwOpt::get_option('cat_custom_bg_color', '#fafafa', 'category', $cat_id);
                $cat_custom_font_color = jwOpt::get_option('cat_custom_font_color', '#2f3033', 'category', $cat_id);

                $css .= ".category_custom_" . $cat_id . " .content-box {background: none repeat scroll 0 0 " . $cat_custom_bg_color . ";color: " . $cat_custom_font_color . ";}\n";
                $css .= ".category_custom_" . $cat_id . " .content-box blockquote p {color: " . $cat_custom_font_color . ";}\n";
                $css .= ".category_custom_" . $cat_id . " .content-box a {color: " . $cat_custom_font_color . ";}\n";
                $css .= "#elements_iso .category_custom_" . $cat_id . ":hover .box {background-color: " . $cat_custom_bg_color . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}\n";
                $css .= ".woocommerce .category_custom_" . $cat_id . ":hover .box {background-color: " . $cat_custom_bg_color . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}\n";
                //$css .= "#elements_iso .category_custom_" . $cat_id . ":hover .box {background-color: " . $cat_custom_bg_color . ";}\n";        
                $css .= "#elements_iso .category_custom_" . $cat_id . " .categories {background-color: " . $cat_custom_bg_color . ";}\n";
                $css .= "#elements_iso .category_custom_" . $cat_id . " .categories a {color: " . $cat_custom_font_color . ";}\n";



                /* SLDIER */
                $css.= ".slides_list li.slider_nav_custom_" . $cat_id . " {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "}\n";
                $css.= ".slides_list li.slider_nav_custom_" . $cat_id . " h3 {color: " . $cat_custom_font_color . ";}\n";
                $css.= ".slides_list li.slider_nav_custom_" . $cat_id . " h3 a {color: " . $cat_custom_font_color . ";}\n";
                /* END SLIDER */

                /* POST TITLE */
                $css.= ".post_title_custom_" . $cat_id . " {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "}\n";
                $css.= ".post_title_custom_" . $cat_id . " h1 {color: " . $cat_custom_font_color . "}\n";

                $css .= ".breadcrumbs-bar-custom-" . $cat_id . " {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "}\n";
                //$css .= ".breadcrumbs-bar-custom-" . $cat_id . " .blog-items-search .widget_search input[type=\"text\"],breadcrumbs-bar-custom-" . $cat_id . " .blog-items-search .widget_search input[type=\"text\"]:focus {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "}\n";

                /* WIDGET TITLES */
                $css .= ".widget_color_custom_" . $cat_id . " .widget h2 {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . " }\n";

                $css .= ".category_color_custom_" . $cat_id . " .share_post {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . " }\n";
                $css .= ".category_color_custom_" . $cat_id . " .share_post_arrow-up {border-bottom-color: " . $cat_custom_bg_color . ";}\n";
                $css .= ".category_color_custom_" . $cat_id . " #nav-single .nav-previous a:after {border-right-color: " . $cat_custom_bg_color . "}\n";
                $css .= ".category_color_custom_" . $cat_id . " #nav-single .nav-next a:after {border-left-color: " . $cat_custom_bg_color . "}\n";

                $css .= ".category_color_custom_" . $cat_id . " .jw-rating-row-title, .category_color_custom_" . $cat_id . " .jw-rating-row-overall-box {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";
                $css .= ".category_color_custom_" . $cat_id . " .jw-rating-row-title h6, .category_color_custom_" . $cat_id . " .jw-rating-row-title h6 strong {color: " . $cat_custom_font_color . " }\n";

                $css .= ".category_color_custom_" . $cat_id . " #respond #commentform .contact_form_button.active {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";
                $css .= ".category_color_custom_" . $cat_id . " #respond #commentform .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $cat_custom_bg_color . "}\n";
                $css .= ".category_color_custom_" . $cat_id . " #respond #commentform .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";

                $css .= ".category_color_custom_" . $cat_id . " #respond #commentform .form-submit.active {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";
                $css .= ".category_color_custom_" . $cat_id . " #respond #commentform .form-submit.active #submit {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";
                $css .= ".category_color_custom_" . $cat_id . " #respond #commentform .form-submit.active .contact_form_arrow {border-bottom-color: " . $cat_custom_bg_color . "}\n";

                $css .= ".widget_color_custom_" . $cat_id . " .contact_form .contact_form_button.active {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";
                $css .= ".widget_color_custom_" . $cat_id . " .contact_form .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $cat_custom_bg_color . "}\n";
                $css .= ".widget_color_custom_" . $cat_id . " .contact_form .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";

                $css .= ".widget_color_custom_" . $cat_id . " #login .contact_form_button.active {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";
                $css .= ".widget_color_custom_" . $cat_id . " #login .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $cat_custom_bg_color . "}\n";
                $css .= ".widget_color_custom_" . $cat_id . " #login .contact_form_button.active .user-submit {background: none repeat scroll 0 0 " . $cat_custom_bg_color . "; color: " . $cat_custom_font_color . "}\n";
                $css .= ".widget_color_custom_" . $cat_id . " #login .contact_form_button.active label {color: " . $cat_custom_font_color . "}\n";

                $css .= ".widget_color_custom_" . $cat_id . " .widget_rss h6 a {color: " . $cat_custom_font_color . "}\n";
            }
        }



        //MENU************************
        $menus = wp_get_nav_menus();
        foreach ((array) $menus as $item_menu) {
            $menu_items = wp_get_nav_menu_items($item_menu->term_id);
            foreach ((array) $menu_items as $key => $menu_item) {

                $menu_type = jwOpt::get_option('menu_type', 'custom', 'menus', $menu_item->ID);
                if ($menu_type == 'page') {
                    $cat_id = get_post_meta($menu_item->ID, '_menu_item_object_id', true);
                    $item_bg_color = get_post_meta($cat_id, 'post_bg_color', true);
                } else {
                    $cat_id = jwOpt::get_option('menu_id', '0', 'menus', $menu_item->ID);
                    $item_bg_color = jwOpt::get_option('cat_bg_color', 'template', 'category', $cat_id);
                }

                if ($item_bg_color == 'custom') {

                    if ($menu_type == 'page') {
                        $cat_custom_bg_color = get_post_meta($cat_id, 'post_custom_bg_color', true);
                        $cat_custom_font_color = get_post_meta($cat_id, 'post_custom_font_color', true);
                    } else {
                        $cat_custom_bg_color = jwOpt::get_option('cat_custom_bg_color', '#fafafa', 'category', $cat_id);
                        $cat_custom_font_color = jwOpt::get_option('cat_custom_font_color', '#2f3033', 'category', $cat_id);
                    }

                    /* MENU */
                    $css .= ".top-bar-jw ul > li.has-dropdown ." . $menu_type . "_custom_menu_" . $cat_id . " {background: none repeat scroll 0 0 " . $cat_custom_bg_color . " !important}\n";
                    $css .= ".top-bar-jw ul > li.has-dropdown ." . $menu_type . "_custom_menu_" . $cat_id . " .dropdown {background: none repeat scroll 0 0 " . $cat_custom_bg_color . " !important}\n";
                    $css .= ".top-bar-jw ul > li.has-dropdown ." . $menu_type . "_custom_menu_" . $cat_id . " li {background: none repeat scroll 0 0 " . $cat_custom_bg_color . " !important;border: 0px !important; border-bottom: 1px solid rgba(255, 255, 255, 0.47) !important;}\n";
                    $css .= ".top-bar-jw ul > li.has-dropdown ." . $menu_type . "_custom_menu_" . $cat_id . " li a:hover { background: " . $cat_custom_bg_color . " !important;}\n";
                    $css .= ".top-bar-jw ul > li." . $menu_type . "_custom_menu_" . $cat_id . ":hover, .top-bar-jw ul > li.active_" . $menu_type . "_custom_menu_" . $cat_id . " { background: " . $cat_custom_bg_color . " !important;}\n";
                    $css .= ".top-bar-jw ul > li." . $menu_type . "_custom_menu_" . $cat_id . " .menu-box .menu-info {color: " . $cat_custom_font_color . "}\n";
                    $css .= ".top-bar-jw ul > li." . $menu_type . "_custom_menu_" . $cat_id . " h1,
                                    .top-bar-jw ul > li." . $menu_type . "_custom_menu_" . $cat_id . " h2,
                                    .top-bar-jw ul > li." . $menu_type . "_custom_menu_" . $cat_id . " h3,
                                    .top-bar-jw ul > li." . $menu_type . "_custom_menu_" . $cat_id . " h4,
                                    .top-bar-jw ul > li." . $menu_type . "_custom_menu_" . $cat_id . " h5,
                                    .top-bar-jw ul > li." . $menu_type . "_custom_menu_" . $cat_id . " h6 {color: " . $cat_custom_font_color . "}\n";
                    $css .= ".dropdown." . $menu_type . "_custom_menu_" . $cat_id . " .contact_form .contact_form_arrow {border-left-color: " . $cat_custom_bg_color . "; border-right-color: " . $cat_custom_bg_color . " ;}\n";
                    /* END MENU */
                }
            }
        }







        $css .= ".submenu-content .contact_form .contact_form_button.active {background-color: rgb(241, 244, 237) !important; opacity: 0.9;color: #000 !important;}\n";
        $css .= ".submenu-content .contact_form .contact_form_button.active .contact_form_arrow {border-bottom-color: rgb(241, 244, 237) !important; opacity: 0.98}\n";
        $css .= ".submenu-content .contact_form .contact_form_button.active .contact_submit {background-color: rgb(241, 244, 237) !important; opacity: 0.9;color: #000 !important;}\n";

        return $css;
    }

    public static function get_bg_image() {

        $out = '';

        ob_start();
        if (self::$preset == true && isset($_COOKIE['bg_image']) && $_COOKIE['bg_image'] == '1') {  // no image 
            ?>
            <div class="template-back-image" style="position: fixed;left:0px;top:0px;z-index: -1;">
                <img class="" src="http://demo.jawtemplates.com/flyingnews/wp/wp-content/uploads/2013/02/01/background-sedy-21.jpg">
            </div>

        <?php } else if (jwOpt::get_option('background_image', '') != '') { ?>
            <div class="template-back-image" style="position: fixed;left:0px;top:0px;z-index: -1;">
                <img class="" src="<?php echo jwOpt::get_option('background_image', ''); ?>">
            </div>
            <?php
        }

        $out = ob_get_clean();
        return $out;
    }

    public function get_inline() {
        // inline for page

        $css = '';

        if (is_page() || (function_exists('is_shop') && is_shop())) {
            if (function_exists('is_shop') && is_shop()) {
                $meta_page = get_post_meta(get_option('woocommerce_shop_page_id'));
            } else {
                $meta_page = get_post_meta(get_the_ID());
            }


            if (isset($meta_page['post_bg_color'][0]) && $meta_page['post_bg_color'][0] == 'custom') {
                $background_color = $meta_page['post_custom_bg_color'][0];
                $color = $meta_page['post_custom_font_color'][0];
            } else if (isset($meta_page['post_bg_color'][0]) && $meta_page['post_bg_color'][0] == 'template') {
                $act_color = jwOpt::get_option('template_body_main_color', 'purple');
                if ($act_color == 'custom') {
                    $background_color = jwOpt::get_option('body_main_color', 'purple');
                    $color = jwOpt::get_option('body_main_font_color', '#fff');
                } else {
                    $background_color = self::$category_colors[$act_color]["color"];
                    $color = self::$category_colors[$act_color]["font"];
                }
            } else if (isset($meta_page['post_bg_color'][0])) {
                $background_color = self::$category_colors[$meta_page['post_bg_color'][0]]["color"];
                $color = self::$category_colors[$meta_page['post_bg_color'][0]]["font"];
            } else {
                $background_color = jwOpt::get_option('body_main_color', '#CA181F');
                $color = jwOpt::get_option('body_main_font_color', '#2f3033');
            }

            // TOP BAR
            $css .= ".top-bar {background: " . $background_color . " repeat scroll 0 0; }\n";
            $css .= ".top-bar ul > li:hover:not(.name), .top-bar ul > li.active:not(.name), .top-bar ul > li:focus:not(.name) {background: none repeat scroll 0 0 " . $background_color . "; color:" . $color . ";}\n";
            $css .= ".top-bar ul > li.has-dropdown .dropdown {background: none repeat scroll 0 0 " . $background_color . ";}\n";
            $css .= ".top-bar ul > li.has-dropdown .dropdown li {background: none repeat scroll 0 0 " . $background_color . "; }\n";
            $css .= ".top-bar ul > li.has-dropdown .dropdown li a:hover, .top-bar ul > li.has-dropdown .dropdown li a:focus {background: none repeat scroll 0 0 " . $background_color . "; }\n";
            $css .= ".top-bar ul > li.has-dropdown.moved > .dropdown li a:hover {background: none repeat scroll 0 0 " . $background_color . ";}\n";
            $css .= ".top-bar ul > li.active, .top-bar ul > li:hover {background: none repeat scroll 0 0 " . $background_color . "; color:" . $color . ";}\n";
            $css .= ".top-bar-jw ul > li.has-dropdown .template .dropdown {background: none repeat scroll 0 0 " . $background_color . " !important;}\n";

            $css .= ".top-bar-jw ul > li .menu-box .menu-info {color: " . $color . "}\n";
            $css .= ".top-bar-jw ul > li h1,
                     .top-bar-jw ul > li h2,
                     .top-bar-jw ul > li h3,
                     .top-bar-jw ul > li h4,
                     .top-bar-jw ul > li h5,
                     .top-bar-jw ul > li h6 {color: " . $color . "}\n";

            $css .= ".top-bar-jw ul  .menu-item a {color:" . $color . "}\n";


            $css .= ".default .menu-box {background: none repeat scroll 0 0 " . $background_color . "; color:" . $color . ";}\n";

            $css .= "#copyright .row {border-top: 5px solid " . $background_color . ";}\n";

            $css .= "#tab-post-widget dl.tabs dd.active {border-top: 3px solid " . $background_color . "; }\n";

            $css .= ".portfolio_categories {background: none repeat scroll 0 0 " . $background_color . "; }\n";
            $css .= ".portfolio_categories .portfolio_categories_item  {color:" . $color . "; border-color:" . $color . ";}\n";
            $css .= ".portfolio_categories .portfolio_categories_item a {color:" . $color . "; border-color:" . $color . ";}\n";
            $css .= ".portfolio_categories .portfolio_categories_item a:hover {color:" . $color . "; border-color:" . $color . ";}\n";
            $css .= ".breadcrumbs .current_crumb {color:" . $color . "; border-color:" . $color . ";}\n";
            $css .= ".breadcrumbs a {color:" . $color . "; border-color:" . $color . ";}\n";
            $css .= ".breadcrumbs a:hover {color:" . $color . "; border-color:" . $color . ";}\n";

            $css .= ".top_arrow, .bottom_arrow, #slider_home .slider_area .slider_list li .text_holder {background: none repeat scroll 0 0 " . $background_color . ";}\n";

            $css .= ".widget_color_template .widget h2 {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . " }\n";
            $css .= ".widget_color_template .widget h2 a {color: " . $color . " }\n";

            $css .= ".widget_color_template .contact_form .contact_form_button.active {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . "}\n";
            $css .= ".widget_color_template .contact_form .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $background_color . "}\n";
            $css .= ".widget_color_template .contact_form .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . "}\n";

            $css .= ".widget_color_template #login .contact_form_button.active {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . "}\n";
            $css .= ".widget_color_template #login .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $background_color . "}\n";
            $css .= ".widget_color_template #login .contact_form_button.active .user-submit {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . "}\n";
            $css .= ".widget_color_template #login .contact_form_button.active label {color: " . $color . "}\n";

            $css .= ".category_color_template #respond #commentform .contact_form_button.active {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . "}\n";
            $css .= ".category_color_template #respond #commentform .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $background_color . "}\n";




            $css .= ".category_color_template #respond #commentform .contact_form_button.active .contact_submit {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . "}\n";

            $css .= ".category_color_template #commentform .form-submit.active {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . "}\n";
            $css .= ".category_color_template #commentform .form-submit.active #submit {background: none repeat scroll 0 0 " . $background_color . "; color: " . $color . "}\n";
            $css .= ".category_color_template #respond #commentform .form-submit.active .contact_form_arrow {border-bottom-color: " . $background_color . "}\n";

            $css .= ".tabs dd.active, .tabs li.active, ul.accordion > li.active {border-top-color: " . $background_color . "}\n";
            $css .= "#footer-content-info .row, #totop, ul.page-numbers li span.current, ul.page-numbers li:hover a, ul.page-numbers li a:focus {background: none repeat scroll 0 0 " . $background_color . ";}\n";

            $css .= ".dropdown.template .contact_form .contact_form_arrow {border-left-color: " . $background_color . ";border-right-color: " . $background_color . "}\n";
            $css .= "#footer-content-info .contact_form .contact_form_button .contact_form_arrow {border-right-color: " . $background_color . " !important;border-left-color: " . $background_color . " !important;}\n";
            $css .= ".tagcloud a {background: none repeat scroll 0 0 " . $background_color . "}\n";
        }


        // preset only for demo and a side frontend option panel 
        if (self::$preset == true) {
            $patterns = jwUtils::fileLoader(STYLESHEETPATH . '/images/bg_texture/', array('.png', '.jpg'), $bg_images_url = get_template_directory_uri() . '/images/bg_texture/');

            if (isset($_COOKIE['background_texture']) && in_array($_COOKIE['background_texture'], $patterns)) {
                $css .= "body {background: url(\"" . $_COOKIE['background_texture'] . "\") repeat scroll 0 0 #F1F4ED}\n";
            }

            if (isset($_COOKIE['template_body_main_color']) && isset(self::$category_colors[$_COOKIE['template_body_main_color']]["color"])) {

                $template_color = $_COOKIE['template_body_main_color'];
                $tempalte_main_color = self::$category_colors[$template_color]["color"];
                $tempalte_main_font_color = self::$category_colors[$template_color]["font"];
                $body_main_color_link = jwOpt::get_option('body_main_color_link', '#2f3033');
                $body_main_color_link_hover = jwOpt::get_option('body_main_color_link_hover', '#CA181F');
                $css .= "\n";
                $css .= ".footer-content .widget li a,.footer-list li a,.top-bar-jw ul > li a:not(.button),.top-bar ul > li.has-dropdown .dropdown.template li a, .top-bar-jw ul > li:not(.name):hover .dropdown.template h2 a:not(.button) {color: " . $tempalte_main_font_color . "}\n";
                $css .= "a {color: " . $body_main_color_link . "}\n";
                $css .= "a:hover,.footer-content .widget tagcloud a:hover,.footer-content .widget li a:hover,.footer-list li a:hover {color: " . $body_main_color_link_hover . "}\n";
                $css .= ".footer-content .widget li a,.footer-list li a {}\n";
                $css .= "#footer-content h1,#footer-content h2,#footer-content h3,#footer-content h4,#footer-content h5,#footer-content h6, .blog-items-sortby, .blog-items-sortby-list li a {color: " . $tempalte_main_font_color . "}\n";
                $css .= ".blog-items-sortby-list li {border-right-color: " . $tempalte_main_font_color . "}\n";
                $css .= "\n";

                $css .= ".top-bar-jw {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar-jw ul > li:hover:not(.name), .top-bar-jw ul > li.active:not(.name) {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar-jw ul > li.has-dropdown .template {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar-jw ul > li.has-dropdown .template li {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar-jw ul > li.has-dropdown .template li a:hover { background: " . $tempalte_main_color . "; }\n";
                $css .= ".top-bar-jw ul > li:hover, .top-bar-jw ul > li.active { background: " . $tempalte_main_color . "; }\n";
                $css .= ".top-bar-jw ul > li.has-dropdown .template .dropdown {background: none repeat scroll 0 0 " . $tempalte_main_color . " !important;}\n";

                $css .= ".top-bar {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar ul > li:hover:not(.name), .top-bar ul > li.active:not(.name), .top-bar ul > li:focus:not(.name) {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar ul > li.has-dropdown .dropdown {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar ul > li.has-dropdown .dropdown li {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar ul > li.has-dropdown .dropdown li a:hover, .top-bar ul > li.has-dropdown .dropdown li a:focus {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar ul > li.has-dropdown.moved > .dropdown li a:hover {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".top-bar ul > li.active, .top-bar ul > li:hover {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".dropdown.template .contact_form .contact_form_arrow {border-left-color: " . $tempalte_main_color . "; border-right-color: " . $tempalte_main_color . " ;}\n";
                $css .= ".menu-box .menu-info {color: " . $tempalte_main_font_color . "}\n";
                $css .= ".top-bar-jw ul > li h1, .top-bar-jw ul > li h2, .top-bar-jw ul > li h3, .top-bar-jw ul > li h4, .top-bar-jw ul > li h5, .top-bar-jw ul > li h6 {color: " . $tempalte_main_font_color . "}\n";

                $css .= ".category_template .content-box {background-color: " . $tempalte_main_color . ";color:" . $tempalte_main_font_color . "}\n";
                $css .= ".category_template .content-box a {color:" . $tempalte_main_font_color . "}\n";
                $css .= ".category_template .content-box a:hover {color:" . $tempalte_main_font_color . "}\n";
                $css .= ".category_template .content-box blockquote, .category_template .content-box blockquote p {color: " . $tempalte_main_font_color . "}\n";

                $css .= ".category_color_template #commentform.active .form-submit {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
                $css .= ".category_color_template #commentform.active .form-submit #submit {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";


                $css .= "#elements_iso .category_template:hover .box {background-color: " . $tempalte_main_color . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}\n";
                $css .= ".woocommerce .category_template:hover .box {background-color: " . $tempalte_main_color . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}\n";
                $css .= "#elements_iso .category_template .categories {background-color: " . $tempalte_main_color . ";color:" . $tempalte_main_font_color . ";}\n";
                $css .= "#elements_iso .category_template .categories a {color:" . $tempalte_main_font_color . ";}\n";

                $css .= ".post_title_template {background: none repeat scroll 0 0 " . $tempalte_main_color . ";color:" . $tempalte_main_font_color . ";}\n";
                $css .= ".post_title_template h1 {color:" . $tempalte_main_font_color . ";}\n";

                //$css .= ".blog-items-search .widget_search input[type=\"text\"],blog-items-search .widget_search input[type=\"text\"]:focus {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color:" . $tempalte_main_font_color . ";}\n";

                $css .= ".grey .menu-box {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";

                $css .= "#wp-calendar caption {color: " . $tempalte_main_color . "}\n";

                $css .= "#slider_home .slider_area .slider_list li .text_holder {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= "#slider_home .slider_area .slider_list li .text_holder h2 {color:" . $tempalte_main_font_color . "}\n";
                $css .= "#slider_home .slider_area .slider_list li .text_holder h2 a {color:" . $tempalte_main_font_color . "}\n";

                $css .= "#tab-post-widget dl.tabs dd.active {border-top: 3px solid " . $tempalte_main_color . ";}\n";

                $css .= ".portfolio_categories {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";

                $css .= ".slides_list li.template {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";
                $css .= ".slides_list li.template h3 {color:" . $tempalte_main_font_color . "}\n";
                $css .= ".slides_list li.template h3 a {color:" . $tempalte_main_font_color . "}\n";

                $css .= "#slider_home .slider_list .text_holder p {color:" . $tempalte_main_font_color . ";}\n";

                $css .= ".top_arrow,.bottom_arrow {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";

                $css .= ".tagcloud a {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color:" . $tempalte_main_font_color . ";}\n";

                $css .= "#footer-content-info .row {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
                //$css .= "ul.template-footer-menu li {border-color: " . $body_main_color_link . ";}\n";

                $css .= "#infinite_load {border-bottom: 3px solid " . $tempalte_main_color . "}\n";
                $css .= ".infinite_load_arrow {border-top-color: " . $tempalte_main_color . "}\n";

                /* WIDGET TITLES */
                $css .= ".widget_color_template .widget h2 {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";
                $css .= ".widget_color_template .widget h2 a {color: " . $tempalte_main_font_color . " }\n";

                $css .= ".category_color_template .share_post {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";
                $css .= ".category_color_template .share_post_arrow-up {border-bottom-color: " . $tempalte_main_color . ";}\n";
                $css .= ".category_color_template #nav-single .nav-previous a:after {border-right-color: " . $tempalte_main_color . "}\n";
                $css .= ".category_color_template #nav-single .nav-next a:after {border-left-color: " . $tempalte_main_color . "}\n";
                $css .= ".category_color_template .jw-rating-row-title h6, .jw-rating-row-title h6 strong {color: " . $tempalte_main_font_color . " }\n";
                $css .= ".category_color_template #respond #commentform .form-submit.active .contact_form_arrow {border-bottom-color: " . $tempalte_main_font_color . "}\n";

                /* PAGINATION */
                $css .= "ul.page-numbers li span.current {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";
                $css .= "ul.page-numbers li:hover a, ul.page-numbers li a:focus { background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . " }\n";

                $css .= ".widget_color_template .contact_form .contact_form_button.active {opacity: 0.9;}\n";
                $css .= ".widget_color_template .contact_form .contact_form_button.active .contact_form_arrow {border-top-color: rgba(241, 244, 237,0.9);}\n";
                $css .= ".widget_color_template .contact_form .contact_form_button.active .contact_submit {opacity: 0.9;}\n";

                $css .= ".widget_color_template #login .contact_form_button.active {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
                $css .= ".widget_color_template #login .contact_form_button.active .contact_form_arrow {border-bottom-color: " . $tempalte_main_color . "}\n";
                $css .= ".widget_color_template #login .contact_form_button.active .user-submit {background: none repeat scroll 0 0 " . $tempalte_main_color . "; color: " . $tempalte_main_font_color . "}\n";
                $css .= ".widget_color_template #login .contact_form_button.active label {color: " . $tempalte_main_font_color . "}\n";



                $css .= "#infinite_load.ajax a {color: " . $tempalte_main_color . "}\n";
                $css .= "#infinite_load.ajax a:hover {color: " . $body_main_color_link_hover . "}\n";
                $css .= "#infinite_load.ajax a:after,#post-nav.wordpress .post-next a:after {border-left-color: " . $tempalte_main_color . "}\n";
                $css .= "#infinite_load.ajax .post-previous-infinite a:after, #post-nav.wordpress .post-previous a:after {border-right-color: " . $tempalte_main_color . "}\n";
                $css .= "#infinite_load h6 {color: " . $tempalte_main_color . "}\n";

                $css .= "#footer-content-info .contact_form .contact_form_button .contact_form_arrow {border-right-color: " . $tempalte_main_color . " !important;border-left-color: " . $tempalte_main_color . " !important;}\n";
                $css .= ".tagcloud a {background: none repeat scroll 0 0 " . $tempalte_main_color . "}\n";

                $css .= "#totop {background: none repeat scroll 0 0 " . $tempalte_main_color . ";}\n";

            }
            /* END TEMPLATE COLORS ********************************************** */



            /* RTL******************* */
            if (isset($_COOKIE['rtl_support']) && $_COOKIE['rtl_support'] == '1') {
                echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/template-rtl.css">';
                echo '<!--[if lt IE 9]>';
                echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/ie-rtl.css">';
                echo '<![endif]-->';
            }
        }


        if (jwOpt::get_option('background_banner_show', '0') == '1') {
            $css .= '.ad-back-image{background: url("' . jwOpt::get_option('background_banner_link', '') . '") no-repeat scroll 50% 0 transparent;}';
        }



        if (jwOpt::get_option('totop_show_mobile', '0') == '0') {
            $css .= " @media handheld, only screen and (max-width: 959px) {
                      #totop {display: none !important};
                  }";
        }


        $css .= jwOpt::get_option('custom_css', '');



        echo '<style>' . $css . '</style>';
    }

    public function get_widget_color($category_id = 0) {
        if (!$category_id) {
            return "widget_color_template";
        } else {
            $cat_bg_color = jwOpt::get_option('cat_bg_color', 'template', 'category', $category_id);

            if ($cat_bg_color == 'custom') {
                return "widget_color_custom_" . $category_id;
            } else {
                return "widget_color_" . $cat_bg_color;
            }
        }
    }

    public function get_category_color($category_id = 0) {
        if (!$category_id) {
            return "category_color_template";
        } else {
            $cat_bg_color = jwOpt::get_option('cat_bg_color', 'template', 'category', $category_id);

            if ($cat_bg_color == 'custom') {
                return "category_color_custom_" . $category_id;
            } else {
                return "category_color_" . $cat_bg_color;
            }
        }
    }

    function hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    function woo_custom_color_inline($id) {
        $css = '';
        if (jwOpt::get_option('cat_bg_color', 'template', 'category', $id) == 'custom') {
            $custom_color = jwOpt::get_option('cat_custom_bg_color', 'template', 'category', $id);
            $css .= '<style>';
            $css .= ".product_cat_".$id." .content-box{background-color: " . $custom_color . ";}";
            $css .= ".product_cat_".$id." .categories{background-color: " . $custom_color . ";}";
            $css .= "#elements_iso .product_cat_".$id.":hover .box{background-color: " . $custom_color . ";-webkit-transition: background 200ms ease-in 100ms;-moz-transition: background 200ms ease-in 100ms;-o-transition: background 200ms ease-in 100ms;transition: background 200ms ease-in 100ms;}";
            $css .= '</style>';
        }
        return $css;
    }

}
?>
