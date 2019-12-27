<?php

$of_options = array();

$of_options[] = array(
    "name" => "Clip ID",
    "desc" => "f. e: http://www.youtube.com/watch?v=<span style=\"color: red\">MWYi4_COZMU</span>",
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
    'id' => 'video-autoplay',
    'type' => 'toggle',
    'name' => 'Autoplay'
);

$of_options[] = array(
    'id' => 'video-autohide',
    'type' => 'toggle',
    'name' => 'Autohide'
);

$of_options[] = array(
    'id' => 'video-controls',
    'type' => 'toggle',
    'name' => 'Show Controls',
    'std' => true
);

$of_options[] = array(
    'id' => 'video-disablekb',
    'type' => 'toggle',
    'name' => 'Disable Keyboard'
);

$of_options[] = array(
    'id' => 'video-fs',
    'type' => 'toggle',
    'name' => 'Full Screen Button'
);

$of_options[] = array(
    'id' => 'video-hd',
    'type' => 'toggle',
    'name' => 'Enable HD version'
);

$of_options[] = array(
    'id' => 'video-loop',
    'type' => 'toggle',
    'name' => 'Play Video in Loop'
);

$of_options[] = array(
    'id' => 'video-rel',
    'type' => 'toggle',
    'name' => 'Rel'
);

$of_options[] = array(
    'id' => 'video-showsearch',
    'type' => 'toggle',
    'name' => 'Show Search'
);

$of_options[] = array(
    'id' => 'video-showinfo',
    'type' => 'toggle',
    'name' => 'Show Info'
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
        
        if (jQuery('#video-autoplay1').is(':checked')) {
            videoAutoplay = "autoplay=\"true\" ";
        } else {
            videoAutoplay = "autoplay=\"false\" ";
        }
        
        if (jQuery('#video-autohide1').is(':checked')) {
            videoAutohide = "autohide=\"true\" ";
        } else {
            videoAutohide = "autohide=\"false\" ";
        }
        
        if (jQuery('#video-controls1').is(':checked')) {
            videoControls = "controls=\"true\" ";
        } else {
            videoControls = "controls=\"false\" ";
        }
        
        if (jQuery('#video-disablekb1').is(':checked')) {
            videoDisablekb = "disablekb=\"true\" ";
        } else {
            videoDisablekb = "disablekb=\"false\" ";
        }
        
        if (jQuery('#video-fs1').is(':checked')) {
            videoFs = "fs=\"true\" ";
        } else {
            videoFs = "fs=\"false\" ";
        }
        
        if (jQuery('#video-hd1').is(':checked')) {
            videoHd = "hd=\"true\" ";
        } else {
            videoHd = "hd=\"false\" ";
        }
        
        if (jQuery('#video-loop1').is(':checked')) {
            videoLoop = "loop=\"true\" ";
        } else {
            videoLoop = "loop=\"false\" ";
        }
        
        if (jQuery('#video-rel1').is(':checked')) {
            videoRel = "rel=\"true\" ";
        } else {
            videoRel = "rel=\"false\" ";
        }
        
        if (jQuery('#video-showsearch1').is(':checked')) {
            videoShowsearch = "showsearch=\"true\" ";
        } else {
            videoShowsearch = "showsearch=\"false\" ";
        }
        
        if (jQuery('#video-showinfo1').is(':checked')) {
            videoShowinfo = "showinfo=\"true\"";
        } else {
            videoShowinfo = "showinfo=\"false\"";
        }
        
        if (videoId.length > 0) {
            tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[video type="youtube" '+videoId+width+height+videoAutoplay+videoAutohide+videoControls+videoDisablekb+videoFs+videoHd+videoLoop+videoRel+videoShowsearch+videoShowinfo+']');
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
