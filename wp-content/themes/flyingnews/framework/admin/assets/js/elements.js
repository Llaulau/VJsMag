/**
 * SMOF js
 *
 * contains the core functionalities to be used
 * inside SMOF
 */

jQuery.noConflict();

/** Fire up jQuery - let's dance! 
 */
jQuery(window).ready(function($){
    
    //delays until AjaxUpload is finished loading
    //fixes bug in Safari and Mac Chrome
    if (typeof AjaxUpload != 'function') { 
        return ++counter < 6 && window.setTimeout(init, counter * 500);
    }
	
    
   
  


	
    //Update Message popup
    $.fn.center = function () {
        this.animate({
            "top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"
        },100);
        this.css("left", 250 );
        return this;
    }
	
			

    extendChange();
      //Masked Inputs (images as radio buttons)
    $('.radio-layout').click(function(){
        $(this).parent().find('.radio-layout').removeClass('of-radio-img-selected');
        $(this).addClass('of-radio-img-selected');
        extendChange('200');
    }); 
    
    
    // Template Check List
	function extendChange(time) {
	
       $('div.of-radio-img-selected').each(function() {
            var val= $(this).children().attr('val');
            var rel= $(this).children().attr('rel');
        
	 switch(val){
            case 'fullwidth':
                $('#section-'+rel+'_right').hide(time);
                $('#section-'+rel+'_left').hide(time);   
            break;
            case 'left':
                 $('#section-'+rel+'_right').hide(time);
                $('#section-'+rel+'_left').show(time);
            break;
            case 'right':
                $('#section-'+rel+'_right').show(time);
                 $('#section-'+rel+'_left').hide(time);
            break;
             case 'both':
                 $('#section-'+rel+'_right').show(time);
                 $('#section-'+rel+'_left').show(time);   
            break;
            default:
                $('#section-'+rel+'_right').hide(time);
                 $('#section-'+rel+'_left').hide(time); 
            break;
         }
            
            
        });
    
               
       
	}
    
    
    
    
   $('.of-radio-img-label').hide();
    $('.of-radio-img-img').show();
    $('.of-radio-img-radio').hide();
	
    //Masked Inputs (background images as radio buttons)
    $('.of-radio-tile-img').click(function(){
        $(this).parent().parent().find('.of-radio-tile-img').removeClass('of-radio-tile-selected');
        $(this).addClass('of-radio-tile-selected');
    });
    $('.of-radio-tile-label').hide();
    $('.of-radio-tile-img').show();
    $('.of-radio-tile-radio').hide();

    //AJAX Upload
    function of_image_upload() {
        $('.image_upload_button').each(function(){
			
            var clickedObject = $(this);
            var clickedID = $(this).attr('id');	
            var save = $('#security').attr('attr');
            var nonce = $('#security').val();
			
            new AjaxUpload(clickedID, {
                action: ajaxurl,
                name: clickedID, // File upload name
                data: { // Additional data to send
                    action: 'jw_ajax_post_action',
                    type: 'upload',
                    security: nonce,
                    data: clickedID,
                    nosave: save
                },
                autoSubmit: true, // Submit file after selection
                responseType: false,
                onChange: function(file, extension){},
                onSubmit: function(file, extension){
                    clickedObject.text('Uploading'); // change button text, when user selects file	
                    this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                    interval = window.setInterval(function(){
                        var text = clickedObject.text();
                        if (text.length < 13){
                            clickedObject.text(text + '.');
                        }
                        else {
                            clickedObject.text('Uploading');
                        } 
                    }, 200);
                },
                onComplete: function(file, response) {
                    window.clearInterval(interval);
                    clickedObject.text('Upload Image');	
                    this.enable(); // enable upload button
			
	
                    // If nonce fails
                    if(response==-1){
                        var fail_popup = $('#of-popup-fail');
                        fail_popup.fadeIn();
                        window.setTimeout(function(){
                            fail_popup.fadeOut();                        
                        }, 2000);
                    }				
					
                    // If there was an error
                    else if(response.search('Upload Error') > -1){
                        var buildReturn = '<span class="upload-error">' + response + '</span>';
                        $(".upload-error").remove();
                        clickedObject.parent().after(buildReturn);
				
                    }
                    else{
                        
                        var buildReturn = '<img class="hide of-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';

                        $(".upload-error").remove();
                        $("#image_" + clickedID).remove();	
                        clickedObject.parent().after(buildReturn);
                        $('img#image_'+clickedID).fadeIn();
                        clickedObject.next('span').fadeIn();
                        clickedObject.parent().prev('input').val(response);
                    }
                }
            });
			
        });
	
    }
	
    of_image_upload();
			
    //AJAX Remove Image (clear option value)
    $('.image_reset_button').live('click', function(){
	
        var clickedObject = $(this);
        var clickedID = $(this).attr('id');
        var theID = $(this).attr('title');	
				
        var nonce = $('#security').val();
	
        var data = {
            action: 'of_ajax_post_action',
            type: 'image_reset',
            security: nonce,
            data: theID
        };
					
        $.post(ajaxurl, data, function(response) {
						
            //check nonce
            if(response==-1){ //failed
							
                var fail_popup = $('#of-popup-fail');
                fail_popup.fadeIn();
                window.setTimeout(function(){
                    fail_popup.fadeOut();                        
                }, 2000);
            }
						
            else {
						
                var image_to_remove = $('#image_' + theID);
                var button_to_hide = $('#reset_' + theID);
                image_to_remove.fadeOut(500,function(){
                    $(this).remove();
                });
                button_to_hide.fadeOut();
                clickedObject.parent().prev('input').val('');
            }
						
						
        });
					
    }); 

    // Style Select
    (function ($) {
        styleSelect = {
            init: function () {
                $('.select_wrapper').each(function () {
                    $(this).prepend('<span>' + $(this).find('.select option:selected').text() + '</span>');
                });
                $('.select').live('change', function () {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                });
                $('.select').bind($.browser.msie ? 'click' : 'change', function(event) {
                    $(this).prev('span').replaceWith('<span>' + $(this).find('option:selected').text() + '</span>');
                }); 
            }
        };
        $(document).ready(function () {
            styleSelect.init()
        })
    })(jQuery);
	
	


    //Remove individual sidebr
    $('.sidebar_delete_button').live('click', function(){
	// event.preventDefault();
	var agree = confirm("Are you sure you wish to delete this sidebar?");
	if (agree) {
	    var $trash = $(this).parents('li');
	    //$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
	    $trash.animate({
		opacity: 0.25,
		height: 0
	    }, 300, function() {
		$(this).remove();
	    });
	    return false; //Prevent the browser jump to the link anchor
	} else {
	    return false;
	}	
    });
    
    
    
    
    /** Aquagraphite Slider MOD */
	
    //Hide (Collapse) the toggle containers on load
    $(".slide_body").hide(); 

    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
    $(".slider").delegate('.slide_edit_button', 'click', function(){
        $(this).parent().toggleClass("active").next().slideToggle("fast");
        return false; //Prevent the browser jump to the link anchor
    });	
	
    // Update slide title upon typing		
    function update_slider_title(e) {
        var element = e;
        if ( this.timer ) {
            clearTimeout( element.timer );
        }
        this.timer = setTimeout( function() {
            $(element).parent().prev().find('strong').text( element.value );
        }, 100);
        return true;
    }
	
    $('.of-slider-title').live('keyup', function(){
        update_slider_title(this);
    });
		
	
    //Remove individual slide
    $(".slider").delegate('.slide_delete_button','click', function(){
        // event.preventDefault();
        var agree = confirm("Are you sure you wish to delete this slide?");
        if (agree) {
            var $trash = $(this).parents('li');
            //$trash.slideUp('slow', function(){ $trash.remove(); }); //chrome + confirm bug made slideUp not working...
            $trash.animate({
                opacity: 0.25,
                height: 0
            }, 500, function() {
                $(this).remove();
            });
            return false; //Prevent the browser jump to the link anchor
        } else {
            return false;
        }	
    });
	
    //Add new slide
    $(".slide_add_button").on('click', function(){		
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#'+sliderId).attr('rel');
		
        var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
            var str = this.id; 
            str = str.replace(/\D/g,'');
            str = parseFloat(str);
            return str;			
        }).get();
		
        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1 ) {
            maxNum = 0
        };
        var newNum = maxNum + 1;
		
        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Image URL</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][url]" id="' + sliderId + '_' + newNum + '_slide_url" value=""><div class="upload_button_div"><span class="button media_upload_button" id="' + sliderId + '_' + newNum + '" rel="'+sliderInt+'">Upload</span><span class="button mlu_remove_button hide" id="reset_' + sliderId + '_' + newNum + '" title="' + sliderId + '_' + newNum + '">Remove</span></div><div class="screenshot"></div><label>Link URL (optional)</label><input class="slide of-input" name="' + sliderId + '[' + newNum + '][link]" id="' + sliderId + '_' + newNum + '_slide_link" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';
		
        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function() {
            $(this).removeClass('temphide');
        });
				
        of_image_upload(); // re-initialise upload image..
		
        return false; //prevent jumps, as always..
    });
    
    //Add new slide
    $(".tabs_add_button").on('click', function(){		
        var slidesContainer = $(this).prev();
        var sliderId = slidesContainer.attr('id');
        var sliderInt = $('#'+sliderId).attr('rel');
		
        var numArr = $('#'+sliderId +' li').find('.order').map(function() { 
            var str = this.id; 
            str = str.replace(/\D/g,'');
            str = parseFloat(str);
            return str;			
        }).get();
		
        var maxNum = Math.max.apply(Math, numArr);
        if (maxNum < 1 ) {
            maxNum = 0
        };
        var newNum = maxNum + 1;
		
        var newSlide = '<li class="temphide"><div class="slide_header"><strong>Slide ' + newNum + '</strong><input type="hidden" class="slide of-input order" name="' + sliderId + '[' + newNum + '][order]" id="' + sliderId + '_slide_order-' + newNum + '" value="' + newNum + '"><a class="slide_edit_button" href="#">Edit</a></div><div class="slide_body" style="display: none; "><label>Title</label><input class="slide of-input of-slider-title" name="' + sliderId + '[' + newNum + '][title]" id="' + sliderId + '_' + newNum + '_slide_title" value=""><label>Description (optional)</label><textarea class="slide of-input" name="' + sliderId + '[' + newNum + '][description]" id="' + sliderId + '_' + newNum + '_slide_description" cols="8" rows="8"></textarea><a class="slide_delete_button" href="#">Delete</a><div class="clear"></div></div></li>';
		
        slidesContainer.append(newSlide);
        $('.temphide').fadeIn('fast', function() {
            $(this).removeClass('temphide');
        });
				
        of_image_upload(); // re-initialise upload image..
		
        return false; //prevent jumps, as always..
    });	
	
    //Sort slides
    jQuery('.slider').find('ul').each( function() {
        var id = jQuery(this).attr('id');
        $('#'+ id).sortable({
            placeholder: "placeholder",
            opacity: 0.6
        });	
    });
	
	
    /**	Sorter (Layout Manager) */
    jQuery('.sorter').each( function() {
        var id = jQuery(this).attr('id');
        $('#'+ id).find('ul').sortable({
            items: 'li',
            placeholder: "placeholder",
            connectWith: '.sortlist_' + id,
            opacity: 0.6,
            update: function() {
                $(this).find('.position').each( function() {
				
                    var listID = $(this).parent().attr('id');
                    var parentID = $(this).parent().parent().attr('id');
                    parentID = parentID.replace(id + '_', '')
                    var optionID = $(this).parent().parent().parent().attr('id');
                    $(this).prop("name", optionID + '[' + parentID + '][' + listID + ']');
					
                });
            }
        });	
    });
	
	
   
	
    


    /**	Tipsy @since v1.3 */
    if (jQuery().tipsy) {
        $('.typography-size, .typography-height, .typography-face, .typography-style, .of-typography-color').tipsy({
            fade: true,
            gravity: 's',
            opacity: 0.7
        });
    }
	
	
    /* iPhone toggle @since jawtemplates */	
    jQuery('.toggle-button:checkbox').each(function(){
        if(jQuery(this).parents('.postbox').is('.closed')){
            var button = $(this);
					
            button.parents('.postbox').children('.hndle,.handlediv').bind('clickoutside',function(e){
                button.iphoneStyle();
            });
        }else{
            jQuery(this).iphoneStyle();
        }
    });
	
    /* Chosen elements @since jawtemplates */
    jQuery("select.chosen").each(function(){
        var $placeholder = jQuery(this).attr('data-placeholder');
        if(jQuery(this).parents('.postbox').is('.closed')){
            var chosen = jQuery(this);
					
            chosen.parents('.postbox').children('.hndle,.handlediv').bind('clickoutside',function(e){
                if($placeholder!=undefined){
                    chosen.data("placeholder", $placeholder).chosen();
                }else{
                    chosen.chosen();
                }
            });
        }else{
            if($placeholder!=undefined){
                jQuery(this).data("placeholder", $placeholder).chosen();
            }else{
                jQuery(this).chosen();
            }
        }
    });

/* toogle ON/OFF button */

$(".cb-enable").click(function(){
		var parent = $(this).parents('.tooglebutton');
		$('.cb-disable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', true);
	});
	$(".cb-disable").click(function(){
		var parent = $(this).parents('.tooglebutton');
		$('.cb-enable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', false);
	});



		
    /* slider - range */
    jQuery(".range-input-wrap :range").rangeinput();
    jQuery("#jaw-shortcode-popup .range-input-wrap :range").rangeinput();
    
    
    $('.colorSelector').each(function(){
        var Othis = this; //cache a copy of the this variable for use inside nested function
				
        $(this).ColorPicker({
            color: '<?php if (isset($color)) echo $color; ?>',
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                $(Othis).children('div').css('backgroundColor', '#' + hex);
                $(Othis).next('input').attr('value','#' + hex);
						
            }
        });
				  
    }); //end color picker
	
    
    
  //  $("#content").attr("autocomplete", "off");

    
}); //end doc ready






    /*HELP*/
var launchHelp = function(URL) {
    if (window.showModalDialog) {
        var help = showModalDialog(URL,"","dialogWidth=800px;dialogHeight=800px");
    } else {
        var help = window.open (URL,"", "width=800,height=800,modal=yes,alwaysRaised=yes");
        help.focus();
    }
}