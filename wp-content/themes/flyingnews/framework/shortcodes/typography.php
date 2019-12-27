<?php

function theme_shortcode_pre($atts, $content = null, $code) {
    return '<pre>'.$content.'</pre>';
}

function theme_shortcode_code($atts, $content = null, $code) {
    return '<code>'.$content.'</code>';
}

add_shortcode('pre', 'theme_shortcode_pre');
add_shortcode('code', 'theme_shortcode_code');