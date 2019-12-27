<?php

/**
 * Description of class_font manage all fonts (Google Fonts and Cufon Js). This is 
 * loader
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo cufon, google fonts
 */
class jwFont {

    //put your code here

    private static $_list = array();
    private static $_font = null;

    function __construct($list, $default_font) {

	$this->set_list($list);
	$this->set_font($default_font);
    }

    function bind($name, $data) {
	
    }

    function set_list($fonts) {
	if (is_array($fonts) && count($fonts) > 0)
	    self::$_list = $fonts;
    }

    function set_font($font) {
	if (isset(self::$_list[$font]))
	    self::$_font = $font;
    }

    static function get_list() {
	return self::$_list;
    }

    static function get_font() {
	return self::$_font;
    }

    function load_google() {
	//todo
    }

    function load_cufon() {
	//todo
    }

    // Ajax to include font infomation

    function get_font_url() {


	$recieve_font = $_POST['font'];
        if(isset($recieve_font)){
            if (jwFont::$all_font[$recieve_font]['type'] == 'Cufon') {

                $font_url = array('type' => $all_font[$recieve_font]['type'], 'url' => $all_font[$recieve_font]['path']);
            } else if ($all_font[$recieve_font]['type'] == "Google Font") {

                $font_url = array('type' => $all_font[$recieve_font]['type'], 'url' => 'http://fonts.googleapis.com/css?family=' . str_replace(' ', '+', $recieve_font));
            } else {

                die(-1);
            }
        }

	die(json_encode($font_url));
    }

}

class jwFontBase {

    private $kind = null;
    private $family = null;
    private $dsds = null;

}

?>
