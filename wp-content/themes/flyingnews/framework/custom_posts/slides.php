<?php

/*
 *   Create Slide post_type page width mataboxes
 *   @version        1.0
 *   @author		JaW Templates
 *   @link		http://www.jawtemplates.com
 *   @copyright	Copyright (c) JaW Templates              
 */

class jwSlidesPost extends jwCustomPost {
   
    function __construct() {
        global $post;
        
        $this->config();
        $this->metabox();
        parent::init();
        add_action('init', array(&$this, 'init'));
        add_action("manage_posts_custom_column", array(&$this, 'custom_columns'));
        add_filter("manage_edit-slides_columns", array(&$this, 'column'));
    }

    function config() {

        $this->slug = 'slides';

        $this->labels = array(
            'name' => _x('Slides', 'Slide General Name', 'jawtemplates'),
            'singular_name' => _x('Slide Item', 'Slide Singular Name', 'jawtemplates'),
            'add_new' => _x('Add New', 'Add New Slide Name', 'jawtemplates'),
            'add_new_item' => 'Add New Slide',
            'edit_item' => 'Edit Slide',
            'new_item' => 'New Slide',
            'view_item' => 'View Slide',
            'search_items' => 'Search Slide',
            'not_found' => 'Nothing found',
            'not_found_in_trash' => 'Nothing found in Trash',
            'parent_item_colon' => ''
        );

        $this->args = array(
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_position' => 5,
            'supports' => array('title',  'thumbnail'),
            'rewrite' => array('slug' => $this->slug, 'with_front' => false)
        );

        include_once  THEME_ADMIN.'/options/metabox-'.$this->slug.'.php';
       
        
    }

    function column($columns) {
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => "Title",
	    "thumb" => "Thumbnails",
            "colors" => "Color",
            "date" => "Date",
            "order" => "Order");
        return $columns;
    }

    function custom_columns($column) {
        global $post;

        switch ($column) {
            case "portfolio-tags":
                echo get_the_term_list($post->ID, 'portfolio-tag', '', ', ', '');
                break;

            case "portfolio-category":
                echo get_the_term_list($post->ID, 'portfolio-category', '', ', ', '');
                break;
            
	    case "thumb": 
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(),'slidebar-small');
                } else {
                    echo "No featured image";
                }
                break;
            case "colors":
                $color = get_post_meta(get_the_ID(), '_slider_bg_color', true);
                
                if (!is_null($color)){
                    echo '<span>'.$color.'</span>';
                }
                break;

        }
    }

    

}





?>
