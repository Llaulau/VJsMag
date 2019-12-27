<?php

$of_options = array();


$of_options[] = array(
    "name" => "Notice Type",
    "desc" => "",
    "id" => "notice-type",
    "std" => "",
    "type" => "select",
    "options" => array(
        "approved" => "approved",
        "attention" => "attention",
        "info" => "info",
        "alert" => "alert"
    )
);

$of_options[] = array(
    "name" => "Notice Content",
    "desc" => "",
    "id" => "notice-text",
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
        
        if (jQuery("#notice-type option:selected").val().length > 0) {
            noticeType = "noticeType=" +"\""+jQuery("#notice-type option:selected").val()+"\" ";
        } else {
            noticeType = "";
        }
        if (jQuery("#notice-text").val().length > 0 ) {
            noticeContent = jQuery("#notice-text").val();
        } else {
            noticeContent = "";
        }      

        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[notice '+noticeType+']'+noticeContent+'[/notice]');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>


