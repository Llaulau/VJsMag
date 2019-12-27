<?php

/**
 * jwSocial_widget
 * 
 * 
 */
class social_vars {

    public $followers;
    public $display_name;
    public $url;
    public $img_url;
    public $error;

}

class jwSocial_widget extends jw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'widget_title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Social'),
        1 => array('id' => 'g_username',
            'description' => 'Google+ page ID',
            'type' => 'text',
            'default' => ''),
        2 => array('id' => 'tw_username',
            'description' => 'Twitter username',
            'type' => 'text',
            'default' => ''),
        3 => array('id' => 'fb_username',
            'description' => 'Facebook page ID',
            'type' => 'text',
            'default' => ''),
        /*   4 => array('id' => 'flickr_username',
          'description' => 'Flickr username',
          'type' => 'text',
          'default' => ''), */
        4 => array('id' => 'youtube_username',
            'description' => 'Youtube username',
            'type' => 'text',
            'default' => ''),
        5 => array('id' => 'vimeo_username',
            'description' => 'Vimeo chanel name',
            'type' => 'text',
            'default' => ''),
        6 => array('id' => 'rss_link',
            'description' => 'RSS link',
            'type' => 'text',
            'default' => ''),
        7 => array('id' => 'cache_time',
            'description' => 'Cache time [minutes]',
            'type' => 'text',
            'default' => '60'),
    );

    function jwSocial_widget() {
        $options = array('classname' => 'jwSocial_widget', 'description' => "Theme-based icon links to your profiles on the most common social networks");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('jwSocial_widget', 'Social - J&W Widget', $options, $controls);
    }

    function widget($args, $instance) {

        if (!empty($instance)) {
            echo "<article id='social_widget' class='row widget'>";

            if (!empty($instance['widget_title'])) {
                echo "<h2><strong>" . $instance['widget_title'] . "</strong></h2>";
            }

            $social = array(
                "google" => array("var" => $instance['g_username'],
                    "type" => "user",
                ),
                "twitter" => array("var" => $instance['tw_username'],
                    "type" => "user",
                ),
                "facebook" => array("var" => $instance['fb_username'],
                    "type" => "user",
                ),
                /* "flickr"=>array("var" => $instance['flickr_username'], 
                  "type" => "user",
                  ), */
                "youtube" => array("var" => $instance['youtube_username'],
                    "type" => "user",
                ),
                "vimeo" => array("var" => $instance['vimeo_username'],
                    "type" => "user",
                ),
                "rss" => array("var" => $instance['rss_link'],
                    "type" => "link",
                    "text" => "Suscribe",
                    "subtext" => "To RSS Feed"
                ),
            );

            $social_active = array();
            foreach ($social as $service => $vars) {
                if (!empty($vars["var"])) {
                    $social_active[$service] = $social[$service];
                }
            }

            $row = 0;
            $class_last = "";
            foreach ($social_active as $service => $vars) {
                $class_last = "";
                if (count($social_active) % 2 == 0) {
                    if (count($social_active) - $row <= 2) {
                        $class_last = "last-social-item";
                    }
                } else {
                    if (count($social_active) - $row < 2) {
                        $class_last = "last-social-item";
                    }
                }
                if ($vars["type"] == 'user') {
                    if (!empty($vars["var"])) {

                        $username_hash = base64_encode($vars["var"]);
                        $namespace = $service . '_' . $username_hash;

                        $service_vars = unserialize($this->_getOption($namespace, '_followers'));
                        $cache_time = $this->_getOption($namespace, '_last_actualization');

                        if ($cache_time == null || ( $cache_time + ( 60 * $instance['cache_time'] ) ) < time() || $service_vars == null) {
                            $service_vars = $this->{$service . "_followers_counter"}($vars["var"]);
                            if ($service_vars !== null) {
                                $this->_setOption($namespace, '_vars', serialize($service_vars));
                                $this->_setOption($namespace, '_last_actualization', time());
                            } else {
                                $service_vars = unserialize($this->_getOption($namespace, '_followers'));
                            }
                        }


                        if (isset($service_vars)) {
                            echo "<div class='social " . $service . " " . $class_last . "'>";
                            echo '<div class="social-icons"></div>';
                            if (isset($service_vars->error)) {
                                echo '<input type="hidden" value="' . $service_vars->error . '">';
                            }
                            echo "<a href='" . $service_vars->url . "' class='" . $vars["type"] . "'>";
                            echo $service_vars->followers . "<br>";
                            echo "<span>";
                            switch ($service) {
                                case "google": _e("followers", "jawtemplates");
                                    break;
                                case "twitter": _e("followers", "jawtemplates");
                                    break;
                                case "facebook": _e("fans", "jawtemplates");
                                    break;
                                case "flickr": _e("photos", "jawtemplates");
                                    break;
                                case "youtube": _e("suscribers", "jawtemplates");
                                    break;
                                case "vimeo": _e("followers", "jawtemplates");
                                    break;
                            }
                            echo "</span>";
                            echo "</a>";
                            //echo "<div class='clear'></div>";
                            echo "</div>";
                            //echo "<div class='clear'></div>";
                        }
                    }
                } else {
                    if (!empty($vars["var"])) {
                        echo "<div class='social " . $service . " " . $class_last . "'>";
                        echo '<div class="social-icons"></div>';
                        echo "<a href='" . $vars["var"] . "' class='" . $vars["type"] . "'>";
                        echo "<span>" . $vars["text"] . "</span>";
                        echo "<br>";
                        echo $vars["subtext"];
                        echo "</a>";

                        echo "</div>";
                    }
                }

                $row++;
            }
            echo "<div class='clear'></div>";
            echo "</article>";
        }
    }

    /*
     *  Práce s wp_opt
     */

    private function _getOption($namespace, $name) {
        return get_option($namespace . '_' . $name);
    }

    private function _setOption($namespace, $name, $value) {
        update_option($namespace . '_' . $name, $value);
    }

    /*
     * ************************** Google plus pages **************************
     */

    public function google_followers_counter($username) {

        $api_key = "AIzaSyDQawavpg46SmVMRFtdPl1YKzSDQc0UI6U";

        $reponse = wp_remote_retrieve_body(wp_remote_request('https://www.googleapis.com/plus/v1/people/' . $username . '?key=' . $api_key . '&alt=json ', array('method' => 'GET')));


        if ($reponse instanceof WP_Error)
            return null;

        $data = json_decode($reponse);

        if (isset($data->error)) {
            return null;
        }

        if ($data === null)
            return null;

        $google_vars = new social_vars();
        if (isset($data->plusOneCount)) {
            $google_vars->followers = $data->plusOneCount;
            $google_vars->display_name = $data->displayName;
            $google_vars->url = $data->url;
            $google_vars->img_url = $data->image->url;
            return $google_vars;
        } else {
            return null;
        }
    }

    /*
     * ************************* Twitter **************************
     */

    public function twitter_followers_counter($username) {




        require_once THEME_FRAMEWORK_DIR . '/widgets/OAuth/OAuth.php';
        require_once THEME_FRAMEWORK_DIR . '/widgets/OAuth/twitteroauth.php';

        //$username = fOpt::Get('twitter', 'username');
        $username_hash = base64_encode($username);
        $namespace = 'twt_' . $username_hash;

        $twitter_feed = $this->_getOption($namespace, 'rss_feed');
        if ($twitter_feed != null)
            $twitter_feed = unserialize($twitter_feed);


        $connection = new TwitterOAuth(jwOpt::get_option('tw_consumer_id', ''), jwOpt::get_option('tw_consumer_secret', ''), jwOpt::get_option('tw_access_id', ''), jwOpt::get_option('tw_access_secret', ''));
        $search_feed3 = "https://api.twitter.com/1.1/users/lookup.json?screen_name=". $username;
        $reponse = $connection->get($search_feed3);


 
        $tw_vars = new social_vars();
       
        if ($reponse instanceof WP_Error)
            return null;

        if (isset($reponse->errors)) {
            $tw_vars->followers = "";//"<strong>ERROR</strong><br>";
            switch ($reponse->errors[0]->code) {
                case 32: $tw_vars->followers .= 'Please check setting Twitter API in Theme Options -> Advanced?';
                    break;
                case 34: $tw_vars->followers .= 'Your user name is probably wrong<br>Please check it';
                    break;
                case 88: $tw_vars->followers .= 'Rate limit exceeded, please check "Actualize every X minutes" item in Twitter J&W Widget. Recommended value is 60.';
                    break;
                case 215: $tw_vars->followers .= 'Don`t you have set Twitter API in Theme Options -> Advanced?';
                    break;
                default: $tw_vars->followers .= 'Your user name is probably wrong<br>Please check it';
                    break;
            }
            $tw_vars->display_name = ""; 
            $tw_vars->url = "https://twitter.com/";
            $tw_vars->img_url = '';
            return $tw_vars;
        }

        if (isset($reponse)) {
            $tw_vars->followers = strval($reponse[0]->followers_count);
            $tw_vars->display_name = "@" . strval($reponse[0]->screen_name); 
            $tw_vars->url = "https://twitter.com/" . strval($reponse[0]->screen_name);
            $tw_vars->img_url = strval($reponse[0]->profile_image_url_https);
            return ( $tw_vars );
        } else {
            return null;
        }
    }

    /*
     * ************************** Facebook pages **************************
     */

    public function facebook_followers_counter($username) {

        $reponse = wp_remote_retrieve_body(wp_remote_request('http://graph.facebook.com/' . $username, array('method' => 'GET')));

        if ($reponse instanceof WP_Error)
            return null;


        $data = json_decode($reponse);

        if (isset($data->error)) {
            return null;
        }

        if ($data === null)
            return null;

        $fb_vars = new social_vars();
        $fb_vars->followers = $data->likes;
        $fb_vars->display_name = $data->name;
        $fb_vars->url = $data->link;
        $fb_vars->img_url = isset($data->cover) ? $data->cover->source : '';
        return $fb_vars;
    }

    /*
     * ************************** Flickr **************************
     */

    public function flickr_followers_counter($username) {

        $fli = new phpFlickr("0a0db584c42d72116855176005babfe6");
        $person = $fli->people_findByUsername($username);
        $photos = $fli->people_getPublicPhotos($person['id'], NULL, NULL, 36);


        $fl_vars->followers = $photos['photos']['total'];
        $fl_vars->display_name = $username;
        $fl_vars->url = $fli->urls_getUserProfile($person['id']);
        return $fl_vars;
    }

    /*
     * ************************** youtube **************************
     */

    public function youtube_followers_counter($username) {
        $reponse = wp_remote_retrieve_body(wp_remote_request('http://gdata.youtube.com/feeds/api/users/' . $username . '?alt=json', array('method' => 'GET')));
        if ($reponse instanceof WP_Error)
            return null;

        $data = json_decode($reponse);

        if ($data === null)
            return null;

        $yt_vars = new social_vars();
        $yt_vars->followers = $data->entry->{'yt$statistics'}->subscriberCount;
        $yt_vars->display_name = $data->entry->title->{'$t'};
        $yt_vars->url = $data->entry->link[0]->href;
        $yt_vars->img_url = $data->entry->{'media$thumbnail'}->url;
        return $yt_vars;
    }

    /*
     * ************************** Vimeo **************************
     */

    public function vimeo_followers_counter($username) {

        $reponse = wp_remote_retrieve_body(wp_remote_request('http://vimeo.com/api/v2/channel/' . $username . '/info.json', array('method' => 'GET')));
        if ($reponse instanceof WP_Error)
            return null;

        $data = json_decode($reponse);

        if ($data === null)
            return null;

        $v_vars = new social_vars();
        $v_vars->followers = $data->total_subscribers;
        $v_vars->display_name = $data->creator_display_name;
        $v_vars->url = $data->url;
        $v_vars->img_url = $data->logo;
        return $v_vars;
    }

}

