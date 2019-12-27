<?php

/**
 *  Base menu class
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class jwMenu_classic extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<a href=\"#\" class=\"flyout-toggle\"><span> </span></a><ul class=\"flyout\">\n";
    }

}

class jwMenu extends Walker_Nav_Menu {

    protected static $menu_id = 0;
    protected static $menu_desc = null;

    function start_lvl(&$output, $depth = 0, $args = array()) {


        if ($depth == 0) {

            $menu_type = jwOpt::get_option('menu_type', 'custom', 'menus', jwMenu::$menu_id);

            if ($menu_type == 'page') {

                $item_id = get_post_meta(jwMenu::$menu_id, '_menu_item_object_id', true);
                $item_bg_color = get_post_meta($item_id, 'post_bg_color', true);
            } else {
                $item_id = jwOpt::get_option('menu_id', '0', 'menus', jwMenu::$menu_id);
                $item_bg_color = jwOpt::get_option('cat_bg_color', 'template', 'category', $item_id);
            }


            if ($item_bg_color == "custom") {
                $item_bg_color = $menu_type . "_" . $item_bg_color . "_menu_" . $item_id;
            }



            $menu_custom_desc_type = jwOpt::get_option('menu_custom_desc_type', 'menu_custom_desc_type_html', 'menus', jwMenu::$menu_id);

            $post_id = jwOpt::get_option('menu_cutom_post_id', '0', 'menus', jwMenu::$menu_id);
            $cat_id = jwOpt::get_option('menu_cutom_cat_id', '0', 'menus', jwMenu::$menu_id);
            $output .= "<div class=\"submenu-content dropdown " . $item_bg_color . "\">";

            // Menu item description
            if (!empty(jwMenu::$menu_desc)) {
                $output .= "<div class=\"description\">" . jwMenu::$menu_desc . "</div>\n";
                jwMenu::$menu_desc = "";
            }
            // Menu item description
            // Menu BOX
            $output .= "<div class=\"menu-box\">\n";

            // Pokud je nastaveny post - zobrazime ho
            if ($menu_custom_desc_type == 'menu_custom_desc_type_post') {

                if ($post_id != 0) {

                    $post = get_post($post_id);
                    $img = get_the_post_thumbnail($post_id, array(220, 220));
                    $href = get_permalink($post_id);

                    $output .= "<div class=\"menu-info\">\n";

                    //post title
                    $output .= "<h2><a href=\"" . $href . "\">" . $post->post_title . "</a></h2>\n";

                    //post image + post content - TO DO potreba udelat lepsi nacitani/zkracovani
                    $output .= "<p><a href=\"" . $href . "\">" . $img . "</a>" . do_shortcode(stripslashes(strip_tags(mb_substr($post->post_content, 0, 120)))) . "</p>\n";

                    // TO DO - read more link
                    //$output .= "<a href=\"" . $href . "\">";
                    //$output .= "Read more";
                    //$output .= "</a>";
                    $output .= "</div>\n";
                }
            } else if ($menu_custom_desc_type == 'menu_custom_desc_type_cat') {
                if ($cat_id != 0) {

                    $latest_cat_post = new WP_Query(array('posts_per_page' => 1, 'category__in' => array($cat_id)));
                    if (isset($latest_cat_post->posts[0]->ID)) {
                        $post_id = $latest_cat_post->posts[0]->ID;
                        $post = get_post($post_id);
                        $img = get_the_post_thumbnail($post_id, array(220, 220));
                        $href = get_permalink($post_id);

                        $output .= "<div class=\"menu-info\">\n";

                        //post title
                        $output .= "<h2><a href=\"" . $href . "\">" . $post->post_title . "</a></h2>\n";

                        //post image + post content - TO DO potreba udelat lepsi nacitani/zkracovani
                        $output .= "<p><a href=\"" . $href . "\">" . $img . "</a>" . do_shortcode(stripslashes(strip_tags(mb_substr($post->post_content, 0, 120)))) . "</p>\n";

                        // TO DO - read more link
                        //$output .= "<a href=\"" . $href . "\">";
                        //$output .= "Read more";
                        //$output .= "</a>";
                        $output .= "</div>\n";
                    }
                }
            } else {
                $menu_custom_html = jwOpt::get_option('menu_custom_html', null, 'menus', jwMenu::$menu_id);
                if (strlen($menu_custom_html) > 0) {
                    $output .= "<div class=\"menu-info custom-html\">\n";

                    $output .= do_shortcode(stripslashes($menu_custom_html));

                    $output .= "</div>\n";
                }
            }
            // zobrazeni postu


            $output .= "<div class=\"sub-menu\">\n";    // submenu
            $output .= "<ul class=\"dropdown\">\n";     // submenu
        } else {
            $indent = str_repeat("\t", $depth);
            $output .= "<ul class=\"dropdown\">\n";
        }
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        if ($depth == 0) {

            $indent = str_repeat("\t", $depth);

            $output .= "$indent</ul>\n";    // end submenu
            $output .= "</div>\n";   // end div submenu

            $output .= "<div class=\"sub-sub-menu\"></div>"; // sub-sub menu wrapper
            //$output .= "<div style=\"clear: both\"></div>";
            $output .= "</div>";     // end menu box 
            $output .= "<div style=\"clear: both\"></div>";
            $output .= "</div>";     // end dropdown
            //$output .= "<div style=\"clear: both\"></div>";
        } else {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "</li>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {


        global $wp_query, $wpdb, $jwmenu;


        $indent = ( $depth ) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        if ($item->menu_order == 1) {
            //$classes[] = 'active';
        }
        $ie_popup = '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        if (isset($args->has_children) && $args->has_children == true) {
            $classes[] = "has-dropdown";
            $ie_popup = ' aria-haspopup="true"';
        } else {
            $classes[] = "no-dropdown";
        }

        $cat_id = jwOpt::get_option('menu_id', '0', 'menus', $item->ID);
        $menu_type = jwOpt::get_option('menu_type', 'custom', 'menus', $item->ID);
        $cat_bg_color = jwOpt::get_option('cat_bg_color', 'template', 'category', $cat_id);

        if ($depth < 1 && $menu_type == "category") {
            if ($cat_bg_color == "custom" && $menu_type == "category") {
                $cat_bg_color = "category_" . $cat_bg_color . "_menu_" . $cat_id;
            }
            if ($item->current == 1) {
                $classes[] = 'active_' . $cat_bg_color;
            }
            $classes[] = $cat_bg_color;
        } else if ($depth < 1 && $menu_type == "page") {
            $meta_page = get_post_meta($item->object_id);
            if (!isset($meta_page['post_bg_color'][0]) || empty($meta_page['post_bg_color'][0])) {
                $meta_page['post_bg_color'][0] = 'template';
            }
            if ($meta_page['post_bg_color'][0] == "custom") {
                $classes[] = 'custom_menu_page_' . $item->object_id;
            } else {
                $classes[] = $meta_page['post_bg_color'][0];
            }
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . $ie_popup . ' >';



        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        //$desc = ! empty( $item->description )        ?  $item->description : '';
        //$args->$desc;
        /* if (! empty( $item->description )){
          $output .= '<div class="desc">'. $item->description . '</div>';

          } */

        $item_output = "";

        if (is_array($args)) {
            $item_output = $args['before'];
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args['link_before'] . apply_filters('the_title', $item->title, $item->ID) . $args['link_after'];
            $item_output .= '</a>';
            $item_output .= $args['after'];
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        jwMenu::$menu_id = $item->ID;

        if (!empty($item->description)) {

            jwMenu::$menu_desc = $item->description;
        } else {
            jwMenu::$menu_desc = "";
        }
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {



        if (!$element)
        //$output = "";
            return;

        $id_field = $this->db_fields['id'];

        if (is_object($args[0])) {
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);
            $args[0]->id_menu = $element->ID;
        }
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

}

?>
