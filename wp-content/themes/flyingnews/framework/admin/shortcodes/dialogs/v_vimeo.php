<?php

$of_options = array();

$of_options[] = array(
    "name" => "Clip ID",
    "desc" => "f. e: http://vimeo.com/=<span style=\"color: red\">abcdef</span>",
    "id" => "video-id",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    'id' => 'video-width',
    'type' => 'range',
    'name' => 'Width', 
    'std' => '634',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);
$of_options[] = array(
    'id' => 'video-height',
    'type' => 'range',
    'name' => 'Height',  
    'std' => '480',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    'id' => 'video-byline',
    'type' => 'toggle',
    'name' => 'Byline'
);

$of_options[] = array(
    'id' => 'video-title',
    'type' => 'toggle',
    'name' => 'Autohide'
);

$of_options[] = array(
    'id' => 'video-portrait',
    'type' => 'toggle',
    'name' => 'Portrait',   
    'std' => true
);

$of_options[] = array(
    'id' => 'video-autoplay',
    'type' => 'toggle',
    'name' => 'Autoplay'
);

$of_options[] = array(
    'id' => 'video-loop',
    'type' => 'toggle',
    'name' => 'Play Video in Loop'
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
        
        if (jQuery("#video-id").val().length > 0 ) {
            videoId = "clip_id=" +"\""+jQuery("#video-id").val()+"\" ";
        } else {            
            videoId = "";
        }
        
        if (jQuery("#video-width").val().length > 0 ) {
            width = "width=" +"\""+jQuery("#video-width").val()+"\" ";
        } else {
            width = "";
        }

        if (jQuery("#video-height").val().length > 0) {
            height = "height=" +"\""+jQuery("#video-height").val()+"\" ";
        } else {
            height = "";
        }        
        
        if (jQuery('#video-byline1').is(':checked')) {
            videoByLine = "byline=\"true\" ";
        } else {
            videoByLine = "byline=\"false\" ";
        }
        
        if (jQuery('#video-title1').is(':checked')) {
            videoTitle = "title=\"true\" ";
        } else {
            videoTitle = "title=\"false\" ";
        }
        
        if (jQuery('#video-portrait1').is(':checked')) {
            videoPortrait = "portrait=\"true\" ";
        } else {
            videoportrait = "portrait=\"false\" ";
        }
        
        if (jQuery('#video-autoplay1').is(':checked')) {
            videoAutoplay = "autoplay=\"true\" ";
        } else {
            videoAutoplay = "autoplay=\"false\" ";
        }
        
        if (jQuery('#video-loop1').is(':checked')) {
            videoLoop = "loop=\"true\" ";
        } else {
            videoLoop = "loop=\"false\"";
        }
        
        if (videoId.length > 0) {
            tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[video type="vimeo" '+videoId+width+height+videoByLine+videoTitle+videoPortrait+videoAutoplay+videoLoop+']');
            tb_remove();
        } else {
            alert('Please fill field Clip ID');
            jQuery('#video-id').focus();
        }
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>
