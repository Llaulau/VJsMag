<?php

/**
 * Helper utils, other code
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class jwUtils {

    public static $glob_ad;

    public static function get_post_number() {
        global $wp_query;
        return $wp_query->current_post;
    }

    public static function getFileExten($file) {

        $pos = strpos($file, ".");
        $fileext = substr($file, $pos, strlen($file));
        return $fileext;
    }

    public static function fileLoader($path, $ext = array(), $prepend = '') {
        $out = null;
        if (is_dir($path)) {
            if ($dir = opendir($path)) {
                while (($file = readdir($dir)) !== false) {

                    if (in_array(jwUtils::getFileExten($file), $ext)) {
                        $out[] = $prepend . $file;
                    }
                }
            }
            else
                $out = 'Folder is close';
        }else {
            $out = 'no folder';
        }
        return $out;
    }

    /*
     * funkce: get_video_info
     * vrací z url adresy (např: http://vimeo.com/26609463) jen ID, název domény a náhledy ve 3 velikostech.
     */

    public static function get_video_info($video_url) {
        $ret = new video_info();
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match)) {
            $ret->id = $match[1];
            $ret->domain = 'youtube';
            $ret->thumbnails['thumbnail_small'] = "http://img.youtube.com/vi/" . $ret->id . "/default.jpg";
            $ret->thumbnails['thumbnail_medium'] = "http://img.youtube.com/vi/" . $ret->id . "/mqdefault.jpg";
            $ret->thumbnails['thumbnail_large'] = "http://img.youtube.com/vi/" . $ret->id . "/hqdefault.jpg";
        } else if (preg_match('/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $video_url, $match)) {
            $ret->id = $match[3];
            $ret->domain = 'vimeo';
            //u vimea jde do thumbnails více informací (např: description, date, nuber of likes ...)
            $thumbnails = (wp_remote_request("http://vimeo.com/api/v2/video/" . $ret->id . ".php"));
            $thumbnails = unserialize($thumbnails['body']);
            $ret->thumbnails = $thumbnails[0];
        }

        return $ret;
    }

    public static function get_url_domain($url) {

        $explode = explode(".", $url);
        $tld = $explode[0];
        $tld = explode("/", $tld);
        return $tld[2];
    }

    /* Zajištění zobrazení správné pozice reklam */

    public static function ads_position() {
        global $wp_query;
        $ratingManager = ratingManager::getInstance();
        $var_posts = $wp_query->posts;

        if ($wp_query->post_count > 4 && (jwOpt::get_option('banner_post_1_show', '0') == '1' || jwOpt::get_option('banner_post_2_show', '0') == '1' || jwOpt::get_option('banner_post_3_show', '0') == '1')) {
            $ratingManager = ratingManager::getInstance();
            $loc_ad_title = array();

            foreach ($wp_query->posts as $post) {
                $sort_title[] = strtolower($post->post_title);
                $sort_date[] = $post->post_date;
                $ratings = $ratingManager->getRatings($post->ID);
                $sort_rating[] = $ratingManager->getRatingsScore($ratings);
                $act_rating[] = $ratingManager->getRatingsScore($ratings);
                $post->rating = $act_rating[0];
                $act_rating = null;
                $sort_popular[] = $post->comment_count;
            }
            $var_posts_title = $var_posts;
            $var_posts_date = $var_posts;
            $var_posts_popular = $var_posts;
            $var_posts_rating = $var_posts;

            $loc_ad = round(sizeof($var_posts) / 3);
            if (sizeof($var_posts) < ($loc_ad * 3)) {
                $korekce = 2;
            } else {
                $korekce = 1;
            }

            array_multisort($sort_title, SORT_ASC, SORT_STRING, $var_posts_title);
            $loc_ad_title[0] = strtolower(substr($var_posts_title[($loc_ad) - 1]->post_title, 0, 5) . "zzz");
            $loc_ad_title[1] = strtolower(substr($var_posts_title[($loc_ad * 2) - 1]->post_title, 0, 5) . "zzz");
            $loc_ad_title[2] = strtolower(substr($var_posts_title[($loc_ad * 3) - $korekce]->post_title, 0, 5) . "zzz");

            array_multisort($sort_date, SORT_DESC, SORT_STRING, $var_posts_date);
            $loc_ad_date[0] = $var_posts_date[($loc_ad) - 1]->post_date;
            $loc_ad_date[1] = $var_posts_date[($loc_ad * 2) - 1]->post_date;
            $loc_ad_date[2] = $var_posts_date[($loc_ad * 3) - $korekce]->post_date;

            array_multisort($sort_date, SORT_DESC, $var_posts_popular);
            $loc_ad_popular[0] = $var_posts_popular[($loc_ad) - 1]->comment_count;
            $loc_ad_popular[1] = $var_posts_popular[($loc_ad * 2) - 1]->comment_count;
            $loc_ad_popular[2] = $var_posts_popular[($loc_ad * 3) - $korekce]->comment_count;

            array_multisort($sort_rating, SORT_DESC, $var_posts_rating);
            $loc_ad_rating[0] = $var_posts_rating[($loc_ad) - 1]->rating;
            $loc_ad_rating[1] = $var_posts_rating[($loc_ad * 2) - 1]->rating;
            $loc_ad_rating[2] = $var_posts_rating[($loc_ad * 3) - $korekce]->rating;

            self::$glob_ad['title'] = $loc_ad_title;
            self::$glob_ad['date'] = $loc_ad_date;
            self::$glob_ad['popular'] = $loc_ad_popular;
            self::$glob_ad['rating'] = $loc_ad_rating;
            ;
        } else {

            foreach ($wp_query->posts as $post) {
                $ratings = $ratingManager->getRatings($post->ID);
                $sort_rating[] = $ratingManager->getRatingsScore($ratings);
                $post->rating = $sort_rating[0];
                $sort_rating = null;
            }
        }
    }

    public static function get_gallery_slider($postID, $size = 'post-size') {

        $attach_gallery_post = array();
        if (get_bloginfo('version') >= 3.5) {
            $post_content = get_the_content();
            preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
            if (isset($ids[1])) {
                $ids = explode(",", $ids[1]);
                foreach ($ids as $id) {
                    $galery['url'] = wp_get_attachment_image_src($id, $size);
                    $thumbnail_image = get_posts(array('p' => $id, 'post_type' => 'attachment'));
                    if (isset($thumbnail_image[0]->post_excerpt)) {
                        $galery['caption'] = $thumbnail_image[0]->post_excerpt;
                    }
                    $attach_gallery_post[] = $galery;
                }
            }
        } else {
            $attach = get_children(array(
                'post_parent' => $postID,
                'post_type' => 'attachment',
                'numberposts' => -1,
                'post_status' => 'any'));

            foreach ($attach as $att) {
                $attach_gallery_post[] = wp_get_attachment_image_src($att->ID, $size);
            }
        }
        return $attach_gallery_post;
    }

    public static function getHelp($keyword) {
        $out = '';
        $out .= '<a href="';     //?amp;TB_iframe=true class="thickbox" záložky v thickbox nejedou    
        $out .= " javascript: launchHelp('" . THEME_URI . "/help/index.php#" . $keyword . "');";


        $out .= '"><img src="' . THEME_URI . '/images/icons/info-icon.gif" /></a>';


        return $out;
    }

    public static function crop_length($string = '', $max_length = 50) {
        if (strlen($string) > $max_length) {
            return mb_substr($string, 0, $max_length, 'UTF-8') . ' ...';
        } else {
            return $string;
        }
    }

    /* public static function crop__html_tags($string = ''){
      $string = preg_replace("/<(.*?)[^>]+\>/i", "", $string);
      $string = preg_replace("/[;,\",\',\n]/i", "", $string);
      return $string;
      }

     */

    static function get_social_meta() {
        ob_start();
        global $post;

        echo "<meta property='fb:app_id' content='" . jwOpt::get_option('fbcomments_appid') . "'/>";

        // facebook, twitter ang google plus meta
        if (is_home() || is_front_page()) {
            echo '<meta property="og:image" content="' . get_template_directory_uri() . '/images/logo/none.png"/>' . "\n";
            echo '<meta property="og:type" content="website"/> ' . "\n";
            echo '<meta property="og:url" content="' . get_site_url() . '"/>' . "\n";
        }
        if (is_singular()) {
            echo '<meta property="og:title" content="' . get_the_title() . '"/>' . "\n";
            $content = preg_replace("/\\[.*?\\]/", "", $post->post_content);
            echo '<meta property="og:description" content="' . stripslashes(strip_tags(jwUtils::crop_length($content, 300))) . '"/>' . "\n";
            if (function_exists('is_shop') && is_shop()) { //woocommerce
                echo '<meta property="og:type" content="product"/>' . "\n";
            } else {
                echo '<meta property="og:type" content="article"/>' . "\n";
            }

            if (has_post_thumbnail()) {
                $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'small');
                echo '<meta property="og:image" content="' . $src[0] . '"/>' . "\n";
            }
            echo '<meta property="og:site_name" content="' . get_bloginfo('name') . '"/>' . "\n";
            echo '<meta property="og:url" content="' . get_permalink() . '"/>' . "\n";
        }


        return ob_get_clean();
    }

    public static function the_post_thumbnail($size) {
        if (has_post_thumbnail()) {
            the_post_thumbnail($size);
        } else {
            if (jwOpt::get_option('post_image_featured', '0') == '1') {
                preg_match('~<img [^>]* />~', get_the_content(), $imgs);
                if (isset($imgs[0])) {
                    echo $imgs[0];
                } 
            }
        }
    }

    public static function has_post_thumbnail() {
        if (!has_post_thumbnail()) {
            preg_match('~<img [^>]* />~', get_the_content(), $imgs);
            if (isset($imgs) && count($imgs) && jwOpt::get_option('post_image_featured', '0') == '1') {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public static function get_thumbnail_link() {
        preg_match('~<img [^>]* />~', get_the_content(), $imgs);
        preg_match('~src="(.*?)"~', $imgs[0], $imgs);
        if (isset($imgs[0])) {
            return $imgs[1];
        } else {
            return false;
        }
    }

    public static function woocommerce_activate() {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        if (is_plugin_active('woocommerce/woocommerce.php')) {
            return true;
        } else {
            return false;
        }
    }

    public static function jaw_nobot_question_filter($x) {

        if (is_user_logged_in()) {
            return $x;
        }
        if (!array_key_exists('question', $_POST) || trim($_POST['question']) == '') {
            wp_die(__('Error: Please fill in the required question.', 'wp_nobot_question'));
        }
        // Verify the answer.
        if ($_POST['question'] == jwOpt::get_option('comments_antispam_answer', '2')) {
            return $x;
        }
        wp_die(__('Error: Please fill in the correct answer to the question.', 'wp_nobot_question'));
    }

}

?>
