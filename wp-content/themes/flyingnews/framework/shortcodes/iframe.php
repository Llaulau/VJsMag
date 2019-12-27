<?php

function theme_shortcode_iframe($atts, $content = null, $code) {
    extract(shortcode_atts(array(
                'src' => '',
                'width' => '',
                'height' => ''
                    ), $atts));
    return '<iframe src="'.$src.'" width="'.$width.'" height="'.$height.'"></iframe>';
}

add_shortcode('iframe', 'theme_shortcode_iframe');