jQuery(document).ready(function ($) {   
    var $doc = $(document);     

    /* Use this js doc for all application specific JS */

    /* TABS --------------------------------- */
    /* Remove if you don't need :) */
    
    $.fn.foundationTabs ? $doc.foundationTabs({callback : $.foundation.customForms.appendCustomMarkup}) : null;
    

    
   
    /* ALERT BOXES ------------ */
    $(".alert-box").delegate("a.close", "click", function(event) {
        event.preventDefault();
        $(this).closest(".alert-box").fadeOut(function(event){
            $(this).remove();
        });
    });

    /* PLACEHOLDER FOR FORMS ------------- */
    /* Remove this and jquery.placeholder.min.js if you don't need :) */
    $('input, textarea').placeholder();

    /* TOOLTIPS ------------ */
    $(this).tooltips();

    /* UNCOMMENT THE LINE YOU WANT BELOW IF YOU WANT IE6/7/8 SUPPORT AND ARE USING .block-grids */
    //  $('.block-grid.two-up>li:nth-child(2n+1)').css({clear: 'left'});
    //  $('.block-grid.three-up>li:nth-child(3n+1)').css({clear: 'left'});
    //  $('.block-grid.four-up>li:nth-child(4n+1)').css({clear: 'left'});
    //  $('.block-grid.five-up>li:nth-child(5n+1)').css({clear: 'left'});


    /* DROPDOWN NAV ------------- */

    var lockNavBar = false;
    /* Windows Phone, sadly, does not register touch events :( */
    if (Modernizr.touch || navigator.userAgent.match(/Windows Phone/i)) {
        $('.nav-bar a.flyout-toggle').on('click.fndtn touchstart.fndtn', function(e) {
            e.preventDefault();
            var flyout = $(this).siblings('.flyout').first();
            if (lockNavBar === false) {
                $('.nav-bar .flyout').not(flyout).slideUp(500);
                flyout.slideToggle(500, function(){
                    lockNavBar = false;
                });
            }
            lockNavBar = true;
        });
        $('.nav-bar>li.has-flyout').addClass('is-touch');
    } else {
        $('.nav-bar>li.has-flyout').hover(function() {
            $(this).children('.flyout').show();
        }, function() {
            $(this).children('.flyout').hide();
        });
    }

    /* DISABLED BUTTONS ------------- */
    /* Gives elements with a class of 'disabled' a return: false; */

    /* SPLIT BUTTONS/DROPDOWNS */
    $('.button.dropdown > ul').addClass('no-hover');

    $('.button.dropdown').on('click.fndtn touchstart.fndtn', function (e) {
        e.stopPropagation();
    });
    $('.button.dropdown.split span').on('click.fndtn touchstart.fndtn', function (e) {
        e.preventDefault();
        $('.button.dropdown').not($(this).parent()).children('ul').removeClass('show-dropdown');
        $(this).siblings('ul').toggleClass('show-dropdown');
    });
    $('.button.dropdown').not('.split').on('click.fndtn touchstart.fndtn', function (e) {
        e.preventDefault();
        $('.button.dropdown').not(this).children('ul').removeClass('show-dropdown');
        $(this).children('ul').toggleClass('show-dropdown');
    });
    $('body, html').on('click.fndtn touchstart.fndtn', function () {
        $('.button.dropdown ul').removeClass('show-dropdown');
    });

    // Positioning the Flyout List
    var normalButtonHeight  = $('.button.dropdown:not(.large):not(.small):not(.tiny)').outerHeight() - 1,
    largeButtonHeight   = $('.button.large.dropdown').outerHeight() - 1,
    smallButtonHeight   = $('.button.small.dropdown').outerHeight() - 1,
    tinyButtonHeight    = $('.button.tiny.dropdown').outerHeight() - 1;

    $('.button.dropdown:not(.large):not(.small):not(.tiny) > ul').css('top', normalButtonHeight);
    $('.button.dropdown.large > ul').css('top', largeButtonHeight);
    $('.button.dropdown.small > ul').css('top', smallButtonHeight);
    $('.button.dropdown.tiny > ul').css('top', tinyButtonHeight);
  
  
    /* ISOTOPE*/


              
              
    var $container = $('#elements');

    if ($container.width() < 500 ) {
        $colnum = 2;
    } else {
        $colnum = 3;
    }
    
    
  
    
    $container.isotope({
        itemSelector: '.element',
        animationEngine : 'best-available',
        resizable: true,
        layoutMode : 'masonry'
 
    });
   
   
    jQuery(window).resize(function () {
        /* Find out container size and do columns accordingly */
        if ($container.width() < 500 ) {
            $colnum = 2;
        } else {
            $colnum = 2;
        }

        /* Resize Isotope Container */
        $container.isotope({
            // update columnWidth to a percentage of container width
            itemSelector : '.element',
            layoutMode : 'masonry'
           
        });
      
    });
    
    /* ShortCodes *************************************************************/
    
    // TopBar
    $(document).foundationTopBar()
    
    // ShortCode Accordion;
    $(document).foundationAccordion();
    
    // ShortCode Toggle
    $(document).toggleChange();
    
    // ShortCode Divider Back to Top
    $('.divider_to_top').click(function() {		
        $('body,html').animate({
            scrollTop:0
        }, 300);
        return false;
    });
    
    /* ShortCodes *************************************************************/
    
    
    /* Menu ***************************************************************** */
    
    $('.top-bar-jw li.has-dropdown').hover(function() {
       if ( $(this).find('.menu-info').length > 0 ) {
            w = 0;
            $(this).find('.sub-menu').find('li').each(function() {
                if ( w < parseInt($(this).outerWidth(true)) ) {
                    w = parseInt($(this).outerWidth(true));
                }
            });
            $(this).find('.menu-box').css({width:$(this).find('.menu-info').outerWidth(true) + w + 1 + 'px'});
        }
        
        if ($(this).position().left > 480) {
            $(this).css({
                width:$(this).css('width')
            });
            liWidth = ($(this).outerWidth());
            left = "-" + ($(this).find('.dropdown').outerWidth() + 1 - liWidth) + "px";
            $(this).find('.dropdown').css({
                left:left
            });
        }
    }, function() {
        
    });

    /* Menu ***************************************************************** */    
    
    
    
    
    //GALLERY****************************************************************
    $('#content').delegate('.orbit-wrapper','hover',function(e){
   
        if(e.type=='mouseenter')
        {
            $(this).find('.right').stop().fadeIn(500);
            $(this).find('.left').stop().fadeIn(500);
        }else{ 
            $(this).find('.right').stop().fadeOut(200);
            $(this).find('.left').stop().fadeOut(200);
        } 
      });

      

    //PORTFOLIO**************************************************************
    $('.portfolio-item-image').hover(function(){   
        $(this).find('.image_overlay').stop();
        $(this).find('.image_overlay').animate({
            opacity: 0.8
        } );

    },function(){
        $(this).find('.image_overlay').stop();
        $(this).find('.image_overlay').animate({
            opacity: 0
        }, 400 );
   
    });
   
    //ISOtope - filtrování portfolii-------------------------------------------
    // initialize isotope
    //$('#elements').isotope({
    // options...
    //  });

    // filter items when filter link is clicked
    $('.blog-items-sortby-list a, .portfolio_categories_item a').click(function(){
        var selector = $(this).attr('data-filter');
        $('#elements_iso').isotope({
            filter: selector
        });      
        return false;
    });
    
    

    // Řazení postů na hlavní straně ******************************************
      
      
      if(rtl == '1'  || $.cookie("rtl_support") == '1'){
        $.Isotope.prototype._positionAbs = function( x, y ) {
                return { right: x, top: y };
              };     
      }
      
              
              
    var $container = $('#elements_iso');
    var sortAscending = false;
    var sortName = 'date';
    
    
    //Když je IE 8 nebo (RTL /$.cookie("rtl_support")- pro demo panel)  

      if($.browser.msie == true  && parseInt($.browser.version, 10) === 8  && $.cookie("rtl_support") != '1'){
          var transformsEnabled = false;
          var animationEngine = 'css';
      }else if(rtl == '1' || $.cookie("rtl_support") == '1'){
          var transformsEnabled = false;  
          var animationEngine = 'best-available';
      }else{
          var transformsEnabled = true;  
          var animationEngine = 'best-available';
      }

    $container.isotope({
        animationEngine: animationEngine,
        transformsEnabled: transformsEnabled,
        itemSelector : '.element',
        getSortData : {
            name : function ( $elem ) { 
                return $elem.attr('sort_name');
            },
            date : function ( $elem ) {
                return $elem.attr('sort_date');
            },
            rating : function ( $elem ) {
                return parseFloat( $elem.attr('sort_rating') );
            },
            popular : function ( $elem ) {
                return parseFloat( $elem.attr('sort_popular') );
            },
            price : function ( $elem ) {
                return parseFloat( $elem.attr('sort_price') );
            },
            sales : function ( $elem ) {
                return parseFloat( $elem.attr('sort_sales') );
            },
            category : function ( $elem ) {
                 return $elem.attr('sort_category');
            },
            custom1 : function ( $elem ) {
                 return parseFloat($elem.attr('sort_custom1'));
            },
            custom2 : function ( $elem ) {
                 return parseFloat($elem.attr('sort_custom2'));
            }
        }
    });
    
    $('.blog-items-sortby-list a').click(function(){

         sortName = $(this).attr('href').slice(1);
         
        if(sortName == 'name' || sortName == 'price' || sortName == 'category' ){
            sortAscending = true;
        }else{
            sortAscending = false; 
        }
        
        $container.isotope({
                sortBy : sortName,   
                sortAscending : sortAscending
        }); 
            
            
        return false;
    });
    
    
   
    
    
      // ========= INFINITY LIST ===========================================
      var count_page = 0;
      var num_page_on_page = 2; // <<--- Nuber of ajax section on page
      if(typeof infinite_scroll != 'undefined'){         
   
         
         
           $( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll ,   function( newElements ) {
           $container.isotope( "appended", $( newElements ) ); //>>>>> Speed gallery slider (on the main page) for next pages in infinite list<<<<<
           $(newElements).find("#featured_gellery").orbit({animation: 'fade',animationSpeed: 800,pauseOnHover: true,startClockOnMouseOut: true,        
                            startClockOnMouseOutAfter: 100,directionalNav: true,fluid: true,timer: true,resetTimerOnClick: false,  advanceSpeed:Math.round(Math.random()*4000)+1000 } );
           $('.morebutton').slideDown();        
           if(type == 'ajax'){
            count_page++;
            if(count_page >= (num_page_on_page-1)){
                 $( infinite_scroll.contentSelector ).infinitescroll({state:{isDone: true}});

                  $( "#infinite_load" ).append( window.next_page );
                  $( "#infinite_load" ).append( $('#post-nav-infinite .post-next-infinite').html() );

            }
           }  
           jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools: false, default_width: 800, default_height: 500 , show_title: false});
           
        });  
        if(type == 'infinitemore'){
            $('#post-nav-infinite').hide();
            $( "#infinite_load" ).append( more );
            $(infinite_scroll.contentSelector).infinitescroll('pause');

            $('.morebutton').click(function(){
               $(infinite_scroll.contentSelector).infinitescroll('retrieve');
                $('.morebutton').slideUp();
             });
            }else if(type == 'infinite'){
                $('#post-nav-infinite').hide();
            }
        
      } 

    /*************************************************************************** 
     * BANNERS - Skyscrapper 
     * ************************************************************************/
    $('.skyscrapper').css({
        top:$('#header').height()+"px"
    });    
    
    /***************************************************************************
    * TO TOP 
    ***************************************************************************/
    $(window).scroll(function(){                 
        offset = $(window).scrollTop();
        
        if (offset >= 50 && wWidth > 959) {
            $('#totop').show(250);
        } else {
            $('#totop').hide(250);
        }
        
        if ( offset > $('#header').height() ) {
            $("#skyscrapper-left").css({
                "top":offset+3+"px"
            });
            $("#skyscrapper-right").css({
                "top":offset+3+"px"
            });
        } else {
            $("#skyscrapper-left").css({
                "top":$('#header').height()+3+"px"
            });
            $("#skyscrapper-right").css({
                "top":$('#header').height()+3+"px"
            });
        }
        
    });
    
    $('#totop').hover(function() {
        $(this).animate({'opacity':'1'},150);
    }, function(){
        $(this).animate({'opacity':'0.8'},150);
    });
    
    $('#totop').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 350);
    });
    
    /***************************************************************************
    * SEARCH BOX
    ***************************************************************************/  
   $('#search_button').click(function() {
       if ($(window).width() > 767) {
            var parent = $(this).parent().find('#s');
            var right = parent.innerWidth();      
            if ( right > 1 ) {
                parent.stop().animate({'width': "0px","paddingLeft":"0px","paddingRight":"0px","marginRight":"-5px"},300,function(){$('.blog-items-search').css({'width':'0px'});});
            } else {
                 parent.css({"marginRight":"6px"});
                 parent.stop().animate({'width': "180px","paddingLeft":"6px","paddingRight":"6px"},250,function(){$('.blog-items-search').css({'width':'auto'});});
                 parent.find("#s").focus();
            }
       }
   });
   /****************************************************************************
    * END SEARCH BOX
    ***************************************************************************/
   
   /**************************************************************************** 
    * CAPTION FADE EFFECT 
    * *************************************************************************/
   $('#elements_iso').delegate('.box','hover',function(e){
        if(e.type=='mouseenter')
        {
            $(this).find('.caption_fadeeffect').stop().fadeIn(500);
        }
        else
        {
            $(this).find('.caption_fadeeffect').stop().fadeOut(200);
        }
    });
   /* CAPTION FADE EFFECT *****************************************************/
   
   /* SELECT BOX MENU */
    $( ".mobile-selectbox" ).change(
        function() {
            window.location = $(this).find("option:selected").val();
        }
    );
        
    /* FIX BACKGROUND SIZE ****************************************************/
    $(window).resize(function() {
        w = $(window).width();
        $('.template-back-image img').css({width:w+"px"});
    });

    /* ADD LAST CHILD CLASS IF IE 8 *******************************************/
    if( $("html").hasClass("ie8") ) {
        $('*:last-child').addClass('last-child');
        $('#sidebar #searchform #searchsubmit').val(' ');
    }

    /* PLACE HOLDER FOR TEXTAREA **********************************************/
    var standard_message = $('textarea').val();
    $('textarea').focus(
        function() {
            if ($(this).val() == standard_message)
                $(this).val("");
        }
    );
    $('textarea').blur(
        function() {
            if ($(this).val() == "")
                $(this).val(standard_message);
        }
    );
        
    /* ACTIVE CONTACT FORM BUTTON */
    $(".contact_submit, .user-submit").hover(function(){
       $(this).parent().parent().addClass('active'); 
    }, function() {
        $(this).parent().parent().removeClass('active'); 
    });
    $('#commentform .form-submit #submit').hover(function(){
       $(this).parent().addClass('active'); 
    }, function() {
        $(this).parent().removeClass('active'); 
    });
    $('#commentform .form-submit').append('<div class="contact_form_arrow"></div>');
    
    

    /* CONTACT FORM SUBMIT ****************************************************/
    $('.jw_contact_form').submit(function() {
        name = $(this).find('.jw_contact_name').val();
        email = $(this).find('.jw_contact_email').val();
        mess = $(this).find('.jw_contact_message').val();
        mess = $(this).find('.jw_contact_message').val();
        answer = $(this).find('.jw_contact_capcha_answer').val();
        
        error = '';
        
        if ( name.length <= 0 ) {
            $(this).find('.jw_contact_name').addClass('required');
            error += '<li>' + $(this).find('.short_contact_error_name').val() + '</li>';
        } else {
            $(this).find('.jw_contact_name').removeClass('required');
        }
        
        if ( email.length <= 0  || validateEmail(email) == false ) {
            $(this).find('.jw_contact_email').addClass('required');
            error += '<li>' + $(this).find('.short_contact_error_email').val() + '</li>';
        } else {
            $(this).find('.jw_contact_email').removeClass('required');
        }
        
        if ( mess.length <= 0 || mess === 'Message' ) {
            $(this).find('.jw_contact_message').addClass('required');
            error += '<li>' + $(this).find('.short_contact_error_message').val() + '</li>';
        } else {
            $(this).find('.jw_contact_message').removeClass('required');
        }
        
        if ( answer.length <= 0 ) {
            $(this).find('.jw_contact_capcha_answer').addClass('required');
            error += '<li>' + $(this).find('.short_contact_error_capcha').val() + '</li>';
        } else {
            $(this).find('.jw_contact_capcha_answer').removeClass('required');
        }
        
        if ( error.length > 0 ) {
            $(this).find('.jw_contact_error').empty();
            $(this).find('.jw_contact_error').append('<ol>' + error + '</ol>');
            $(this).find('.jw_contact_error').addClass('active_log');         
        } else {
            return true;
        }        
        return false;
    });

    /* SLIDER *****************************************************************/
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
	

    function validateEmail($email) {var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;if( !emailReg.test( $email ) ) {return false;} else {return true;}}
    
    
    /* STARS RATING *******************************************************/
        $('.ratig-background-stars').mousemove(function(e) {            
            $jw_rating_id = $(this).find(".jw_rating_id").val(); 
            $jw_rating_post_id = $(this).find(".jw_rating_post_id").val();
            cookieName = "jw_user_rating_"+$jw_rating_post_id+"_"+$jw_rating_id;

            if ($.cookie(cookieName) == 1) {
                $(this).find(".rating-top-stars").removeClass("user_editable");
            }
            
            if ($(this).find('.rating-top-stars').hasClass("user_editable")) {
                
                $('.jw-rating-userrating-name').text( $('.jw-rating-userrating-name').attr('data-rel')+':');
                
                userRating = (e.pageX - $(this).offset().left);
                if (userRating > 100) {
                    userRating = 100;
                }
            if ($('body').hasClass('rtl'))
                    userRating = 100-userRating;
                
                //$('#rating-top-stars').css({width:Math.round(userRating)+"px"});
                switch (true) {
                    case (userRating < 9 ):
                        $(this).find('.rating-top-stars').css({width:"0px"});
                        $('.jw-rating-userrating-score').text(0);
                        $(this).find('.jw_rating_user_value').val(0);
                        break;   
                    case (userRating >= 9 && userRating < 20):
                        $(this).find('.rating-top-stars').css({width:"9px"});
                        $('.jw-rating-userrating-score').text(0.5);
                        $(this).find('.jw_rating_user_value').val(0.1);
                        break;
                    case (userRating >= 20 && userRating < 29):
                        $(this).find('.rating-top-stars').css({width:"20px"});
                        $('.jw-rating-userrating-score').text(1);
                        $(this).find('.jw_rating_user_value').val(0.2);
                        break;
                    case (userRating >= 29 && userRating < 40):
                        $(this).find('.rating-top-stars').css({width:"29px"});
                        $('.jw-rating-userrating-score').text(1.5);
                        $(this).find('.jw_rating_user_value').val(0.3);
                        break;
                    case (userRating >= 40 && userRating < 49):
                        $(this).find('.rating-top-stars').css({width:"40px"});
                        $('.jw-rating-userrating-score').text(2);
                        $(this).find('.jw_rating_user_value').val(0.4);
                        break;
                    case (userRating >= 49 && userRating < 60):
                        $(this).find('.rating-top-stars').css({width:"49px"});
                        $('.jw-rating-userrating-score').text(2.5);
                        $(this).find('.jw_rating_user_value').val(0.5);
                        break;
                    case (userRating >= 60 && userRating < 69):
                        $(this).find('.rating-top-stars').css({width:"60px"});
                        $('.jw-rating-userrating-score').text(3);
                        $(this).find('.jw_rating_user_value').val(0.6);
                        break;
                    case (userRating >= 69 && userRating < 80):
                        $(this).find('.rating-top-stars').css({width:"69px"});
                        $('.jw-rating-userrating-score').text(3.5);
                        $(this).find('.jw_rating_user_value').val(0.7);
                        break;
                    case (userRating >= 80 && userRating < 89):
                        $(this).find('.rating-top-stars').css({width:"80px"});
                        $('.jw-rating-userrating-score').text(4);
                        $(this).find('.jw_rating_user_value').val(0.8);
                        break;
                    case (userRating >= 89 && userRating < 100):
                        $(this).find('.rating-top-stars').css({width:"89px"});
                        $('.jw-rating-userrating-score').text(4.5);
                        $(this).find('.jw_rating_user_value').val(0.9);
                        break;    
                    case (userRating >= 100 ):
                        $(this).find('.rating-top-stars').css({width:"100px"});
                        $('.jw-rating-userrating-score').text(5);
                        $(this).find('.jw_rating_user_value').val(1);
                        break;     
                }           
            }
        });
        
        $('.jw-rating-area-percent-user-rating').find('.ratig-background-stars').mouseleave(function() {
            ratingScore = Math.round($(this).find(".jw_rating_value").val()*100);
            $(this).find('.rating-top-stars').css({width:ratingScore+"px"});
            $('.jw-rating-userrating-name').text($(this).find(".jw_rating_name").val()+":");            
            
            if ($(this).find('.rating-top-stars').hasClass("user_editable")) {
                $('.jw-rating-userrating-score').text((Math.round(ratingScore)/100*5).toFixed(1));
            }
        });
        
        $('.ratig-background-stars').click(function(){
            var ratingBg        = $(this);
            jw_rating_id        = ratingBg.find(".jw_rating_id").val(); 
            jw_rating_post_id   = ratingBg.find(".jw_rating_post_id").val();
            var cookieName          = "jw_user_rating_"+jw_rating_post_id+"_"+jw_rating_id;
            if (ratingBg.find('.rating-top-stars').hasClass("user_editable")) {
                var data = {
                    postId:ratingBg.find(".jw_rating_post_id").val(),
                    ratingId:ratingBg.find(".jw_rating_id").val(),
                    score:ratingBg.find(".jw_rating_user_value").val()
                }
                $.post(
                site_url+'/wp-admin/admin-ajax.php',
                {
                    'action':'jwrating_vote',   // nebo jwrating_get
                    'data':data
                },
                function(response){                    
                    var resp = jQuery.parseJSON(response);
                    ratingBg.find(".jw_rating_value").val(resp.score);
                   var label = $('.jw-rating-userrating-votes').attr('data-rel');
                    $('.jw-rating-userrating-votes').text("("+resp.voted+": "+label+")");
                    $('.jw-rating-userrating-score').text(Math.round((resp.score*100)/2)/10);
                   
                    ratingBg.find('.rating-top-stars').css({width:Math.round(resp.score*100)+"px"});                    
                    ratingBg.find('.rating-top-stars').removeClass('user_editable');
                    $.cookie(cookieName, 1, {
                        expires: 1, 
                        path: '/'
                    });
                });
            }
        });
        /* END STARS RATING ***************************************************/
        
        /* PERCENT RATING *****************************************************/        
        $('.ratig-background-percent').mousemove(function(e) {            
            jw_rating_id        = $(this).find(".jw_rating_id").val(); 
            jw_rating_post_id   = $(this).find(".jw_rating_post_id").val();
            cookieName          = "jw_user_rating_"+jw_rating_post_id+"_"+jw_rating_id;

            if ($.cookie(cookieName) == 1) {
                $(this).find(".rating-top-percent").removeClass("user_editable");
            }
            
            if ($(this).find('.rating-top-percent').hasClass("user_editable")) {
                
                $('.jw-rating-userrating-name').text( $('.jw-rating-userrating-name').attr('data-rel')+':');
                
                userRating = e.pageX - $(this).offset().left;
                if (userRating > 99.5) {
                    userRating = 100;
                } else if (userRating < 1) {
                    userRating = 0;
                }

                $(this).find('.rating-top-percent').css({width:Math.round(userRating)+"px"});
                $(this).find('.rating-top-percent-value').text(Math.round(userRating) + " %");
                $('.jw-rating-userrating-score').text(Math.round(userRating) + " %");            
            }
        });
        
        $('.jw-rating-area-percent-user-rating').find('.ratig-background-percent').mouseleave(function() {
            ratingScore = Math.round($(this).find(".jw_rating_value").val()*100);
            //alert(ratingScore);
            $(this).find('.rating-top-percent').css({width:ratingScore+"px"});
            $('.jw-rating-userrating-name').text($(this).find(".jw_rating_name").val()+":");            

            if ($(this).find('.rating-top-percent').hasClass("user_editable")) {
                $('.rating-top-percent-user-value, .jw-rating-userrating-score').text(ratingScore + " %");
            }
        });
        
        $('.ratig-background-percent').click(function(){
            
            var ratingBg        = $(this);
            jw_rating_id        = ratingBg.find(".jw_rating_id").val(); 
            jw_rating_post_id   = ratingBg.find(".jw_rating_post_id").val();
            var cookieName      = "jw_user_rating_"+jw_rating_post_id+"_"+jw_rating_id;
            
            if (ratingBg.find('.rating-top-percent').hasClass("user_editable")) {
                var data = {
                    postId:ratingBg.find(".jw_rating_post_id").val(),
                    ratingId:ratingBg.find(".jw_rating_id").val(),
                    score:(userRating/100)
                }
                $.post(
                site_url+'/wp-admin/admin-ajax.php',
                {
                    'action':'jwrating_vote',   // nebo jwrating_get
                    'data':data
                },
                function(response){                    
                    var resp = jQuery.parseJSON(response);
                    ratingBg.find(".jw_rating_value").val(resp.score);
                    $('.rating-top-percent-user-value, .jw-rating-userrating-score').text(Math.round(Math.round(resp.score*100)) + " %");
                    var label = $('.jw-rating-userrating-votes').attr('data-rel');
                    $('.jw-rating-userrating-votes').text("("+resp.voted+": "+label+")");
           
                    ratingBg.find('.rating-top-percent').css({width:Math.round(resp.score*100)+"px"});
                    ratingBg.find('.rating-top-percent').removeClass('user_editable');
                    $.cookie(cookieName, 1, {
                        expires: 1, 
                        path: '/'
                    });
                });
            }
        });
        /* END PERCENT RATING *************************************************/
    
  
	
        
        
        var jaw_dropdown = document.getElementById("cat");
        
	function onCatChange() {
		if ( jaw_dropdown.options[jaw_dropdown.selectedIndex].value > 0 ) {
                    /// LOCATION dodelat!!,
                    //alert(site_url);
                    
			location.href = site_url+"/?cat="+jaw_dropdown.options[jaw_dropdown.selectedIndex].value;
		}
	}
        if(document.getElementById("cat") !== null && jaw_dropdown.length > 0){
            jaw_dropdown.onchange = onCatChange;
        }
});


