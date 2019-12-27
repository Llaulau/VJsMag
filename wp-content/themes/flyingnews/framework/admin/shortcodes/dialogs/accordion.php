<?php
$of_options = array();

$of_options[] = array(
    "name" => "Accordion Options",
    "desc" => "",
    "id" => "pingu_slider",
    "std" => "",
    "type" => "tabs"
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
        var actab="",i = 1;
        jQuery('#pingu_slider li .slide_body').each(function(){
            title = (jQuery(this).find('input').val());
            content = (jQuery(this).find('textarea').val());
            if (i === 1) {
                actab += "[accordion_item class=\"active\" title=\""+title+"\"]"+content+"[/accordion_item]";
            } else {
                actab += "[accordion_item title=\""+title+"\"]"+content+"[/accordion_item]";
            }
            i++;
        });
        
        tinymce.activeEditor.selection.setContent("[accordion]"+actab+"[/accordion]");
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>