jQuery(document).ready(function($) {
    $slider = $('#slider_home');
    $arrowTop = $slider.find('.arrow_top');
    $arrowBottom = $slider.find('.arrow_bottom');
    $sliderArea = $slider.find('.slider_area');
    $sliderList = $sliderArea.find('.slider_list');
    $sliderSpeed = parseInt($sliderArea.attr('speed'));
    if(isNaN($sliderSpeed)){
        $sliderSpeed = 3500;
    }
    $navigationArea = $slider.find('.navigation_area');
    $navigationList = $navigationArea.find('.slides_list');
    var refreshId = setInterval(moveSlide,$sliderSpeed);
    
   /* Kontrola jestli jsem na Ipadu/iPhonu - nezastavuj na hover
    * var device = navigator.userAgent.toLowerCase();
    var ios = device.match(/(iphone|ipod|ipad)/);
  */

    
    $slider.hover(function(){
        clearInterval(refreshId);
    },function() {
        refreshId = setInterval(moveSlide,$sliderSpeed);
    });


    function moveSlide() {
        if($('#slider_home').attr('class') =="up"){
             moveSliderUp();
             moveNavigationDown();
        }else{
            moveSliderDown();
            moveNavigationUp();  
        }
       
    }      
	
    $arrowTop.click(function() { 
        if( $slider.data('data-animating') == 'true' ) {
            return;
        }		
        $slider.data('data-animating', 'true');
        moveSliderUp();
        moveNavigationDown();
    });
	
    $arrowBottom.click(function() {
        if( $slider.data('data-animating') == 'true' ) { 
            return; 
        }		
        $slider.data('data-animating', 'true');
        moveSliderDown();
        moveNavigationUp();
    })
        
	
	
    var moveSliderUp = function() {
        var step = $sliderList.children('li').outerHeight();
		
        $sliderList.animate({
            marginTop:-step
            },700, function() {
            $firstSlide = $sliderList.find('li').eq(0);
            $firstSlideClone = $firstSlide.clone();
            $sliderList.append( $firstSlideClone );
			
            $firstSlide.remove();
            $sliderList.css('margin-top', 0);
            $slider.data('data-animating', 'false');
        });
		
    };
	
    var moveSliderDown = function() {
        var step = $sliderList.children('li').outerHeight();
        $firstSlide = $sliderList.find('li').last();
        $firstSlideClone = $firstSlide.clone();
        $sliderList.prepend( $firstSlideClone );
		
        $firstSlide.remove();
        $sliderList.css('margin-top', -step);
		
        $sliderList.animate({
            marginTop:0
        },700, function() {
            $slider.data('data-animating', 'false');
        });
    };
	
    var moveNavigationUp = function() {
        var step = $navigationList.children('li').outerHeight();
		
        $navigationList.animate({
            marginTop:-step
            },700, function() {
            $firstSlide = $navigationList.find('li').first();
            $firstSlideClone = $firstSlide.clone();
            $navigationList.append( $firstSlideClone );
			
            $firstSlide.remove();
            $navigationList.css('margin-top',0);
        });
		
    };
	
    var moveNavigationDown = function() {
        var step = $navigationList.children('li').outerHeight();
        $firstSlide = $navigationList.find('li').last();
        $firstSlideClone = $firstSlide.clone();
        $navigationList.prepend( $firstSlideClone );
		
        $firstSlide.remove();
        $navigationList.css('margin-top', -step);
		
        $navigationList.animate({
            marginTop:0
        },700, function() {
			
            });
    };
	
});