<?php
$sliderSlides = $slides;

echo ('<div id="slider_home" class="' . $direction . '">');
   
$output = '';

if (sizeof($sliderSlides) >= 3) {
    ?>
    <!-- SLIDER AREA -->
    <div class="slider_area" speed="<?php echo jwOpt::get_option('slider_speed', '3500') ?>" >

        <div class="top_arrow">
            <div class="arrow_top">

            </div>
        </div>

        <div class="bottom_arrow">
            <div class="arrow_bottom">

            </div>
        </div>

        <ul class="slider_list">
            <?php
            foreach ($sliderSlides as $oneSlide) {
                $oneSlideText = '';
                $oneSlideText .= '<li>';
                $oneSlideText .= '<div class="image_holder">';
                if(!isset($oneSlide->target)){
                    $oneSlide->target = '_self';
                }
                $oneSlideText .= '<a href="' . $oneSlide->link . '" target="'.$oneSlide->target.'">' . $oneSlide->img_big . '</a>';
                $oneSlideText .= '</div>';
                $oneSlideText .= '<div class="text_holder">';
                $oneSlideText .= '<h2><a href="' . $oneSlide->link . '" target="'.$oneSlide->target.'">' . jwUtils::crop_length($oneSlide->title,(int) jwOpt::get_option('slider_excerpt_title','50')) . '</a></h2>';
                
                if($oneSlide->position == 'shop' && jwUtils::woocommerce_activate() == true){
                    $oneSlideText .= '<div class="slider_price"> ';
                    $oneSlideText .= '<h4>'. $oneSlide->price .'</h4>';
                    $oneSlideText .= '</div>';
                }
                
                $oneSlideText .= '<p>' . jwUtils::crop_length($oneSlide->content, (int) jwOpt::get_option('slider_excerpt', '50')) . '</p>';
                $oneSlideText .= '</div>';
                $oneSlideText .='</li>';

                $output = $oneSlideText . $output;
                
            }

            echo $output;
            ?>
        </ul>	
    </div>

    <!-- NAVIGATION AREA -->
    <div class="navigation_area">
        <ul class="slides_list">
            <?php
            $sliderSlides = $slides;
            unset($sliderSlides[0]);
            $sliderSlides[] = $slides[0];
            foreach ($sliderSlides as $oneSlide) {

                if ($oneSlide->bgColor != 'custom') {
                    echo '<li class="' . $oneSlide->bgColor . '">';
                } else {
                    echo '<li class="' . $oneSlide->bgColor . '" style="background-color:' . $oneSlide->bgCustomColor . '; color:' . $oneSlide->bgCustomTextColor . '" >';
                }
                echo '<div class="image_holder">';


                echo '<a href="' . $oneSlide->link . '" target="'.$oneSlide->target.'">' . $oneSlide->img_small . '</a>';
                echo '</div>';
                echo '<div class="text_holder">';
                echo '<h3><a href="' . $oneSlide->link . '" target="'.$oneSlide->target.'">' . jwUtils::crop_length($oneSlide->title, 50) . '</a></h3>';
                //echo $oneSlide->content;
                echo '</div>';
                echo '</li>';
            }
            ?>		
        </ul>
    </div>
    <div class="clear"></div>

    <?php
} else {

    ?>

    slider  >>>   <b>Too few posts!</b> (required minimum are 3) (the featured image may be missing)
    <div class="clear"></div>  
    <?php
}
?>
</div>


