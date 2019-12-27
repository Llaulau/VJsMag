<?php

if (!function_exists('themeoptions')) {

    function themeoptions() {
       

 
        $of_options = array();
        



        /* GENERAL ******************************************************* */
        $of_options[] = array("name" => "General Settings",
            "type" => "headingstart");
 

        $of_options[] = array("name" => "Logo",
            "desc" => "Upload your logo " . jwUtils::getHelp("main_logo"),
            "id" => "custom_logo",
            "std" => "",
            "type" => "upload");
        
        $of_options[] = array(
            'id' => 'logo_retina_ready',
            'type' => 'toggle',
            'name' => 'Retina Ready',
            'desc' => 'Logo ready for retina display'.' '. jwUtils::getHelp("retina_ready"),
            'std' => '0'
        );
        
        $of_options[] = array("name" => "Favicon",
            "desc" => "Upload a 16px * 16px PNG/GIF image that will represent your website's favicon.".' '. jwUtils::getHelp("favicon"),
            "id" => "custom_favicon",
            "std" => "",
            "type" => "upload");

        
        $of_options[] = array(
            'id' => 'totop_show',
            'type' => 'toggle',
            'name' => 'To Top Arrow',
            'desc' => 'Choose whether you want to show the "To Top" arrow.'.' '. jwUtils::getHelp("show_totop"),
            'std' => '0'
        );
        
        $of_options[] = array(
            'id' => 'totop_show_mobile',
            'type' => 'toggle',
            'name' => 'Show To Top Arrow on Mobile devices',
            'desc' => '',
            'std' => '0'
        );



        $of_options[] = array("type" => "headingend");
        /* GENERAL END ******************************************************* */





        /* SLIDER ************************************************************ */
        $of_options[] = array("name" => "Sliders Settings",
            "type" => "headingstart");

        $of_options[] = array("name" => "Source",
            "desc" => "Source of the content for your slider. Choose one from preset options.".' '. jwUtils::getHelp("s_source"),
            "id" => "slider_source",
            "std" => "three",
	    "mod" => "small",
            "type" => "select",
            "options" => array("last" => "Last posts", "sticky" => "Sticky posts", "slides" => "Slides", "shop" => "shop products" )
            
        );


        $of_options[] = array("name" => "Number of Slides",
            "desc" => "The maximum number of slides for showing.".' '. jwUtils::getHelp("s_number"),
            "id" => "slider_number",
            "std" => "6",
	    "mod" => "small",
            "type" => "text");

        $of_options[] = array("name" => "Speed",
            "desc" => "Speed of a slideshow. Enter your value in miliseconds.".' '. jwUtils::getHelp("s_speed"),
            "id" => "slider_speed",
            "std" => "3500",
	    "mod" => "small",
            "type" => "text");
        
        $of_options[] = array("name" => "Length of Excerpt of Title",
            "desc" => "Length of the excerpt. Fill in the number of characters.".' '. jwUtils::getHelp("s_exerpt"), 
            "id" => "slider_excerpt_title",
	    "mod" => "small",
            "std" => "50",
            "type" => "text");
        
        $of_options[] = array("name" => "Length of Excerpt",
            "desc" => "Length of the excerpt. Fill in the number of characters.".' '. jwUtils::getHelp("s_exerpt"), 
            "id" => "slider_excerpt",
	    "mod" => "small",
            "std" => "50",
            "type" => "text");

        $of_options[] = array("name" => "Direction of Scrolling",
            "desc" => "Set direction for scrolling of the slides.".' '. jwUtils::getHelp("s_direction"),
            "id" => "slider_orientation",
            "std" => "down",
	    "mod" => "small",
            "type" => "select",
            "options" => array("up" => "Up", "down" => "Down"));


        $of_options[] = array(
            'id' => 'slider_cat',
            'type' => 'multidropdown',
            'name' => 'Include Category',
            'desc' => 'Choose the post categories you want to fetch the post.'.' '. jwUtils::getHelp("s_cat"),
            "std" => array(),
            "page" => null,
            "mod" => 'big',
            "chosen" => "true",
            "target" => 'cat',
            "prompt" => "Choose category..",
        );
        
        
        $of_options[] = array(
            'id' => 'slider_sticky',
            'type' => 'toggle',
            'name' => 'Show sticky also in page content',
            'desc' => '',
            'std' => '0'
        );
        

        $of_options[] = array("type" => "headingend");
        /* SLIDER END ******************************************************** */



        /* BLOG ************************************************************** */
        $of_options[] = array("name" => "Blog",
            "type" => "headingstart");



        $of_options[] = array(
            "name" => "Blog Page Layout",
            "desc" => "Select a main content and sidebar alignment." . jwUtils::getHelp("b_layout"),
            "id" => "blog_layout",
            "std" => 'right',
            "type" => "layout",
            "extend" => 'blog_sidebar',
            "options" => array(
                'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
                'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
                'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
            )
        );

        $of_options[] = array(
            'id' => 'blog_sidebar_left',
            'type' => 'sidebar_select',
            'name' => 'Blog Left Sidebars',
            'desc' => 'Here you can add some optional sidebars.',
            'std' => null,
            'mod' => 'medium'
        );

        $of_options[] = array(
            'id' => 'blog_sidebar_right',
            'type' => 'sidebar_select',
            'name' => 'Blog Right Sidebars',
            'desc' => 'Here you can add some optional sidebars. You can add custom sidebar in <b>Sidebar Manager</b>',
            'std' => null,
            'mod' => 'medium'
        );


        $of_options[] = array(
            'id' => 'blog_cat',
            'type' => 'multidropdown',
            'name' => 'Include Category',
            'desc' => 'Choose the post categories you want to fetch the post.'.' '. jwUtils::getHelp("b_incl_cat"),
            "std" => array(),
            "page" => null,
            "mod" => 'big',
            "chosen" => "true",
            "target" => 'cat',
            "prompt" => "Choose category..",
        );
        
        $of_options[] = array(
            'id' => 'blog_featured_allsite',
            'type' => 'toggle',
            'name' => 'Featured area on all site',
            'desc' => 'Show Featured area (slider and small top sidebar) on the all site or only on page.',
            'std' => '0'
        );

        $of_options[] = array(
            'id' => 'blog_slider',
            'type' => 'toggle',
            'name' => 'Slider',
            'desc' => 'Choose whether the slider is displayed or not.',
            'std' => '1'
        );
        
        


        $of_options[] = array(
            'id' => 'blog_postscount',
            'type' => 'text',
            'name' => 'Number of Posts',
            'desc' => 'Number of posts per page or per one batch of posts (their loading method depends on the Pagination Style below).',
            'std' => '6',
            'max' => '100',
            'maxlength' => '3',
            'mod' => 'micro'
        );
     /*   $of_options[] = array(
            'id' => 'blog_pagescount',
            'type' => 'text',
            'name' => 'Number of post pages',
            'desc' => 'Number of regular wordpress post pages on one flying news page. (Only ajax scrooling)',
            'std' => '2',
            'max' => '100',
            'maxlength' => '3',
            'mod' => 'micro'
        );*/
        $of_options[] = array(
            'id' => 'blog_pagination',
            'type' => 'select',
            'name' => 'Pagination Style',
            'desc' => 'Choose the pagination style you prefer. For details please see our documentation.'.' '. jwUtils::getHelp("b_pagination"),
            'std' => 'ajax',
            'mod' => 'medium',
            'options' => array("ajax" => "ajax", "infinite" => "infinite", "infinitemore"=>"infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress"),
        );

        $of_options[] = array(
            'id' => 'blog_order',
            'type' => 'select',
            'name' => 'Post Order',
            'desc' => 'Posts order (ascending or descending).'.' '. jwUtils::getHelp("b_post_order"),
            'std' => 'desc',
            'mod' => 'small',
            'options' => array("desc" => "Desc", "asc" => "Asc")
        );

        $of_options[] = array(
            'id' => 'blog_orderby',
            'type' => 'select',
            'name' => 'Post Order by',
            'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>'.' '. jwUtils::getHelp("b_post_orderby"),
            'std' => 'date',
            'mod' => 'medium',
            'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
                "author" => "Author", "title" => "Title", "modified" => "Modified",
                "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
        );

        $of_options[] = array(
            'id' => 'blog_dateformat',
            'type' => 'text',
            'name' => 'Post Date Format',
            'desc' => 'Please visit <a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time in Wordpress</a> to learn how to use the characters convention.'.' '. jwUtils::getHelp("b_date_format"),
            'std' => "F j, Y",
            'mod' => 'mini'
        );
        

        $of_options[] = array(
            'id' => 'std_post_image_clickable',
            'type' => 'toggle',
            'name' => 'Hyperlink the Post Images',
            'desc' => 'Choose whether the posts images are hyperlinked as well as the titles. Set the option on or off.'.' '. jwUtils::getHelp("b_hyperlink"),
            'std' => '0'
        );

        $of_options[] = array(
            'id' => 'image_lightbox',
            'type' => 'toggle',
            'name' => 'Show Lightbox',
            'desc' => 'Choose whether to display lightbox after clicking on an image of post (Image, Video or Gallery type).'.' '. jwUtils::getHelp("b_im_lightbox"),
            'std' => '1'
        );



        $of_options[] = array(
            "name" => "Search/Archive/Category Layout",
            "desc" => "Select a main content and sidebar alignment.".' '. jwUtils::getHelp("b_sac_layout"),
            "id" => "search_and_archive_layout",
            "std" => 'right',
            "type" => "layout",
            "extend" => 'search_and_archive_sidebar',
            "options" => array(
                'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
                'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
                'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
            )
        );

        $of_options[] = array(
            'id' => 'search_and_archive_sidebar_left',
            'type' => 'sidebar_select',
            'name' => 'Search/Archive Left Sidebars',
            'desc' => 'Here you can add some optional sidebars.'.' '. jwUtils::getHelp("b_sa_sidebar"),
            'std' => null,
            'mod' => 'medium'
        );

        $of_options[] = array(
            'id' => 'search_and_archive_sidebar_right',
            'type' => 'sidebar_select',
            'name' => 'Search/Archive Right Sidebars',
            'desc' => 'Here you can add some optional sidebars.'.' '. jwUtils::getHelp("b_sa_sidebar"),
            'std' => null,
            'mod' => 'medium'
        );




        $of_options[] = array("name" => "Number of Words Excerpt",
            "desc" => "This is a number of words in a preview content.".' '. jwUtils::getHelp("b_number_excerpt"),
            "id" => "blog_excerpt",
            "std" => 20,
            "mod" => 'micro',
            'maxlength' => 4,
            "type" => "text"
        );

        
        $of_options[] = array(
            'id' => 'blog_category',
            'type' => 'toggle',
            'name' => 'Category Name',
            'desc' => 'Options for displaying a category name in a preview. Choose on or off.'.' '. jwUtils::getHelp("b_cat_name"),
            'std' => '1'
        );
        
        
        $of_options[] = array(
            "name" => "Custom sort",
            "type" => "sectionstart");

        $of_options[] = array(
            'id' => 'custom_sort1',
            'type' => 'toggle',
            'name' => 'Custom sort 1',
            'desc' => 'Beside "Date", "Name", "Rating",... sort option, show new sotr item which is can be set at every post.',
            'std' => '0'
        );
        $of_options[] = array(
            'id' => 'custom_sort1_name',
            'type' => 'text',
            'name' => 'Custom sort 1 name',
            'desc' => 'Text which is will be showed net to "Date", "Name", "Rating",...',
            'std' => "Custom sort 1",
            'mod' => 'medium'
        );
        $of_options[] = array(
            'id' => 'custom_sort2',
            'type' => 'toggle',
            'name' => 'Custom sort 2',
            'desc' => 'Beside "Date", "Name", "Rating",... sort option, show new sotr item which is can be set at every post.',
            'std' => '0'
        );
        $of_options[] = array(
            'id' => 'custom_sort2_name',
            'type' => 'text',
            'name' => 'Custom sort 2 name',
            'desc' => 'Text which is will be showed net to "Date", "Name", "Rating",...',
            'std' => "Custom sort 2",
            'mod' => 'medium'
        );
        $of_options[] = array(
            "type" => "sectionend");

        /*  read more je zakázaný
         * $of_options[] = array("name" => "Read More Text",
          "desc" => "Zde zadejte readmore text",
          "id" => "blog_readmore",
          "std" => "Read more",
          "mod" => "medium",
          "type" => "text"
          );
         */
        /* METAdata */

        $of_options[] = array(
            "name" => "Meta Data".' '. jwUtils::getHelp("b_meta"),
            "type" => "sectionstart");


        $of_options[] = array(
            "name" => "Meta Bar Transitions",
            "desc" => "Choose your meta bar transition style or switch the bar on/off. This bar is displayed in the post preview.",
            "id" => "blog_metacaption",
            "std" => "fadeEffect",
            "type" => "select",
	    "mod" => "small",
            "options" => array(
                "static" => "Static",
                "toggle" => "Toggle",
                "fadeEffect" => "Fade Effect"
            )
        );

        

        $of_options[] = array(
            'id' => 'blog_metacategory',
            'type' => 'toggle',
            'name' => 'Meta Category',
            'desc' => 'Choose whether the category name is displayed or not in the post preview.',
            'std' => '1'
        );
        
        $of_options[] = array(
            'id' => 'blog_metaauthor',
            'type' => 'toggle',
            'name' => 'Meta Author',
            'desc' => 'Choose whether the autors name is displayed or not in the post preview.',
            'std' => '0'
        );

        $of_options[] = array(
            'id' => 'blog_metadate',
            'type' => 'toggle',
            'name' => 'Meta Date',
            'desc' => 'Choose whether the date is displayed or not in the post preview.',
            'std' => '1'
        );

        $of_options[] = array(
            'id' => 'blog_metacomments',
            'type' => 'toggle',
            'name' => 'Meta Comments',
            'desc' => 'Choose whether a number of comments is displayed or not in the post preview.',
            'std' => '1'
        );

        $of_options[] = array(
            'id' => 'blog_ratings',
            'type' => 'toggle',
            'name' => 'Ratings',
            'desc' => 'Choose whether the ratings are displayed or not in the post preview.',
            'std' => '1'
        );

        $of_options[] = array(
            "type" => "sectionend");
        /* Metadata end */


        /* Sortovací lišta */

        $of_options[] = array(
            "name" => "Main Bar".' '. jwUtils::getHelp("b_main"),
            "type" => "sectionstart");


        $of_options[] = array(
            'id' => 'ribbon_show',
            'type' => 'toggle',
            'name' => 'Main Bar',
            'desc' => 'Choose whether to display the Main Bar or not.',
            'std' => '1'
        );

        $of_options[] = array(
            'id' => 'ribbon_sort',
            'type' => 'toggle',
            'name' => 'Sort Options',
            'desc' => 'Choose whether to enable the Sortion options or not.',
            'std' => '1'
        );

        $of_options[] = array(
            'id' => 'ribbon_search',
            'type' => 'toggle',
            'name' => 'Search Options',
            'desc' => 'Choose whether to enable the Search option or not.',
            'std' => '1'
        );

        $of_options[] = array(
            "type" => "sectionend");



        /* FB comments settings */
        $of_options[] = array(
            "name" => "Facebook Comments".' '. jwUtils::getHelp("b_fb_comm"),
            "type" => "sectionstart");
        
        $of_options[] = array(
            "name" => "Facebook Comments",
            "id" => "info-fb",
            "text" => "Don't forget insert Facebook App ID in advanced section.",
            "type" => "info",
            "space" => false,
            "message" => "warnings"
        );

        $of_options[] = array(
            'id' => 'fbcomments_switch',
            'type' => 'toggle',
            'name' => 'Facebook Comments',
            'desc' => 'Switch between wordpress and facebook comments',
            'std' => '0'
        );

       
        $of_options[] = array(
            'id' => 'fbcomments_nuberofcomments',
            'type' => 'text',
            'name' => 'Number of Comments',
            'desc' => 'Enter the number of comments to be displayed.',
            'std' => "5",
            'mod' => 'mini'
        );
        $of_options[] = array(
            "type" => "sectionend");


        $of_options[] = array("type" => "headingend");
        /* BLOG END ****************************************************** */


        /* SINGLE POST ***************************************************** */
        $of_options[] = array("name" => "Single Post",
            "type" => "headingstart");

        $of_options[] = array(
            "name" => "Post Layout",
            "desc" => "Select the main content and sidebar alignment.".' '. jwUtils::getHelp("sp_layout"),
            "id" => "post_layout",
            "std" => 'right',
            "type" => "layout",
            "extend" => 'post_sidebar',
            "options" => array(
                'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
                'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
                'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
            )
        );

        $of_options[] = array(
            'id' => 'post_sidebar_left',
            'type' => 'sidebar_select',
            'name' => 'Post Left Sidebars',
            'desc' => 'Here you can add some optional sidebars. Create those sidebars in the Sidebar Manager sections.'.' '. jwUtils::getHelp("sp_sidebar"),
            'std' => null,
            'mod' => 'medium'
        );

        $of_options[] = array(
            'id' => 'post_sidebar_right',
            'type' => 'sidebar_select',
            'name' => 'Post Right Sidebars',
            'desc' => 'Here you can add some optional sidebars. Create those sidebars in the Sidebar Manager sections.'.' '. jwUtils::getHelp("sp_sidebar"),
            'std' => null,
            'mod' => 'medium'
        );
        
        
        $of_options[] = array(
            'id' => 'post_nav_bar',
            'type' => 'toggle',
            'name' => 'Navigation Bar',
            'desc' => 'Global settings',
            'std' => '1'
        );
        
        
        $of_options[] = array(
            'id' => 'post_share',
            'type' => 'toggle',
            'name' => 'Share Post Bar',
            'desc' => 'Choose whether to make a bar with some sharing options below the post available or not.'.' '. jwUtils::getHelp("sp_share"),
            'std' => '1',
            'mod' => 'medium'
        );
        
        $of_options[] = array(
            'id' => 'post_relatedpost',
            'type' => 'toggle',
            'name' => 'Related Posts',
            'desc' => 'Do you want to show the latest posts section on your post page?',
            'std' => '0',
            'mod' => 'medium'
        );
        
         $of_options[] = array(
            'id' => 'post_relatedpost_num',
            'type' => 'text',
            'name' => 'Number of Related Posts',
            'desc' => 'Choose your number of related posts.',
            'std' => '4',
            'mod' => 'mini'
        );
         
         $of_options[] = array(
            'id' => 'post_image_featured',
            'type' => 'toggle',
            'name' => 'Use image in post as featured',
            'desc' => '',
            'std' => '0',
            'mod' => 'medium'
        );
        
         $of_options[] = array(
            'id' => 'post_use_featured',
            'type' => 'toggle',
            'name' => 'Use Featured Image or Gallery or Video in post',
            'desc' => 'Global settings',
            'std' => '0',
            'mod' => 'medium'
        );
         $of_options[] = array(
            'id' => 'post_pp_galery',
            'type' => 'toggle',
            'name' => 'Use Pretty Photo for Gallery.',
            'desc' => '',
            'std' => '0',
            'mod' => 'medium'
        );
         
        $of_options[] = array(
            'id' => 'blog_author',
            'type' => 'toggle',
            'name' => 'About Author',
            'desc' => 'Choose whether the autors name with photo and description is displayed or not in a post.'.' '. jwUtils::getHelp("b_author"),
            'std' => '1'
        );
	
	$of_options[] = array(
            "name" => "Meta Options",
            "type" => "sectionstart");
	$of_options[] = array(
            'id' => 'post_author',
            'type' => 'toggle',
            'name' => 'Meta Post Author',
            'desc' => 'Show post authors name',
            'std' => '1',
            'mod' => 'medium'
        );
	$of_options[] = array(
            'id' => 'post_date',
            'type' => 'toggle',
            'name' => 'Meta Post Date',
            'desc' => 'Show post publish date',
            'std' => '1',
            'mod' => 'medium'
        );
        
	
	
	$of_options[] = array(
            "type" => "sectionend");
	
          $of_options[] = array(
            "name" => "Sharing Options".' '. jwUtils::getHelp("sp_share_opt"),
            "type" => "sectionstart");
          
          $of_options[] = array(
            'id' => 'post_share_tw',
            'type' => 'toggle',
            'name' => 'Share Post Twitter',
            'std' => '1',
            'mod' => 'medium'
        );
          $of_options[] = array(
            'id' => 'post_share_fb',
            'type' => 'toggle',
            'name' => 'Share Post Facebook',
            'std' => '1',
            'mod' => 'medium'
        );
          $of_options[] = array(
            'id' => 'post_share_g',
            'type' => 'toggle',
            'name' => 'Share Post Google',
            'std' => '1',
            'mod' => 'medium'
        );
          $of_options[] = array(
            'id' => 'post_share_li',
            'type' => 'toggle',
            'name' => 'Share Post LinkedIn',
            'std' => '1',
            'mod' => 'medium'
        );
          $of_options[] = array(
            'id' => 'post_share_pi',
            'type' => 'toggle',
            'name' => 'Share Post Pinterest',
            'std' => '1',
            'mod' => 'medium'
        );
          
          
            $of_options[] = array(
            "type" => "sectionend");


        $of_options[] = array("type" => "headingend");
        /* STYLING END ****************************************************** */


        /* SIDEBAR MANAGER ************************************************** */
        $of_options[] = array("name" => "Sidebar Manager",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'sidebars',
            'type' => 'sidebars',
            'name' => 'Custom Sidebars',
            'desc' => 'Here you can add some optional sidebars.'.' '. jwUtils::getHelp("sm_sidebars"),
            'std' => null
        );

        $of_options[] = array("type" => "headingend");
        /* STYLING END ******************************************************* */


        /* STYLING *********************************************************** */
        $of_options[] = array("name" => "Styling Options",
            "type" => "headingstart");
        
        $of_options[] = array(
            "name" => "Template Background Settings".' '. jwUtils::getHelp("templ_back"),
            "type" => "sectionstart");
        
        $of_options[] = array("name" => "Background Image",
            "desc" => "Upload your background image." ,
            "id" => "background_image",
            "std" => "",
            "mod" => "big",         
            "type" => "upload");

        $bg_images_url = get_template_directory_uri() . '/images/bg_texture/';
        $bg_images = jwUtils::fileLoader(STYLESHEETPATH . '/images/bg_texture/', array('.png', '.jpg'), $bg_images_url = get_template_directory_uri() . '/images/bg_texture/');
        
        $bg = array("none" => get_template_directory_uri() . '/images/bg_texture/'.$bg_images_url . 'lil_fiber.png');

        $of_options[] = array("name" => "Background Texture",
            "desc" => "Choose a background texture. If you select the cross filled box, no texture will be used.",
            "id" => "background_texture",
            "std" => $bg_images_url . "lil_fiber.png",
            "type" => "tiles",
            "options" => $bg_images,
        );        
        
        $of_options[] = array("name" => "Background Color",
            "desc" => "Pick a custom background color for the theme (by default: #F1F4ED).",
            "id" => "body_background_color",
            "std" => "#F1F4ED",
            "type" => "color");
        
        $of_options[] = array(
            "type" => "sectionend"
        );
        
       $of_options[] = array(
            "name" => "Template Styling Settings". jwUtils::getHelp("templ_styling"),
            "type" => "sectionstart");
                
        $bg_images_url = get_template_directory_uri() . '/images/cat_bg_color/';
        $of_options[] = array("name" => "Template Main Color",
            "desc" => "Choose the template color.",
            "id" => "template_body_main_color",
            "std" => "darkgrey",
            "type" => "tiles",
            "index" => true,
            "mod" => "big",
            "options" => array(                
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

        $of_options[] = array("name" => "Template Custom Main Color",
            "desc" => "Pick a custom template color for the theme (by default: #CA181F).",
            "id" => "body_main_color",
            "std" => "#CA181F",
            "type" => "color");

        $of_options[] = array("name" => "Template Custom Font Color",
            "desc" => "Template custom Font Color (by default: #ffffff).",
            "id" => "body_main_font_color",
            "std" => "#ffffff",
            "type" => "color");

        $of_options[] = array("name" => "Template Link Color",
            "desc" => "Pick a link color for the theme (by default: #000000).",
            "id" => "body_main_color_link",
            "std" => "#000000",
            "type" => "color");

        $of_options[] = array("name" => "Template Link Hover Color",
            "desc" => "Pick a link hover color for the theme (by default: #CA181F).",
            "id" => "body_main_color_link_hover",
            "std" => "#CA181F",
            "type" => "color");

        $of_options[] = array(
            'id' => 'body_font',
            'type' => 'text',
            'name' => 'Title Font',
            'desc' => 'Here you can change the title font. This doesnt affect the font size, typeface and color remain standard. <a href="http://www.google.com/webfonts">Use font from this web</a>',
            'std' => "Oswald",
            'mod' => 'big'
        );

        $of_options[] = array("name" => "Paragraph Font",
            "desc" => "Copy the font name (e. g. 'Denk One') here and choose a size, style and color. <a href='http://www.google.com/webfonts'>Use font from this web</a>",
            "id" => "small_font",
            "std" => array('size' => '13px', 'face' => 'Droid Sans', 'style' => 'normal', 'color' => '#000000'),
            "type" => "typography");
        
        $of_options[] = array(
            "type" => "sectionend"
        );

        $of_options[] = array("type" => "headingend");
        /* STYLING END ******************************************************* */

        /* CUSTOM ************************************************************* */
        $of_options[] = array("name" => "Custom Code",
            "type" => "headingstart");

        $of_options[] = array("name" => "Custom CSS",
            "desc" => "Simply add some CSS to your theme by adding it to this field.",
            "id" => "custom_css",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("name" => "Custom Javascript Footer",
            "desc" => "Simply add some javascript to your theme by adding it to this field.",
            "id" => "custom_js",
            "std" => "",
            "type" => "textarea");
        
        $of_options[] = array("name" => "Custom Javascript Header",
            "desc" => "Simply add some javascript to your theme by adding it to this field.<strong> Use it for Google DFP.</strong> For custom code add 'script' tag",
            "id" => "custom_js_header",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("name" => "Google Analytics",
            "desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
            "id" => "google_analytics",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("name" => "Footer Text",
            "desc" => "You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]",
            "id" => "footer_text",
            "std" => 'Copyright © 2013 Design by <a href="http://www.jawtemplates.com">Jawtemplates.com</a>.',
            "type" => "textarea");




        $of_options[] = array("type" => "headingend");
        /* CUSTOM END ************************************************** */

        /* BANNERTY  ********************************************************* */
        
        
        //background
        $of_options[] = array("name" => "Banner Background",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'background_banner_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Show Banner',
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Background",
            "desc" => "Upload your image banner.",
            "id" => "background_banner",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Background Image Link",
            "desc" => "Fill in the banner link.",
            "id" => "background_banner_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "background_lead_link_target",
            "std" => "_blank",
            "type" => "select",
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("type" => "headingend");
        
        
        
        //leader
        $of_options[] = array("name" => "Banner Leader",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'leader_banner_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Show Banner',
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_leader_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));

        $of_options[] = array("name" => "Banner Leader",
            "desc" => "Upload your image banner.",
            "id" => "leader_banner",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Leader Image Link",
            "desc" => "Fill in the banner link.",
            "id" => "leader_banner_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_lead_link_target",
            "std" => "_blank",
            "type" => "select",
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "leader_banner_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");
        
        
        

        // top
        $of_options[] = array("name" => "Banner Header 468x60",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'header_banner_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Show Banner'.' '. jwUtils::getHelp("adv_header"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_header_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));

        $of_options[] = array("name" => "Banner Header 468x60",
            "desc" => "Upload your image banner.",
            "id" => "header_banner",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Header Image Link",
            "desc" => "Fill in the banner link.",
            "id" => "header_banner_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_head_link_target",
            "std" => "_blank",
            "type" => "select",
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "header_banner_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");


        // Skyscrapper - Right
        $of_options[] = array("name" => "Banner - Skyscrapper Right",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'skyscrapper_right_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Choose whether the banner is displayed or not.'.' '. jwUtils::getHelp("adv_right"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_skyscrapper_right_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));


        $of_options[] = array("name" => "Banner - Skyscrapper Right",
            "desc" => "Upload your image banner.",
            "id" => "skyscrapper_right",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "skyscrapper_right_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_ss_r_link_target",
            "std" => "_blank",
            "type" => "select",
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));
        

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "skyscrapper_right_link_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");


        // Skyscrapper left
        $of_options[] = array("name" => "Banner - Skyscrapper Left",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'skyscrapper_left_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Show Banner'.' '. jwUtils::getHelp("adv_left"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_skyscrapper_left_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));

        $of_options[] = array("name" => "Banner - Skyscrapper Left",
            "desc" => "Upload your image banner.",
            "id" => "skyscrapper_left",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "skyscrapper_left_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_ss_l_link_target",
            "std" => "_blank",
            "type" => "select",
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "skyscrapper_left_link_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");


        // Banner into Post - 1 
        $of_options[] = array("name" => "Banner - Post 1",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'banner_post_1_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Choose whether the banner is displayed or not.'.' '. jwUtils::getHelp("adv_post"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_post_1_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));


        $of_options[] = array("name" => "Banner - Post 1",
            "desc" => "Upload your image banner.",
            "id" => "banner_post_1",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "banner_post_1_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_1_link_target",
            "std" => "_blank",
            "type" => "select",
     
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "banner_post_1_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");

        // Banner into Post - 2 
        $of_options[] = array("name" => "Banner - Post 2",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'banner_post_2_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Choose whether the banner is displayed or not.'.' '. jwUtils::getHelp("adv_post"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_post_2_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));


        $of_options[] = array("name" => "Banner - Post 2",
            "desc" => "Upload your image banner",
            "id" => "banner_post_2",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "banner_post_2_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_2_link_target",
            "std" => "_blank",
            "type" => "select",
     
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "banner_post_2_google",
            "std" => "",
            "type" => "textarea");

        
        $of_options[] = array("type" => "headingend");

        // Banner into Post - 3 
        $of_options[] = array("name" => "Banner - Post 3",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'banner_post_3_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Choose whether the banner is displayed or not.'.' '. jwUtils::getHelp("adv_post"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_post_3_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));


        $of_options[] = array("name" => "Banner - Post 3",
            "desc" => "Upload your image banner.",
            "id" => "banner_post_3",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "banner_post_3_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_3_link_target",
            "std" => "_blank",
            "type" => "select",
     
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "banner_post_3_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");
        
        
        
        // Banner IN TOP POST 
        $of_options[] = array("name" => "Banner - in post top",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'banner_posttop_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Choose whether the banner is displayed or not.'.' '. jwUtils::getHelp("adv_custom"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_posttop_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));
        

     
        $of_options[] = array("name" => "Banner - in post top",
            "desc" => "Upload your image banner.",
            "id" => "banner_posttop",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "banner_posttop_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_posttop_target",
            "std" => "_blank",
            "type" => "select",
     
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "banner_posttop_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");
        
        
       // Banner IN Bottom POSt
        $of_options[] = array("name" => "Banner - in post bottom",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'banner_postbottom_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Choose whether the banner is displayed or not.'.' '. jwUtils::getHelp("adv_custom"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_postbottom_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));
        

     
        $of_options[] = array("name" => "Banner - in post bottom",
            "desc" => "Upload your image banner.",
            "id" => "banner_postbottom",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "banner_postbottom_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_postbottom_target",
            "std" => "_blank",
            "type" => "select",
     
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "banner_postbottom_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend"); 
        
        

        // Banner Custom Widget - 1 
        $of_options[] = array("name" => "Banner - Custom 1",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'banner_custom_1_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Choose whether the banner is displayed or not.'.' '. jwUtils::getHelp("adv_custom"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_custom_1_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));
        

     
        $of_options[] = array("name" => "Banner - widget 1",
            "desc" => "Upload your image banner.",
            "id" => "banner_custom_1",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "banner_custom_1_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_w_1_link_target",
            "std" => "_blank",
            "type" => "select",
     
            "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "banner_custom_1_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");

        // Banner into Post - 1 
        $of_options[] = array("name" => "Banner - Custom 2",
            "type" => "headingstart");

        $of_options[] = array(
            'id' => 'banner_custom_2_show',
            'type' => 'toggle',
            'name' => 'Show Banner',
            'desc' => 'Choose whether the banner is displayed or not.'.' '. jwUtils::getHelp("adv_custom"),
            'std' => '0'
        );

        $of_options[] = array("name" => "Banner Type",
            "desc" => "Choose the banner type you prefer.",
            "id" => "banner_custom_2_type",
            "std" => "image",
            "type" => "select",
            "options" => array("image" => "Image Banner", "google" => "Google Ads"));


        $of_options[] = array("name" => "Banner - widget 2",
            "desc" => "Upload your image banner.",
            "id" => "banner_custom_2",
            "std" => "",
            "type" => "upload");

        $of_options[] = array("name" => "Banner Link",
            "desc" => "Fill in the banner link.",
            "id" => "banner_custom_2_link",
            "std" => "http://",
            'maxlength' => 255,
            "type" => "text"
        );
        $of_options[] = array("name" => "Banner Link Target",
            "desc" => "Define a link target.",
            "id" => "banner_w_2_link_target",
            "std" => "_blank",
            "type" => "select",
     
           "options" => array("_blank"=>"_blank","_top"=>"_top","_parent"=>"_parent","_self"=>"_self"));

        $of_options[] = array("name" => "Google Ads Code",
            "desc" => "Insert the Google Ads Code. <b>Notice: You can have maximally 3 google ads on one page.</b>",
            "id" => "banner_custom_2_google",
            "std" => "",
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");

        /* END BANNERS ******************************************************* */

        /* 404  **************************************************** */
        $of_options[] = array("name" => "Error 404",
            "type" => "headingstart");



        $of_options[] = array("name" => "404 HTML",
            "desc" => "Insert the Error 404 page HTML code.".' '. jwUtils::getHelp("error_404"),
            "id" => "error_custom_html",
            "rows" => 20,
            "std" => '		<h1>File Not Found</h1>
				<div class="error">
					<p class="bottom">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
				</div>
				<p>Please try the following:</p>
				<ul> 
					<li>Return to the <a href="' . SITE_URL . '">home page</a></li>
				</ul>',
            "type" => "textarea");

        $of_options[] = array("type" => "headingend");




        /* BACKUP  **************************************************** */
        $of_options[] = array("name" => "Backup Options",
            "type" => "headingstart");

        $of_options[] = array("name" => "Backup and Restore Options",
            "id" => "of_backup",
            "std" => "",
            "type" => "backup",
            "desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.'.' '. jwUtils::getHelp("backup_opt"),
        );

        $of_options[] = array("name" => "Transfer Theme Options Data",
            "id" => "of_transfer",
            "std" => "",
            "type" => "transfer",
            "desc" => "You can transfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click Import Options.".' '. jwUtils::getHelp("backup_transfer_theme"), 
						
        );

        $of_options[] = array("type" => "headingend");


        // DEMO **********************************************************
        $of_options[] = array("name" => "Demo Data",
            "type" => "headingstart");

        $of_options[] = array(
            "name" => "Imort DEMO",
            "id" => "info-demo",
            "text" => "<h3 style=\"margin: 0 0 10px;\">Warning:</h3> When uploading the demo content you may lose your data. Please dont forget to back-up your database before you choose this option.<br><br> When you import the demo at the first time, the whole data will be imported. You will get only the presets at the next updates.<br><br>Import only on clean Wordpress.",
            "type" => "info",
            "space" => false,
            "message" => "warnings"
        );


        
        $of_options[] = array(
            "name" => "Import Sample Data".' '. jwUtils::getHelp("demo_import"),
            "space" => true,
            "id" => "import-sample-preset1",
            "file" => array("demo1"),
            "description" => array("Click the thumbnail to make your site look like our demo.<br /><b>Please read carefully the Warning above before you do this.</b>"),
            "img" => array("demo1.jpg"), //in /demo/images folder
            "type" => "importpreset"
        );
        


        $of_options[] = array("type" => "headingend");
        
        
         // Advanced **********************************************************
        $of_options[] = array("name" => "Advanced",
            "type" => "headingstart");
        
        $of_options[] = array(
            'id' => 'site_rtl',
            'type' => 'toggle',
            'name' => 'Right to left',
            'desc' => 'Support for RTL languages',
            'std' => '0'
        );
        

        $of_options[] = array(
            'id' => 'switch_udate',
            'type' => 'toggle',
            'name' => 'Notification of New Updates',
            'desc' => 'Choose whether you want to be informed about new available updates.'.' '. jwUtils::getHelp("a_update"),
            'std' => '1'
        );
        
        $of_options[] = array(
            'id' => 'social_comments_language',
            'type' => 'text',
            'name' => 'Social language',
            'desc' => 'To change the language use a value from <a href="'.THEME_URI.'/languages/language_code.html?amp;TB_iframe=true" class="thickbox">this</a> list.'.' '. jwUtils::getHelp("a_lng"),
            'std' => "en_GB",
            'mod' => 'mini'
        );
        
         $of_options[] = array(
            'id' => 'fbcomments_appid',
            'type' => 'text',
            'mod' => 'large',
            'name' => 'Facebook App ID',
            'desc' => 'For sharing your site and create FB commentary. For more information please visit <a href="https://developers.facebook.com">developers.facebook.com</a>.',
            'std' => "",
        );

         $of_options[] = array(
            'id' => 'fbcomments_moderated',
            'type' => 'button',
            'name' => 'Comment Moderation Area',
            'desc' => "When you're a moderator you will see notifications within facebook.com. If you don't want to have moderator status or want to see all comments in one area, use the link to the left.",
            'std' => '1',
            'href' => 'https://developers.facebook.com/tools/comments',
            'title' => 'Comment Moderation Area',
            'target' => '_blank'
        );
         
         //START TWITTER
       $of_options[] = array(
            "name" => "Twitter API",
            "type" => "sectionstart");
       
       $of_options[] = array(
            'id' => 'tw_consumer_id',
            'type' => 'text',
            'mod' => 'large',
            'name' => 'Consumer id',
            'desc' => 'To get this item please go to: <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>',
            'std' => "",
        );
       $of_options[] = array(
            'id' => 'tw_consumer_secret',
            'type' => 'text',
            'mod' => 'large',
            'name' => 'Consumer secret',
            'desc' => 'To get this item please go to: <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>',
            'std' => "",
        );
       $of_options[] = array(
            'id' => 'tw_access_id',
            'type' => 'text',
            'mod' => 'large',
            'name' => 'Access token',
            'desc' => 'To get this item please go to: <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>',
            'std' => "",
        );
       $of_options[] = array(
            'id' => 'tw_access_secret',
            'type' => 'text',
            'mod' => 'large',
            'name' => 'Access token secret',
            'desc' => 'To get this item please go to: <a href="https://dev.twitter.com/apps/new">https://dev.twitter.com/apps/new</a>',
            'std' => "",
        );
       
          
       $of_options[] = array(
            "type" => "sectionend");
         //END TWITTER
       
       
         
       $of_options[] = array(
            "name" => "Comments antispam question",
            "type" => "sectionstart");
       
       
       $of_options[] = array(
            'id' => 'comments_antispam_toggle',
            'type' => 'toggle',
            'name' => 'Turn on comments antispam question',
            'desc' => 'This option add antispam question to comment box.',
            'std' => '0'
        );
       
       
       $of_options[] = array(
            'id' => 'comments_antispam_question',
            'type' => 'text',
            'mod' => 'large',
            'name' => 'Comments antispam question',
            'desc' => '',
            'std' => "1+1=",
        );
       $of_options[] = array(
            'id' => 'comments_antispam_answer',
            'type' => 'text',
            'mod' => 'large',
            'name' => 'Comments antispam answer',
            'desc' => '',
            'std' => "2",
        );
       
       

       $of_options[] = array(
            "type" => "sectionend");

        $of_options[] = array("type" => "headingend");
        
        
        
        
        
        
         // WooCommerce **********************************************************
        $of_options[] = array("name" => "Woocommerce",
            "type" => "headingstart");
        
 
        $of_options[] = array(
            'id' => 'woo_display_on_main',
            'type' => 'toggle',
            'name' => 'Mix Products and Posts'.' '. jwUtils::getHelp("woocomm"),
            'desc' => 'Display product in the main blog, or display posts in shop if you have set shop as your homepage.',
            'std' => '1'
        );
        $of_options[] = array(
            'id' => 'woo_fequency_display_on_main',
            'type' => 'text',
            'mod' => 'large',
            'name' => 'Frequency product boxes',
            'desc' => 'Every X post boxes is showing as product box',
            'std' => "4"
        );
        
        $of_options[] = array(
            'id' => 'woo_choose_product',
            'type' => 'multidropdown',
            'name' => 'Show Product',
            'desc' => 'Choose what product will appear on the main page between your posts.',
            "std" => array(),
            "page" => null,
            "mod" => 'big',
            "chosen" => "true",
            "target" => 'products',
            "prompt" => "Choose products..",
        );
        
         $of_options[] = array("name" => "Where to Show a Cart in Header",
            "desc" => "Choose where you want a cart in header to be shown.",
            "id" => "woo_main_cart",
            "std" => "ecomm",
            "type" => "select",
           "options" => array("ecomm"=>"eCommerce","all_web"=>"All site","none"=>"none")
         );
        
        /* Product */
        $of_options[] = array(
            "name" => "Product Page".' '. jwUtils::getHelp("product_page"),
            "type" => "sectionstart");
        
        
        $of_options[] = array(
            "name" => "Product Page Layout",
            "desc" => "Select sidebar alignment." ,
            "id" => "product_layout",
            "std" => 'right',
            "type" => "layout",
            "extend" => 'woo_sidebar',
            "options" => array(
                'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
                'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
                'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
            )
        );

        $of_options[] = array(
            'id' => 'woo_sidebar_left',
            'type' => 'sidebar_select',
            'name' => 'Product Left Sidebars',
            'desc' => 'Here you can add some optional sidebars.',
            'std' => null,
            'mod' => 'medium'
        );

        $of_options[] = array(
            'id' => 'woo_sidebar_right',
            'type' => 'sidebar_select',
            'name' => 'Product Right Sidebars',
            'desc' => 'Here you can add some optional sidebars. You can add custom sidebar in <b>Sidebar Manager</b>',
            'std' => null,
            'mod' => 'medium'
        );
        
        
        
        $of_options[] = array(
            'id' => 'woo_nav_bar',
            'type' => 'toggle',
            'name' => 'Display Nav Bar on Product Pages',
            'desc' => 'Choose this option if you want to display the nav bar in individual products.',
            'std' => '1'
        );
        

     
        $of_options[] = array(
            "type" => "sectionend");
        
        
        
        /* Product CAT */
        $of_options[] = array(
            "name" => "Product Category".' '. jwUtils::getHelp("product_category"),
            "type" => "sectionstart");
        
        $of_options[] = array(
            "name" => "Product Category Layout",
            "desc" => "Select sidebar alignment.",
            "id" => "product_cat_layout",
            "std" => 'right',
            "type" => "layout",
            "extend" => 'product_cat_sidebar',
            "options" => array(
                'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
                'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
                'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
            )
        );

        $of_options[] = array(
            'id' => 'product_cat_sidebar_left',
            'type' => 'sidebar_select',
            'name' => 'Product Category Left Sidebars',
            'desc' => 'Here you can add some optional sidebars.',
            'std' => null,
            'mod' => 'medium'
        );

        $of_options[] = array(
            'id' => 'product_cat_sidebar_right',
            'type' => 'sidebar_select',
            'name' => 'Product Category Right Sidebars',
            'desc' => 'Here you can add some optional sidebars. You can add custom sidebar in <b>Sidebar Manager</b>',
            'std' => null,
            'mod' => 'medium'
        );
        
         $of_options[] = array(
            "type" => "sectionend");
         
         
         
         
          /* Product TAG */
        $of_options[] = array(
            "name" => "Product Tag",
            "type" => "sectionstart");
        
        $of_options[] = array(
            "name" => "Product Tag Layout",
            "desc" => "Select sidebar alignment.",
            "id" => "product_tag_layout",
            "std" => 'right',
            "type" => "layout",
            "extend" => 'product_tag_sidebar',
            "options" => array(
                'fullwidth' => ADMIN_DIR . 'assets/images/no_sidebar.gif',
                'left' => ADMIN_DIR . 'assets/images/left_sidebar.gif',
                'right' => ADMIN_DIR . 'assets/images/right_sidebar.gif'
            )
        );

        $of_options[] = array(
            'id' => 'product_tag_sidebar_left',
            'type' => 'sidebar_select',
            'name' => 'Product Tag Left Sidebars',
            'desc' => 'Here you can add some optional sidebars.',
            'std' => null,
            'mod' => 'medium'
        );

        $of_options[] = array(
            'id' => 'product_tag_sidebar_right',
            'type' => 'sidebar_select',
            'name' => 'Product Tag Right Sidebars',
            'desc' => 'Here you can add some optional sidebars. You can add custom sidebar in <b>Sidebar Manager</b>',
            'std' => null,
            'mod' => 'medium'
        );
        
         $of_options[] = array(
            "type" => "sectionend");
         
         
         
         

        $of_options[] = array("type" => "headingend");
        
        
        
        
        
        




        $menu['generalsettings'] = array('submenu' => 0, 'name' => 'General Settings');
        $menu['blog'] = array('submenu' => 0, 'name' => 'Blog');
        $menu['singlepost'] = array('submenu' => 0, 'name' => 'Single Post');
        $menu['sidebarmanager'] = array('submenu' => 0, 'name' => 'Sidebar Manager');
        $menu['customcode'] = array('submenu' => 0, 'name' => 'Custom Code');
        $menu['stylingoptions'] = array('submenu' => 0, 'name' => 'Styling Options');
        $menu['advertisementd'] = array('submenu' => 1, 'name' => 'Advertisement');
       // $menu['bannerbackground'] = array('submenu' => 1, 'name' => 'Banner Background'); - jedine bez vodkazu, nebo s js
        $menu['bannerleader'] = array('submenu' => 1, 'name' => 'Banner Leader');
        $menu['bannerheader468x60'] = array('submenu' => 1, 'name' => 'Banner Header 468x60');
        $menu['banner-skyscrapperright'] = array('submenu' => 1, 'name' => 'Banner - Skyscraper Right');
        $menu['banner-skyscrapperleft'] = array('submenu' => 1, 'name' => 'Banner - Skyscraper Left');
        $menu['banner-post1'] = array('submenu' => 1, 'name' => 'Banner - Post 1');
        $menu['banner-post2'] = array('submenu' => 1, 'name' => 'Banner - Post 2');
        $menu['banner-post3'] = array('submenu' => 1, 'name' => 'Banner - Post 3');
        $menu['banner-post3'] = array('submenu' => 1, 'name' => 'Banner - Post 3');
        $menu['banner-post3'] = array('submenu' => 1, 'name' => 'Banner - Post 3');
        $menu['banner-inposttop'] = array('submenu' => 1, 'name' => 'Banner - in post top');
        $menu['banner-inpostbottom'] = array('submenu' => 1, 'name' => 'Banner - in post bottom');
        $menu['banner-custom1'] = array('submenu' => 1, 'name' => 'Banner - Custom 1');
        $menu['banner-custom2'] = array('submenu' => -1, 'name' => 'Banner - Custom 2');
        $menu['sliderssettings'] = array('submenu' => 0, 'name' => 'Slider Settings');
        $menu['error404'] = array('submenu' => 0, 'name' => 'Error 404');
        $menu['backupoptions'] = array('submenu' => 0, 'name' => 'Backup');
        $menu['demodata'] = array('submenu' => 0, 'name' => 'Demo');
        $menu['advanced'] = array('submenu' => 0, 'name' => 'Advanced');
        $menu['woocommerce'] = array('submenu' => 0, 'name' => 'Woocommerce');





        return array($of_options, $menu);
    }

}
?>
