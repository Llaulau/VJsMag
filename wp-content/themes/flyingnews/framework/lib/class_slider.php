<?php

class oneSlide {

    public $title = null;
    public $content = null;
    public $img_big = null;
    public $img_small = null;
    public $bgColor = null;
    public $link = null;
    public $price = null;
    public $position = null;

}

class jwSlider {

    public $_slides = array();
    private $_count = 0;
    public $_image;

    public function __construct($type = 'home') {

        require_once THEME_FRAMEWORK_DIR . '/custom_posts/slides.php';
        require_once THEME_FRAMEWORK_LIB . 'class_custompost.php';
        global $jwOpt, $jwSlidesPost, $wpdb, $post, $jawtruepage;


        $pos = 'slides';
        if ((is_page() || $jawtruepage) && !is_front_page()) {
            $pos = get_post_meta(get_the_ID(), '_page_slider_source', true);
        } else if (is_front_page()) {
            $pos = jwOpt::get_option('slider_source', 'last');
        } else if (is_category()) {
            $category = get_the_category();
            $pos = jwOpt::get_option('cat_custom_source', 'last', 'category', $category[0]->cat_ID);
        }


        $slider_array = $this->get($type);
        foreach ($slider_array as $post) {
            setup_postdata($post);

            if (get_the_post_thumbnail($post->ID, 'slidebar-big') != '' || get_the_post_thumbnail($post->ID, 'slidebar-small') != '') {

                if ($pos == 'slides') {
                    $content = get_post_meta(get_the_ID(), '_slider_textarea', true);
                } else {
                    $content = get_the_excerpt();
                }
                $slider_arg = array(
                    'title' => get_the_title(),
                    'content' => $content,
                    'meta' => get_post_meta($post->ID, ''),
                    'thumbnail-big' => get_the_post_thumbnail($post->ID, 'slidebar-big'),
                    'thumbnail-small' => get_the_post_thumbnail($post->ID, 'slidebar-small'),
                    'background-color' => jwSlider::get_the_backgroundcolor($post->ID, $pos),
                    'link' => jwSlider::get_the_link($post->ID),
                    'position' => $pos
                );

                $this->addSlide($slider_arg);
            }
        }
    }

    public function addSlide($arg) {
        $newSlide = new oneSlide();
        $newSlide->title = $arg['title'];

        if (isset($meta['_slider_textarea'])) {
            $newSlide->content = $meta['_slider_textarea'][0];
        } else if (isset($arg['content'])) {
            $newSlide->content = $arg['content'];
        }
        $excerpt_len = (int) jwOpt::get_option('slider_excerpt');
        $newSlide->content = jwUtils::crop_length($newSlide->content, $excerpt_len);


        $newSlide->img_big = $arg['thumbnail-big'];
        $newSlide->img_small = $arg['thumbnail-small'];
        $newSlide->bgColor = $arg['background-color'][0];
        if ($newSlide->bgColor == 'custom') {
            $newSlide->bgCustomColor = $arg['background-color'][1];
            $newSlide->bgCustomTextColor = $arg['background-color'][2];
        }
        if ($arg['position'] == 'shop' && jwUtils::woocommerce_activate() == true) {
            $newSlide->price = sprintf(get_woocommerce_price_format(), get_woocommerce_currency_symbol(), get_post_meta(get_the_ID(), '_price', true));
        }
        $newSlide->position = $arg['position'];
        $newSlide->link = $arg['link'];
        if (isset($arg['meta']['_slider_image_target'][0])) {
            switch ($arg['meta']['_slider_image_target'][0]) {
                case 0: $newSlide->target = "_blank";
                    break;
                case 1: $newSlide->target = "_top";
                    break;
                case 2: $newSlide->target = "_parent";
                    break;
                case 3: $newSlide->target = "_self";
                    break;
            }
        }
        $this->_slides[] = $newSlide;
    }

    /**
     * @return array[oneSlide]
     */
    public function getSlides() {
        $direction = jwOpt::get_option('slider_orientation', 'down');
        $slides = $this->_slides;
        if (jwOpt::get_option('slider_orientation', 'down') == 'up') {
            $slides = array_reverse($slides);
        } else if (isset($slides[0])) {
            $first = $slides[0];
            array_shift($slides);
            $slides[] = $first;
        }
        require_once get_template_directory() . '/templates/slider/slider_home.php';
    }

    static function get_the_link($postID) {
        $tmp = get_post_meta($postID, '_slider_image_link', true);
        if (!empty($tmp)) {
            return $tmp;
        }

        return get_permalink($postID);
    }

    static function get_the_backgroundcolor($postID, $pos) {


        if ($pos == 'slides') {
            $BgColor = (get_post_meta(get_the_ID(), '_slider_bg_color', true));
            $ret[0] = $BgColor;
            $BgColor = (get_post_meta(get_the_ID(), '_slider_custom_bg_color', true));
            $ret[1] = $BgColor;
            $BgColor = (get_post_meta(get_the_ID(), '_slider_custom_font_color', true));
            $ret[2] = $BgColor;

            return $ret;
        } else {
            //kdekoliv !slides
            if ($pos == 'shop') {
                $terms = get_the_terms($postID, 'product_cat');
                if (!empty($terms) && is_array($terms)) {
                    $terms = array_shift(array_values($terms));
                    $postCategories[0] = ($terms->term_id );
                }
            } else {
                $postCategories = wp_get_post_categories($postID);
            }

            if (isset($postCategories[0]) && sizeof($postCategories) > 0) {
                $catID = $postCategories[0];
                $catBgColor[0] = jwOpt::get_option('cat_bg_color', 'template', 'category', $catID);

                if ($catBgColor[0] == "custom") {
                    $catBgColor[0] = "slider_nav_custom_" . $catID;
                }
            } else {
                $catBgColor[0] = 'template';
            }
            return $catBgColor;
        }
    }

    public function get($type) {
        $cat_id_str = '';

        if ($type == 'home') {
            $slider_number = jwOpt::get_option('slider_number', 6);
            $slider_source = jwOpt::get_option('slider_source');
            $slider_cat = jwOpt::get_option('slider_cat');
            $slider_post = '';
            $slider_author = '';
        } else if ($type == 'category') {
            $slider_cat = get_cat_id(single_cat_title("", false));
            $slider_number = jwOpt::get_option('cat_custom_max', 6, 'category', $slider_cat);
            $slider_source = jwOpt::get_option('cat_custom_source', 'last', 'category', $slider_cat);
            $slider_post = '';
            $slider_author = '';
        } else {
            global $wp_query;
            $slider_cat = $wp_query->query_vars['category__in'];
            $slider_post = $wp_query->query_vars['post__in'];
            if (isset($wp_query->query_vars['author'])) {
                $slider_author = $wp_query->query_vars['author'];
            } else {
                $slider_author = '';
            }
            $slider_number = $wp_query->query_vars['slider_max'];
            $slider_source = $wp_query->query_vars['slider_source'];
        }

        $argslider = array(
            'numberposts' => $slider_number,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_status' => 'publish',
            'ignore_sticky_posts' => 1,
            'suppress_filters' => true);

        if ($slider_source == 'slides') {
            $argslider['post_type'] = 'slides';
        } elseif ($slider_source == 'shop') {
            $argslider['post_type'] = 'product';
        } else {
            $argslider['post_type'] = 'post';
            $cat_id = (array) $slider_cat;
            $childcategories = get_categories('child_of=' . (int) $cat_id);
            foreach ($childcategories as $child_cat) {
                $cat_id[] = $child_cat->term_id;
            }
            if (isset($cat_id)) {
                $cat_id_str = implode(',', $cat_id);
            }


            $argslider['category'] = $cat_id_str;
            $argslider['post__in'] = $slider_post;
            $argslider['author'] = $slider_author;


            if ($slider_source == 'sticky') {
                $sticky = get_option('sticky_posts');
                $argslider['post__in'] = $sticky;
                $argslider['ignore_sticky_posts'] = 0;
            }
        }

        return get_posts($argslider);
    }

}

?>
