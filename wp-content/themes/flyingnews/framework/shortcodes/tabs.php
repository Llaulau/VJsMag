<?php
function theme_shortcode_tabs($atts, $content = null, $code) {
    return do_shortcode($content);
}

function theme_shortcode_tabtitles($atts, $content = null, $code) {
    return "<dl class=\"tabs\">" . do_shortcode($content) . "</dl>";
}

function theme_shortcode_tabtitle($atts, $content = null, $code) {
    extract(shortcode_atts(array(
                'class' => '',
                'id' => '1'
                    ), $atts));
    if ($class == 'active') {
        return "<dd class=\"active\"><a href=\"#tab" . $id . "\">" . $content . "</a></dd>";
    } else {
        return "<dd><a href=\"#tab" . $id . "\">" . $content . "</a></dd>";
    }
}

function theme_shortcode_tabcontents($atts, $content = null, $code) {
    return "<ul class=\"tabs-content\">" . do_shortcode($content) . "</ul>";
}

function theme_shortcode_tabcontent($atts, $content = null, $code) {
    extract(shortcode_atts(array(
                'class' => '',
                'id' => '1'
                    ), $atts));
    if ($class == 'active') {
        return "<li class=\"active\" id=\"tab".$id."Tab\">" . do_shortcode($content) . "</li>";
    } else {
        return "<li id=\"tab".$id."Tab\">" . do_shortcode($content) . "</li>";
    }
}

add_shortcode('tabs', 'theme_shortcode_tabs');
add_shortcode('tabtitles', 'theme_shortcode_tabtitles');
add_shortcode('tabtitle', 'theme_shortcode_tabtitle');
add_shortcode('tabcontents', 'theme_shortcode_tabcontents');
add_shortcode('tabcontent', 'theme_shortcode_tabcontent');