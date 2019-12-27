<?php

$of_options = array();

$of_options[] = array(
    "name" => "Title",
    "desc" => "A text input field.",
    "id" => "button-title",
    "std" => "Default Value",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Link",
    "desc" => "A text input field.",
    "id" => "button-link",
    "std" => "http://",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Normal Select",
    "desc" => "Normal Select Box.",
    "id" => "button-size",
    "std" => "three",
    "type" => "select",
    "options" => array(
        "button-small" => "Small",
        "button-medium" => "Medium",
        "button-large" => "Large"
    )
);

$of_options[] = array(
    "name" => "Button Color",
    "desc" => "",
    "id" => "button-color",
    "std" => "",
    "type" => "select",
    "options" => array(
        "" => "red",
        "" => "Choose color",
        "button-red" => "Red",
        "button-blazeorange" => "Blazeorange",
        "button-orange" => "Orange",
        "button-blue" => "Blue",
        "button-lightblue" => "Lightblue",
        "button-teal" => "Teal",
        "button-green" => "Green",
        "button-salmon" => "Salmon",
        "button-pistachio" => "Pistachio"
    )
);

$of_options[] = array(
    "name" => "Background Color",
    "desc" => "",
    "id" => "button-background-color",
    "std" => "",
    "type" => "color"
);

$of_options[] = array(
    "name" => "Text Color",
    "desc" => "",
    "id" => "button-text-color",
    "std" => "",
    "type" => "color"
);

$of_options[] = array(
    "name" => "Hover Background Color",
    "desc" => "",
    "id" => "button-hover-background-color",
    "std" => "",
    "type" => "color"
);

$of_options[] = array(
    "name" => "Hover Text Color",
    "desc" => "",
    "id" => "button-hover-text-color",
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
        
        title = "title=" +"\""+jQuery("#button-title").val()+"\" ";
        
        if (jQuery("#button-link").val().length > 0 && jQuery("#button-link").val() !== 'http://') {
            link = "link=" +"\""+jQuery("#button-link").val()+"\" ";
        } else {
            link = "";
        }

        size = "size=" +"\""+jQuery("#button-size option:selected").val()+"\" ";
        
        if (jQuery("#button-color option:selected").val().length > 0) {
            buttonColor = "buttonColor=" +"\""+jQuery("#button-color option:selected").val()+"\" ";
        } else {
            buttonColor = "";
        }
        
        if (jQuery("#button-background-color").val().length > 0 ) {
            bgColor = "bgColor=" +"\""+jQuery("#button-background-color").val()+"\" ";
        } else {
            bgColor = "";
        }
        
        if (jQuery("#button-text-color").val().length > 0 ) {
            textColor = "textColor=" +"\""+jQuery("#button-text-color").val()+"\" ";
        } else {
            textColor = "";
        }
        
        if (jQuery("#button-hover-background-color").val().length > 0 ) {
            bgHoverColor = "bgHoverColor=" +"\""+jQuery("#button-hover-background-color").val()+"\" ";
        } else {
            bgHoverColor = "";
        }
        
        if (jQuery("#button-hover-text-color").val().length > 0 ) {
            textHoverColor = "textColor=" +"\""+jQuery("#button-hover-text-color").val()+"\" ";
        } else {
            textHoverColor = "";
        }
        
        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[button '+title+link+size+buttonColor+bgColor+textColor+bgHoverColor+textHoverColor+']');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>


