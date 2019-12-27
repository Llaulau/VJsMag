<?php
$of_options = array();

$of_options[] = array(
    'id' => 'google-map-width',
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
    'id' => 'google-map-height',
    'type' => 'range',
    'name' => 'Height',
    'std' => '600',
    'value' => "10",
    'min' => '0',
    'max' => '960',
    'step' => '1',
    'unit' => 'px'
);

$of_options[] = array(
    "name" => "Lat",
    "id" => "google-map-lat",
    "std" => "",
    "type" => "text"
);

$of_options[] = array(
    "name" => "Long",
    "id" => "google-map-long",
    "std" => "",
    "type" => "text"
);


$of_options[] = array(
    'id' => 'google-map-zoom',
    'type' => 'range',
    'name' => 'Zoom',
    'std' => '1',
    'value' => "1",
    'min' => '1',
    'max' => '19',
    'step' => '1',
    'unit' => ''
);

$of_options[] = array(
    'id' => 'google-map-marker',
    'type' => 'toggle',
    'name' => 'Map marker',
    "std" => "0",
);
/*
$of_options[] = array(
    'id' => 'google-map-popup-marker',
    'type' => 'toggle',
    'name' => 'Popup marker',
    'desc' => ''
);*/

$of_options[] = array(
    'id' => 'google-map-controls',
    'type' => 'toggle',
    'name' => 'Map controls',
    "std" => "1",
);

$of_options[] = array(
    'id' => 'google-map-doubleclickzoom',
    'type' => 'toggle',
    'name' => 'Diable doubleclick zoom',
    "std" => "1",
);

$of_options[] = array(
    'id' => 'google-map-scrollwheel',
    'type' => 'toggle',
    'name' => 'Enable scrool wheel',
    "std" => "0",
);

$of_options[] = array(
    'id' => 'google-map-dragable',
    'type' => 'toggle',
    'name' => 'Dragable map',
    "std" => "1",
);


$of_options[] = array(
    "name" => "Map Type",
    "id" => "google-map-type",
    "std" => "",
    "type" => "select",
    "options" => array(
        "" => "Choose",
        "ROADMAP" => "Road Map",
        "SATELLITE" => "Google Earth Map",
        "HYBRID" => "Mixture of normal and satellite",
        "TERRAIN" => "Physical Map"
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
        
        if (jQuery("#google-map-width").val().length > 0 ) {
            width = " width=" +"\""+jQuery("#google-map-width").val()+"\" ";
        } else {
            width = "";
        }
        
        if (jQuery("#google-map-height").val().length > 0 ) {
            height = " height=" +"\""+jQuery("#google-map-height").val()+"\" ";
        } else {
            height = "";
        }

        if (jQuery("#google-map-lat").val().length > 0) {
            llat = " latitude=" +"\""+jQuery("#google-map-lat").val()+"\" ";
        } else {
            llat = "";
        }
        
        if (jQuery("#google-map-long").val().length > 0) {
            llong = " longitude=" +"\""+jQuery("#google-map-long").val()+"\" ";
        } else {
            llong = "";
        }
        
        if (jQuery("#google-map-zoom").val().length > 0) {
            zoom = " zoom=" +"\""+jQuery("#google-map-zoom").val()+"\" ";
        } else {
            zoom = "";
        }

        if (jQuery("#google-map-marker input[type=radio]:checked").val() == '1') {
            marker = " marker='true'";
        } else {
            marker = " marker='false'";
        }
        
     /*   if (jQuery("#google-map-popup-marker").attr("checked")) {
            popupmarker = " popup=" +"\""+jQuery("#google-map-popup-marker").val()+"\" ";
        } else {
            popupmarker = " popup='false'";
        }*/
        
        if (jQuery("#google-map-controls input[type=radio]:checked").val() == '1'){
            controls  = " controls='true'";
        } else {
            controls = " controls='false'";
        }
        
        if (jQuery("#google-map-doubleclickzoom input[type=radio]:checked").val() == '1'){
            doubleclick = " disabledoubleclickzoom='true'";
        } else {
            doubleclick = " disabledoubleclickzoom='false'";
        }
        if (jQuery("#google-map-scrollwheel input[type=radio]:checked").val() == '1'){
            wheel = " scrollwheel='true'";
        } else {
            wheel = " scrollwheel='false'";
        }
        if (jQuery("#google-map-dragable input[type=radio]:checked").val() == '1'){
            dragable = " dragable='true'";
        } else {
            dragable = " dragable='false'";
        }    
        if (jQuery("#google-map-type").val().length > 0) {
            map_type = " maptype=" +"\""+jQuery("#google-map-type").val()+"\" ";
        } else {
            map_type = "";
        }

        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[google_map '+width+height+llat+llong+zoom+marker+controls+doubleclick+wheel+dragable+map_type+']');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>


