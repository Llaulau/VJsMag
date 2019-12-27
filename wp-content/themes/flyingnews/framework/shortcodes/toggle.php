<?php
function theme_shortcode_toggle($atts, $content = null, $code) {
    extract(
        shortcode_atts(
            array(
                'class' => '',
                'title' => ''
                 ), 
            $atts
        )
    );
    return "<div class=\"toggle\"><h4>".$title."</h4><div class=\"toggle_content\">" . do_shortcode($content) . "</div></div>";
}

add_shortcode('toggle', 'theme_shortcode_toggle');

