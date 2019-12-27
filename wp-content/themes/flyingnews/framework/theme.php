<?php
/**
 * Base loader and theme initialization
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */

if (!class_exists('jwTheme')) {

    class jwTheme {
        /*
         * Basic themes inicialization
         */

        
        function init() {
            
            
            
           // error_reporting(E_ALL);
           // ini_set("display_errors", 1);
            //
            //  Define constants.
            $this->constants();
            
            // Language support.
            add_action('init', array(&$this, 'language'));

            // Add css 
            add_action('init', array(&$this, 'css'));
            add_action('wp_head', array(&$this, 'ie_css'));
            
      

            //Add meta
           // add_action('wp_head', array(&$this, 'meta'));

            // Add js
            add_action('init', array(&$this, 'scripts'));

            // Theme support. 
            add_action('after_setup_theme', array(&$this, 'supports'));
       
            
            add_action( 'wp', array(&$this,'custom_paged_404_fix' ));

            add_theme_support( 'woocommerce' );
            
            // Load basic class functions.
            $this->libs();

            // register Optios manager
            $jwOpt = new jwOpt();
            
            
            //RTL css
            if(jwOpt::get_option('site_rtl', '0') == '1'){
                add_action('wp_head', array(&$this, 'rtl_css'));
            }
            
            
            // Load theme's shortcodes
            $this->shortcodes();            
                 
            // Custom item in menu must be load for all space
            require THEME_ADMIN . '/options/menu.php';
            $optManager = nav_menu_options_manager::getInstance();
            require THEME_ADMIN . '/options/metaboxes.php';

            //loads Custom Posts
            require THEME_FRAMEWORK_DIR . '/custom_posts/portfolio.php';
            require THEME_FRAMEWORK_DIR . '/custom_posts/slides.php';

            //require THEME_FRAMEWORK_DIR . '/custom_posts/testimonial.php';
            //require THEME_FRAMEWORK_DIR . '/custom_posts/gallery.php';

            // Widgets initialize 
         
            add_action('widgets_init', array(&$this, 'widgets'));
            add_action('wp_ajax_get_media_image', array('Elements', 'get_media_image'));
            
            //woo-cart
            add_filter('add_to_cart_fragments', 'jwRender::woocommerce_header_add_to_cart_fragment');
            
            //Shortcode in widgets
            add_filter('widget_text', 'do_shortcode');
	
            //static class

            $jwStyle = new jwStyle();	    	  
            $jwStyle->get_static();
	         
            
            // register sidebar
            $jwSidebars = new jwSidebars(jwOpt::get_option('sidebars'));
                      
            if ( isset($_GET['import_data']) ) { 
            ?>
             <script>    
                    var nonce = '<?php echo wp_create_nonce  ('of_ajax_nonce'); ?>' ;
            </script>
            <?php
            }
            
            if ( isset($_REQUEST['_wpnonce']) ) { 
                $nonce = $_REQUEST['_wpnonce'];
                if (isset($_GET['import_data']) && (wp_verify_nonce($nonce,'of_ajax_nonce'))) {
                    $this->import_sample_demo($_GET['file']);
                    
                }
            }
            
            
           
            add_filter('rss2_item', 'rss_post_thumbnail');
            add_filter('rss_item', 'rss_post_thumbnail');
            
            function rss_post_thumbnail() {
                global $post;
                if(has_post_thumbnail($post->ID)) {   
                    $img = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ),"post-size" );
                    list($width, $height, $type, $attr) = getimagesize($img[0]);
                    echo '<enclosure
                            url="'.$img[0].'"
                            type="'.image_type_to_mime_type($type).'"
                            length=""
                            />';
                  }  
            }  


            // Load admin options
            if (is_admin()) {
                require THEME_ADMIN . '/options/metaboxes.php';
                require THEME_ADMIN . '/options/metaboxes-woocommerce.php';

                $jwPanel = new jwPanel();

                
                $jwMetabox = new jwMetabox($metapost);
                $jwMetabox = new jwMetabox($metapage);
                $jwMetabox = new jwMetabox($metapageblog);
                
                //$jwMetabox = new jwMetabox($metagallery);
                $jwMetatax = new jwMetatax($metacat,'category');
                $jwMetatax = new jwMetatax($metaprductcat,'product_cat');
                $jwSlidesPost = new jwSlidesPost();
                

                
                
		//pro testovani odpoznamkovat // update
                //set_site_transient('update_themes', null);
                
             if(jwOpt::get_option('switch_udate','1') == '1'){
		
                $example_update_checker = new ThemeUpdateChecker(
                        THEMESLUG,
                        'http://support.jawtemplates.com/updates/flyingnews/wp/update.json'
                    );
                
                //Ostra: 'http://support.jawtemplates.com/updates/flyingnews/wp/update.json'
                //Test: 'http://support.jawtemplates.com/updates/test/update.json'
             }
            
               
                
            }

            //Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
            //@ini_set('pcre.backtrack_limit', 500000);
            function custom_excerpt_length($length) {
                return jwOpt::get_option('blog_excerpt', 20);
            }

            add_filter('excerpt_length', 'custom_excerpt_length', 20);
            
            //Anti-spam filter
             if(jwOpt::get_option('comments_antispam_toggle', '0') == '1'){
                 add_filter('preprocess_comment', array('jwUtils','jaw_nobot_question_filter'));
             }
           

            //TOHLE NECHCE FUNGOVAT - proto sem to naflákal ručně do class_render;
            /*
              function new_excerpt_more($more) {
              return ' <a href="'. get_permalink() . '">Read the Rest...</a>';
              }
              add_filter('excerpt_more', 'new_excerpt_more');
             */


            function add_iframe($initArray) {
                $initArray['extended_valid_elements'] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]";
                return $initArray;
            }

            add_filter('tiny_mce_before_init', 'add_iframe');


            add_action('pre_get_posts', array(&$this, 'build_query_posts'));


            include_once ABSPATH . '/wp-admin/includes/nav-menu.php';
            require_once ( ABSPATH . 'wp-admin/includes/image.php' );

            
            // Při prvním spuštění šablony se deregistují všechny widgety a nastaví se základní menu.
           
                
                
                
                
            if (get_option('install') == null) {
                 $current_sidebars = get_option('sidebars_widgets');
                foreach($current_sidebars as $key=>$value){
                   $current_sidebars[$key] = array();
                }
                update_option('sidebars_widgets', $current_sidebars);
                
                wp_insert_term(
                        'Menu', 'nav_menu', array(
                    'description' => 'Base menu',
                    'slug' => 'default',
                    'parent' => ''
                        )
                );

                $mymenu = wp_get_nav_menu_object('Menu');
                $menuID = (int) $mymenu->term_id;


                $custom_item = array(
                    'menu-item-type' => 'custom',
                    'menu-item-url' => get_option('siteurl'),
                    'menu-item-title' => 'Home',
                    'menu-item-status' => 'publish'
      
                );
                
                wp_update_nav_menu_item($menuID,0, $custom_item);
                
                $insert_menu = array('primary_navigation' => $menuID);
                register_nav_menu('primary_navigation', 'Primary Navigation');
                set_theme_mod('nav_menu_locations', $insert_menu);
                
     
                add_option('install', '1');
            }
            
            
                  
            

            
        }
        

       
          
        


       function import_sample_demo($file) {
           require THEME_FRAMEWORK_LIB . 'class_demoimport.php';
            $import = new jwDemoImport($file);
            ?>
            <script>
                alert("Import done"); 
                location.replace('themes.php?page=optionsframework');
            </script>

            <?php
           
        }

        /*
         * Load constants
         */

        function constants() {

            $theme_version = '';

            if (function_exists('wp_get_theme')) {
                if (is_child_theme()) {
                    $temp_obj = wp_get_theme();
                    $theme_obj = wp_get_theme($temp_obj->get('Template'));
                } else {
                    $theme_obj = wp_get_theme();
                }

                $theme_version = $theme_obj->get('Version');
                $theme_name = $theme_obj->get('Name');
                $theme_uri = $theme_obj->get('ThemeURI');
                $author_uri = $theme_obj->get('AuthorURI');
            } else { // for WP < 3.4.0
                $theme_data = get_theme_data( get_template_directory() . '/style.css');
                $theme_version = $theme_data['Version'];
                $theme_name = $theme_data['Name'];
                //$theme_uri = $theme_data['ThemeURI'];
                $author_uri = $theme_data['AuthorURI'];
            }



            define('SITE_URL', get_option('siteurl'));
            define('FRAMEWORK', '1.0');
            define('THEMENAME', $theme_name);
            define('THEMESLUG', strtolower($theme_name));
            define('THEMEVERSION', $theme_version);
            define('THEMEURI', get_template_directory_uri());
            define('THEMEAUTHORURI', $author_uri);
            define('THEME_FRAMEWORK_DIR',  get_template_directory() . '/framework');
            define('THEME_FRAMEWORK_URI', get_template_directory_uri() . '/framework');
            define('THEME_FRAMEWORK_LIB', THEME_FRAMEWORK_DIR . '/lib/');

            define('ADMIN_PATH', THEME_FRAMEWORK_DIR . '/admin/');
            define('ADMIN_DIR', THEME_FRAMEWORK_URI . '/admin/');
            define('THEME_ADMIN', THEME_FRAMEWORK_DIR . '/admin');

            define('THEME_DIR', get_template_directory());
            define('THEME_URI', get_template_directory_uri());


            /* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */



            define('CATEGORIES', THEMESLUG . '_categories');
            define('MENUS', THEMESLUG . '_menus');
            define('OPTIONS', THEMESLUG . '_options');
            define('BACKUPS', '_backups');

            define('CHECK_UPDATE', 1209600); //86400*14 = 1209600
            define('THEME_FUNCTIONS', THEME_FRAMEWORK_DIR . '/functions');

          
        }


        /*
         * Load basic classes
         */

        function libs() {
            require THEME_FRAMEWORK_LIB . 'class_options.php';
            require THEME_FRAMEWORK_LIB . 'class_layout.php';
            require THEME_FRAMEWORK_LIB . 'class_utils.php';
            require THEME_FRAMEWORK_LIB . 'class_sidebars.php';    
            require THEME_FRAMEWORK_LIB . 'class_slider.php';
            require THEME_FRAMEWORK_LIB . 'class_render.php';   
            require THEME_FRAMEWORK_LIB . 'class_menu_jw.php';
            require THEME_FRAMEWORK_LIB . 'class_menu_mobile.php';
            require THEME_FRAMEWORK_LIB . 'class_menu_selectbox.php';
            require THEME_FRAMEWORK_LIB . 'class_custompost.php';
            require THEME_FRAMEWORK_LIB . 'class_flickr.php';      
            require THEME_FRAMEWORK_LIB . 'class_styles.php';
            require THEME_FRAMEWORK_LIB . 'class_breadcrumbs.php';                
            require THEME_FRAMEWORK_LIB . '/menu/nav_menu_walker.php';
            require THEME_FRAMEWORK_LIB . '/menu/nav_menu_one_option.php';
            require THEME_FRAMEWORK_LIB . '/menu/nav_menu_options_store.php';
            require THEME_FRAMEWORK_LIB . '/menu/nav_menu_options_printer.php';
            require THEME_FRAMEWORK_LIB . '/menu/nav_menu_options_manager.php';

            require THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsDataStore.php';
            require THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsDataPrinter.php';
            require THEME_FRAMEWORK_LIB . '/rating/metaboxOptionsStore/writepanelsManager.php';
            require THEME_FRAMEWORK_LIB . '/rating/admin.php';
            require THEME_FRAMEWORK_LIB . 'class_facebook.php';
            require THEME_FRAMEWORK_LIB . 'class_elements.php'; 
            require THEME_FRAMEWORK_LIB . 'class_updatechecker.php'; 
       
            if (is_admin()) {
                require THEME_FRAMEWORK_LIB . 'class_panel.php';
                require THEME_FRAMEWORK_LIB . 'class_metatax.php';
                require THEME_FRAMEWORK_LIB . 'class_metabox.php';
                
            }
        }

      

        /*
         * Supports 
         */

       function supports() {
            if (function_exists('add_theme_support')) {
               
               
                // Add post thumbnail supports. http://codex.wordpress.org/Post_Thumbnails
                add_theme_support('post-thumbnails');
              
                // Add post formarts supports. http://codex.wordpress.org/Post_Formats
                add_theme_support('post-formats', array('gallery', 'image', 'quote', 'video'));
                
                //Tuna to vobcas BLBNE!!!
                add_image_size('thumbs', 304, 0,true);
                add_image_size('slidebar-big', 310, 375,true); // registrace nové velikosti obrázku
                add_image_size('slidebar-small', 145, 105,true); // registrace nové velikosti obrázku
                add_image_size('post-size', 296, 0 ,true);
             
              


                // Add menu supports. http://codex.wordpress.org/Function_Reference/register_nav_menus
                add_theme_support('menus');
                register_nav_menus(array(
                    'primary_navigation' => __('Primary Navigation', 'jawtemplates'),
                    'footer_navigation' => __('Footer Navigation', 'jawtemplates')
                ));
                //add_theme_support('custom-header');
                //add_theme_support('custom-background');
                add_editor_style('/css/editor-style.css');
                /*
                  if ( function_exists('add_custom_background') ) {
                  add_custom_background();
                  }
                 */


                //This enables post and comment RSS feed links to head. This should be used in place of the deprecated automatic_feed_links.
                add_theme_support('automatic-feed-links');

                // reference to: http://codex.wordpress.org/Function_Reference/add_editor_style
                add_theme_support('editor-style');
            }
        }

       
        /*
         * Register theme's extra widgets.
         */

        function widgets() {
            require_once (THEME_FRAMEWORK_DIR . '/widgets/default_widget.php');
            require_once (THEME_FRAMEWORK_DIR . '/widgets/tab_posts.php');
            register_widget('tab_posts_widget');

            require_once (THEME_FRAMEWORK_DIR . '/widgets/jwtwitter.php');
            register_widget('jwTwitterWidget');

            require_once (THEME_FRAMEWORK_DIR . '/widgets/jwbannerwidget.php');
            register_widget('jwBannerWidget');
            
            require_once (THEME_FRAMEWORK_DIR . '/widgets/flickr.php');
            register_widget('Theme_Widget_Flickr');
            
            require_once (THEME_FRAMEWORK_DIR . '/widgets/jwSocial.php');
            register_widget('jwSocial_widget');
            
            require_once (THEME_FRAMEWORK_DIR . '/widgets/contact_form.php');
            register_widget('jwContact_Form');
            
            require_once (THEME_FRAMEWORK_DIR . '/widgets/jwLogin.php');
            register_widget('jwLogin_widget');
            
            require_once (THEME_FRAMEWORK_DIR . '/widgets/jwRating.php');
            register_widget('jwRatingWidget');
 
        }

        /*
         * Register shortcodes.
         */

        function shortcodes() {
            if (is_admin()) { // delete if not use 
                // INCLUDE JAW SHORTCODES
                include (THEME_ADMIN . '/shortcodes/jaw_shortcodes.php');
            } if (!is_admin()) { // delete if not use
                // COLUMNS
                include(THEME_FRAMEWORK_DIR . '/shortcodes/columns.php');

                // LAYOUTS
                include(THEME_FRAMEWORK_DIR . '/shortcodes/layouts.php');

                // INCLUDE JAW SHORTCODES
                include(THEME_FRAMEWORK_DIR . '/shortcodes/blockquote.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/headline.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/buttons.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/notices.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/highlight.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/typography.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/dividers.php');


                include(THEME_FRAMEWORK_DIR . '/shortcodes/portfolios.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/contact_form.php');
                //Galerie out of date
                //include(THEME_FRAMEWORK_DIR . '/shortcodes/gallery.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/blog.php');

                // FEATURES
                include(THEME_FRAMEWORK_DIR . '/shortcodes/iframe.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/google_map.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/tabs.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/accordion.php');
                include(THEME_FRAMEWORK_DIR . '/shortcodes/toggle.php');

                include(THEME_FRAMEWORK_DIR . '/shortcodes/media.php');
            }
        }

        /*
         * Make theme available for translation
         */

        function language() {
            
                load_theme_textdomain('jawtemplates', THEME_DIR . '/languages/');
            
        }

        function css() {
	    
            if (!is_admin()) {
                wp_register_style('foundation.min', get_template_directory_uri() . '/css/foundation.min.css', false);
                wp_enqueue_style('foundation.min');

                // Load style.css to allow contents overwrite foundation & app css
                wp_register_style('style', get_template_directory_uri() . '/style.css', false);
                // Load dynamic style css/file
                //include THEME_FUNCTIONS.'/styledeclaration.php';
                wp_register_style('template', get_template_directory_uri() . '/css/template.css', false);
                wp_enqueue_style('style');
                wp_enqueue_style('template');

                wp_register_style('custom-styles', get_template_directory_uri() . '/css/custom-styles.css', false);
                wp_enqueue_style('custom-styles');
                
                wp_register_style('woocommerce-custom', get_template_directory_uri() . '/css/woocommerce-custom.css', array('woocommerce_frontend_styles'));
		wp_enqueue_style('woocommerce-custom');
                
            } else {
                   
                wp_register_style('custompost', ADMIN_DIR . 'assets/css/custompost.css', false);
                wp_enqueue_style('custompost');

                wp_register_style('admin-style', ADMIN_DIR . 'assets/css/admin-style.css', false);
                wp_enqueue_style('admin-style');

                wp_register_style('colorpicker', ADMIN_DIR . 'assets/css/colorpicker.css', false);
                wp_enqueue_style('colorpicker');
                wp_enqueue_style('thickbox');
		
		
		 wp_register_style('colorpicker', ADMIN_DIR . 'assets/css/colorpicker.css', false);
		
            }
        }

        function ie_css() {
            if (!is_admin()) {
                echo '<!--[if lt IE 9]>';
                echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/ie.css">';
                echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
                echo '<![endif]-->';
            }
        }
        
        function rtl_css() {
            if (!is_admin()) {
                // wp_register_style('template-rtl', get_template_directory_uri() . '/css/template-rtl.css', false);
                 //wp_enqueue_style('template-rtl');
                 echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/template-rtl.css">';
                 echo '<!--[if lt IE 9]>';
                 echo '<link rel="stylesheet" href="'.get_template_directory_uri().'/css/ie-rtl.css">';
                 echo '<![endif]-->';
            }
        }
        
        
         
                    
        /*function meta() {
            echo "<meta property='fb:app_id' content='" . jwOpt::get_option('fbcomments_appid') . "'/>";
        }*/

        function scripts() {


            if (!is_admin()) {
                // Enqueue to header
                wp_register_script('all', get_template_directory_uri() . '/js/all.js', array('jquery'), false, true);
                wp_enqueue_script('all');
                

                wp_register_script('app', get_template_directory_uri() . '/js/app.js', array('jquery'), false, true);
                wp_enqueue_script('app');
		

                // Enable threaded comments 
                if (is_singular() && comments_open() && get_option('thread_comments')){
                    wp_enqueue_script('comment-reply');
                }
                
            } else {

                wp_enqueue_script('jquery-ui-core',  array('jquery'));
                wp_enqueue_script('jquery-ui-sortable', array('jquery'));
                wp_enqueue_script('of-medialibrary-uploader', ADMIN_DIR . 'assets/js/of-medialibrary-uploader.js', array('jquery'));
                wp_enqueue_script('media-upload', array('jquery'));
                wp_enqueue_script('jquery-input-mask', ADMIN_DIR . 'assets/js/jquery.maskedinput-1.2.2.js', array('jquery'));
                wp_enqueue_script('tipsy', ADMIN_DIR . 'assets/js/jquery.tipsy.js', array('jquery'));
                wp_enqueue_script('color-picker', ADMIN_DIR . 'assets/js/colorpicker.js', array('jquery'));
                wp_enqueue_script('ajaxupload', ADMIN_DIR . 'assets/js/ajaxupload.js', array('jquery'));
                wp_enqueue_script('chosen', ADMIN_DIR . 'assets/js/chosen.jquery.js', array('jquery'));
                wp_enqueue_script('cookie', ADMIN_DIR . 'assets/js/cookie.js', array('jquery'), false, true);     
                wp_enqueue_script('rangeinput', ADMIN_DIR . 'assets/js/rangeinput.js', array('jquery'));
                wp_enqueue_script('elements', ADMIN_DIR . 'assets/js/elements.js', array('jquery'));

                wp_enqueue_script('thickbox', array('jquery'));

                if (isset($_GET['page']) && $_GET['page'] == 'optionsframework') {
                    wp_enqueue_script('smof', ADMIN_DIR . 'assets/js/smof.js', array('jquery', 'utils', 'thickbox')); // must by LAST!!
                }
            }
            
        }

        function build_query_posts($query) {

             global $jawtruepage;
            if ($query->is_main_query() && !is_admin()) {
                if (is_page()) {
                    $jawtruepage = true;
                }else {$jawtruepage = false;}


                if (is_front_page()) {
                    $query->set('paged', (get_query_var('paged')) ? get_query_var('paged') : 1 );
                    $query->set('posts_per_page', jwOpt::get_option('blog_postscount', '-1'));
                    // $query->set('post_type', $post_type);

                    $cat = jwOpt::get_option('blog_cat', '');
                    if ($cat)
                        $cat = implode(',', $cat);

                    $query->set('cat', $cat);

                    $query->set('order', jwOpt::get_option('blog_order', 'desc'));
                    $query->set('orderby', jwOpt::get_option('blog_orderby', 'date'));
                   
                 
                    
                    
                    if (is_home()  ){
                        $pos = jwOpt::get_option('slider_source','last') ;             
                        $sp = jwOpt::get_option('slider_sticky','0') ; 

                    } 
                    else if (is_category()){
                        
                        $category = single_term_title("", false);
                        $catid = get_cat_ID( $category );
                        $pos = jwOpt::get_option('cat_custom_source','last','category',$catid) ;      
                        $sp = jwOpt::get_option('cat_slider_sticky','0','category',$catid) ;  
                        
                        
                    }

        
                    if(isset($pos) && $pos == 'sticky' && isset($sp) && $sp == '0'){
                        $query->set('post__not_in', get_option( 'sticky_posts' ));
                    }                    
                   
                }
            }

        }
        
        
        
             
            /**
             * If we go beyond the last page and request a page that doesn't exist,
             * force WordPress to return a 404.
             * See http://core.trac.wordpress.org/ticket/15770
             */
            function custom_paged_404_fix( ) {
                global $wp_query;

                if ( is_404() || !is_paged() || 0 != count( $wp_query->posts ) )
                    return;

                $wp_query->set_404();
                status_header( 404 );
                nocache_headers();
            }
            
           
 
            


    }

}
?>
