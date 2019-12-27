<?php

$absolute_path = __FILE__;
$path_to_file = explode('wp-content', $absolute_path);
$path_to_wp = $path_to_file[0];

//Access WordPress
require_once( $path_to_wp . '/wp-load.php' );
require_once (THEME_FRAMEWORK_LIB .'class_elements.php');
include_once('dialogs/' . $_GET['code'] . '.php');

?>
<script src="<?php echo ADMIN_DIR. 'assets/js/elements.js' ?>"></script>