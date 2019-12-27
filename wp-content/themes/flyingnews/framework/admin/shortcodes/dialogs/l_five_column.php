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

$of_options[] = array(
    "name" => "Column 4",
    "desc" => "",
    "id" => "column4-text",
    "std" => "",
    "type" => "textarea"
);

$of_options[] = array(
    "name" => "Column 5",
    "desc" => "",
    "id" => "column5-text",
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
        
        if (jQuery("#column4-text").val().length > 0 ) {
            column4 = jQuery("#column4-text").val();
        } else {
            column4 = "";
        }
        
        if (jQuery("#column5-text").val().length > 0 ) {
            column5 = jQuery("#column5-text").val();
        } else {
            column5 = "";
        }
        
        tinymce.activeEditor.selection.setContent('[one_fifth]'+column1+'[/one_fifth][one_fifth]'+column2+'[/one_fifth][one_fifth]'+column3+'[/one_fifth][one_fifth]'+column4+'[/one_fifth][one_fifth_last]'+column5+'[/one_fifth_last]');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>


