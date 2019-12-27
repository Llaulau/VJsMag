<?php

/*
  Name: Simple Breadcrumb Navigation
  Description: A simple and very lightweight breadcrumb navigation that covers nested pages and categories
  Version: 1
  Author: Christian "Kriesi" Budschedl
  Author URI: http://www.kriesi.at/
 */

/*
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class jwBreadcrumb {

    var $options;

    function __construct() {
        $this->options = array(//change this array if you want another output scheme
            'before' => '',
            'after' => '',
            'delimiter' => ''
        );

        $markup = $this->options['before'] . $this->options['delimiter'] . $this->options['after'];

        global $post;
        echo '<span class="breadcrumb" itemprop="breadcrumb"><a href="' . home_url() . '" >';
        echo __('Home','jawtemplates');
        echo "</a>";
        if (!is_front_page()) {
            echo $markup;
        }
        $output = $this->simple_breadcrumb_case($post);
        
        if (is_page() || is_single()) {
            echo '<a href="'.  get_permalink().'">'.jwUtils::crop_length(get_the_title(),50).'</a>';
        } else {
            echo $output;
        }
        echo "</span>";
    }

    function simple_breadcrumb_case($der_post) {
        $karma_blog_page = get_option('ka_blogpage');
        $karma_blog_title = get_option('ka_blogtitle');
        $karma_404_title = get_option('ka_404title');
        $karma_searchpage_title = get_option('ka_results_title');


        global $post, $blog_page;
        $markup = $this->options['before'] . $this->options['delimiter'] . $this->options['after'];
        if (is_page()) {
            
            if ($der_post->post_parent) {
                $my_query = get_post($der_post->post_parent);
                $this->simple_breadcrumb_case($my_query);
                $link .= '<a href="';
                $link .= get_permalink($my_query->ID);
                $link .= '" itemprop="url">';
                $link .= '<span itemprop="title">' . get_the_title($my_query->ID) . '</span></a>' . $markup;
                echo $link;
            }
            return;
        }
        
       if (is_single() && (!function_exists('is_product') || (function_exists('is_product') && !is_product()))) {

            if (is_attachment()) {
                return;
            }

            $category = get_the_category();
            if (is_attachment()) {

                $my_query = get_post($der_post->post_parent);
                $category = get_the_category($my_query->ID);
                $ID = $category[0]->cat_ID;
                
                echo get_category_parents($ID, TRUE, $markup, FALSE);
              
                previous_post_link("%link $markup");
            } else {
               
                 $cats = get_the_category(); 
                if(isset($cats[0])){
                    $category = $cats[0]->name;
                    $cat_id = $cats[0]->term_id;

                    if (sizeof($category) > 0 && $category != ''){

                        echo get_category_parents($cat_id, TRUE, $markup, FALSE); 
                    }
                }
                
            }

            return;
        }
        


        if (is_category()) {
         

            $cat_id = get_query_var('cat');
            $category =  get_cat_name($cat_id);
            if (sizeof($category) > 0 && $category != ''){
                echo get_category_parents($cat_id, TRUE, $markup, FALSE); 
               return;
            }
        }
        if(function_exists('is_product') && (is_product_category() || is_product())){
            $terms = get_the_terms(get_the_ID() , 'product_cat' );
            if(isset($terms) && is_array($terms) && sizeof($terms)>0){
                $terms = array_shift(array_values($terms));
            
                if(!empty($terms)){  
                   $parent  = get_term_by( 'id', $terms->term_id, 'product_cat');
                   // climb up the hierarchy until we reach a term with parent = '0'
                   $term_parent[] = $parent;
                   if(isset($parent->parent) && sizeof($parent->parent)>0){
                       while ($parent->parent != '0'){
                            $parent = get_term_by( 'id', $parent->parent, 'product_cat'); 
                            $term_parent[] = $parent;
                        }
                        $term_parent = array_reverse($term_parent);
                        foreach((array) $term_parent as $trm){  
                            echo '<a href="'.get_term_link( $trm, 'product_cat' ).'">'.($trm->name ).'</a>';
                        }
                   }            
                }
             }
        }

        if (is_author()) {
            $curauth = get_user_by('id',get_query_var('author'));
            return "Author: " . $curauth->nickname;
        }
        if (is_tag()) {
            return "Tag: " . single_tag_title('', FALSE);
        }

        if (is_404()) {
            return $karma_404_title;
        }

        if (is_home()) {
            return $karma_blog_title;
        }

        if (is_search()) {
            return $karma_searchpage_title;
        }

        if (is_year()) {
            return get_the_time('Y');
        }

        if (is_month()) {
            $k_year = get_the_time('Y');
            echo "<a href='" . get_year_link($k_year) . "'>" . $k_year . "</a>" . $markup;
            return get_the_time('F');
        }

        if (is_day() || is_time()) {
            $k_year = get_the_time('Y');
            $k_month = get_the_time('m');
            $k_month_display = get_the_time('F');
            echo "<a href='" . get_year_link($k_year) . "'>" . $k_year . "</a>" . $markup;
            echo "<a href='" . get_month_link($k_year, $k_month) . "'>" . $k_month_display . "</a>" . $markup;
            return get_the_time('jS (l)');
        }
    }

}

?>