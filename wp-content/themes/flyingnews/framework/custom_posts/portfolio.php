<?php

/*
 *   Create Portfolio post_type page width mataboxes
 *   @version        1.0
 *   @author		JaW Templates
 *   @link		http://www.jawtemplates.com
 *   @copyright	Copyright (c) JaW Templates              
 */

class jwPortfolioPost extends jwCustomPost {

    function __construct() {
        $this->config();
        $this->metabox();
        parent::init();
        add_action('init', array(&$this, 'init'));
        add_action("manage_posts_custom_column", array(&$this, 'custom_columns'));
        add_filter("manage_edit-portfolio_columns", array(&$this, 'column'));
        
    }

    function config() {

        $this->slug = 'portfolio';


        $this->labels = array(
            'name' => _x('Portfolio', 'Portfolio General Name', 'jawtemplates'),
            'singular_name' => _x('Portfolio Item', 'Portfolio Singular Name', 'jawtemplates'),
            'add_new' => _x('Add New', 'Add New Portfolio Name', 'jawtemplates'),
            'add_new_item' => 'Add New Portfolio',
            'edit_item' => 'Edit Portfolio',
            'new_item' => 'New Portfolio',
            'view_item' => 'View Portfolio',
            'search_items' => 'Search Portfolio',
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
            'menu_position' => 4,
            'supports' => array('title', 'editor','page-attributes','thumbnail'),
            'rewrite' => array('slug' => $this->slug, 'with_front' => false)
        );



        $this->taxonomy = array(
            "hierarchical" => true,
            "label" => 'Portfolio Categories',
            "singular_label" => 'Portfolio Categories',
            "rewrite" => true);

        include  THEME_ADMIN.'/options/metabox-'.$this->slug.'.php';
        
        
        
    }

    function column($columns) {
        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => "Titled",
            "thumbnail" => "Thumbnail",
            "portfolio-category" => "Portfolio Categories",
            "date" => "Date",
            "order" => "Order"  );
        return $columns;
    }

    function custom_columns($column) {
        global $post;

        switch ($column) {
           

            case "thumbnail":
               
             if (has_post_thumbnail()) 
                     the_post_thumbnail('slidebar-small');  
              else 
                    echo "No featured image.";

                break;
           case "order":
               
               echo $post->menu_order;
                break;
         
        }
    }


}



$jwPortfolio = new jwPortfolioPost();
?>
