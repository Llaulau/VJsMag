<?php

$this->metabox = array(
    "id" => "testimonial-metabox",
    "title" => "General Settings",
    "pages" => array('testimonial'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "low", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => "",
    "js" => "", //Oprional. Insert javascript
    "fields" => array()
);



$this->metabox['fields'][] = array(
    "name" => "Page Layout",
    "desc" => "",
    "id" => "_layout",
    "std" => "left",
    "type" => "layout",
    "extend" => "_sidebar",
    "options" => array(
        'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
        'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
        'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);


$this->metabox['fields'][] = array(
    'id' => '_sidebar_left',
    'type' => 'sidebar_select',
    'name' => 'Blog Left Sidebars',
    'desc' => 'Add custom sidebars.',
    'std' => null,
    'mod' => 'medium'
);

$this->metabox['fields'][] = array(
    'id' => '_sidebar_right',
    'type' => 'sidebar_select',
    'name' => 'Blog Right Sidebars',
    'desc' => 'Add custom sidebars.',
    'std' => null,
    'mod' => 'medium'
);
?>
