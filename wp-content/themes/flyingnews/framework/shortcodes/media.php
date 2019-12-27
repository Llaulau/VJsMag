<?php

function jawtheme_shortcode_video($atts) {
    
    if (isset($atts['type'])) {
        switch ($atts['type']) {
            case 'flash':
                return jawtheme_video_flash($atts);
                break;
            case 'youtube':
                return jawtheme_video_youtube($atts);
                break;
            case 'vimeo':
                return jawtheme_video_vimeo($atts);
                break;
            case 'html5':
		return jawtheme_video_html5($atts);
		break;
        }
    }else{
        return jawtheme_video_html5($atts);
    }
    return '';
}

add_shortcode('video', 'jawtheme_shortcode_video');

function jawtheme_video_flash($atts) {
    extract(shortcode_atts(array(
                'src' => '',
                'id' => '',
                'width' => false,
                'height' => false,
                'play' => 'false',
                'flashvars' => '',
                    ), $atts));

    if ($id != '') {
        $id = ' id="' . $id . '"';
    }
    if ($height && !$width)
        $width = intval($height * 16 / 9);
    if (!$height && $width)
        $height = intval($width * 9 / 16);
    if (!$height && !$width) {
        $height = 600;
        $width = 800;
    }

    $uri = THEME_URI;
    if (!empty($src)) {
        return "
<div class='video_frame'>
<object{$id} class='flash' width='{$width}' height='{$height}' type='application/x-shockwave-flash' data='{$src}'>
	<param name='movie' value='{$src}' />
	<param name='allowFullScreen' value='true' />
	<param name='allowscriptaccess' value='always' />
	<param name='expressInstaller' value='{$uri}/shortcodes/swf/expressInstall.swf'/>
	<param name='play' value='{$play}'/>
	<param name='wmode' value='transparent' />
	<embed src='$src' type='application/x-shockwave-flash' wmode='transparent' allowscriptaccess='always' allowfullscreen='true' width='{$width}' height='{$height}' />
</object>
</div>";
    }
}





function jawtheme_video_vimeo($atts) {
    extract(shortcode_atts(array(
                'clip_id' => '',
                'width' => false,
                'height' => false,
                'byline' => false,
                'title' => false,
                'portrait' => false,
                'autoplay' => false,
                'loop' => false,
                    ), $atts));

    if ($height && !$width)
        $width = intval($height * 16 / 9);
    if (!$height && $width)
        $height = intval($width * 9 / 16);
    if (!$height && !$width) {
        $height = 600;
        $width = 800;
    }
    if ($byline === 'true') {
        $byline = '1';
    } else {
        $byline = '0';
    }


    if ($title === 'true') {
        $title = '1';
    } else {
        $title = '0';
    }

    if ($portrait === 'true') {
        $portrait = '1';
    } else {
        $portrait = '0';
    }


    if ($autoplay === 'true') {
        $autoplay = '1';
    } else {
        $autoplay = '0';
    }

    if ($loop === 'true') {
        $loop = '1';
    } else {
        $loop = '0';
    }

    if (!empty($clip_id) && is_numeric($clip_id)) {
        
        return "<div class='video_frame'><iframe class='vimeo' style='height:{$height}px;width:{$width}px' src='http://player.vimeo.com/video/$clip_id?title={$title}&amp;byline={$byline}&amp;portrait={$portrait}&amp;autoplay={$autoplay}&amp;loop={$loop}' width='$width' height='$height' frameborder='0'></iframe></div>";
    }
}

function jawtheme_video_youtube($atts, $content = null) {
    extract(shortcode_atts(array(
                'clip_id' => '',
                'width' => false,
                'height' => false,
                'autohide' => false,
                'autoplay' => false,
                'controls' => false,
                'disablekb' => false,
                'fs' => false,
                'hd' => false,
                'loop' => false,
                'rel' => false,
                'showsearch' => false,
                'showinfo' => false,
                    ), $atts));

    if ($height && !$width)
        $width = intval($height * 16 / 9);
    if (!$height && $width)
        $height = intval($width * 9 / 16) + 25;
    if (!$height && !$width) {
        $height = 600;
        $width = 800;
    }






    if ($controls === 'true') {
        $controls = '1';
    } else {
        $controls = '0';
    }


    if ($disablekb === 'true') {
        $disablekb = '1';
    } else {
        $disablekb = '0';
    }

    if ($fs === 'true') {
        $fs = '1';
    } else {
        $fs = '0';
    }

    if ($hd === 'true') {
        $hd = '1';
    } else {
        $hd = '0';
    }

    if ($loop === 'true') {
        $loop = '1';
    } else {
        $loop = '0';
    }

    if ($rel === 'true') {
        $rel = '1';
    } else {
        $rel = '0';
    }


    if ($showinfo === 'true') {
        $showinfo = '1';
    } else {
        $showinfo = '0';
    }
    if ($showsearch === 'true') {
        $showsearch = '1';
    } else {
        $showsearch = '0';
    }


    if (!empty($clip_id)) {
        
        return "<div class='video_frame'><iframe class='youtube' style='height:{$height}px;width:{$width}px' src='http://www.youtube.com/embed/{$clip_id}?autohide={$autohide}&amp;autoplay={$autoplay}&amp;controls={$controls}&amp;disablekb={$disablekb}&amp;fs={$fs}&amp;hd={$hd}&amp;loop={$loop}&amp;rel={$rel}&amp;showinfo={$showinfo}&amp;showsearch={$showsearch}&amp;wmode=transparent' width='{$width}' height='{$height}' frameborder='0'></iframe></div>";
    }
}

add_shortcode('flickr', 'jawtheme_flickr');
function jawtheme_flickr($atts, $content = null) {
    extract(shortcode_atts(array(
                'id' => '',
                'count' => '3',
                'display' => 'latest', //random,latest
                'type' => 'user', //user,group
                    ), $atts));

                   ob_start(); ?>
                <div class="flickr_wrap">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $count; ?>&amp;display=<?php echo $display; ?>&amp;size=s&amp;layout=x&amp;source=<?php echo $type;?>&amp;<?php echo $type;?>=<?php echo $flickr_id; ?>"></script>
		</div>
		<div class="clearboth"></div>
                <?php return ob_get_clean();
              
    
}



function jawtheme_video_html5($atts) {
   
    extract(shortcode_atts(array(
                'src' => '',
                'width' => false,
                'height' => false,
                    ), $atts));

    if ($height && !$width)
        $width = intval($height * 16 / 9);
    if (!$height && $width)
        $height = intval($width * 9 / 16);
    if (!$height && !$width) {
        $height = 600;
        $width = 800;
    }
    $uri = THEME_URI;
    if (!empty($src)) {
        return '
        <div class="video_frame">
            <video width="'.$width.'" height="'.$height.'" src="'.$src.'" controls>
                Your browser does not support the video tag.
            </video> 
        </div>';
    }
}

