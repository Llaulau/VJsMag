<?php

function theme_shortcode_divider_top($atts, $content = null, $code) {
    return '<div class="divider_top"><a class="divider_to_top" href="#">Back to Top</a></div>';
}

function theme_shortcode_divider_line($atts, $content = null, $code) {
    return '<div class="divider_line"></div>';
}

function theme_shortcode_divider_adv($atts, $content = null, $code) {
    extract(shortcode_atts(array(
                'topwidth' => '',
                'bottomwidth' => '',
                'linecolor' => ''
                    ), $atts));
    if (isset($topwidth) && !empty($topwidth)) {
        $top = " padding-top: ".$topwidth."px; ";
    }
    if (isset($bottomwidth) && !empty($bottomwidth)) {
        $bottom = " margin-bottom: ".$bottomwidth."px; ";
    }
    if (isset($linecolor) && !empty($linecolor)) {
        $color = " border-bottom: 1px solid ".$linecolor."; ";
    }
    return '<div class="divider_adv" style="'.$top.$bottom.$color.'"></div>';
}

function theme_shortcode_divider_adv_top_top($atts, $content = null, $code) {
    extract(shortcode_atts(array(
                'title' => '',
                'color' => ''
                    ), $atts));
    $textColor = "";
    if (isset($color) && !empty($color)) {
        $textColor = 'style="color: '.$color.';"';
        $color = 'style="border-top: 1px solid '.$color.";'";
    }
    if (isset($title) && !empty($title)) {
        $title = '<a href="#" '.$textColor.'>'.$title.'</a>';
    }
    return '<div class="divider_adv_to_top" '.$color.'">'.$title.'</div>';
}

add_shortcode('divider_to_top', 'theme_shortcode_divider_top');
add_shortcode('divider_line', 'theme_shortcode_divider_line');
add_shortcode('divider_adv', 'theme_shortcode_divider_adv');
add_shortcode('divider_adv_top_top', 'theme_shortcode_divider_adv_top_top');
