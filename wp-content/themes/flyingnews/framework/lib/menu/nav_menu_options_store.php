<?php

/**
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo check permition for dynamic file 
 */


class nav_menu_options_store {
	/**
	 * @var nav_menu_options_store
	 */
	private static $_instance = null;
	/**
	 * @var nav_menu_one_option
	 */
	private $_options = null;
	/**
	 * @var names of all added options
	 */
	private $_optionsNames = null;
	/**
	 * @var nav_menu_one_option
	 */
	private $_actualOptionHolder = null;
	
/******************************************************************************/
/* CONSTRUCTORS	
/******************************************************************************/
	private function __construct() {
		$this->_options = array();
		$this->_optionsNames = array();
	}
	
	public static function getInstance() {
		if( self::$_instance == null ) {
			self::$_instance = new nav_menu_options_store();
		}
		return self::$_instance;
	}

/******************************************************************************/
/* GETTERS
/******************************************************************************/	
	/**
	 * @return array[nav_menu_one_option]
	 */
	public function getOptions() {
		return $this->_options;
	}
	
	public function getOptionsNames() {
		return $this->_optionsNames;
	}
/******************************************************************************/
/* OPTION ADDING
/******************************************************************************/

	/**
	 *
	 * @param unknown $type
	 * @param unknown $value
	 * @param unknown $name
	 * @param unknown $title
	 * @return nav_menu_options_data
	 */
	public function addOption( $type, $value, $name, $title) {
		$this->_reset();
		$this->_actualOptionHolder->type = $type;
		$this->_actualOptionHolder->value = $value;
		$this->_actualOptionHolder->name = $name;
		$this->_actualOptionHolder->title = $title;
	
		return $this;
	}
	/**
	 *
	 * @param unknown $size
	 * @return nav_menu_options_data
	 */
	public function size( $size ) {
		$this->_actualOptionHolder->size = $size;
	
		return $this;
	}
	/**
	 *
	 * @param unknown $values
	 * @return nav_menu_options_data
	 */
	public function addValue( $name, $value ) {
		if( $this->_actualOptionHolder->values == null ) {
			$this->_actualOptionHolder->values = array();
		}
		$newValue = array('name'=>$name, 'value'=>$value);
		$this->_actualOptionHolder->values[] = $newValue;
	
		return $this;
	}
	/**
	 *
	 * @param unknown $description
	 * @return nav_menu_options_data
	 */
	public function description( $description ) {
		$this->_actualOptionHolder->description = $description;
	
		return $this;
	}
	
	public function push() {
		if( $this->_actualOptionHolder != null ) {
			$this->_options[] = $this->_actualOptionHolder;
			//$this->_optionsCollection->addOption( $this->_actualOptionHolder );
			$this->_optionsNames[] = $this->_actualOptionHolder->name;
			$this->_actualOptionHolder = null;
		}
	}	
	
	private function _reset() {
		if( $this->_actualOptionHolder !== null ) $this->push();
		$this->_actualOptionHolder = new nav_menu_one_option();
	}
	public function endNotation() {
		$this->push();
	}	
}