<?php

function theme_shortcode_h($atts, $content = null, $code) {
    return '<'.$code.'>'.$content.'</'.$code.'>';
}

add_shortcode('h1', 'theme_shortcode_h');
add_shortcode('h2', 'theme_shortcode_h');
add_shortcode('h3', 'theme_shortcode_h');
add_shortcode('h4', 'theme_shortcode_h');
add_shortcode('h5', 'theme_shortcode_h');
add_shortcode('h6', 'theme_shortcode_h');