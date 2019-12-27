<?php

$of_options = array();

$of_options[] = array(
    "name" => "Slider Options",
    "desc" => "Unlimited slider with drag and drop sortings.",
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
        var tab_title = "",tab_cont = "", i = 1;
        jQuery('#pingu_slider li .slide_body').each(function(){
            title = (jQuery(this).find('input').val());
            cont = (jQuery(this).find('textarea').val());
            if (i == 1) {
                tab_title += "[tabtitle class=\"active\" id=\""+i+"\"]"+title+"[/tabtitle]";
                tab_cont  += "[tabcontent class=\"active\" id=\""+i+"\"]"+cont+"[/tabcontent]";
            } else {
                tab_title += "[tabtitle id=\""+i+"\"]"+title+"[/tabtitle]";
                tab_cont  += "[tabcontent id=\""+i+"\"]"+cont+"[/tabcontent]";
            }
            i++;
        });
        
        tinymce.activeEditor.selection.setContent("[tabs]"+"[tabtitles]"+tab_title+"[/tabtitles]"+"[tabcontents]"+tab_cont+"[/tabcontents]"+"[/tabs]");
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>