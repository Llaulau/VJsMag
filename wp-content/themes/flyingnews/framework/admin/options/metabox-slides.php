<?php
/*
 * ID v metaboxes [fields] musí být s podtržítkem na začátku
 */


$this->metabox = array(
    "id" => "slides-metabox",
    "title" => "Slides Settings".' '. jwUtils::getHelp("slider_settings"),
    "pages" => array('slides'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "low", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => "Insert a picture using Featured Image.",
    "js" => "", //Oprional. Insert javascript
    "fields" => array()
);




$this->metabox['fields'][] = array("name" => "Text Area",
            "desc" => "Fill in an additional text for the image.",
            "id" => "_slider_textarea",
            "std" => "",
            "type" => "textarea");

$this->metabox['fields'][] = array("name" => "Image Link",
            "desc" => "Fill in the image URL. This rewrites a&nbsp;slidess link with the link you have entered.",
            "id" => "_slider_image_link",
            "std" => "",
            "type" => "text");


 $this->metabox['fields'][] = array("name" => "Link Target",
            "desc" => "Define a link target.",
            "id" => "_slider_image_target",
            "std" => 3,
	    "mod" => "small",
            "type" => "select",
            "options" => array("_blank","_top","_parent","_self"));
 
 
    $bg_images_url = get_template_directory_uri() . '/images/cat_bg_color/';
    $this->metabox['fields'][] = array("name" => "Slider Background Color",
       "desc" => "Set a background color for your slide. Choose the cross filled box to use your custom color selected in the option below.",
       "id" => "_slider_bg_color",
       "std" => "red",
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
    
    $this->metabox['fields'][] = array("name" => "Custom Background Color",
    "desc" => 'Choose a background color for your slide. Remember, that the cross option in the Slider Background Color has to be chosen.',
    "id" => "_slider_custom_bg_color",
    "std" => "#fafafa",
    "type" => "color");

    $this->metabox['fields'][] = array("name" => "Custom Text Color",
    "desc" => 'Choose a text color for your slide description. The cross option in the Slider Background Color has to be chosen.',
    "id" => "_slider_custom_font_color",
    "std" => "#000000",
    "type" => "color");    
?>
