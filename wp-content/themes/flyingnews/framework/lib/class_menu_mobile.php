<?php

/**
 * Menu formobile devices 
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class jwMenu_mobile extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth) {
	$indent = str_repeat("\t", $depth);
	$output .= "\n$indent<a href=\"#\" class=\"flyout-toggle\"><span> </span></a><ul class=\"flyout\">\n";
    }

}

class jwMenuMobile extends Walker_Nav_Menu {

    function start_lvl(&$output, $depth = 0, $args = array()) {
	$indent = str_repeat("\t", $depth);
	$output .= "\n$indent<ul class=\"dropdown\">\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
	$indent = str_repeat("\t", $depth);
	$output .= "$indent</ul>\n";
    }

    function end_el(&$output, $item, $depth = 0, $args = array()) {
	$output .= "</li>\n";
	if (!empty($item->description)) {
	    // $output .= '<div class="desc">'. $item->description . '</div>'; 
	}
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	global $wp_query, $wpdb;
	;
	$indent = ( $depth ) ? str_repeat("\t", $depth) : '';
	$class_names = $value = '';

	if ($item->menu_order == 1) {
	    $classes[] = 'active';
	}

	$classes = empty($item->classes) ? array() : (array) $item->classes;
	$classes[] = 'menu-item-' . $item->ID;
	if (isset($args->has_children) && $args->has_children == true) {
	    $classes[] = "has-dropdown";
	}

	$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
	$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

	$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
	$id = $id ? ' id="' . esc_attr($id) . '"' : '';

	$output .= $indent . '<li' . $id . $value . $class_names . '>';

	$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
	$attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
	$attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
	$attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
	//$desc = ! empty( $item->description )        ?  $item->description : '';
	//$args->$desc;
	/* if (! empty( $item->description )){
	  $output .= '<div class="desc">'. $item->description . '</div>';

	  } */


	$item_output = $args->before;
	$item_output .= '<a' . $attributes . '>';
	$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
	$item_output .= '</a>';
	$item_output .= $args->after;

	$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

	if (!$element)
	    return;

	$id_field = $this->db_fields['id'];

	if (is_object($args[0])) {
	    $args[0]->has_children = !empty($children_elements[$element->$id_field]);
	}
	return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

}

?>