<?php
function theme_shortcode_accordion($atts, $content = null, $code) {
    return "<ul class=\"accordion\">" . do_shortcode($content) . "</ul>";
}

function theme_shortcode_accordion_item($atts, $content = null, $code) {
    extract(
        shortcode_atts(
            array(
                'class' => '',
                'title' => ''
                 ), 
            $atts
        )
    );
    
    if ($class == 'active') {
        return "<li class=\"active\"><div class=\"title\"><h5>".$title."</h5></div><div class=\"content\">".$content."</div></li>";
    } else {
        return "<li><div class=\"title\"><h5>".$title."</h5></div><div class=\"content\">".$content."</div></li>";
    }
}

add_shortcode('accordion', 'theme_shortcode_accordion');
add_shortcode('accordion_item', 'theme_shortcode_accordion_item');

