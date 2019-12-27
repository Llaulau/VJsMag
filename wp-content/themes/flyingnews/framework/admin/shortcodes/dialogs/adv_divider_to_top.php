<?php

$of_options = array();

$of_options[] = array(
    "name" => "Title",
    "desc" => "A text input field.",
    "id" => "divider-title",
    "std" => "Back To Top",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Divider Color",
    "desc" => "",
    "id" => "dividercolor",
    "std" => "",
    "type" => "color"
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
        if (jQuery("#divider-title").val().length > 0 ) {
            title = "title=" +"\""+jQuery("#divider-title").val()+"\" ";
        } else {
            title = "";
        }
        
        if (jQuery("#dividercolor").val().length > 0 ) {
            color = "color=" +"\""+jQuery("#dividercolor").val()+"\" ";
        } else {
            color = "";
        }

        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[divider_adv_top_top '+title+color+']');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>