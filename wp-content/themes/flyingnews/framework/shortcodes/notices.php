<?php

function theme_shortcode_notice($atts, $content = null, $code) {
    extract(shortcode_atts(array(
                'noticetype' => ''
                    ), $atts));
    return '<p class="notice '.$noticetype.'">'.$content.'</a>';
}

add_shortcode('notice', 'theme_shortcode_notice');