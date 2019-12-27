<?php
function jaw_shortcodes_button() {
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }

    if (get_user_option('rich_editing') == 'true') {
        add_filter('mce_external_plugins', 'add_jawshortcodes');
        add_filter('mce_buttons', 'register_button');
    }
}

function register_button($buttons) {
    array_push($buttons, "|", "jaw_shortcodes");
    return $buttons;
}

function add_jawshortcodes($parray) {
    $parray['jaw_shortcodes'] = get_template_directory_uri() . '/framework/admin/shortcodes/jaw_shortcodes.js';
    return $parray;
}

add_action('init', 'jaw_shortcodes_button');
?>