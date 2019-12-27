<?php

/**
 * Definition metabox for category
 */
$metaprductcat = array(
    "id" => "product_cat",
    "pages" => array("product_cat"),
    "fields" => array()
);

$bg_images_url = get_template_directory_uri() . '/images/cat_bg_color/';
$metaprductcat['fields'][] = array("name" => "Category Color Scheme",
    "desc" => "Choose a color you want to use for the main graphic elements of the category. Choose the cross to use your custom color selected in the option below.".' '. jwUtils::getHelp("mc_color"),
    "id" => "cat_bg_color",
    "std" => "template",
    "type" => "tiles",
    "index" => true,
    "mod" => "big",
    "options" => array(
        "template" => $bg_images_url . 'cat_template.png',
        "lightblue" => $bg_images_url . 'cat_lightblue.png',
        "blue" => $bg_images_url . 'cat_blue.png',
        "cyan" => $bg_images_url . 'cat_cyan.png',
        "darkblue" => $bg_images_url . 'cat_darkblue.png',
        "navy" => $bg_images_url . 'cat_navy.png',        
        "purple" => $bg_images_url . 'cat_purple.png',        
        "lightgreen" => $bg_images_url . 'cat_lightgreen.png',
        "lime" => $bg_images_url . 'cat_lime.png',
        "green" => $bg_images_url . 'cat_green.png',
        "darkgreen" => $bg_images_url . 'cat_darkgreen.png',        
        "yellow" => $bg_images_url . 'cat_yellow.png',
        "orange" => $bg_images_url . 'cat_orange.png',
        "red" => $bg_images_url . 'cat_red.png',
        "darkred" => $bg_images_url . 'cat_darkred.png',
        "pink" => $bg_images_url . 'cat_pink.png',
        "salmon" => $bg_images_url . 'cat_salmon.png',
        "grunge" => $bg_images_url . 'cat_grunge.png',  
        "darkgrey" => $bg_images_url . 'cat_darkgrey.png',
        "custom" => $bg_images_url . 'cat_custom.png',
    ),
);

$metaprductcat['fields'][] = array("name" => "Custom Category Color Scheme",
    "desc" => 'Choose a color you want to use for the main graphic elements of the category. The cross option in the Category Color Scheme has to be chosen withal.'.' '. jwUtils::getHelp("mc_custom_color"),
    "id" => "cat_custom_bg_color",
    "std" => "#fafafa",
    "type" => "color");

$metaprductcat['fields'][] = array("name" => "Custom Menu Text Color",
    "desc" => 'Choose a color for the menu items. The cross option in the Category Color Scheme has to be chosen withal.'.' '. jwUtils::getHelp("mc_custom_text_color"),
    "id" => "cat_custom_font_color",
    "std" => "#000000",
    "type" => "color");

$metaprductcat['fields'][]= array(
            'id' => 'cat_custom_sheet',
            'type' => 'toggle',
            'name' => 'Category Bar',
            'desc' => 'Choose whether a category bar is displayed or not.'.' '. jwUtils::getHelp("mc_cat_bar"),
            'std' => '1',
            'mod' => 'medium'
        );
$metaprductcat['fields'][]  = array(
            'id' => 'cat_custom_sheet_source',
            'type' => 'select',
            'name' => 'Category Bar Content',
            'desc' => 'Choose your preference for a content of the category bar.'.' '. jwUtils::getHelp("mc_scat_bar_content"),
            'std' => 'sorting',
            'mod' => 'small',
            'options' => array("breadcrumb"=>"breadcrumb", "sorting"=>"sorting", "nothing"=>"nothing")
        ); 

?>
