<?php


function theme_wpml_translate($atts, $content = null, $code) {
    extract(shortcode_atts(array( 'lang' => '' ), $atts));
    $lang_active = ICL_LANGUAGE_CODE;
		
		if($lang == $lang_active){
			return $content;
		}
}

	add_shortcode('wpml_translate', 'theme_wpml_translate');	

?>
