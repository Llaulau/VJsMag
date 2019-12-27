<?php

add_shortcode('one_half', 'jaw_column');
add_shortcode('one_third', 'jaw_column');
add_shortcode('one_fourth', 'jaw_column');
add_shortcode('one_fifth', 'jaw_column');
add_shortcode('one_sixth', 'jaw_column');
add_shortcode('two_third', 'jaw_column');
add_shortcode('three_fourth', 'jaw_column');
add_shortcode('two_fifth', 'jaw_column');
add_shortcode('three_fifth', 'jaw_column');
add_shortcode('four_fifth', 'jaw_column');
add_shortcode('five_sixth', 'jaw_column');
add_shortcode('one_half_last', 'jaw_column');
add_shortcode('one_third_last', 'jaw_column');
add_shortcode('one_fourth_last', 'jaw_column');
add_shortcode('one_fifth_last', 'jaw_column');
add_shortcode('one_sixth_last', 'jaw_column');
add_shortcode('two_third_last', 'jaw_column');
add_shortcode('three_fourth_last', 'jaw_column');
add_shortcode('two_fifth_last', 'jaw_column');
add_shortcode('three_fifth_last', 'jaw_column');
add_shortcode('four_fifth_last', 'jaw_column');
add_shortcode('five_sixth_last', 'jaw_column');


function jaw_column($atts, $content = null, $code) {
    $pattern = '/((.*)_last)/';
    preg_match($pattern, $code, $matches);
    $out = ""; 
    if(isset($matches[0])){
       $out .= '<div class="' . $matches[2] . ' last">' . do_shortcode(trim($content)) . '</div>';
       $out.= '<div class="clear"></div>'; 
    }else{
       $out .= '<div class="' . $code . '">' . do_shortcode(trim($content)) . '</div>';
    }
    return $out;
}

?>