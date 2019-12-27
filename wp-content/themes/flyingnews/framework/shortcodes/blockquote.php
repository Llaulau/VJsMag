<?php

function theme_shortcode_blockquote($atts, $content = null, $code) {
    return '<blockquote><p>'.$content.'</p></blockquote>';
}

add_shortcode('blockquote', 'theme_shortcode_blockquote');