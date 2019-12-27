<?php

/**
 *  Defines metaboxes for pages and posts
 *  Warning id must prefix "_"  e.g.: id="_layout"
 * 
 * 
 */


$js_post_type = "jQuery(window).ready(function($){
   
if($('input:radio[name=post_format]:checked').val() == 'video'){
    prepinac_video(true);
    prepinac_audio(false);
}else if($('input:radio[name=post_format]:checked').val() == 'audio'){
    prepinac_audio(true);
    prepinac_video(false);
}else{
    prepinac_video(false);
    prepinac_audio(false);
}

jQuery('.post-format').click(function() {
    prepinac_video(false);
    prepinac_audio(false);
});

jQuery('#post-format-video').click(function() {
     prepinac_video(true);
     prepinac_audio(false);
});

jQuery('#post-format-audio').click(function() {
     prepinac_video(false);
     prepinac_audio(true);
});

function prepinac_video(sw){
    switch(sw){
    case true: $('#section-_post_video_link').show(300);
        break;
    case false: $('#section-_post_video_link').hide(300);
        break;   
    }
}

function prepinac_audio(sw){
    switch(sw){
    case true: $('#section-audio_mp3').show(300);
               $('#section-audio_ogg').show(300);
        break;
    case false: $('#section-audio_mp3').hide(300);
                $('#section-audio_ogg').hide(300);
        break;   
    }
}

});";

$metapost = array(
    "id" => "jawmetabox",
    "title" => "General Settings",
    "pages" => array('post'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "high", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => null,
    "js" => $js_post_type, //Oprional. Insert javascript
    "fields" => array()
);



$metapost['fields'][] = array(
    "name" => "Page Layout",
    "desc" => "Choose one of the preset layouts for your page.".' '. jwUtils::getHelp("mpo_layout"),
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

$metapost['fields'][] = array(
            'id' => '_sidebar_left',
            'type' => 'sidebar_select',
            'name' => 'Blog Left Sidebars',
            'desc' => 'Here you can add some optional sidebars.',
            'std' => '',
            'mod' => 'medium'
        ); 
 
$metapost['fields'][] = array(
            'id' => '_sidebar_right',
            'type' => 'sidebar_select',
            'name' => 'Blog Right Sidebars',
            'desc' => 'Here you can add some optional sidebars.',
            'std' => '',
            'mod' => 'medium'
        ); 


$metapost['fields'][] = array(
            'id' => '_use_featured',
            'type' => 'select',
            'name' => "Use Featured Image or Gallery or Video in post",
            'desc' => "Use Featured Image or Gallery (if post-type is 'gallery') on the top of the post page".' '. jwUtils::getHelp("mpo_featured"),
            "std" => "-1",
            "options" => array("-1"=>"by temlate","0"=>"off","1"=>"on")
        );

$metapost['fields'][] = array(
            'id' => 'post_custom_sheet',
            'type' => 'select',
            'name' => "Navigation Bar",
            'desc' => 'Choose whether a Post bar with a breadcrumb navigation and search is displayed or not.'.' '. jwUtils::getHelp("mpo_bar"),
            "std" => "-1",
            "options" => array("-1"=>"by temlate","0"=>"off","1"=>"on")
             
        );

$metapost['fields'][] = array(
            'id' => '_custom_sort1',
            'type' => 'text',
            'name' => "Custom sort 1",
            'desc' => "Used for custom sorting. (decimal number). Turn it on in Theme Options -> Blog -> Custom sorting",
            "std" => ""
        );
$metapost['fields'][] = array(
            'id' => '_custom_sort2',
            'type' => 'text',
            'name' => "Custom sort 2",
            'desc' => "Used for custom sorting. (decimal number). Turn it on in Theme Options -> Blog -> Custom sorting",
            "std" => ""
        );

$metapost['fields'][] = array("name" => "Video src",
            "desc" => "URL video (youtube, vimeo). <b>Use Featured Image for a preview.</b>",
            "id" => "_post_video_link",
            "std" => "",
            
            "type" => "text");

/*$metapost['fields'][] = array("name" => "Audio MP3",
            "desc" => "Upload audio using the native media uploader, or define the URL directly",
            "id" => "audio_mp3",
            "std" => "",
            "type" => "media");

$metapost['fields'][] = array("name" => "Audio OGG",
            "desc" => "Upload audio using the native media uploader, or define the URL directly",
            "id" => "audio_ogg",
            "std" => "",
            "type" => "media");*/





if( jwUtils::woocommerce_activate() == true){
$metapost['fields'][] = array(
            'id' => 'post_connect_woo',
            'type' => 'multidropdown',
            'name' => 'Associate product',
            'desc' => '',
            "std" => array(),
            "page" => null,
            "mod" => 'big',
            "chosen" => "true",
            "target" => 'products',
            "prompt" => "Choose products..",
        );
}





$js = "jQuery(function() {

var sel = ('#section-_layout .of-radio-img-selected'); 
if (jQuery(sel).val() == 'full' || typeof sel === 'undefined'){
  jQuery('#section-_left_sidebar').hide();
  jQuery('#section-_right_sidebar').hide();
}




 /********  Vypinac textoveho editoru.. (Pri zobrazeni se rozbije)********* 
if(jQuery('#page_template').val() == 'page-blog.php'){
    prepinac_blog(true);
}else{
    prepinac_blog();
}

jQuery('#page_template').change(function() {
    if(jQuery('#page_template').val() == 'page-blog.php'){
       prepinac_blog(true); 
    }else{
        prepinac_blog();
    }
  
});

function prepinac_blog(blog=false){
    switch(blog){
    case false: jQuery('#postdivrich').show(300);
                jQuery('#postdivrich').width(100);
        break; 
    case true: jQuery('#postdivrich').hide(300);
        break;
    }
}
*/



});";

$metapage = array(
    "id" => "general",
    "title" => "General Settings",
    "pages" => array('page'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "low", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => "This settings is a general.",
    "js" => $js, //Optional. Insert javascript
    "fields" => array()
);


$metapage['fields'][] = array(
    "name" => "Page Layout",
    "desc" => "Choose one of the preset layouts for your page.".' '. jwUtils::getHelp("mpa_layout"),
    "id" => "_layout",
    "std" => "fullwidth",
    "extend" => "_sidebar",
    "type" => "layout",
    "options" => array(
                'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
                'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif',
                'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif')
);

$metapage['fields'][] = array(
    "name" => "Left Sidebar",
    "desc" => "  Add a new sidebar in <a href='./themes.php?page=optionsframework'>Sidebars</a> ",
    "id" => "_sidebar_left",
    "class" => "right",
    "std" => "",
    "type" => "sidebar_select"
);

$metapage['fields'][] = array(
    "name" => "Right Sidebar",
    "desc" => "",
    "id" => "_sidebar_right",
    "std" => "",
    "type" => "sidebar_select"
);


$metapage['fields'][]  = array(
            'id' => '_display_page_name',
            'type' => 'toggle',
            'name' => 'Page Name',
            'desc' => 'Options for displaying a page name in a preview. Choose on or off.'.' '. jwUtils::getHelp("mpa_display_name"),
            'std' => '1'
        );

     

$metapage['fields'][]  = array(
            'id' => '_use_breadcrumbs',
            'type' => 'toggle',
            'name' => 'Navigation Bar',
            'desc' => 'Choose whether a bar with the navigation bar is displayed or not.'.' '. jwUtils::getHelp("mpa_breadcrums"),
            'std' => '0'
        );
$metapage['fields'][]  = array(
            'id' => '_page_custom_sheet_search',
            'type' => 'toggle',
            'name' => 'Show search',
            'desc' => 'Choose whether the slider is displayed or not.',
            'std' => '0'
        );
$bg_images_url = get_template_directory_uri() . '/images/cat_bg_color/';
$metapage['fields'][] = array("name" => "Menu Background Color",
    "desc" => "Choose a background color for your portfolio menu.".' '. jwUtils::getHelp("mpa_b_color"),
    "id" => "post_bg_color",
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

$metapage['fields'][] = array("name" => "Custom Menu Background Color",
    "desc" => 'Choose a background color.'.' '. jwUtils::getHelp("mpa_b_custom_color"),
    "id" => "post_custom_bg_color",
    "std" => "#fafafa",
    "type" => "color");

$metapage['fields'][] = array("name" => "Custom Menu Text Color",
    "desc" => 'Choose a text color.'.' '. jwUtils::getHelp("mpa_f_custom_color"),
    "id" => "post_custom_font_color",
    "std" => "#000000",
    "type" => "color");








$jsBlog = "jQuery(function() {
    
if(jQuery('#page_template').val() == 'page-blog.php'){
    prepinac_blog(true);
}else{
    prepinac_blog();
}

jQuery('#page_template').change(function() {
    if(jQuery('#page_template').val() == 'page-blog.php'){
       prepinac_blog(true); 
    }else{
        prepinac_blog();
    }
  
});

function prepinac_blog(blog=false){
   switch(blog){
    case false: jQuery('#blog_and_cat').addClass('closed');
        break; 
    case true: jQuery('#blog_and_cat').removeClass('closed');
        break;
    }
}

});";

$metapageblog = array(
    "id" => "blog_and_cat",
    "title" => "Blog and Categories Settings",
    "pages" => array('page'),
    "context" => "normal", //Optional. The context within the page where the boxes should show ('normal', 'advanced')
    "priority" => "low", //Optional. The priority within the context where the boxes should show ('high', 'low').
    "desc" => "These options are available if Page Attributes >> Template is set to Blog and Category",
    "js" => $jsBlog, //Oprional. Insert javascript
    "fields" => array()
);



        
$metapageblog['fields'][]  = array(
            'id' => '_page_blog_cat',
            'type' => 'multidropdown',
            'name' => 'Include Category (optional)',
            'desc' => 'Choose the post categories you want to fetch the post.'.' '. jwUtils::getHelp("mpb_incl_cat"),
            "std" => array(),
            "page" => null,
            "mod" => 'big',
            "chosen" => "true",
            "target" => 'cat',
            "prompt" => "Choose category..",
        );

$metapageblog['fields'][]  = array(
            'id' => '_page_blog_post',
            'type' => 'text',
            'name' => 'Include Posts (optional)',
            'desc' => 'The specific posts you want to display (in format 52, 45, 87)'.' '. jwUtils::getHelp("mpb_incl_post"),
            "std" => '',
            
            
        );

$metapageblog['fields'][]  = array(
            'id' => '_page_blog_author',
            'type' => 'multidropdown',
            'name' => 'Include Authors (optional)',
            'desc' => 'The specific authors posts you want to display'.' '. jwUtils::getHelp("mpb_incl_author"),
            "std" => array(),
            "page" => null,
            "mod" => 'big',
            "chosen" => "true",
            "target" => 'author',
            "prompt" => "Choose Authors..",
        );


        
$metapageblog['fields'][]  = array(
            'id' => '_page_blog_postscount',
            'type' => 'text',
            'name' => 'Number of Posts',
            'desc' => 'Number of posts per page or per one batch of posts (their loading method depends on the Pagination Style below).'.' '. jwUtils::getHelp("mpb_postcount"),
            'std' => '6',
            'max' => '100',
            'maxlength' => '3',
            'mod' => 'micro'
        );
$metapageblog['fields'][]  = array(
            'id' => '_page_blog_pagination',
            'type' => 'select',
            'name' => 'Pagination Style',
            'desc' => 'Choose the pagination style you prefer. For details please see our documentation.'.' '. jwUtils::getHelp("mpb_pag_style"),
            'std' => 'number',
            'mod' => 'small',
            'options' => array("ajax" => "ajax", "infinite" => "infinite", "infinitemore"=>"infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress")
        ); 
        
$metapageblog['fields'][]  = array(
            'id' => '_page_blog_order',
            'type' => 'select',
            'name' => 'Post Order'.' '. jwUtils::getHelp("mpb_order"),
            'desc' => 'Posts order (ascending or descending).',
            'std' => 'desc',
            'mod' => 'small',
            'options' => array("desc"=>"Desc", "asc"=>"Asc")
        );
        
$metapageblog['fields'][]  = array(
            'id' => '_page_blog_orderby',
            'type' => 'select',
            'name' => 'Post Order by'.' '. jwUtils::getHelp("mpb_orderby"),
            'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
            'std' => 'date',
            'mod' => 'medium',
 
            'options' => array("date"=>"Date", "none"=>"None", "ID" =>"ID", 
                                "author" => "Author", "title" =>"Title","modified"=>"Modified",
                                "parent"=>"Parent","rand"=>"Rand","comment_count"=>"Comment count")
        );
        
$metapageblog['fields'][]  = array(
            'id' => '_page_blog_dateformat',
            'type' => 'text',
            'name' => 'Post Date Format'.' '. jwUtils::getHelp("mpb_dateformat"),
            'desc' => 'Please visit <a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time in Wordpress</a> to learn how to use the characters convention.',
            'std' => "F j, Y",
            'mod' => 'mini'
        );

$metapageblog['fields'][]  = array( 
            'id' => '_page_custom_sheet_source',
            'type' => 'select',
            'name' => 'Category Bar Content',
            'desc' => 'Choose your preference for a content of the category bar.'.' '. jwUtils::getHelp("mpb_bar_content"),
            'std' => 'sorting',
            'mod' => 'small',
            'options' => array("breadcrumb"=>"breadcrumb", "sorting"=>"sorting")
        );      
$metapageblog['fields'][] = array("name" => "Number of Words Excerpt",
            "desc" => "This is a number of words in a preview content.".' '. jwUtils::getHelp("mpb_excerpt"),
            "id" => "_page_blog_excerpt",
            "std" => 20,
            "mod" => 'micro',
            'maxlength' => 4,
            "type" => "text"
        );
$metapageblog['fields'][] = array(
            'id' => '_page_blog_image_clickable',
            'type' => 'toggle',
            'name' => 'Hyperlink the Post Images',
            'desc' => 'Choose whether the posts images are hyperlinked as well as the titles. Set the option on or off.'.' '. jwUtils::getHelp("mpb_clickable_img"),
            'std' => '0'
        );

$metapageblog['fields'][] = array(
            'id' => '_page_blog_image_lightbox',
            'type' => 'toggle',
            'name' => 'Show Lightbox',
            'desc' => 'Choose whether to display lightbox after clicking on an image of post (Image, Video or Gallery type).'.' '. jwUtils::getHelp("mpb_lightbox"),
            'std' => '1'
        );


/*SLIDER======*/
        
$metapageblog['fields'][] = array(
            "name" => "Blog slider",
            "id" => "_blogslider",
            "type" => "sectionstart");  
 
$metapageblog['fields'][] = array(
            'id' => '_page_blog_slider',
            'type' => 'toggle',
            'name' => 'Slider',
            'desc' => 'Choose whether the slider is displayed or not.'.' '. jwUtils::getHelp("mpb_s_slider"),
            'std' => '1'
        );
       
        
$metapageblog['fields'][] = array("name" => "Slider source",
            "desc" => "Source of the content for your slider. Choose one from preset options.".' '. jwUtils::getHelp("mpb_s_source"),
            "id" => "_page_slider_source",
            "std" => "three",
	    "mod" => "small",
            "type" => "select",
            "options" => array("last" => "Last posts", "sticky" => "Sticky posts", "slides" => "Slides", "shop" => "shop products" )
        );
$metapageblog['fields'][]  = array(
            'id' => '_page_custom_max',
            'type' => 'text',
            'name' => 'Maximum number of posts in the slider',
            'desc' => 'Choose your maximum number of posts for the slider.'.' '. jwUtils::getHelp("mpb_s_max"),
            'std' => "5",
            'mod' => 'mini'
        );


        

  $metapageblog['fields'][] = array(
                "id" => "_blogslider_end",
            "type" => "sectionend");         
        


/*METAdata*/
 $metapageblog['fields'][] = array(
            "name" => "Meta Data".' '. jwUtils::getHelp("mpb_meta"),
            "id" => "_metadata",
            "type" => "sectionstart");  
 
 
$metapageblog['fields'][] = array(
            "name" => "Bar Transitions",
            "desc" => "Choose your meta bar transition style or switch the bar on/off. This bar is displayed in the post preview.",
            "id" => "_page_blog_metacaption",
            "std" => "fadeEffect",
            "type" => "select",
	    "mod" => "small",
            "options" => array(
                "off" => "Off",
                "on" => "On",
                "toggle" => "Toggle",
                "fadeEffect" => "Fade Effect"
            )
        );
    
$metapageblog['fields'][] = array(
            'id' => '_page_blog_metaauthor',
            'type' => 'toggle',
            'name' => 'Meta Author',
            'desc' => "Choose whether the autor's name is displayed or not in the post preview.",
            'std' => '1'   
        );
$metapageblog['fields'][] = array(
            'id' => '_page_blog_metacategory',
            'type' => 'toggle',
            'name' => 'Meta Category',
            'desc' => 'Choose whether the category name is displayed or not in the post preview.',
            'std' => '0'   
        );

$metapageblog['fields'][] = array(
            'id' => '_page_blog_metadate',
            'type' => 'toggle',
            'name' => 'Meta Date',
            'desc' => 'Choose whether the date is displayed or not in the post preview.',
            'std' => '1'   
        );
$metapageblog['fields'][]= array(
            'id' => '_page_blog_metacomments',
            'type' => 'toggle',
            'name' => 'Meta Comments',
            'desc' => 'Choose whether a number of comments is displayed or not in the post preview.',
            'std' => '1'   
        );
$metapageblog['fields'][] = array(
            'id' => '_page_blog_metaratings',
            'type' => 'toggle',
            'name' => 'Ratings',
            'desc' => 'Choose whether the ratings are displayed or not in the post preview.',
            'std' => '1'
        );

  $metapageblog['fields'][] = array(
            "id" => "_metadata_end",
            "type" => "sectionend");         
        



        


/**
 * Definition metabox for category
 */
$metacat = array(
    "id" => "custom",
    "pages" => array("category"),
    "fields" => array()
);

$bg_images_url = get_template_directory_uri() . '/images/cat_bg_color/';
$metacat['fields'][] = array("name" => "Category Color Scheme",
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

$metacat['fields'][] = array("name" => "Custom Category Color Scheme",
    "desc" => 'Choose a color you want to use for the main graphic elements of the category. The cross option in the Category Color Scheme has to be chosen withal.'.' '. jwUtils::getHelp("mc_custom_color"),
    "id" => "cat_custom_bg_color",
    "std" => "#fafafa",
    "type" => "color");

$metacat['fields'][] = array("name" => "Custom Menu Text Color",
    "desc" => 'Choose a color for the menu items. The cross option in the Category Color Scheme has to be chosen withal.'.' '. jwUtils::getHelp("mc_custom_text_color"),
    "id" => "cat_custom_font_color",
    "std" => "#000000",
    "type" => "color");

$metacat['fields'][]= array(
            'id' => 'cat_custom_slider',
            'type' => 'toggle',
            'name' => 'Slider',
            'desc' => 'Choose whether the slider is displayed or not.'.' '. jwUtils::getHelp("mc_slider"),
            'std' => '0'   
        );

$metacat['fields'][]  = array(
            'id' => 'cat_custom_source',
            'type' => 'select',
            'name' => 'Slider Source',
            'desc' => 'Source of links for the slider (define where user will be redirected after a clicking).'.' '. jwUtils::getHelp("mc_slider_source"),
            'std' => 'number',
            'mod' => 'small',
            'options' => array("last"=>"Last posts", "sticky"=>"Sticky posts", "slides"=>"Slides", "shop" => "shop products" )
        ); 
$metacat['fields'][]  = array(
            'id' => 'cat_custom_max',
            'type' => 'text',
            'name' => 'Maximum Number of Posts in the Slider',
            'desc' => 'Choose your maximum number of posts for the slider.'.' '. jwUtils::getHelp("mc_max_post"),
            'std' => "5",
            'mod' => 'mini'
        );

$metacat['fields'][] = array(
            'id' => 'cat_slider_sticky',
            'type' => 'toggle',
            'name' => 'Show sticky also in page content',
            'desc' => '',
            'std' => '0'
        );


$metacat['fields'][]= array(
            'id' => 'cat_custom_sheet',
            'type' => 'toggle',
            'name' => 'Category Bar',
            'desc' => 'Choose whether a category bar is displayed or not.'.' '. jwUtils::getHelp("mc_cat_bar"),
            'std' => '1',
            'mod' => 'medium'
        );
$metacat['fields'][]  = array(
            'id' => 'cat_custom_sheet_source',
            'type' => 'select',
            'name' => 'Category Bar Content',
            'desc' => 'Choose your preference for a content of the category bar.'.' '. jwUtils::getHelp("mc_scat_bar_content"),
            'std' => 'sorting',
            'mod' => 'small',
            'options' => array("breadcrumb"=>"breadcrumb", "sorting"=>"sorting", "nothing"=>"nothing")
        ); 
/*
$metacat['fields'][] = array("name" => "Custom Title",
    "desc" => "Unlimited slider with drag and drop sortings.",
    "id" => "title",
    "std" => "",
    "type" => "text");

//Background Images Reader
$bg_images = jwUtils::fileLoader(STYLESHEETPATH . '/images/bg/', array('.png', '.jpg'), $bg_images_url = get_template_directory_uri() . '/images/bg/');

$metacat['fields'][] = array("name" => "Background Images",
            "desc" => "Select a background pattern.",
            "id" => "custom_bg",
            "std" => $bg_images_url . "bg0.png",
            "type" => "tiles",
            "index" => true,
            "mod" => "big",
            "options" => $bg_images,
        );

$metacat['fields'][] = array("name" => "Category Image Media",
    "desc" => "Set category image",
    "id" => "media",
    "std" => "",
    "type" => "media");*/
?>
