<?php

$js_portfolio_video = "jQuery(window).ready(function($){
   
if(jQuery('#_portfolio_type').val() == 'video'){
    prepinac_portfolio(true);
}else if((jQuery('#_portfolio_type').val() == 'link')  || (jQuery('#_portfolio_type').val() == 'doc')){
    prepinac_portfolio(false,true);
}else{
    prepinac_portfolio();
}

jQuery('#_portfolio_type').change(function() {
    if(jQuery('#_portfolio_type').val() == 'video'){
       prepinac_portfolio(true); 
    }else if((jQuery('#_portfolio_type').val() == 'link')  || (jQuery('#_portfolio_type').val() == 'doc')){
       prepinac_portfolio(false,true); 
    }else{
        prepinac_portfolio();
    }
  
});

function prepinac_portfolio(vid=false,lnk=false){
    switch(vid){
    case false: $('#section-_portfolio_video_link').hide(300);
        break; 
    case true: $('#section-_portfolio_video_link').show(300);
        break;
    }
     switch(lnk){
    case false: $('#section-_portfolio_link').hide(300);
            $('#section-_portfolio_link_target').hide(300);
        break; 
    case true: $('#section-_portfolio_link').show(300);
            $('#section-_portfolio_link_target').show(300);
        break;
      
    }
}

});";



$this->metabox = array(
    "id" => "porfolio-metabox",
    "title" => "Portfolio options",
    "pages" => array('portfolio'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "low", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => "",
    "js" => $js_portfolio_video, //Oprional. Insert javascript
    "fields" => array()
);

$this->metabox['fields'][] = array(
    "name" => "Page Layout",
    "desc" => "Choose one of the preset layouts for your page.".' '. jwUtils::getHelp("port_layout"),
    "id" => "_layout",
    "std" => 'default',
    "type" => "layout",
    "extend" => "_sidebar",
    "options" => array(
                'default' => ADMIN_DIR . 'assets/images/default.gif',
                'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
                'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
                'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);

$this->metabox['fields'][] = array(
            'id' => '_sidebar_left',
            'type' => 'sidebar_select',
            'name' => 'Blog Left Sidebars',
            'desc' => 'Here you can add some optional sidebars.',
            'std' => '',
            'mod' => 'medium'
        ); 
 
$this->metabox['fields'][] = array(
            'id' => '_sidebar_right',
            'type' => 'sidebar_select',
            'name' => 'Blog Right Sidebars',
            'desc' => 'Here you can add some optional sidebars.',
            'std' => '',
            'mod' => 'medium'
        ); 



$this->metabox['fields'][] = array(
            'id' => '_portfolio_type',
            'type' => 'select',
            'name' => "Type",
            'desc' => "Choose your portfolio post type.".' '. jwUtils::getHelp("port_type"),
            'std' => 'desc',
            'mod' => 'small',
            'options' => array("image"=>"Image", "video"=>"Video" , "doc"=>"Doc", "link"=>"Link")
        );

$this->metabox['fields'][] = array("name" => "Video src",
            "desc" => "URL video (youtube, vimeo). Create a thumbnail using Featured Image.",
            "id" => "_portfolio_video_link",
            "std" => "",
            "type" => "text");

$this->metabox['fields'][] = array("name" => "URL Link (optional)",
            "desc" => "Insert the link on which you want to redirect a user after clicking.",
            "id" => "_portfolio_link",
            "std" => "",
            "type" => "text");





 $this->metabox['fields'][] = array("name" => "Link Target",
            "desc" => "Define a link target.",
            "id" => "_portfolio_link_target",
            "std" => "three",
            "type" => "select",
     
            "options" => array("_blank","_top","_parent","_self"));
 




?>
