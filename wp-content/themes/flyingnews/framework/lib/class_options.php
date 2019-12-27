<?php

/**
 * This class is main manager for all options theme option
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class jwOpt {

    private static $_rawOptions = array(); // binds options
    private static $_options = null; // key(id) = value (value can bt array]
    private static $_default = array(); // key >> value (value can by array)
    private static $_categories = null;
    private static $_menus = null;
    private static $_panelmenu = null;

    public function __construct($options = null) {

	if (is_null($options)) {
	    require THEME_ADMIN . '/options/themeoptions.php';
	    list($options, self::$_panelmenu) = themeoptions();
	}


	self::$_rawOptions = $options;


	self::$_options = get_option(OPTIONS);
	self::$_categories = get_option(CATEGORIES);
	self::$_menus = get_option(MENUS);

	if (is_array($options))
	    foreach ($options as $opt) {
		if (isset($opt['id'])) {
		    //do $_default jsou všechny defaultní hodnoty, kromě sidebarů
		    if ($opt['id'] != 'sidebars') {
			self::$_default[$opt['id']] = self::getDefault($opt);
		    } else {
			self::$_default[$opt['id']] = self::get_option($opt['id'], null);
		    }
		}
	    }
    }
    
    
    /**
     * Docasne ulozeni/presani hodnoty. Hodnoty nejsou ulozeny do DB.
     * @param string $name variable name
     * @param mixed $value
     * @param string $type namespace
     * @param int $id (optional) 
     */
    public static function set_option($name, $value, $type = 'opt', $id = '') {
	switch ($type) {
	    case 'category':
		self::$_categories['category_' . $id][$name] = $value;
		break;
	    case 'menus':
		self::$_menus[$id][$name] = $value;
		break;
	    default:
		self::$_options[$name] = $value;
		break;
	}
    }

    private static function getDefault($opt) {
	if (isset($opt['std']))
	    return $opt['std'];
	else
	    return null;
    }

    private static function getValue($opt, $data = null) {
	if (!is_null($data) && isset($data[$opt['id']])) {
	    return $data[$opt['id']];
	} else if (isset($opt['std'])) {
	    return $opt['std'];
	} else
	    return null;
    }

    public static function getRawOptions() {
	return self::$_rawOptions;
    }

// get item options
    public static function get_option($name, $default = null, $type = 'opt', $id = '') {

	switch ($type) {
	    case 'category':
		if (isset(self::$_categories['category_' . $id][$name]))
		    return (self::$_categories['category_' . $id][$name]);
		else
		    return $default;
		break;
	    case 'menus':
		if (isset(self::$_menus[$id][$name]))
		    return (self::$_menus[$id][$name]);
		else
		    return $default;
		break;
	    default:
		if (isset(self::$_options[$name]))
		    return (self::$_options[$name]);
		else
		    return $default;
		break;
	}
    }

// get all options
    public static function get_options($type = 'opt') {
	switch ($type) {
	    case 'category':
		if (is_null(self::$_categories))
		    return get_option(CATEGORIES);
		else
		    return self::$_categories;
		break;
	    case 'menus':
		if (is_null(self::$_menus))
		    return get_option(MENUS);
		else
		    return self::$_menus;
		break;
	    default:
		if (is_null(self::$_options))
		    return get_option(OPTIONS);
		else
		    return self::$_options;
		break;
	}
    }

    // update type options
    public static function update_option($data, $type = 'opt') {
	switch ($type) {
	    case 'category':
		update_option(CATEGORIES, $data);
		break;
	    case 'menus':
		update_option(MENUS, $data);
		break;
	    default:
		update_option(OPTIONS, $data);
		break;
	}
    }

    public static function update_backups() {
	$data_opt = jwOpt::get_options();
	$data_opt['backup_log'] = date('r');
	$data_cat = jwOpt::get_options('category');
	$data_cat['backup_log'] = date('r');
	$data_men = jwOpt::get_options('menus');
	$data_men['backup_log'] = date('r');

	update_option(OPTIONS . BACKUPS, $data_opt);
	update_option(CATEGORIES . BACKUPS, $data_cat);
	update_option(MENUS . BACKUPS, $data_men);
    }

    public static function get_backups($type = OPTIONS) {
	$prom = get_option($type . BACKUPS);
	return $prom;
    }

    public static function getDefaults() {
	return self::$_default;
    }

    public static function getPanelMenu() {
	return self::$_panelmenu;
    }

    public static function beforeSave($data) {
	wp_parse_str(stripslashes($data), $data);
	unset($data['security']);
	unset($data['of_save']);
	return $data;
    }

    public static function is($data) {
	if (isset($data) && !empty($data))
	    return true;
	else
	    return false;
    }

}

?>
