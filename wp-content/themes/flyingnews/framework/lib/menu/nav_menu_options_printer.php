<?php

/**
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo check permition for dynamic file 
 */



/**
 * Print option, by inner switch decide which one and then print it by private
 * functions.
 *
 */
class nav_menu_options_printer {
	/**
	 * @var nav_menu_one_option
	 */
	private $_oneOptionTemporary = null;
	
	public function printOption( nav_menu_one_option $oneOption )	{
		$this->_oneOptionTemporary = $oneOption;
		switch( $oneOption->type ) {
			case nav_menu_one_option::TYPE_TEXT :
				$this->_printText( $oneOption );
				break;
			case nav_menu_one_option::TYPE_TEXT_AREA:
				$this->_printTextarea( $oneOption );
				break;
			case nav_menu_one_option::TYPE_CHECK:
				$this->_printCheckbox();
				break;
			case nav_menu_one_option::TYPE_SELECT:
				$this->_printSelect();
				break;
                        case nav_menu_one_option::TYPE_POST_SELECT:
				$this->_printSelectPost();
				break;
                        case nav_menu_one_option::TYPE_CAT_POST_SELECT:
				$this->_printSelectPost();
				break;
                            
		}
		$this->_oneOptionTemporary = null;
	}
/******************************************************************************/
/* PRINT TEXT
/******************************************************************************/
	private function _printText(){
		echo '<p class="description description-'.$this->_getSize().'">'.PHP_EOL;
			echo '<label for="'.$this->_getHtmlId() .'">'.PHP_EOL;
				echo $this->_oneOptionTemporary->title.PHP_EOL;
				echo '<input type="text" id="'.$this->_getHtmlId().'" class="widefat '.$this->_getHtmlId().'" name="'.$this->_getHtmlName().'" value="'.$this->_getValue().'">'.PHP_EOL;
			echo '</label>'.PHP_EOL;
		echo '</p>'.PHP_EOL;
	}	
	
	private function _printTextarea() {
		echo '<p class="field-custom-description description description-'.$this->_getSize().'">'. PHP_EOL;
		echo '<label for="'.$this->_getHtmlId() .'">'. PHP_EOL;
                echo $this->_oneOptionTemporary->title.PHP_EOL;
                echo '<textarea id="'.$this->_getHtmlId() .'" class="widefat edit-menu-item-description" rows="3" cols="20" name="'.$this->_getHtmlName() .'">'.$this->_getValue().'</textarea>'. PHP_EOL;
                if( $this->_oneOptionTemporary->description != null )
			echo '<span class="description">'. $this->_oneOptionTemporary->description .'</span>'. PHP_EOL;
		echo '</label>'. PHP_EOL;
		echo '</p>'. PHP_EOL;
	}
	
	private function _printCheckbox() {
		$isChecked = (int)$this->_getValue();
		( $isChecked === 1 ) ? $checked = 'checked="checked"' : $checked = ' '; 
		echo '<p class="field-link-target description">'. PHP_EOL;
			echo '<label for="'.$this->_getHtmlId() .'">'. PHP_EOL;
				echo '<input type="checkbox" id="'.$this->_getHtmlId() .'" value="_blank" '.$checked.' name="'.$this->_getHtmlName() .'" />'. PHP_EOL;
				if( $this->_oneOptionTemporary->description != null )
					echo '<span class="description">'. $this->_oneOptionTemporary->description .'</span>'. PHP_EOL;
			echo '</label>'. PHP_EOL;
		echo '</p>'. PHP_EOL;
	}
	
	private function _printSelect() {
		echo '<p class="description description-'.$this->_getSize().'">'.PHP_EOL;
			echo '<label for="'.$this->_getHtmlId() .'">'.PHP_EOL;
				echo $this->_oneOptionTemporary->title.PHP_EOL;
				//echo '<input type="text" id="'.$this->_getHtmlId().'" class="widefat '.$this->_getHtmlId().'" name="'.$this->_getHtmlName().'" value="'.$this->_getValue().'">'.PHP_EOL;
				echo '<select id="'.$this->_getHtmlId().'" class="widefat '.$this->_getHtmlId().'" name="'.$this->_getHtmlName().'" value="'.$this->_getValue().'">'.PHP_EOL;
					foreach( $this->_oneOptionTemporary->values as $oneValue ) {
						( $oneValue['value'] == $this->_getValue() ) ? $selected = 'selected="selected"' : $selected = '';
							
						echo '<option value="'.$oneValue['value'].'" '.$selected.' >';
							echo $oneValue['name'];
						echo '</option>';
					}
				echo '</select>';
		echo '</label>'.PHP_EOL;
		
	}
        
        private function _printSelectPost() {
		echo '<p class="description description-'.$this->_getSize().'">'.PHP_EOL;
			echo '<label for="'.$this->_getHtmlId() .'">'.PHP_EOL;
				echo $this->_oneOptionTemporary->title.PHP_EOL;
                                $value = array(
                                    "id" => $this->_getHtmlName(),
                                    "std" => null,
                                    "type" => 'text',
                                    "mod" => 'mini',
                                    "std" => array(),
                                    
                                );
                                echo Elements::element_text($value, $this->_getValue());
		echo '</label>'.PHP_EOL;
		
	}
        
        
       
        
/******************************************************************************/
/* HELPERS
/******************************************************************************/
	private function _getSize() {
		if ( $this->_oneOptionTemporary->size != null )
			$size = $this->_oneOptionTemporary->size;
		else
			$size = nav_menu_one_option::SIZE_THIN;

		return $size;
	}
	
	private function _getHtmlId() {
		return 'edit-menu-item-'.$this->_oneOptionTemporary->name.'-'.$this->_oneOptionTemporary->itemId;
	}
	
	private function _getHtmlName() {
		return 'menu-item-'.$this->_oneOptionTemporary->name.'['.$this->_oneOptionTemporary->itemId.']';
	}
	
	private function _getValue() {
		return esc_attr( $this->_oneOptionTemporary->value );
	}	
	
}