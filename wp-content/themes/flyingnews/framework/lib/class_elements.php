<?php

/**
 * Library of HTML elements. Use only in admin area
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class Elements {

    public static $_layout = 'options';
    private static $_instance = null;

    //public static $gallery_meta_box;


    static function setLayout($layout = 'options') {
	self::$_layout = $layout;
    }

    public static function getInstance() {
	if (self::$_instance == null) {
	    self::$_instance = new Elements();
	}


	return self::$_instance;
    }

    static function defaults($value) {
	$defaults = array();
	if (isset($value['type']) && $value['type'] == 'multicheck') {
	    if (is_array($value['std'])) {
		foreach ($value['std'] as $key) {
		    $defaults[$value['id']][$key] = true;
		}
	    } else {
		$defaults[$value['id']][$value['std']] = true;
	    }
	} else if (isset($value['type']) && $value['type'] == 'range_measurement') {
	    if (isset($value['id']) && isset($value['std']))
		$defaults[$value['id']] = $value['std'];
	    if (isset($value['id']) && isset($value['unit_std']))
		$defaults[$value['id']['unit_std']] = $value['unit_std'];
	}else {
	    if (isset($value['id']) && isset($value['std']))
		$defaults[$value['id']] = $value['std'];
	    //else $defaults[$value['id']] = '';
	}

	return $defaults;
    }

    /**
     * Validate options data
     *
     * @uses get_option()
     *
     * @access public
     * @since 1.0.0
     *
     * @return array
     */
    public static function elements_valitate($value, $data = null, $args = array()) {
	$error = "";

	if (!is_null($value['type']))
	    switch ($value['type']) {

		//   todo overeni u sidebaru bz m2lo byt unikatni id email, file, value
	    }

	return array($value, $error);
    }

    public static function renderPages($options, $data) {
	$pages = '';
	foreach ($options as $opt) {
	    if (isset($opt['id']) && isset($data[$opt['id']]))
		$val = $data[$opt['id']];
	    else
		$val = null;
	    if ($opt['type'] == 'layout') {
		
	    }

	    $pages .= self::elements_machine($opt, $val);
	}

	return $pages;
    }

    public static function elements_render($elements, $data = null, $layout = 'default') {
	$out = '';
	foreach ($elements as $element) {
	    $out .= self::elements_machine($element, $data, $layout);
	}
	return $out;
    }

    /*
     * Render element for taxonomies (Category option)
     * @param $value array
     * @param $data mixed
     * $param layout mixed (add or edit)
     */

    public static function render_metatax($value, $data = null, $layout = 'default') {

	$defaults = array();
	$menu = '';
	$output = '';



	$val = '';

	if (isset($value['type']) && !in_array($value['type'], array('headingstart', 'headingend'))) {

	    $class = '';
	    if (isset($value['class'])) {
		$class = $value['class'];
	    }
	    //hide items in checkbox group
	    $fold = '';

	    if (is_array($value) && array_key_exists("fold", $value)) {
		if (isset($data[$value['fold']])) {
		    $fold = "f_" . $value['fold'] . " ";
		} else {
		    $fold = "f_" . $value['fold'] . " temphide ";
		}
	    }


	    //only show header if 'name' value exists

	    if ($value['name']) {
		switch ($layout) {
		    case 'edit':
			$output .= '<tr class="form-field">';
			$output .= '<th scope="row" valign="top"><label for="' . $value['id'] . '">' . $value['name'] . '</label></th>' . "\n";
			$output .= '<td>';
			$output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";
			break;
		    default:
			$output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . ' form-field">' . "\n";

			$output .= '<h4 class="heading">' . $value['name'] . '</h4>' . "\n";
			break;
		}
	    }

	    if (isset($value['space']) && $value['space'])
		$output .= '<div class="space">&nbsp;</div>';

	    $output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
	}
	$c = "element_" . $value['type'];
	if (method_exists(get_class(), $c)) {
	    $output .= Elements::$c($value, $data);
	} else {
	    $output .= 'Element not found in class_elements.php';
	}


	//description of each option
	if (isset($value['type']) && $value['type'] != "headingstart" && $value['type'] != "headingend") {

	    if (!isset($value['desc'])) {
		$explain_value = '';
	    } else {
		$explain_value = '<div class="explain">' . $value['desc'] . '</div>' . "\n";
	    }

	    $output .= '</div><!-- end controls -->' . $explain_value . "\n";

	    $output .= '<div class="clear"></div>
                </div><!-- end options -->
                </div><!-- end section jw_option -->' . "\n";

	    if ($layout == 'edit') {
		$output .= '</div></td></tr>';
	    }
	}






	return $output;
	// return array($output, $menu, $defaults);
    }

    /**
     * Process options data and build option fields
     *
     * @uses get_option()
     *
     * @access public
     * @since 1.0.0
     *
     * @return array
     */
    public static function elements_machine($value, $data = null, $layout = 'default') {

	$defaults = array();
	$menu = '';
	$output = '';



	$val = '';


	//Start Heading

	if (isset($value['type']) && $value['type'] != "headingstart" && $value['type'] != "headingend" && $value['type'] != "sectionstart" && $value['type'] != "sectionend") {

	    $class = '';
	    if (isset($value['class'])) {
		$class = $value['class'];
	    }

	    //hide items in checkbox group
	    $fold = '';

	    if (is_array($value) && array_key_exists("fold", $value)) {
		if (isset($data[$value['fold']])) {
		    $fold = "f_" . $value['fold'] . " ";
		} else {
		    $fold = "f_" . $value['fold'] . " temphide ";
		}
	    }




	    //only show header if 'name' value exists
	    if ($value['name']) {
		switch ($layout) {
		    case 'metabox':
			$output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";

			$output .= '<h4 class="heading">' . $value['name'] . '</h4>' . "\n";
			break;
		    case 'cat':

			$output .= '<tr class="form-field">';
			$output .= '<th scope="row" valign="top"><label for="' . $value['id'] . '">' . $value['name'] . '</label></th>' . "\n";
			$output .= '<td>';
			$output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";


			break;
		    case 'default':
		    default:
			$output .= '<div id="section-' . self::convert($value['id']) . '" class="' . $fold . 'section jw_option section-' . $value['type'] . ' ' . $class . '">' . "\n";

			$output .= '<h3 class="heading">' . $value['name'] . '</h3>' . "\n";
			break;
		}
	    }

	    if (isset($value['space']) && $value['space'])
		$output .= '<div class="space">&nbsp;</div>';

	    $output .= '<div class="option">' . "\n" . '<div class="controls ';
	    if ($value['type'] == 'importpreset') {
		$output .= 'control_fw';
	    }
	    $output .= '">' . "\n";
	}



	$c = "element_" . $value['type'];
	if (method_exists(get_class(), $c)) {
	    $output .= Elements::$c($value, $data);
	} else {
	    $output .= 'Element not found in class_elements.php';
	}


	//description of each option
	if (isset($value['type']) && $value['type'] != "headingstart" && $value['type'] != "headingend" && $value['type'] != "sectionstart" && $value['type'] != "sectionend") {
	    if (!isset($value['desc'])) {
		$explain_value = '';
	    } else {
		if ($layout == 'cat') {
		    $explain_value = ' <p class="description">' . $value['desc'] . '</p>' . "\n";
		} else {
		    $explain_value = '<div class="explain">' . $value['desc'] . '</div>' . "\n";
		}
	    }

	    $output .= '</div><!-- end controls -->' . $explain_value . "\n";

	    $output .= '<div class="clear"></div>
                </div><!-- end options -->
                </div><!-- end section jw_option -->' . "\n";

	    if ($layout == 'cat') {
		$output .= '</div></td></tr>';
	    }
	}






	return $output;
	// return array($output, $menu, $defaults);
    }

    private static function _box() {
	
    }

    private function _layout($part, $type) {
	
    }

    public static function element_headingstart($value, $data = null) {
	$output = '';
	$jquery_click_hook = str_replace(' ', '', strtolower($value['name']));
	$jquery_click_hook = "of-option-" . $jquery_click_hook;

	$output .= '<div class="group" id="' . $jquery_click_hook . '"><h2>' . $value['name'] . '</h2>' . "\n";
	// echo $output;
	return $output;
    }

    public static function element_headingend($value, $data = null) {
	return '</div>' . "\n";
    }

    public static function element_sectionstart($value, $data = null) {
	$output = '';
	$output .= '<div class="section sub_all" ><h3>' . $value['name'] . '</h3>';
	$output .= '<div class="section sub" >';
	return $output;
    }

    public static function element_sectionend($value, $data = null) {
	return '</div></div>';
    }

    public static function element_text($value, $data = null) {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else if (isset($value['std']))
	    $evalue = $value['std'];
	else
	    $evalue = '';
	$t_value = '';
	$t_value = stripslashes((string) $evalue);

	$class = '';
	if (isset($value['mod']))
	    $class .= $value['mod'];

	if (isset($value['class']))
	    $class .= ' ' . $value['class'];

	if (isset($value['maxlength']))
	    $maxlength = 'maxlength=' . $value['maxlength'];
	else
	    $maxlength = '';

	$output .= '<input class="of-input ' . $class . '" name="' . $value['id'] . '"  ' . $maxlength . ' id="' . self::convert($value['id']) . '" type="' . $value['type'] . '" value="' . $t_value . '" />';


	return $output;
    }

    public static function element_select($value, $data = null, $type = 'default') {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else if (isset($value['std']))
	    $evalue = $value['std'];
	else
	    $evalue = '';

	if (!isset($value['mod']))
	    $mini = '';
	else
	    $mini = $value['mod'];

	$output .= '<div class="select_wrapper ' . $mini . '">';
	$output .= '<select class="select of-input" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '">';
	if (isset($value['options']) && count($value['options']) > 0)
	    foreach ((array) $value['options'] as $select_ID => $option) {
		$output .= '<option id="' . $select_ID . '" value="' . $select_ID . '" ' . selected($evalue, $select_ID, false) . ' >' . $option . '</option>';
	    }
	$output .= '</select></div>';

	return $output;
    }

    public static function element_textarea($value, $data = null) {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else if (isset($value['std']))
	    $evalue = $value['std'];
	else
	    $evalue = '';
	if (isset($value['editor']) && $value['editor'] == true)
	    $editor = "ok";
	else
	    $editor = "";



	$cols = '8';
	$rows = '4';
	
	    if (isset($value['cols'])) {
		$cols = $value['cols'];
	    }
	    if (isset($value['rows'])) {
		$rows = $value['rows'];
	    }
	

	$ta_value = stripslashes($evalue);
	$output .= '<textarea class="of-input wp-editor-area" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" cols="' . $cols . '" rows="' . $rows . '">' . $ta_value . '</textarea>';


	return $output;
    }

    public static function element_radio($value, $data = null) {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else if (isset($value['std']))
	    $evalue = $value['std'];
	else
	    $evalue = '';
	foreach ($value['options'] as $option => $name) {
	    $output .= '<input class="of-input of-radio" name="' . $value['id'] . '" type="radio" value="' . $option . '" ' . checked($evalue, $option, false) . ' /><label class="radio">' . $name . '</label><br/>';
	}

	return $output;
    }

    public static function element_checkbox($value, $data = null) {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else if (isset($value['std']))
	    $evalue = $value['std'];
	else
	    $evalue = 0;


	$fold = '';
	if (array_key_exists("folds", $value))
	    $fold = "fld ";

	if (isset($value['mod']))
	    $mod = $value['mod'];
	else
	    $mod = '';

	$output .= '<input type="hidden" class="' . $fold . 'checkbox aq-input" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" value="0"/>';
	$output .= '<input type="checkbox" class="' . $fold . 'checkbox of-input ' . $mod . '" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" value="1" ' . checked($evalue, 1, false) . ' />';


	return $output;
    }

    public static function element_multicheck($value, $data = null) {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else if (isset($value['std']))
	    $evalue = $value['std'];
	else
	    $evalue = '';

	$multi_stored = $evalue;

	foreach ($value['options'] as $key => $option) {
	    if (!isset($multi_stored[$key])) {
		$multi_stored[$key] = '';
	    }
	    $of_key_string = $value['id'] . '_' . $key;
	    $output .= '<input type="checkbox" class="checkbox of-input" name="' . $value['id'] . '[' . $key . ']' . '" id="' . $of_key_string . '" value="1" ' . checked($multi_stored[$key], 1, false) . ' /><label class="multicheck" for="' . $of_key_string . '">' . $option . '</label><br />';
	}

	return $output;
    }

    public static function element_upload($value, $data = null) {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else
	    $evalue = '';
        
        if (!isset($value['mod'])) {
            $value['mod'] = '';
        }

        
       
	$output .= Elements::elements_uploader_function($value['id'], $value['std'], $value['mod'], $evalue);


	return $output;
    }

    public static function element_media($value, $data = null) {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else if (isset($value['std']))
	    $evalue = $value['std'];
	else
	    $evalue = '';
	$_id = strip_tags(strtolower($value['id']));
	$int = '';
	$int = Elements::elements_mlu_get_silentpost($_id);
	if (!isset($value['mod']))
	    $value['mod'] = '';
	$output .= Elements::elements_media_uploader_function($value['id'], $value['std'], $int, $value['mod'], $evalue); // New AJAX Uploader using Media Library			


	return $output;
    }

    public static function element_color($value, $data = null) {
	$output = '';

	if (isset($data))
	    $evalue = $data;
	else if (isset($value['std']))
	    $evalue = $value['std'];
	else
	    $evalue = '';

	$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div style="background-color: ' . $evalue . '"></div></div>';
	$output .= '<input class="of-color" name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" type="text" value="' . $evalue . '" />';
	$output .= '<div class="clear"></div>';

	return $output;
    }

    public static function element_font($value, $data = null) {
	$output = '';
	extract($values);
	if (empty($value)) {
	    $value = $default;
	}
	$elements = get_font_array();
	?>

	<div class="panel-body">
	    <div class="panel-body-gimmick"></div>
	    <div class="panel-title">
		<label for="<?php echo $name; ?>"><?php echo $title; ?></label>
	    </div>
	    <div class="panel-input">	
		<div class="panel-font-sample" id="panel-font-sample"><?php echo FONT_SAMPLE_TEXT; ?></div> 
		<div class="combobox" id="combobox-font-sample">
		    <select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="gdl-panel-select-font-family">

	<?php foreach ($elements as $option_name => $status) { ?>

	    		<option <?php if ($option_name == substr(esc_html($value), 2)) {
		echo 'selected';
	    } ?> <?php echo $status; ?>><?php
	    echo ($status == 'enabled') ? '- ' : '';
	    echo $option_name;
	    ?></option>

	<?php } ?>

		    </select>
		</div>
	    </div>
	<?php if (isset($description)) { ?>

	        <div class="panel-description"><?php echo $description; ?></div>
	        <div class="panel-description-info-img"></div>

			    <?php } ?>
	    <br class="clear">
	</div>

			    <?php
			    return $output;
			}

			public static function element_typography($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';
			    $typography_stored = $evalue;
			    /* Font Size */

			    if (isset($typography_stored['size'])) {
				$output .= '<div class="select_wrapper typography-size" original-title="Font size">';
				$output .= '<select class="of-typography of-typography-size select" name="' . $value['id'] . '[size]" id="' . $value['id'] . '_size">';
				for ($i = 9; $i < 20; $i++) {
				    $test = $i . 'px';
				    $output .= '<option value="' . $i . 'px" ' . selected($typography_stored['size'], $test, false) . '>' . $i . 'px</option>';
				}

				$output .= '</select></div>';
			    }

			    /* Line Height */
			    if (isset($typography_stored['height'])) {

				$output .= '<div class="select_wrapper typography-height" original-title="Line height">';
				$output .= '<select class="of-typography of-typography-height select" name="' . $value['id'] . '[height]" id="' . $value['id'] . '_height">';
				for ($i = 20; $i < 38; $i++) {
				    $test = $i . 'px';
				    $output .= '<option value="' . $i . 'px" ' . selected($typography_stored['height'], $test, false) . '>' . $i . 'px</option>';
				}

				$output .= '</select></div>';
			    }

			    /* Font Face */
			    if (isset($typography_stored['face'])) {

				$output .= '<div class="typography-face" original-title="Font family">';
				$output .= '<input class=" of-typography of-typography-face" name="' . $value['id'] . '[face]" id="' . $value['id'] . '_face" type="text" value="' . $typography_stored['face'] . '" />';




				/* $output .= '<select class="of-typography of-typography-face select" name="' . $value['id'] . '[face]" id="' . $value['id'] . '_face">';

				  $faces = array('arial' => 'Arial',
				  'verdana' => 'Verdana, Geneva',
				  'trebuchet' => 'Trebuchet',
				  'georgia' => 'Georgia',
				  'times' => 'Times New Roman',
				  'tahoma' => 'Tahoma, Geneva',
				  'palatino' => 'Palatino',
				  'helvetica' => 'Helvetica');
				  foreach ($faces as $i => $face) {
				  $output .= '<option value="' . $i . '" ' . selected($typography_stored['face'], $i, false) . '>' . $face . '</option>';
				  }
				  $output .= '</select>; */
				$output .= '</div>';
			    }

			    /* Font Weight */
			    if (isset($typography_stored['style'])) {

				$output .= '<div class="select_wrapper typography-style" original-title="Font style">';
				$output .= '<select class="of-typography of-typography-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';
				$styles = array('normal' => 'Normal',
				    'italic' => 'Italic',
				    'bold' => 'Bold',
				    'bold italic' => 'Bold Italic');

				foreach ($styles as $i => $style) {

				    $output .= '<option value="' . $i . '" ' . selected($typography_stored['style'], $i, false) . '>' . $style . '</option>';
				}
				$output .= '</select></div>';
			    }

			    /* Font Color */
			    if (isset($typography_stored['color'])) {

				$output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: ' . $typography_stored['color'] . '"></div></div>';
				$output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="' . $value['id'] . '[color]" id="' . $value['id'] . '_color" type="text" value="' . $typography_stored['color'] . '" />';
			    }


			    return $output;
			}

			public static function element_border($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    /* Border Width */
			    $border_stored = $evalue;

			    $output .= '<div class="select_wrapper border-width">';
			    $output .= '<select class="of-border of-border-width select" name="' . $value['id'] . '[width]" id="' . $value['id'] . '_width">';
			    for ($i = 0; $i < 21; $i++) {
				$output .= '<option value="' . $i . '" ' . selected($border_stored['width'], $i, false) . '>' . $i . '</option>';
			    }
			    $output .= '</select></div>';

			    /* Border Style */
			    $output .= '<div class="select_wrapper border-style">';
			    $output .= '<select class="of-border of-border-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';

			    $styles = array('none' => 'None',
				'solid' => 'Solid',
				'dashed' => 'Dashed',
				'dotted' => 'Dotted');

			    foreach ($styles as $i => $style) {
				$output .= '<option value="' . $i . '" ' . selected($border_stored['style'], $i, false) . '>' . $style . '</option>';
			    }

			    $output .= '</select></div>';

			    /* Border Color */
			    $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: ' . $border_stored['color'] . '"></div></div>';
			    $output .= '<input class="of-color of-border of-border-color" name="' . $value['id'] . '[color]" id="' . $value['id'] . '_color" type="text" value="' . $border_stored['color'] . '" />';


			    return $output;
			}

			public static function element_images($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    $i = 0;

			    $select_value = $evalue;

			    foreach ($value['options'] as $key => $option) {
				$i++;

				$checked = '';
				$selected = '';
				if (NULL != checked($select_value, $key, false)) {
				    $checked = checked($select_value, $key, false);
				    $selected = 'of-radio-img-selected';
				}
				$output .= '<span>';
				$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . ' />';
				$output .= '<div class="of-radio-img-label">' . $key . '</div>';
				$output .= '<img src="' . $option . '" alt="" class="of-radio-img-img ' . $selected . '" onClick="document.getElementById(\'of-radio-img-' . $value['id'] . $i . '\').checked = true;" />';
				$output .= '</span>';
			    }

			    return $output;
			}

			public static function element_info($value, $data = null) {
			    $output = '';

			    if (isset($value['message']))
				$message = $value['message'];
			    else
				$message = '';

			    $info_text = $value['text'];
			    $output .= '<div class="of-info ' . $message . '">' . $info_text . '</div>';

			    return $output;
			}

			public static function element_image($value, $data = null) {
			    $output = '';

			    $output .= '<img ' . (isset($value['width']) ? 'width="' . $value['width'] . '"' : '') . ' ' . (isset($value['height']) ? 'height="' . $value['height'] . '"' : '') . ' src="' . $value['std'] . '">';
			    return $output;
			}

			// only for metabox layout + sidebars_delect 
			public static function element_sidebar_select($value, $data = null) {
			    $output = '';
			    $sdbs = jwOpt::get_option('sidebars');
			    //var_dump($value['options'] );
			    //transform
			    if (isset($sdbs) && count($sdbs) > 0)
				foreach ((array) $sdbs as $k => $sdb) {
				    $value['options'][$k] = $sdb['name'];
				}
			    $output = Elements::element_select($value, $data);


			    return $output;
			}

			public static function element_sidebars($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';


			    $output .= '<div class="sidebars">';
			    $output .= '<input name="sidebar_name" id="sidebar_name" value="" /><a href="#" class="button sidebar_add_button">Add New Sidebar</a>';
			    $output .= '<ul class="sidebras_list" id="' . $value['id'] . '">';
			    $sidebars = $evalue;

			    $count = count($sidebars);
			    $i = 0;
			    if (is_array($sidebars))
				foreach ($sidebars as $sidebar) {

				    $i++;
				    $order = $i;
				    $output .= Elements::elements_sidebar_function($value['id'], $sidebar);
				}
			    $output .= '</ul>';
			    $output .= '</div>';

			    return $output;
			}

			public static function element_layout($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';
			    $i = 0;

			    $select_value = $evalue;
			    if (isset($value['extend']) && !empty($value['extend'])) {
				$rel = ' rel="' . $value['extend'] . '"';
				$page = 'page_layout ';
			    } else {
				$rel = '';
				$page = '';
			    }


			    foreach ($value['options'] as $key => $option) {
				$i++;

				$check = '';
				$checked = '';
				$selected = '';
				if (NULL != checked($evalue, $key, false)) {
				    $checked = checked($evalue, $key, false);
				    $selected = 'of-radio-img-selected';
				    $check = 'check';
				}



				$output .= '<div class="radio-layout ' . $selected . '">';
				$output .= '<label val="' . $key . '" ' . $rel . '  for="' . $value['id'] . '-' . $key . '-sidebar">';
				$output .= '<img alt="page-option-sidebar-template" src="' . $option . '" />';
				//  $output .= '<div class="checked '.$check.'"></div>';
				$output .= '</label>';
				$output .= '<input autocomplete="off" type="radio" ' . $checked . ' id="' . $value['id'] . '-' . $key . '-sidebar" value="' . $key . '" name="' . $value['id'] . '"> ';

				$output .= '</div>';
			    }





			    return $output;
			}

			public static function element_tabs($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    $_id = strip_tags(strtolower($value['id']));
			    $int = '';
			    $int = Elements::elements_mlu_get_silentpost($_id);
			    $output .= '<div class="slider"><ul id="' . $value['id'] . '" rel="' . $int . '">';
			    $slides = $evalue;
			    $count = count($slides);
			    if ($count < 2) {
				$oldorder = 1;
				$order = 1;
				$output .= Elements::elements_tabs_function($value['id'], $value['std'], $oldorder, $order, $int);
			    } else {
				$i = 0;
				foreach ($slides as $slide) {
				    $oldorder = $slide['order'];
				    $i++;
				    $order = $i;
				    $output .= Elements::elements_tabs_function($value['id'], $value['std'], $oldorder, $order, $int);
				}
			    }
			    $output .= '</ul>';
			    $output .= '<a href="#" class="button tabs_add_button">Add New Slide</a></div>';

			    return $output;
			}

			public static function element_slider($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    $_id = strip_tags(strtolower($value['id']));
			    $int = '';
			    $int = Elements::elements_mlu_get_silentpost($_id);
			    $output .= '<div class="slider"><ul id="' . $value['id'] . '" rel="' . $int . '">';
			    $slides = $evalue;
			    $count = count($value);
			    if ($count < 2) {
				$oldorder = 1;
				$order = 1;
				$output .= Elements::elements_slider_function($value['id'], $value['std'], $oldorder, $order, $int, $evalue);
			    } else {
				$i = 0;

				if ($slides)
				    foreach ($slides as $slide) {
					$oldorder = $slide['order'];
					$i++;
					$order = $i;
					$output .= Elements::elements_slider_function($value['id'], $value['std'], $oldorder, $order, $int, $evalue);
				    }
			    }
			    $output .= '</ul>';
			    $output .= '<a href="#" class="button slide_add_button">Add New Slide</a></div>';

			    return $output;
			}

			public static function element_sorter($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    $sortlists = $evalue;

			    $output .= '<div id="' . $value['id'] . '" class="sorter">';


			    if (is_array($sortlists)) {

				foreach ($sortlists as $group => $sortlist) {

				    $output .= '<ul id="' . $value['id'] . '_' . $group . '" class="sortlist_' . $value['id'] . '">';
				    $output .= '<h3>' . $group . '</h3>';
				    if (is_array($sortlist))
					foreach ($sortlist as $key => $list) {

					    $output .= '<input class="sorter-placebo" type="hidden" name="' . $value['id'] . '[' . $group . '][placebo]" value="placebo">';

					    if ($key != "placebo") {

						$output .= '<li id="' . $key . '" class="sortee">';
						$output .= '<input class="position" type="hidden" name="' . $value['id'] . '[' . $group . '][' . $key . ']" value="' . $list . '">';
						$output .= $list;
						$output .= '</li>';
					    }
					}

				    $output .= '</ul>';
				}
			    }

			    $output .= '</div>';

			    return $output;
			}

			public static function element_tiles($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';
			    $i = 0;
			    $select_value = $evalue;

			    if (isset($value['mod']))
				$mod = $value['mod'];
			    else
				$mod = '';

			    if (isset($value['index']) && $value['index'])
				$index = $value['index'];
			    else
				$index = null;

			    $output .='<div class="' . $mod . '">';
			    foreach ((array) $value['options'] as $key => $option) {
				$i++;
				if ($index)
				    $v = $key;
				else
				    $v = $option;

				$checked = '';
				$selected = '';
				if (NULL != checked($select_value, $v, false)) {
				    $checked = checked($select_value, $v, false);
				    $selected = 'of-radio-tile-selected';
				}
				$output .= '<span>';
				$output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $v . '" name="' . $value['id'] . '" ' . $checked . ' />';
				$output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
				$output .= '</span>';
			    }
			    $output .='</div>';
			    return $output;
			}

			public static function element_backup($value, $data = null) {
			    $output = '';


			    $instructions = $value['desc'];
			    $backup = jwOpt::get_backups();

			    if (!isset($backup['backup_log'])) {
				$log = 'No backups yet';
			    } else {
				$log = $backup['backup_log'];
			    }

			    $output .= '<div class="backup-box">';
			    $output .= '<div class="instructions">' . $instructions . "\n";
			    $output .= '<p><strong>Last Backup : <span class="backup-log">' . $log . '</span></strong></p></div>' . "\n";
			    $output .= '<a href="#" id="of_backup_button" class="button" title="Backup Options">Backup Options</a>';
			    $output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
			    $output .= '</div>';

			    return $output;
			}

			public static function element_button($value, $data = null) {
			    $output = '';

			    $output .= '<div class="el_button">';
			    $output .= '<a href="' . $value['href'] . '" target="' . $value['target'] . '" id="' . $value['id'] . 'element_button" class="element_button" title="' . $value['title'] . '">' . $value['title'] . '</a>';
			    $output .= '</div>';



			    return $output;
			}

			public static function element_importdemo($value, $data = null) {
			    return '<a href="#" id="of_importdemodata_button" class="button" title="Import" file="' . $value['file'] . '" demo_type="' . $value['demo_type'] . '">Import Data</a>';
			}

			public static function element_importpreset($value, $data = null) {
			    $output = '';
			    $output .= '<div class="demoimport">';
			    for ($i = 0; $i < sizeof($value['file']); $i++) {

				$output .= '<div class="demoimport_image">';
				$output .= '<a href="#" id="of_importdemodata_button"title="Import" file="' . $value['file'][$i] . '">';
				$output .= ' <img src="' . THEME_URI . '/demo/images/' . $value['img'][$i] . '"/>';
				$output .= '</a>';
				$output .= '</div>';
				$output .= '<div class="demoimport_desc">';
				$output .= $value['description'][$i];
				$output .= '</div>';
				$output .= '<div class="clear"></div>';
			    }
			    $output .= '</div>';
			    return $output;
			}

			public static function element_transfer($value, $data = null) {
			    $output = '';

			    $instructions = $value['desc'];
			    $output .= '<textarea id="export_data" rows="8">' . base64_encode(serialize(jwOpt::get_options())) . '</textarea>' . "\n";
			    $output .= '<a href="#" id="of_import_button" class="button" title="Restore Options">Import Options</a>';

			    return $output;
			}

			public static function element_multidropdown($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    if (isset($value['options']))
				$options = $value['options'];
			    else
				$options = array();
			    if (isset($value['target']) && !is_null($value['target'])) {
				$options += Elements::get_select_target($value['target']);
			    }

			    if (isset($value['chosen']) && $value['chosen'] == true) {
				$class[] = 'chosen';
			    }
			    if (isset($value['mod']))
				$class[] = $value['mod'];

			    $class = $class ? ' class="' . implode(' ', $class) . '"' : '';

			    if (!is_null($value['page'])) {
				$depth = $value['page'];
				$pages = get_pages();
			    }
			    if (!empty($value['prompt'])) {
				$value['prompt'] = 'data-placeholder="' . $value['prompt'] . '"';
			    }

			    if (!isset($value['size'])) {
				$value['size'] = '6';
			    }




			    $output.= '<select ' . $class . ' ' . $value['prompt'] . '  multiple="true" size="' . $value['size'] . '" style="height:auto" name="' . $value['id'] . '[]" id="' . $value['id'] . '">';

			    foreach ($options as $key => $option) {
				if (is_array($option)) {
				    $output.= '<optgroup label="' . $key . '">';
				    foreach ($option as $k => $o) {
					$output.= '<option value="' . $k . '"';
					if (is_array($value) && in_array($k, $value)) {
					    $output.= ' selected="selected"';
					}
					$output.= '>' . $o . '</option>';
				    }
				    $output.= "</optgroup>";
				} else {
				    $output.= '<option value="' . $key . '"';
				    if (is_array($evalue) && in_array($key, $evalue)) {
					$output.= ' selected="selected"';
				    }
				    $output.= '>' . $option . '</option>';
				}
			    }
			    if (!is_null($value['page'])) {
				$args = array(
				    'depth' => $value['page'], 'child_of' => 0,
				    'selected' => $evalue, 'echo' => 1,
				    'name' => 'page_id', 'id' => '',
				    'show_option_none' => '', 'show_option_no_change' => '',
				    'option_none_value' => ''
				);
				$output.= Elements::walk_page_multi_select_tree($pages, $depth, $args);
			    }
			    $output.= '</select>';


			    return $output;
			}

			public static function element_toggle($value, $data = null) {
			    $output = $yes = $no = $yess = $nos ='';
                         
                             
                             
                           
			    if (isset($data) && $data =='1')
				$evalue = $data;
                            else if (is_null($data) && isset($value['std']) )
                                $evalue = $value['std'];
			    else 
				$evalue = '0';
                            
                            if ($evalue == '1' || $evalue =='true' ){ 
                                $yes = 'checked="checked"';
                                $yess = 'selected';
                            }
                            else{
                                $no = 'checked="checked"';
                                $nos = 'selected';
                            }
                           
			    
 $output.='<div class="tooglebutton" id="' . self::convert($value['id']) . '">';
 $output.='<input class="hide" type="radio" id="' . self::convert($value['id']) . '1" name="' . $value['id'] . '" '.$yes.' value="1"/><label class="cb-enable '.$yess.'" for="' . self::convert($value['id']) . '1"><span>On</span></label>';
 $output.='<input class="hide" type="radio" id="' . self::convert($value['id']) . '2" name="' . $value['id'] . '" '.$no.' value="0" /><label class="cb-disable '.$nos.'" for="' . self::convert($value['id']) . '2"><span>Off</span></label></div>';
			   
			    return $output;
			}

			/*
			 * upravi vstupni ID elementu pro pouziti menu
			 * 
			 */

			public static function convert($id) {
			    $id = str_replace('[', '-', $id);
			    $id = str_replace(']', '', $id);

			    return $id;
			}

			public static function element_advselect($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    $options = array();
			    if (isset($value['target']) && !is_null($value['target'])) {
				$options += Elements::get_select_target($value['target']);
			    }
			    if (isset($value['chosen']) && $value['chosen'] == true) {
				$class[] = 'chosen';
			    }

			    $class = $class ? ' class="' . implode(' ', $class) . '"' : '';


			    $output.= '<select ' . $class . ' name="' . $value['id'] . '" id="' . self::convert($value['id']) . '">';
			    if (isset($value['prompt']) && !is_null($value['prompt'])) {
				$output.= '<option value="">' . $value['prompt'] . '</option>';
			    }

			    if (is_array($options)) {
				foreach ($options as $key => $option) {
				    if (is_array($option)) {
					$output.= '<optgroup label="' . $key . '">';
					foreach ($option as $k => $o) {
					    $output.= '<option value="' . $k . '"';
					    if ($k == $evalue) {
						$output.= ' selected="selected"';
					    }
					    $output.= '>' . $o . '</option>';
					}
					$output.= "</optgroup>";
				    } else {
					$output.= '<option value="' . $key . '"';
					if ($key == $evalue) {
					    $output.= ' selected="selected"';
					}
					$output.= '>' . $option . '</option>';
				    }
				}
			    }
			    if (isset($value['page']) && !is_null($value['page'])) {
				$depth = $value['page'];
				$args = array(
				    'depth' => $value['depth'], 'child_of' => 0,
				    'selected' => $evalue, 'echo' => 1,
				    'name' => 'page_id', 'id' => '',
				    'show_option_none' => '', 'show_option_no_change' => '',
				    'option_none_value' => ''
				);
				$pages = get_pages($args);

				$output.= walk_page_dropdown_tree($pages, $depth, $args);
			    }

			    $output.= '</select>';


			    return $output;
			}

			public static function element_googlefonts($value, $date = null) {
			    /*
			     * @TODO
			     */
			    $fonts = get_transient('nhp-opts-google-webfonts');
			    if (!is_array(json_decode($fonts))) {

				$fonts = wp_remote_retrieve_body(wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key=' . $this->args['google_api_key']));
				set_transient('nhp-opts-google-webfonts', $fonts, 60 * 60 * 24);
			    }
			    $this->field['fonts'] = json_decode($fonts);

			    $class = (isset($this->field['class'])) ? 'class="' . $this->field['class'] . '" ' : '';

			    echo '<p class="description" style="color:red;">The fonts provided below are free to use custom fonts from the <a href="http://www.google.com/webfonts" target="_blank">Google Web Fonts directory</a>.<br/>Please <a href="http://www.google.com/webfonts" target="_blank">browse the directory</a> to preview a font, then select your choice below.</p>';

			    echo '<select id="' . $this->field['id'] . '" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . ']" ' . $class . 'rows="6" >';


			    foreach ($this->field['fonts']->items as $cut) {

				foreach ($cut->variants as $variant) {

				    echo '<option value="' . $cut->family . ':' . $variant . '" ' . selected($this->value, $cut->family . ':' . $variant, false) . '>' . $cut->family . ' - ' . $variant . '</option>';
				}
			    }
			    echo '</select>';
			}

			public static function element_editor($value, $data = null) {
			    $output = '';
			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    if (isset($value['class']))
				$class = $value['class'];
			    else
				$class = '';
			    $settings = array(
				'textarea_name' => $value['id'],
				'editor_class' => $class
			    );

			    ob_start();

			    wp_editor($evalue, $value['id'], $settings);

			    return $output.=ob_get_clean();
			}

			public static function element_range($value, $data = null) {
			    $output = '';
			    //var_dump($data);
			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';
			    // var_dump($value);

			    $output.= '<div class="range-input-wrap" ><input name="' . $value['id'] . '" id="' . self::convert($value['id']) . '" type="range" class="regular-text" ';

			    if (isset($value['min']) && !is_null($value['min'])) {
				$output.= ' min="' . $value['min'] . '"';
			    }
			    if (isset($value['max']) && !is_null($value['max'])) {
				$output.= ' max="' . $value['max'] . '"';
			    }
			    if (isset($value['step']) && !is_null($value['step'])) {
				$output.= ' step="' . $value['step'] . '"';
			    }

			    $output.= ' value="' . $evalue . '"';

			    if (isset($value['range']) && !is_null($value['range'])) {
				$output.= ' range="' . $value['range'] . '"';
			    }
			    $output.='" />';
			    if (!is_null($value['unit'])) {
				$output.= '<div class="unit">' . $value['unit'] . '</div>';
			    }
			    $output.= '</div>';


			    return $output;
			}

			public static function element_rangemeasurement($value, $data = null) {
			    $output = '';

			    if (isset($data))
				$evalue = $data;
			    else if (isset($value['std']))
				$evalue = $value['std'];
			    else
				$evalue = '';

			    $stored = $evalue;

			    if (isset($stored['value']))
				$value_value = $stored['value'];
			    else
				$value_value = $value['std'];

			    if (!isset($value['units']))
				$value['units'] = array('px', '%', 'pt', 'em');
			    else
				$units = $value['units'];

			    if (isset($stored['unit']))
				$value_unit = $stored['unit'];
			    else if (isset($value['unit_std']))
				$value_unit = $value['unit_std'];
			    else
				$value_unit = 0;




			    $output.='<div class="range-input-wrap" >
		    
		    <input name="' . $value['id'] . '[value]" id="' . $value['id'] . '_value" type="range" value="' . $value_value . '"';

			    if (isset($value['min']) && !is_null($value['min'])) {
				$output.=' min="' . $value['min'] . '"';
			    }
			    if (isset($value['max']) && !is_null($value['max'])) {
				$output.= ' max="' . $value['max'] . '"';
			    }
			    if (isset($value['step']) && !is_null($value['step'])) {
				$output.= ' step="' . $value['step'] . '"';
			    }

			    if (isset($value['range']) && !is_null($value['range'])) {
				$output.= ' range="' . $value['range'] . '"';
			    }
			    $output.= '" />';


			    if (is_array($units) && count($units) > 1) {
				$output .= '<div class="select_wrapper border-width">';
				$output .= '<select class="of-border of-border-width select" name="' . $value['id'] . '[unit]" id="' . $value['id'] . '_unit">';
				foreach ($units as $unit) {
				    $output .= '<option value="' . $unit . '" ' . selected($value_unit, $unit, false) . '>' . $unit . '</option>';
				}
				$output .= '</select></div>';
			    } else {
				$output.= '<div class="unit">' . $value_unit . '</div>';
			    }
			    //echo '</span>';
			    $output.= '</div>';


			    return $output;
			}

			/**
			 * Ajax image uploader - supports various types of image types
			 *
			 * @uses get_option()
			 *
			 * @access public
			 * @since 1.0.0
			 *
			 * @return string
			 */
			public static function elements_uploader_function($id, $std, $mod, $data) {


			    $uploader = '';
			    $upload = $data;
			    $hide = '';

			    

			    if ($upload != "") {
				$val = $upload;
			    } else {
				$val = $std;
			    }

			    $uploader .= '<input class="' . $mod . ' upload of-input" name="' . $id . '" id="' . $id . '_upload" value="' . $val . '" />';

			    $uploader .= '<div class="upload_button_div"><span class="button image_upload_button" id="' . $id . '">' . _('Upload') . '</span>';

			    if (!empty($upload)) {
				$hide = '';
			    } else {
				$hide = 'hide';
			    }
			    $uploader .= '<span class="button image_reset_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
			    $uploader .='</div>' . "\n";
			    $uploader .= '<div class="clear"></div>' . "\n";
			    if (!empty($upload)) {
				$uploader .= '<div class="screenshot">';
				$uploader .= '<a class="of-uploaded-image" href="' . $upload . '">';
				$uploader .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
				$uploader .= '</a>';
				$uploader .= '</div>';
			    }
			    $uploader .= '<div class="clear"></div>' . "\n";

			    return $uploader;
			}

			/**
			 * Native media library uploader
			 *
			 * @uses get_option()
			 *
			 * @access public
			 * @since 1.0.0
			 *
			 * @return string
			 */
			public static function elements_media_uploader_function($id, $std, $int, $mod, $data) {


			    $uploader = '';
			    $upload = $data;
			    $hide = '';

			    if ($mod == "min") {
				$hide = 'hide';
			    }

			    if ($upload != "") {
				$val = $upload;
			    } else {
				$val = $std;
			    }

			    $uploader .= '<input class="' . $hide . ' upload of-input" name="' . $id . '" id="' . $id . '_upload" value="' . $val . '" />';

			    $uploader .= '<div class="upload_button_div"><span class="button media_upload_button" id="' . $id . '" rel="' . $int . '">Upload</span>';

			    if (!empty($upload)) {
				$hide = '';
			    } else {
				$hide = 'hide';
			    }
			    $uploader .= '<span class="button mlu_remove_button ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">Remove</span>';
			    $uploader .='</div>' . "\n";
			    $uploader .= '<div class="screenshot">';
			    if (!empty($upload)) {
				$uploader .= '<a class="of-uploaded-image" href="' . $upload . '">';
				$uploader .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" alt="" />';
				$uploader .= '</a>';
			    }
			    $uploader .= '</div>';
			    $uploader .= '<div class="clear"></div>' . "\n";

			    return $uploader;
			}

			/**
			 * Drag and drop slides manager
			 *
			 * @uses get_option()
			 *
			 * @access public
			 * @since 1.0.0
			 *
			 * @return string
			 */
			public static function elements_slider_function($id, $std, $oldorder, $order, $int, $data) {


			    $slider = '';
			    $slide = array();
			    $slide = $data;

			    if (isset($slide[$oldorder])) {
				$val = $slide[$oldorder];
			    } else {
				$val = $std;
			    }

			    //initialize all vars
			    $slidevars = array('title', 'url', 'link', 'description');

			    foreach ($slidevars as $slidevar) {
				if (!isset($val[$slidevar])) {
				    $val[$slidevar] = '';
				}
			    }

			    //begin slider interface	
			    if (!empty($val['title'])) {
				$slider .= '<li><div class="slide_header"><strong>' . stripslashes($val['title']) . '</strong>';
			    } else {
				$slider .= '<li><div class="slide_header"><strong>Slide ' . $order . '</strong>';
			    }

			    $slider .= '<input type="hidden" class="slide of-input order" name="' . $id . '[' . $order . '][order]" id="' . $id . '_' . $order . '_slide_order" value="' . $order . '" />';

			    $slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';

			    $slider .= '<div class="slide_body">';

			    $slider .= '<label>Title</label>';
			    $slider .= '<input class="slide of-input of-slider-title" name="' . $id . '[' . $order . '][title]" id="' . $id . '_' . $order . '_slide_title" value="' . stripslashes($val['title']) . '" />';

			    $slider .= '<label>Image URL</label>';
			    $slider .= '<input class="slide of-input" name="' . $id . '[' . $order . '][url]" id="' . $id . '_' . $order . '_slide_url" value="' . $val['url'] . '" />';

			    $slider .= '<div class="upload_button_div"><span class="button media_upload_button" id="' . $id . '_' . $order . '" rel="' . $int . '">Upload</span>';

			    if (!empty($val['url'])) {
				$hide = '';
			    } else {
				$hide = 'hide';
			    }
			    $slider .= '<span class="button mlu_remove_button ' . $hide . '" id="reset_' . $id . '_' . $order . '" title="' . $id . '_' . $order . '">Remove</span>';
			    $slider .='</div>' . "\n";
			    $slider .= '<div class="screenshot">';
			    if (!empty($val['url'])) {

				$slider .= '<a class="of-uploaded-image" href="' . $val['url'] . '">';
				$slider .= '<img class="of-option-image" id="image_' . $id . '_' . $order . '" src="' . $val['url'] . '" alt="" />';
				$slider .= '</a>';
			    }
			    $slider .= '</div>';
			    $slider .= '<label>Link URL (optional)</label>';
			    $slider .= '<input class="slide of-input" name="' . $id . '[' . $order . '][link]" id="' . $id . '_' . $order . '_slide_link" value="' . $val['link'] . '" />';

			    $slider .= '<label>Description (optional)</label>';
			    $slider .= '<textarea class="slide of-input" name="' . $id . '[' . $order . '][description]" id="' . $id . '_' . $order . '_slide_description" cols="8" rows="8">' . stripslashes($val['description']) . '</textarea>';

			    $slider .= '<a class="slide_delete_button" href="#">Delete</a>';
			    $slider .= '<div class="clear"></div>' . "\n";

			    $slider .= '</div>';
			    $slider .= '</li>';

			    return $slider;
			}

			/**
			 * Drag and drop sidebar manager
			 *
			 * @uses get_option()
			 *
			 * @access public
			 * @since 1.0.0
			 *
			 * @return string
			 */
			public static function elements_sidebar_function($id, $data) {

			    $out = '';


			    $out .= '<li>';
			    $out .= '<div class="sidebar_header">';
			    $out .= '<input type="hidden" name="' . $id . '[' . $data['id'] . '][name]" value="' . stripslashes($data['name']) . '" />';
			    $out .= '<input type="hidden" name="' . $id . '[' . $data['id'] . '][id]"  value="' . stripslashes($data['id']) . '" />';
			    $out .= '<input type="hidden" name="' . $id . '[' . $data['id'] . '][desc]" value="' . stripslashes($data['desc']) . '" />';
			    $out .= '<strong>' . $data['name'] . '</strong><a class="sidebar_delete_button" href="#">Delete</a>';
			    $out .= '</li>';
			    return $out;
			}

			/**
			 * Uses "silent" posts in the database to store relationships for images.
			 * This also creates the facility to collect galleries of, for example, logo images.
			 * 
			 * Return: $_postid.
			 *
			 * If no "silent" post is present, one will be created with the type "optionsframework"
			 * and the post_name of "of-$_token".
			 *
			 * Example Usage:
			 * elements_mlu_get_silentpost ( 'of_logo' );
			 */
			public static function elements_mlu_get_silentpost($_token) {

			    global $wpdb;
			    $_id = 0;

			    // Check if the token is valid against a whitelist.
			    // $_whitelist = array( 'of_logo', 'of_custom_favicon', 'of_ad_top_image' );
			    // Sanitise the token.

			    $_token = strtolower(str_replace(' ', '_', $_token));

			    // if ( in_array( $_token, $_whitelist ) ) {
			    if ($_token) {

				// Tell the function what to look for in a post.

				$_args = array('post_type' => 'options', 'post_name' => 'of-' . $_token, 'post_status' => 'draft', 'comment_status' => 'closed', 'ping_status' => 'closed');

				// Look in the database for a "silent" post that meets our criteria.
				$query = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent = 0';
				foreach ($_args as $k => $v) {
				    $query .= ' AND ' . $k . ' = "' . $v . '"';
				} // End FOREACH Loop

				$query .= ' LIMIT 1';
				$_posts = $wpdb->get_row($query);

				// If we've got a post, loop through and get it's ID.
				if (count($_posts)) {
				    $_id = $_posts->ID;
				} else {

				    // If no post is present, insert one.
				    // Prepare some additional data to go with the post insertion.
				    $_words = explode('_', $_token);
				    $_title = join(' ', $_words);
				    $_title = ucwords($_title);
				    $_post_data = array('post_title' => $_title);
				    $_post_data = array_merge($_post_data, $_args);
				    $_id = wp_insert_post($_post_data);
				}
			    }
			    return $_id;
			}

			public static function element_scripts($data) {
			    $out = '';
			    if (isset($data['script']) && !empty($data['script'])) {
				$out = "<javascript>
                jQuery(function() {
                        $data
                    }
                </javascript>";
			    }

			    return $out;
			}

			/**
			 * Drag and drop slides manager
			 *
			 * @uses get_option()
			 *
			 * @access public
			 * @since 1.0.0
			 *
			 * @return string
			 */
			public static function elements_tabs_function($id, $std, $oldorder, $order, $int) {

			    $data = get_option(OPTIONS);

			    $slider = '';
			    $slide = array();
			    if (isset($data[$id]))
			    $slide = $data[$id];

			    if (isset($slide[$oldorder])) {
				$val = $slide[$oldorder];
			    } else {
				$val = $std;
			    }

			    //initialize all vars
			    $slidevars = array('title', 'url', 'link', 'description');

			    foreach ($slidevars as $slidevar) {
				if (!isset($val[$slidevar])) {
				    $val[$slidevar] = '';
				}
			    }

			    //begin slider interface	
			    if (!empty($val['title'])) {
				$slider .= '<li><div class="slide_header"><strong>' . stripslashes($val['title']) . '</strong>';
			    } else {
				$slider .= '<li><div class="slide_header"><strong>Slide ' . $order . '</strong>';
			    }

			    $slider .= '<input type="hidden" class="slide of-input order" name="' . $id . '[' . $order . '][order]" id="' . $id . '_' . $order . '_slide_order" value="' . $order . '" />';

			    $slider .= '<a class="slide_edit_button" href="#">Edit</a></div>';

			    $slider .= '<div class="slide_body">';

			    $slider .= '<label>Title</label>';
			    $slider .= '<input class="slide of-input of-slider-title" name="' . $id . '[' . $order . '][title]" id="' . $id . '_' . $order . '_slide_title" value="' . stripslashes($val['title']) . '" />';

			    $slider .= '<label>Description (optional)</label>';
			    $slider .= '<textarea class="slide of-input" name="' . $id . '[' . $order . '][description]" id="' . $id . '_' . $order . '_slide_description" cols="8" rows="8">' . stripslashes($val['description']) . '</textarea>';

			    $slider .= '<a class="slide_delete_button" href="#">Delete</a>';
			    $slider .= '<div class="clear"></div>' . "\n";

			    $slider .= '</div>';
			    $slider .= '</li>';

			    return $slider;
			}

			function walk_page_multi_select_tree() {
			    $args = func_get_args();
			    if (empty($args[2]['walker']))
				$walker = new Walker_PageMultiSelect;
			    else
				$walker = $args[2]['walker'];

			    return call_user_func_array(array(&$walker, 'walk'), $args);
			}

			/**
			 * Target generator
			 */
			public function get_select_target($typ) {
			    $options = array();
			    switch ($typ) {
				case 'cat':
				    $entries = get_categories('orderby=name&hide_empty=0');
				    foreach ($entries as $key => $entry) {
					$options[$entry->term_id] = $entry->name;
				    }
				    break;
				case 'page':
				    $entries = get_pages('title_li=&orderby=name');
				    foreach ($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				    }
				    break;
				case 'post':
				    $entries = get_posts('orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
				    foreach ($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				    }
				    break;
				case 'author':
				    global $wpdb;
				    $order = 'user_id';
				    $user_ids = $wpdb->get_col($wpdb->prepare("SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta where meta_key='wp_user_level' and meta_value>=1 ORDER BY %s ASC", $order));
				    foreach ($user_ids as $user_id) :
					$user = get_userdata($user_id);
					$options[$user_id] = $user->display_name;
				    endforeach;
				    break;
				
				case 'portfolio':
				    $entries = get_posts('post_type=portfolio&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
				    foreach ($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				    }
				    break;
				case 'post_types':
				    foreach (get_post_types(array('show_ui' => true), 'objects') as $post_type) {
					$options[$post_type->name] = esc_html($post_type->labels->name) . ' (' . esc_html($post_type->name) . ')';
				    }
				    break;
				case 'portfolio-category':
				    $entries = get_terms('portfolio-category', 'orderby=name&hide_empty=0&suppress_filters=0');
				    foreach ($entries as $key => $entry) {
					$options[$entry->slug] = $entry->name;
				    }
				    break;
                                case 'products':
				    $entries = get_posts('post_type=product&orderby=title&numberposts=-1&order=ASC&suppress_filters=0');
				    foreach ($entries as $key => $entry) {
					$options[$entry->ID] = $entry->post_title;
				    }
				    break;
			    }
			    return $options;
			}

			//todo
			function validate($input, $type, $field_id) {

			    /* exit early if missing data */
			    if (!$input || !$type || !$field_id)
				return $input;

			    $input = apply_filters('validate', $input, $type, $field_id);

			    if ('background' == $type) {

				$input['background-color'] = validate($input['background-color'], 'colorpicker', $field_id);

				$input['background-image'] = validate($input['background-image'], 'upload', $field_id);
			    } else if ('colorpicker' == $type) {

				/* return empty & set error */
				if (0 === preg_match('/^#([a-f0-9]{6}|[a-f0-9]{3})$/i', $input)) {

				    $input = '';

				    add_settings_error('option-tree', 'invalid_hex', 'The Colorpicker only allows valid hexadecimal values.', 'error');
				}
			    } else if (in_array($type, array('css', 'text', 'textarea', 'textarea-simple'))) {

				if (!current_user_can('unfiltered_html')) {

				    $input = wp_kses_post($input);
				}
			    } else if ('measurement' == $type) {

				$input[0] = sanitize_text_field($input[0]);
			    } else if ('typography' == $type) {

				$input['font-color'] = validate($input['font-color'], 'colorpicker', $field_id);
			    } else if ('upload' == $type) {

				$input = sanitize_text_field($input);
			    }

			    $input = apply_filters('ot_after_validate_setting', $input, $type, $field_id);

			    return $input;
			}

		    }

		    /**
		     * Create HTML MultiSelect list of pages.
		     *
		     * @package WordPress
		     * @since 2.1.0
		     * @uses Walker
		     */
		    class Walker_PageMultiSelect extends Walker {

			/**
			 * @see Walker::$tree_type
			 * @since 2.1.0
			 * @var string
			 */
			var $tree_type = 'page';

			/**
			 * @see Walker::$db_fields
			 * @since 2.1.0
			 * @todo Decouple this
			 * @var array
			 */
			var $db_fields = array('parent' => 'post_parent', 'id' => 'ID');

			/**
			 * @see Walker::start_el()
			 * @since 2.1.0
			 *
			 * @param string $output Passed by reference. Used to append additional content.
			 * @param object $page Page data object.
			 * @param int $depth Depth of page in reference to parent pages. Used for padding.
			 * @param array $args Uses 'selected' argument for selected page to set selected HTML attribute for option element.
			 */
			function start_el(&$output, $page, $depth, $args) {
			    $pad = str_repeat('&nbsp;', $depth * 3);

			    $output .= "\t<option class=\"level-$depth\" value=\"$page->ID\"";
			    if (is_array($args['selected'])) {
				if (in_array($page->ID, $args['selected'])) {
				    $output .= ' selected="selected"';
				}
			    } else {
				if ($page->ID == $args['selected']) {
				    $output .= ' selected="selected"';
				}
			    }
			    $output .= '>';
			    $title = apply_filters('list_pages', $page->post_title);
			    $output .= $pad . esc_html($title);
			    $output .= "</option>\n";
			}

		    }
		    ?>
