<?php

/**
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo check permition for dynamic file 
 */


class nav_menu_options_manager {
	/**
	 * @var nav_menu_options_manager
	 */
	private static $_instance = null;
	
	private $_actualMenuId = null;
	private $_options = null;
	private $_itemIdToMenuId = array();
	
	/**
	 * @var nav_menu_options_printer
	 */
	private $_optionsPrinter = null;
	
	/**
	 * @var nav_menu_options_store
	 */
	private $_optionsStore = null;


	private function __construct() {
		$this->_optionsStore = nav_menu_options_store::getInstance();
		$this->_setHooks();
		$this->loadOptions();
	}
	
/******************************************************************************/
/* GET & SET OPTIONS
/******************************************************************************/		
	public function getOptionAdmin( $itemId, $optionName ) {
		return $this->_getOption( $this->_getActualMenuId(), $itemId, $optionName);
	}
	
	public function setOptionAdmin( $itemId, $optionName, $value ) {
		$this->_setOption( $this->_getActualMenuId(), $itemId, $optionName, $value);
	}
	
	public function getOption( $itemId, $optionName ) {
		$menuId = $this->getMenuId( $itemId );
		return $this->_getOption( $menuId, $itemId, $optionName);
	}
	
	private function _getOption( $menuId, $itemId, $optionName ) {
		if( isset( $this->_options[ $itemId ][ $optionName ] ) ) {
			return $this->_options[ $itemId ][ $optionName ];
		} else {
			return null;
		}
	}
	
	private function _setOption( $menuId, $itemId, $optionName, $value  ) {
           
		$this->_options[ $itemId ][ $optionName ] = $value;
	}

/******************************************************************************/
/* PRINT & UPDATE OPTIONS
/******************************************************************************/		
	public function printOptions( $itemId ) {
		$optionsData = $this->_optionsStore->getOptions();
		foreach( $optionsData as $oneOption ) {
			$oneOption->itemId = $itemId;
			$customValue = $this->getOptionAdmin($oneOption->itemId, $oneOption->name );
			
			if( $this->getOptionAdmin($oneOption->itemId, $oneOption->name ) != null )
				$oneOption->value = $customValue;
			$this->_getOptionsPrinter()->printOption($oneOption);
		}		
	}
	
	private function _getMenuItemId() {
		$listOfId = array();
		foreach((array) $_POST['menu-item-title'] as $id => $value ) {
			$listOfId[] = $id;
		}
		return $listOfId;
	}
	
	public function updateOptions() {
		$menuItemId = $this->_getMenuItemId();
		
		$optionsNames = $this->_optionsStore->getOptionsNames();
		$uniquePostId = array();
                
		foreach( $optionsNames as $oneName ) {
			$newName = $this->_generateOptionNameForPost( $oneName );                        
			foreach( $menuItemId as $id ) {
				( isset( $_POST[ $newName ][$id ] ) ) ? $val = $_POST[$newName][$id] : $val = '0'; 
				$uniquePostId[ $id ] = true;
				// test for checkbox only
				if( $val == '_blank') $val = true;
				//echo $oneName . ' ==== ' . $val . PHP_EOL;
				
                                if ( $oneName == 'menu_custom_html' ) {
                                    $val = stripslashes($val);
                                }
                                
                                $this->setOptionAdmin( $id, $oneName, $val);
			}
                        
                        foreach( $menuItemId as $id ) {
				( isset( $_POST[ 'menu-item-object' ][$id ] ) ) ? $val = $_POST['menu-item-object'][$id] : $val = '0';
				$this->setOptionAdmin( $id, 'menu_type', $val);
                                ( isset( $_POST[ 'menu-item-object-id' ][$id ] ) ) ? $val = $_POST['menu-item-object-id'][$id] : $val = '0'; 
				$this->setOptionAdmin( $id, 'menu_id', $val);
                                ( isset( $_POST[ 'menu' ] ) ) ? $val = $_POST['menu'] : $val = '0'; 
                                $this->setOptionAdmin( $id, 'nav_menu_id', $val);
                                ( isset( $_POST[ 'menu-name' ] ) ) ? $val = $_POST['menu-name'] : $val = '0'; 
                                $this->setOptionAdmin( $id, 'nav_menu_name', $val);                                
			}                      
		}
		foreach( $uniquePostId as $postId => $true ) {
			$this->_setMenuIdToMeta( $postId );
		}
		$this->saveOptions();
	}
	
	private function _generateOptionNameForPost( $name ) {
		return 'menu-item-'.$name;
	}

/******************************************************************************/
/* LOAD & SAVE OPTIONS
/******************************************************************************/
	private function _setMenuIdToMeta( $itemId ) {
		update_post_meta( $itemId, 'menu_id', $this->_getActualMenuId());
	}
	
	public function getMenuId( $itemId ) {
		return get_post_meta( $itemId, 'menu_id', true);
	}
	
	public function loadOptions() {
		$this->_options = get_option(MENUS);
	}
	
	public function saveOptions() {
		update_option(MENUS, $this->_options);
	}

/******************************************************************************/
/* OTHERS
/******************************************************************************/

	
	private function _setHooks() {
		add_action('jw_walker_nav_menu_edit_add_fields', array($this, 'printOptions') );
		add_action('wp_update_nav_menu', array( $this, 'updateOptions') );
	}
	
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new nav_menu_options_manager();
		}
		return self::$_instance;
	}
	
	
	private function _getActualMenuId() {
		if( $this->_actualMenuId == null ) {
			if( isset( $_GET['menu'] ) )
				$this->_actualMenuId = $_GET['menu'];
			else
				$this->_actualMenuId =  (int) get_user_option( 'nav_menu_recently_edited' );
		}
		return $this->_actualMenuId;
	}	
	
	/**
	 * @return nav_menu_option_printer
	 */
	private function _getOptionsPrinter() {
		if( $this->_optionsPrinter == null ) {
			$this->_optionsPrinter = new nav_menu_options_printer();
		}
		
		return $this->_optionsPrinter;
	}
}

nav_menu_options_manager::getInstance();
