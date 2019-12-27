<?php

function theme_shortcode_googlemap($atts, $content = null, $code) {
    extract(shortcode_atts(array(
		"width" => false,
		"height" => '400',
		"address" => '',
		"latitude" => 0,
		"longitude" => 0,
		"zoom" => 14,
		"html" => '',
		"popup" => 'false',
		"controls" => 'false',
		'pancontrol' => 'true',
		'zoomcontrol' => 'true',
		'maptypecontrol' => 'true',
		'scalecontrol' => 'true',
		'streetviewcontrol' => 'true',
		'overviewmapcontrol' => 'true',
                "dragable" => "true",
		"scrollwheel" => 'true',
		'disabledoubleclickzoom' =>'true',
		"maptype" => 'ROADMAP',
		"marker" => 'true',
		'align' => false,
	), $atts));

    if ($width) {
        if (is_numeric($width)) {
            $width = $width . 'px';
        }
        $width = 'width:100%;';
    } else {
        $width = '';
        $align = false;
    }
    if ($height) {
        if (is_numeric($height)) {
            $height = $height . 'px';
        }
        $height = 'height:' . $height . ';';
    } else {
        $height = '';
    }


    $align = $align ? ' align' . $align : '';
    $id = rand(1000, 10000);
   
    
  
        
        if ($marker != 'false') {
        ob_start();
        wp_register_script('g_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDQawavpg46SmVMRFtdPl1YKzSDQc0UI6U&sensor=false', array('jquery'), false, true);
        wp_enqueue_script('g_maps');
        echo '
        <div id="google_map_'.$id.'" class="google_map'.$align.'" style="'.$width.' '.$height.'"></div>


       
        <script type="text/javascript">
        jQuery(window).load(function() {
                var location = new google.maps.LatLng('.$latitude.', '.$longitude.');
                var mapOptions = {
                  center: location,
                  zoom: '.$zoom.',
                  panControl: '.$controls.',
                  zoomControl: '.$controls.',
                  zoomControlOptions: {
                      style: google.maps.ZoomControlStyle.SMALL,
                      position: google.maps.ControlPosition.TOP_LEFT
                  },

                   mapTypeControl: '.$controls.',
                   mapTypeControlOptions: {
                      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                      position: google.maps.ControlPosition.TOP_RIGHT

                   },
                   scaleControl: false,
                   streetViewControl: false,
                   overviewMapControl: false,
                   draggable: '.$dragable.',
                   disableDoubleClickZoom: '.$disabledoubleclickzoom.',
                   scrollwheel: '.$scrollwheel.',
                   mapTypeId: google.maps.MapTypeId.'.$maptype.'
                };


                var map = new google.maps.Map(document.getElementById("google_map_'.$id.'"), mapOptions);

                var marker = new google.maps.Marker({   
                        position: location,
                        map: map
                  });



        });
        </script>';
        return ob_get_clean();

    } else {
        ob_start();
        wp_register_script('g_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDQawavpg46SmVMRFtdPl1YKzSDQc0UI6U&sensor=false', array('jquery'), false, true);
        wp_enqueue_script('g_maps');
        echo '
        <div id="google_map_'.$id.'" class="google_map'.$align.'" style="'.$width.' '.$height.'"></div>



        <script>
        jQuery(window).load(function() {
                var location = new google.maps.LatLng('.$latitude.', '.$longitude.');
                var mapOptions = {
                  center: location,
                  zoom: '.$zoom.',
                  panControl: '.$controls.',
                  zoomControl: '.$controls.',
                  zoomControlOptions: {
                      style: google.maps.ZoomControlStyle.SMALL,
                      position: google.maps.ControlPosition.TOP_LEFT
                  },

                   mapTypeControl: '.$controls.',
                   mapTypeControlOptions: {
                      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                      position: google.maps.ControlPosition.TOP_RIGHT

                   },
                   scaleControl: false,
                   streetViewControl: false,
                   overviewMapControl: false,
                   draggable: '.$dragable.',
                   disableDoubleClickZoom: '.$disabledoubleclickzoom.',
                   scrollwheel: '.$scrollwheel.',
                   mapTypeId: google.maps.MapTypeId.'.$maptype.'
                };


                var map = new google.maps.Map(document.getElementById("google_map_'.$id.'"), mapOptions);

                    
              



        });
        </script>';
        return ob_get_clean();


    }
}

add_shortcode('google_map', 'theme_shortcode_googlemap');
