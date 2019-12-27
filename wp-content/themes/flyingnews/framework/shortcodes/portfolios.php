<?php





add_shortcode('portfolio', 'jawtheme_shortcode_portfolio');

function jawtheme_shortcode_portfolio($atts, $content = null, $code) {
    global $wp_query; 

    $opts = shortcode_atts(array(
        'cat' => '',
        'height' => '',
        'title' => 'true',
        'titlelink' => 'true',
        'desc' => 'false',
        'maxlen' => -1,
        'filter' => 'false',
        'group' => 'true',
        'lightbox' => 'true',
        'lightboxtitle' => 'title', //title,desc,none
        'order' => 'ASC',
        'orderby' => 'menu_order', //none, id, author, title, date, modified, parent, rand, comment_count, menu_order
        'post_on_page' => '1000',
        'pagination' => 'number' 
        
            ), $atts);

    extract($opts);
    $column = 3;

    // v pripade, ze se nekdy bude pouzivat layout >> pomer mb a sd muze byt ruzny je treba tohle prepsat, 
    // tak aby se presne vedela sirka a mohlo se nastavit optimalni sirka obrazku
    $image_height = $height;
    $col_style = 'one_col';
    $image_width = 308;
            


    $output = '<div class="portfolio">'; // start output
    $paged = ((get_query_var('paged')) ? get_query_var('paged') : 1);
    $query = array(
        'post_type' => 'portfolio',
        'paged' => $paged,
        'posts_per_page' => (int) $post_on_page, 
        'orderby' => $orderby,
        'order' => $order
    );

    
    $size = array();
    
    if ($group == 'false'){
      $rel_group = '';
    }else{
      $rel_group = '[portfolio_' . get_the_ID().']'; //uniq id for lightbox group
    }

    if ($cat != '') {
        global $wp_version;
        
        if (version_compare($wp_version, "3.1", '>=')) {
            $query['tax_query'] = array(
                array(
                    'taxonomy' => 'portfolio-category',
                    'field' => 'slug',
                    'terms' => explode(',', strtolower($cat))
                )
            );
        } else {
            $query['taxonomy'] = 'portfolio-category';
            $query['term'] = strtolower($cat);
        }
    }

    $original_query = $wp_query;
    $wp_query = null;
    wp_reset_query();

    $wp_query = new WP_Query($query);

    
    //*************BAR***********
    //Terms to bar
    $potfolio_terms = array();
    foreach((array) $wp_query->posts as $potfolio_post){
        $potfolio_term = get_the_terms($potfolio_post->ID, 'portfolio-category');
        foreach($potfolio_term as $pf){
         $potfolio_terms[] = $pf->term_id;   
        }
    }
     $args = array(
	'type'                     => 'portfolio',
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'taxonomy'                 => 'portfolio-category',
        'include'                  => implode(',', $potfolio_terms)
        );
    
     //render bar
    if($filter == 'true'){
        $output .= "<div class='portfolio_categories'>";
            $categories_list = get_categories($args);

            $output .= "<div class='portfolio_categories_item'>";
            $output .= __('Filter:','jawtemplates');
            $output .= "</div>";
            $output .= "<div class='portfolio_categories_item'>";
            $output .= "<a href ='#' data-filter='*'>".__('All','jawtemplates')."</a>";
            $output .= "</div>";
            foreach($categories_list as $cl){ 

                $output .= "<div class='portfolio_categories_item'>";
                $output .= "<a href ='#' data-filter='.".$cl->slug."'>".$cl->name."</a>";
                $output .= "</div>";
            }   
        $output .= "</div>";
    }
    $output .= '<div class="clear"></div>';
    
    
    
    
    
    //*********CONTENT****************   
    $i = 1;



    $p = 0;
    $output .= '<div class="portfolio-rows">';
    $output .= '<div id="elements_iso">';


    
    while ($wp_query->have_posts() && $p < $wp_query->post_count) {

	$video_player = '';

        for ($i = 0; $i < $column; $i++) {
            $p++;
            if ($i == $column - 1)
                $row_end = 'row_end';
            else
                $row_end = '';
            if ($i == 0)
                $row_start = 'row_start';
            else
                $row_start = '';
          //  if ($column == 1)
               // $row_style = ''; // radek je roztazen do boku
            //else
             //   $row_style = 'style="width: ' . $image_width . 'px;"';

            if ($wp_query->have_posts()) {
                

                
                $wp_query->the_post();
                $terms = get_the_terms(get_the_id(), 'portfolio-category');
                $type = get_post_meta(get_the_id(), '_portfolio_type', true);
                $link = get_post_meta(get_the_ID(), '_portfolio_link', true); //overrrides
                $link_target = get_post_meta(get_the_ID(), '_portfolio_link_target', true);
                
                if(isset($link_target) && ($type == 'link' || $type == 'doc')){
                    switch($link_target){
                        case 0:$link_target = '_blank';
                            break;
                        case 1:$link_target = '_top';
                            break;
                        case 2:$link_target = '_parent';
                            break;
                        case 3:$link_target = '_self';
                            break;
                        
                    }
                }else{
                    $link_target = '';
                }
                $categories = '';
                
                
                foreach((array) $terms as $cat) { 
                    if($cat != null){
                         $categories .= $cat->slug.' ';     
                    } 
                }
              
                
                $output .='<article class="element '.$categories.'portfolio-item box ' . $col_style . ' ' . $row_start . ' ' . $row_end . '  ">';
                //$output .='<div class="portfolio-item box ' . $col_style . ' ' . $row_start . ' ' . $row_end . '  " ' . $row_style . '>';

                if ($link)
                    $more_link = $link;
                else
                    $more_link = get_permalink();
               
                $image = array();
                $image_src = array();
                $image_src[0] = null;
                $image[0] = null;
                
                if (has_post_thumbnail()) {
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'post-size');
                    $image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'large');
                    
                } else {

                }
                
                $width = '';
                $height = '';
                $img = '';
                $href = '';
                switch ($type) {
                    case 'image' :
                        $icon = 'zoom';
                        $light = ' lightbox';
                        $href = $image_src[0];
                        $img = $image[0];
                        if ($lightbox == 'true') {
                            $rel = ' rel="prettyPhoto'.$rel_group.'"';
                        } else {
                            $rel = '';
                        }
                        break;
                    case 'video' :
                        $video_src = get_post_meta(get_the_id(), '_portfolio_video_link', true);

                        $video = jwUtils::get_video_info($video_src);
                      
                        if(has_post_thumbnail()){
                            //featured image
                           $img_src = $image[0];
                        }else if(isset($video->thumbnails['thumbnail_medium'])){
                            //obrázek videa
                           $img_src = $video->thumbnails['thumbnail_medium'];                     
                        }else{
                            
                            //dávej defaultní obrázek
                        }

                        $href = $video_src; 
                        $img = $img_src;
                        $icon = 'play';
                        $light = ' lightbox';
                        if ($lightbox == 'true') {
                            $rel = ' rel="prettyPhoto'.$rel_group.'"';
                        } else {
                            $rel = '';
                        }
                        break;
                    case 'link' :
                        $icon = 'link';
                        $light = '';
                        $href = $more_link;
                        $img = $image[0];
                        $rel = '';
                        break;
                    default :
                        $href = $more_link;
                        $img = $image[0];
                        $icon = 'doc';
                        $light = '';
                        $rel = '';
                        break;
                }

                $text = getReadMore(get_the_content(), get_the_ID());
                $text = maxContentLen($text, $maxlen);

                switch ($lightboxtitle) {
                    case 'title':
                        $item_title = get_the_title();
                        break;
                    case 'desc':
                        $item_title = $text;
                        break;
                    case 'none':
                    default:
                        $item_title = '';
                }
        
                $output .= '<div class="portfolio-item-image">' . "\n";
                if ($image_height)
                    $height_style = 'height:' . $image_height . 'px';
                else
                    $height_style = '';
                
                $output .= '<div class="portfolio-item-frame " >' . "\n";
                $output .= '<a class="' . $light . '" ' . (isset($link_target) ? 'target="' . $link_target . '" ' : '') . ' alt="gallery" title="' . htmlspecialchars(strip_tags(($item_title), '')) . ' - '.get_post(get_post_thumbnail_id())->post_excerpt.'" href="' . $href . '" ' . $rel . '>'; 
                   
                $output .= '<img src="' . $img . '"   border="0" / >';                    
                $output .= '<span class="image_overlay portfolio-item-icon_' . $icon . '" ></span>';
                $output .= '</a>';
                $output .= '</div>';
                $output .= '</div>';

                if ($title == 'true' ) {
                    $output .= '<div class="portfolio-item-details ">';
                    $output .= '<div class="portfolio-item-separator"></div>';
                    if ($title == 'true') {
                        if ($titlelink == 'true') {
                            $output .= '<h2 class="portfolio-item-title"><a ' . (isset($link_target) ? 'target="' . $link_target . '" ' : '') . ' href="' . $more_link . '">' . get_the_title() . '</a></h2>';
                        } else {
                            $output .= '<h2 class="portfolio-item-title">' . get_the_title() . '</h2>';
                        }
                    }

                    if ($desc == 'true') {
                        $output .= '<div class="portfolio-item-desc">' .  do_shortcode(wpautop($text)) . '</div>';
                    }
             
                    $output .= '</div>'; //element end
                }
                //   $output .= '</div>'; //row-detail end  

                $output .= '</article>'; //row-item end
                
            }else {
                break; // game over, any posts
            }
        }
        $output .= '<div class="clear"></div>';
    }

    $output .= '</div>';
    $output .= '</div>';  
    $output .= jwRender::pagination($pagination);
    $output .= '</div>'; // <div class="portfolio"> end

    $wp_query = null;
    $wp_query = $original_query;
    wp_reset_postdata();

    return $output;
}

function getReadMore($content, $id) {
    $out = '';

    if ($content) {
        $pos = strpos($content, '<span id="more-' . $id . '"></span>');
        if ($pos)
            return mb_substr($content, 0, $pos, 'UTF-8');
        else
            return $content;
    }
    return $out;
}

function maxContentLen($content, $maxlen = '-1') {
    if (strlen($content) > $maxlen && $maxlen != '-1') {
        return mb_substr($content, 0, $maxlen, 'UTF-8').' ...';
    } else {
        return $content;
    }
}




?>
