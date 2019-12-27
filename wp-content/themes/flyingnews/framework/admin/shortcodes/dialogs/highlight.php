<?php

$of_options = array();

$of_options[] = array(
    "name" => "Highlight Color",
    "desc" => "",
    "id" => "highlight-color",
    "std" => "",
    "type" => "select",
    "options" => array(
        "" => "Choose color",
        "highlight-red" => "Red",
        "highlight-blazeorange" => "Blazeorange",
        "highlight-orange" => "Orange",
        "highlight-blue" => "Blue",
        "highlight-lightblue" => "Lightblue",
        "highlight-teal" => "Teal",
        "highlight-green" => "Green",
        "highlight-salmon" => "Salmon",
        "highlight-pistachio" => "Pistachio"
    )
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
        
        if (jQuery("#highlight-color option:selected").val().length > 0) {
            highlightColor = "highlightColor=" +"\""+jQuery("#highlight-color option:selected").val()+"\" ";
        } else {
            highlightColor = "";
        }   

        tinymce.activeEditor.selection.setContent('[highlight ' + highlightColor + ']' + tinymce.activeEditor.selection.getContent() + '[/highlight]');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>

