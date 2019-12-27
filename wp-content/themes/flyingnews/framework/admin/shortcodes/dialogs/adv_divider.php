<?php

$of_options = array();

$of_options[] = array(
    'id' => 'top-width',
    'type' => 'range',
    'name' => 'Padding Top',
    'std' => '0',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);
$of_options[] = array(
    'id' => 'bottom-width',
    'type' => 'range',
    'name' => 'Padding Bottom',
    'std' => '0',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    "name" => "Line color",
    "desc" => "",
    "id" => "linecolor",
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
        
        if (jQuery("#top-width").val().length > 0 ) {
            topwidth = "topwidth=" +"\""+jQuery("#top-width").val()+"\" ";
        } else {
            topwidth = "";
        }
        
        if (jQuery("#bottom-width").val().length > 0 ) {
            bottomwidth = "bottomwidth=" +"\""+jQuery("#bottom-width").val()+"\" ";
        } else {
            bottomwidth = "";
        }
        
        if (jQuery("#linecolor").val().length > 0 ) {
            color = "linecolor=" +"\""+jQuery("#linecolor").val()+"\" ";
        } else {
            color = "";
        }

        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[divider_adv '+topwidth+bottomwidth+color+']');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>


