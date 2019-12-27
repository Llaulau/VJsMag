<?php

/**
 * Get layout for page/post/gallery/homepage,forntpage
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo v pripade ze sablona potrebuje dalsi rozmery contentu a sidebaru je 
 * treba napsat prevodni tabulku nebo to vzpodminkovat ve funkci get. 
 * U sidebaru je pevna sirka four
 */
class jwLayout {

    // default initialization: fullwidth
    private static $_init = false;
    private static $_sidebar_layout = 'sidebar-none';
    private static $_sidebar = '';
    private static $_sidebar_width = 'four';
    private static $_content_width = 'twelve';

    function __construct() {
        self::get();     
    }

    public static function sidebar_layout() {

	if (!self::$_init)
	    self::get();

	return self::$_sidebar_layout;
    }

    public static function content_width() {
	if (!self::$_init)
	    self::get();
	return self::$_content_width;
    }

    public static function sidebar_width() {
	if (!self::$_init)
	    self::get();
	return self::$_sidebar_width;
    }

    public static function sidebar() {
	if (!self::$_init)
	    self::get();
	return self::$_sidebar;
    }
    
    // prepered for defined variable $name in do_action( 'get_sidebar', $name ); 
    public static function add_action(){
        
   
    }
    

    public static function get() {
	self::$_init = true;
        
        
        
        if(function_exists('is_shop') && is_shop()){
            $layout = get_post_meta(get_option('woocommerce_shop_page_id'), '_layout', true);
	    if ($layout != '' && $layout != 'fullwidth') {
		self::$_sidebar = get_post_meta(get_option('woocommerce_shop_page_id'), '_sidebar_' . $layout, true);
		self::$_content_width = 'eight';
		self::$_sidebar_width = 'four';
		self::$_sidebar_layout = $layout . '-sidebar';
	    } else { /* default init */
	    }    
	}else if(function_exists('is_product') && is_product()){
            $layout = jwOpt::get_option('product_layout');
	    if ($layout != '' && $layout != 'fullwidth') {
		self::$_sidebar = jwOpt::get_option('woo_sidebar_'.$layout);
		self::$_content_width = 'eight';
		self::$_sidebar_width = 'four';
		self::$_sidebar_layout = $layout . '-sidebar';
	    } else { /* default init */
	    }    
	}else if(function_exists('is_product_category') && is_product_category()){
            $layout = jwOpt::get_option('product_cat_layout');
	    if ($layout != '' && $layout != 'fullwidth') {
		self::$_sidebar = jwOpt::get_option('product_cat_sidebar_'.$layout);
		self::$_content_width = 'eight';
		self::$_sidebar_width = 'four';
		self::$_sidebar_layout = $layout . '-sidebar';
	    } else { /* default init */
	    }    
	}else if(function_exists('is_product_tag') && is_product_tag()){
            $layout = jwOpt::get_option('product_tag_layout');
	    if ($layout != '' && $layout != 'fullwidth') {
		self::$_sidebar = jwOpt::get_option('product_tag_sidebar_'.$layout);
		self::$_content_width = 'eight';
		self::$_sidebar_width = 'four';
		self::$_sidebar_layout = $layout . '-sidebar';
	    } else { /* default init */
	    }    
	}else if (is_page()) { // post type PAGE

	    $layout = get_post_meta(get_the_ID(), '_layout', true);
	    if ($layout != '' && $layout != 'fullwidth') {
		self::$_sidebar = get_post_meta(get_the_ID(), '_sidebar_' . $layout, true);
		self::$_content_width = 'eight';
		self::$_sidebar_width = 'four';
		self::$_sidebar_layout = $layout . '-sidebar';
	    } else { /* default init */
	    }    
	} elseif (is_single()) { // all post type (post,portfolios, taxonomies and slidies....) 
	    $layout = get_post_meta(get_the_ID(), '_layout', true);
	    
	    if ($layout !== 'default' && $layout !== '') { // first test post page layout
		if ($layout !== 'fullwidth') {
		    self::$_sidebar = get_post_meta(get_the_ID(), '_sidebar_' . $layout, true);
		    self::$_content_width = 'eight';
		    self::$_sidebar_width = 'four';
		    self::$_sidebar_layout = $layout . '-sidebar';
		} else { /* default init */
		}
	    } else { // global configuration in the Theme admin panel
		$layout2 = jwOpt::get_option('post_layout');
		if ($layout2 != '' && $layout2 != 'fullwidth') { // first test post page layout
		    self::$_sidebar = jwOpt::get_option('post_sidebar_' . $layout2);
		    self::$_content_width = 'eight';
		    self::$_sidebar_width = 'four';
		    self::$_sidebar_layout = $layout2 . '-sidebar';
		} else { /* default init */
		}
	    }
	} elseif (is_archive() || is_search()) { //elseif ((is_archive() && !is_category ()) || is_search()) {
	    $layout = jwOpt::get_option('search_and_archive_layout');
	    if ($layout != '' && $layout != 'fullwidth') { // first test post page layout
		self::$_sidebar = jwOpt::get_option('search_and_archive_sidebar_' . $layout);
		self::$_content_width = 'eight';
		self::$_sidebar_width = 'four';
		self::$_sidebar_layout = $layout . '-sidebar';
	    } else { /* default init */
	    }
	}  else { //if (is_category() || is_tag() || is_tax() || is_feed) {
	    $layout = jwOpt::get_option('blog_layout');
	    if ($layout != '' && $layout != 'fullwidth') { // first test post page layout
		self::$_sidebar = jwOpt::get_option('blog_sidebar_' . $layout);
		self::$_content_width = 'eight';
		self::$_sidebar_width = 'four';
		self::$_sidebar_layout = $layout . '-sidebar';
	    } else { /* default init */
	    }
	    /*
	      if (is_home()) { // jedna se klasicky blog
	      } else { // nejaka obzc kategorie
	      } */
	}
        
	global $content_width;
	if (!isset(self::$_content_width)) {
	    $content_width = 960;
	}
	if (self::$_content_width == 'twelve') {
	    $content_width = 960;
	} else if (self::$_content_width == 'eight') {
	    $content_width = 640;
	}
        

        
        
    }

    // debug mod
    static function debug() {
	ob_start();
	?>
	<ul>
	    <li>Content width: <?php echo self::$_content_width; ?></li>
	    <li>Sidebar: <?php echo self::$_sidebar ?></li>
	    <li>Sidebar Layout: <?php echo self::$_sidebar_layout; ?></li>
	    <li>Sidebar width: <?php echo self::$_sidebar_width; ?></li>
	</ul>    
	<?php
	echo ob_get_clean();
    }

}
?>
