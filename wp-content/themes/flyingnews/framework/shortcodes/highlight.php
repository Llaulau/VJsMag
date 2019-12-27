<?php

function theme_shortcode_highlight($atts, $content = null, $code) {
    extract(shortcode_atts(array(
                'highlightcolor' => ''
                    ), $atts));
    return '<em class="highlight '.$highlightcolor.'">'.$content.'</em>';
}

add_shortcode('highlight', 'theme_shortcode_highlight');