<?php

$of_options = array();

$of_options[] = array(
    "name" => "Pre Content",
    "desc" => "",
    "id" => "pre-text",
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
        
        if (jQuery("#pre-text").val().length > 0 ) {
            preContent = jQuery("#pre-text").val();
        } else {
            preContent = "";
        }      

        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[pre]'+preContent+'[/pre]');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>


