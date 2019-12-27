<?php

$st = nav_menu_options_store::getInstance();

$st->addOption(nav_menu_one_option::TYPE_SELECT, '', 'menu_custom_desc_type', 'Type of the menu description')
            ->addValue('Custom HTML', 'menu_custom_desc_type_html')
            ->addValue('Post','menu_custom_desc_type_post')
            ->addValue('Last post from category','menu_custom_desc_type_cat');

$st->addOption(nav_menu_one_option::TYPE_TEXT_AREA, null, 'menu_custom_html', 'Custom HTML')->description('Here you write html code.')->size( nav_menu_one_option::SIZE_WIDE);
$st->addOption(nav_menu_one_option::TYPE_POST_SELECT, null, 'menu_cutom_post_id', 'Choose Post ID');
$st->addOption(nav_menu_one_option::TYPE_CAT_POST_SELECT, null, 'menu_cutom_cat_id', 'Choose Category ID');

$st->endNotation();

?>
