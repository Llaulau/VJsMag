<?php

/**
 * Sidebar manager
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */

/**
 * Base info:
 * 
 * sidebar model: Id, Name, description (optional), class=id
 */
class jwSidebars {

    private static $sidebars = array(
        'featured_right' => array('name' => 'Featured', 'id' => 'featured_right', 'desc' => ''),
        'footer1' => array('name' => 'Footer 1', 'id' => 'footer1', 'desc' => ''),
        'footer2' => array('name' => 'Footer 2', 'id' => 'footer2', 'desc' => ''),
        'footer3' => array('name' => 'Footer 3', 'id' => 'footer3', 'desc' => ''),
    );

    public function __construct($load = null, $default = null) {
        if (!is_null($default))
            $this->defaultSidebars($default);

        $this->loadSidebars($load);
        $this->registerSidebars();

        add_action('wp_ajax_jw_check_sidebar_action', array('jwSidebars', 'exist'));
        add_action('wp_ajax_jw_check_sidebar_action', array('jwSidebars', 'exist'));
    }

    private function loadSidebars($detault) {

        if (isset($detault) && !is_null($detault) && is_array($detault)) {
            foreach ($detault as $k => $v) {
                self::$sidebars[$k]['name'] = $v['name'];
                self::$sidebars[$k]['desc'] = $v['desc'];
                self::$sidebars[$k]['id'] = $v['id'];
            }
        }
    }

    public static function exist() {

        $nonce = $_POST['security'];
        if (!wp_verify_nonce($nonce, 'of_ajax_nonce'))
            die('security fail');

        if (isset($_POST['name'])) {
            $name = self::_getIdFromName($_POST['name']);
        }
        if (isset(self::$sidebars[$id]))
            die(1);
        else
            die(0);
    }

    public function defaultSidebars($sidebars) {
        self::$sidebars = $sidebars;
    }

    public function registerSidebars() {



        foreach (self::$sidebars as $key => $sidebar) {

            register_sidebar(array(
                'id' => $sidebar['id'],
                'name' => $sidebar['name'],
                'description' => $sidebar['desc'],
                'class' => $key,
                'before_widget' => '<article id="%1$s" class="row widget %2$s"><div class="sidebar-section twelve columns">',
                'after_widget' => '</div></article>',
                'before_title' => '<h2><strong>',
                'after_title' => '</strong></h2>'
            ));
        }
    }

    /**
     * Update sidebars info
     * @param type array $sidebar_array
     */
    function editSidebar($sidebar_array) {
        $sidebars = update_option(SIDEBARS, $sidebar_array);
    }

    function remove() {
        $sidebars = sidebars::getAll();
        if (isset($_POST['sidebar_name'])) {
            $name = str_replace(array("\n", "\r", "\t"), '', $_POST['sidebar_name']);
            $id = sidebars::getIdFromName($name);
        } else {
            die("alert('No sidebar name')");
        }
        if (!isset($sidebars[$id])) {
            die("alert('Sidebar does not exist.')");
        }
        $row_number = $_POST['row_number'];
        unset($sidebars[$id]);
        sidebars::update($sidebars);
        $js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($row_number)

		";
        die($js);
    }

    public function getSidebarName($id) {
        if ($id == 'default')
            return null;
        if (isset($this->sidebars[$id]))
            return $this->sidebars[$id];
        else
            return null;
    }

    private static function _generateName($name) {
        
    }

    public static function render($name) {
        if (isset(self::$sidebars[$name]))
            dynamic_sidebar($name);
    }

    /**
     * Build uniq id from name
     */
    private static function _getIdFromName($name) {
        $out = $name;
        $out = preg_replace('~[^\\pL0-9_]+~u', '-', $out);
        $out = trim($url, "-");
        $out = iconv("utf-8", "us-ascii//TRANSLIT", $out);
        $out = strtolower($url);
        $out = preg_replace('~[^-a-z0-9_]+~', '', $out);
        return $out;
    }


}

?>