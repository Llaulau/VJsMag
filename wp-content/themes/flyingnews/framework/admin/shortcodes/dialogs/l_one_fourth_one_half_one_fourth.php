<?php

$of_options = array();

$of_options[] = array(
    "name" => "Column 1",
    "desc" => "",
    "id" => "column1-text",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "name" => "Column 2",
    "desc" => "",
    "id" => "column2-text",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "name" => "Column 3",
    "desc" => "",
    "id" => "column3-text",
    "std" => "",
    "type" => "textarea"
);

 
?>

<div id="jaw-shortcode-popup">
    <div id="of_container" style="">
        <div id="content" style="">
             <?php echo Elements::elements_render($of_options) /* Settings */ ?>
        </div>
    </div>

    <div id="jaw-shortcode-buttons">
        <div class="jaw-shortcode-buttons-content">
            <input type="submit" value="Cancel" accesskey="p" tabindex="5" id="cancel-button" class="button-primary" name="save">
            <input type="submit" value="Insert" accesskey="p" tabindex="5" id="insert-button" class="button-primary" name="save">
        </div>
    </div>
</div>
<script>
    jQuery("#insert-button").click(function () {
        
        if (jQuery("#column1-text").val().length > 0) {
            column1 = jQuery("#column1-text").val();
        } else {
            column1 = "";
        }
        
        if (jQuery("#column2-text").val().length > 0 ) {
            column2 = jQuery("#column2-text").val();
        } else {
            column2 = "";
        }
        
        if (jQuery("#column3-text").val().length > 0 ) {
            column3 = jQuery("#column3-text").val();
        } else {
            column3 = "";
        } 

        tinymce.activeEditor.selection.setContent('[one_fourth]'+column1+'[/one_fourth][one_half]'+column2+'[/one_half][one_fourth_last]'+column3+'[/one_fourth_last]');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>


