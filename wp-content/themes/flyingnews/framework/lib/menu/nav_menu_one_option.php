<?php

/**
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo check permition for dynamic file 
 */


/**
 * Holds all important informations about the one navigation menu option. 
 * This class is just a data structure, and holds constants about
 * the types.
 *
 */
class nav_menu_one_option {
	const TYPE_TEXT = 'text';
	const TYPE_TEXT_AREA = 'textarea';
	const TYPE_CHECK = 'check';
	const TYPE_SELECT = 'select';
        const TYPE_POST_SELECT = 'post_select';
        const TYPE_CAT_POST_SELECT = 'cat_select';
	
	const SIZE_THIN = 'thin';		// 1/2 of the area
	const SIZE_WIDE = 'wide';		// full area
	
	public $itemId = null;				// position of the item in the menu
	public $name = null;				// option unique identificator, dont use spaces
	public $title = null;				// Title of the option 
	public $type = null;				// type, one of the above mentioned
	public $value = null;				// default value
	
	public $values = null;				// [optional] array( array('name'='value'), array('name'=>'value') ) FOR SELECT
	public $description = null;			// [optional] item description
	public $size = null;				// [optional] THIN / WIDE
}