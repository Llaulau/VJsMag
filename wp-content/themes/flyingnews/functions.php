<?php
//Kint::trace() ;
// load theme framework

include get_template_directory() . '/framework/theme.php';

$theme = new jwTheme();
$theme->init();



                


/* Customized the output of caption, you can remove the filter to restore back to the WP default output. Courtesy of DevPress. http://devpress.com/blog/captions-in-wordpress/ */
add_filter('img_caption_shortcode', 'cleaner_caption', 10, 3);


function cleaner_caption($output, $attr, $content) {

    /* We're not worried abut captions in feeds, so just return the output here. */
    if (is_feed())
	return $output;

    /* Set up the default arguments. */
    $defaults = array(
	'id' => '',
	'align' => 'alignnone',
	'width' => '',
	'caption' => ''
    );

    /* Merge the defaults with user input. */
    $attr = shortcode_atts($defaults, $attr);

    /* If the width is less than 1 or there is no caption, return the content wrapped between the [caption]< tags. */
    if (1 > $attr['width'] || empty($attr['caption']))
	return $content;

    /* Set up the attributes for the caption <div>. */
    $attributes = ' class="figure ' . esc_attr($attr['align']) . '"';
    

    /* Open the caption <div>. */
    $output = '<div' . $attributes . ' style="width:'.$attr['width'].'px;">';
    /* Allow shortcodes for the content the caption was created for. */
    $output .= do_shortcode($content);

    /* Append the caption text. */
    $output .= '<div>' . $attr['caption'] . '</div>';
    /* Close the caption </div>. */
    $output .= '</div>';
    

    /* Return the formatted, clean caption. */
    return $output;
}

// Clean the output of attributes of images in editor. Courtesy of SitePoint. http://www.sitepoint.com/wordpress-change-img-tag-html/
function image_tag_class($class, $id, $align, $size) {
    $align = 'align' . esc_attr($align);
    return $align;
}

add_filter('get_image_tag_class', 'image_tag_class', 0, 4);

function image_tag($html, $id, $alt, $title) {
    return preg_replace(array(
		'/\s+width="\d+"/i',
		'/\s+height="\d+"/i',
		'/alt=""/i'
		    ), array(
		'',
		'',
		'',
		'alt="' . $title . '"'
		    ), $html);
}

add_filter('get_image_tag', 'image_tag', 0, 4);

// img unautop, Courtesy of Interconnectit http://interconnectit.com/2175/how-to-remove-p-tags-from-images-in-wordpress/
function img_unautop($pee) {
    $pee = preg_replace('/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $pee);
    return $pee;
}

// Blbě to zarovnava obrazek
//add_filter('the_content', 'img_unautop', 30);


function add_social_contactmethod($contactmethods)
{
    // Add Networks
    $contactmethods['twitter'] = 'Twitter URL';
    $contactmethods['facebook'] = 'Facebook URL';
    $contactmethods['linkedin'] = 'Linkedin URL';
    $contactmethods['youtube'] = 'YouTube URL';
    $contactmethods['google'] = 'Google+ URL';
    $contactmethods['vimeo'] = 'Vimeo URL';
    $contactmethods['flickr'] = 'Flickr URL';

    return $contactmethods;
}

add_filter('user_contactmethods', 'add_social_contactmethod', 10, 1);

/**
 * Change "Product Description Tab Title" on single product panel 
 */
 
function isa_product_description_tab_title() {
    echo 'Shop';
}
add_filter('woocommerce_product_description_tab_title',
'isa_product_description_tab_title');


?>