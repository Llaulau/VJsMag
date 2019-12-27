<?php

$of_options = array();

$of_options[] = array(
    "name" => "Src",
    "desc" => "",
    "id" => "iframe-src",
    "std" => "http://",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'iframe-width',
    'type' => 'range',
    'name' => 'Width',
    'std' => '600',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);
$of_options[] = array(
    'id' => 'iframe-height',
    'type' => 'range',
    'name' => 'Height',
    'std' => '600',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
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
        
        if (jQuery("#iframe-src").val().length > 0 && jQuery("#iframe-src").val() !== 'http://') {
            src = "src=" +"\""+jQuery("#iframe-src").val()+"\" ";
        } else {
            src = "";
        }
        
        if (jQuery("#iframe-width").val().length > 0 ) {
            width = "width=" +"\""+jQuery("#iframe-width").val()+"\" ";
        } else {
            width = "";
        }
        
        if (jQuery("#iframe-height").val().length > 0 ) {
            height = "height=" +"\""+jQuery("#iframe-height").val()+"\" ";
        } else {
            height = "";
        }

        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[iframe '+src+width+height+']');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>


