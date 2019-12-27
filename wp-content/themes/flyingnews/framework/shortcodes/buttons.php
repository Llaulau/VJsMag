<?php

function theme_shortcode_button($atts, $content = null, $code) {
    extract(shortcode_atts(array(
                'title' => '',
                'link' => '',
                'size' => '',
                'buttoncolor' => '',
                'bgcolor' => '',
                'textcolor' => '',
                'bghovercolor' => '',
                'tetxhovercolor' => ''
                    ), $atts));
    return '<a href="'.$link.'" class="button '.$size.' '.$buttoncolor.'"><span>'.$title.'</span></a>';
}

add_shortcode('button', 'theme_shortcode_button');