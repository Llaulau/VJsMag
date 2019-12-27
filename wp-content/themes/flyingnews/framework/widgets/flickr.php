<?php

/**
 * Flickr Widget Class
 */
/* Last updated with phpFlickr 1.3.2
 *
 * This example file shows you how to call the 100 most recent public
 * photos.  It parses through them and prints out a link to each of them
 * along with the owner's name.
 *
 * Most of the processing time in this file comes from the 100 calls to
 * flickr.people.getInfo.  Enabling caching will help a whole lot with
 * this as there are many people who post multiple photos at once.
 *
 * Obviously, you'll want to replace the "<api key>" with one provided 
 * by Flickr: http://www.flickr.com/services/api/key.gne
 */
class Theme_Widget_Flickr extends jw_default_widget {

    /**
     *  Defining the widget options
     */
    protected $options = array(
        0 => array('id' => 'widget_title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Flickr photos'),
        1 => array('id' => 'username',
            'description' => 'User name',
            'type' => 'text',
            'default' => ''),
        2 => array('id' => 'num_of_photos',
            'description' => 'Number of photos',
            'type' => 'text',
            'default' => '9'),
        3 => array('id' => 'cache_time',
            'description' => 'Cache time [minutes]',
            'type' => 'text',
            'default' => '60'),
    );

    function Theme_Widget_Flickr() {
        $options = array('classname' => 'Theme_Widget_Flickr', 'description' => "Optional theme based Flickr preview image");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('Theme_Widget_Flickr', 'Flickr - J&W Widget', $options, $controls);
    }

    function widget($args, $instance) {
        echo "<article id='flickr_widget' class=\"widget widget_flickr\">";
        if ( strlen($instance['widget_title']) > 0 ) {
            echo "<h2><strong>" . $instance['widget_title'] . "</strong></h2>";
        }
        $flickr_user = $instance['username'];
        if (!empty($flickr_user)) {

            $this->get_photos($flickr_user, (int) $instance['num_of_photos'], (int) $instance['cache_time']);
        }
        echo "</article>";
    }

    private function _getOption($namespace, $name) {
        return get_option($namespace . '_' . $name);
    }

    private function _setOption($namespace, $name, $value) {
        update_option($namespace . '_' . $name, $value);
    }

    public function get_photos($user, $numOfPhotos = 9, $cachingInterval = 60) {
        $username_hash = base64_encode($user);
        $namespace = 'flickr_' . $username_hash;

        $flickr_feed = $this->_getOption($namespace, '_photos');
        $cache_dir = THEME_DIR . '/cache';


        $cache_time = $this->_getOption($namespace, '_last_actualization');
        $f = new phpFlickr("34ad6419ef5791eee34a2ce3b8e8639f");
        if ($cache_time == null || ( $cache_time + ( 60 * $cachingInterval ) ) < time() || $flickr_feed == null) {


            $person = $f->people_findByUsername($user);

            // Get the friendly URL of the user's photos
            $photos_url = $f->urls_getUserPhotos($person['id']);

            // Get the user's first 36 public photos
            $photos = $f->people_getPublicPhotos($person['id'], NULL, NULL, 36);

            $flickr_feed = $photos;
            $flickr_feed['url'] = $photos_url;

            $this->_setOption($namespace, '_photos', $flickr_feed);
            $this->_setOption($namespace, '_last_actualization', time());
        } else {
            
        }

        if (empty($flickr_feed))
            return null;
        $i = 0;
        // Loop through the photos and output the html
        if (isset($flickr_feed['photos']['photo'])){
        echo '<div class="flickr_widget_content">';
        foreach ((array) $flickr_feed['photos']['photo'] as $photo) {

            echo "<div class='flickr_photo'>";
            echo "<a href='" . $flickr_feed['url'] . $photo['id'] . "'>";
            echo "<img border='0' alt='$photo[title]' " .
            "src=" . $f->buildPhotoURL($photo, "Square") . ">";


            echo "</a>";

            echo "</div>";
            $i++;
            if ($i >= $numOfPhotos) {
                break;
            }
        }
        echo '</div>';
        }

        // return $tweetCollection;
    }

}