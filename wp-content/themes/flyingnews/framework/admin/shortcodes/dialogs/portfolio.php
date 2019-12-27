<?php
$of_options = array();
        
        
 $of_options[] = array(
            'id' => 'porfolio_cat',
            'type' => 'multidropdown',
            'name' => 'Include Category',
            'desc' => 'Choose the portfolio categories which you want to be displayed in the portfolio.',
            "std" => array(),
            "page" => null,
            "mod" => 'big',
            "chosen" => "true",
            "target" => 'portfolio-category',
            "prompt" => "Choose category..",
 );      
        
 $of_options[] = array(
            'id' => 'portfolio_title',
            'type' => 'toggle',
            'name' => 'Title',
            'desc' => 'Show title',
            'std' => 'true'   
 );
 
 $of_options[] = array(
            'id' => 'portfolio_titlelink',
            'type' => 'toggle',
            'name' => 'Title Link',
            'desc' => 'Choose whether to hyperlink a title.',
            'std' => '1'   
 );
 
 $of_options[] = array(
            'id' => 'portfolio_desc',
            'type' => 'toggle',
            'name' => 'Description',
            'desc' => 'Choose whether to show or hide a&nbsp;portfolio text.',
            'std' => '0'   
 );
 
  $of_options[] = array(
            "name" => "Maximal Length of Description",
            "desc" => "(-1) nolimit",
            "id" => "portfolio_maxlen",
            "std" => "-1",
            "mod" => "medium",
            "type" => "text"       
 );
  

 
 $of_options[] = array(
            'id' => 'portfolio_filter',
            'type' => 'toggle',
            'name' => 'Filter',
            'desc' => 'Show or hide the filtering bar.',
            'std' => '0'   
 );
 
 $of_options[] = array(
            'id' => 'portfolio_lightbox',
            'type' => 'toggle',
            'name' => 'Enable Lightbox',
            'desc' => '',
            'std' => 'true'   
 );
  
 $of_options[] = array(
            'id' => 'portfolio_lightbox_group',
            'type' => 'toggle',
            'name' => 'Lightbox Group',
            'desc' => 'Toggle between portfolios within a&nbsp;lightbox.',
            'std' => 'true'   
 );
 
 $of_options[] = array(
            "name" => "Lightbox Title",
            "desc" => "",
            "id" => "portfolio_lightboxtitle",
            "std" => "title",
            "type" => "select",
            "options" => array("title","desc","none")
 );
 
 $of_options[] = array(
            "name" => "Order",
            "desc" => "",
            "id" => "portfolio_order",
            "std" => "ASC",
            "type" => "select",
            "options" => array("ASC","DESC")
 );
 
 $of_options[] = array(
            "name" => "Order By",
            "desc" => "",
            "id" => "portfolio_orderby",
            "std" => "menu_order",
            "type" => "select",
            "options" => array("ID","none", "author", "title", "date", "modified", "parent", "rand", "comment_count","menu_order")
 );
 
   $of_options[] = array(
            "name" => "Portfolios items per page",
            "desc" => "",
            "id" => "portfolio_per_page",
            "std" => "1000",
            "mod" => "medium",
            "type" => "text"       
 );
   
   
  $of_options[] = array(
            "name" => "Pagination style",
            "desc" => "",
            "id" => "portfolio_pagination",
            "std" => "none",
            "type" => "select",
            "options" => array("ajax" => "ajax", "infinite" => "infinite", "infinitemore"=>"infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress")
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
 
        var values = jQuery("select[id='porfolio_cat']").map(function(){return jQuery(this).val();}).get();
        var catsId = [];
        jQuery(values).each(function() {
            catsId.push(this);
        });
        var cats = catsId.join();
        
        
       
        if (jQuery("#portfolio_title input[type=radio]:checked").val() == '1'){  
            var title = 'true';
        }else{
            var title = 'false';
        }
        
        
        if (jQuery("#portfolio_titlelink input[type=radio]:checked").val() == '1'){  
            var titlelink = 'true';
        }else{
            var titlelink = 'false';
        }
        
        
      
        if (jQuery("#portfolio_desc input[type=radio]:checked").val() == '1'){  
            var desc = 'true';
        }else{
            var desc = 'false';
        }
        
       
        
        var maxlen = jQuery('#portfolio_maxlen').val();

        

        
        
        if (jQuery("#portfolio_filter input[type=radio]:checked").val() == '1'){ 
            var filter = 'true';
        }else{
            var filter = 'false';
        }
        
        if (jQuery("#portfolio_lightbox input[type=radio]:checked").val() == '1'){  
            var lightbox = 'true';
        }else{
            var lightbox = 'false';
        }
       
       if (jQuery("#portfolio_lightbox_group input[type=radio]:checked").val() == '1'){  
            var lightbox_group = 'true';
        }else{
            var lightbox_group = 'false';
        }
        
        var lightboxtitle = jQuery('#portfolio_lightboxtitle option:selected').text();
        
        var order = jQuery('#portfolio_order option:selected').text();

        var orderby = jQuery('#portfolio_orderby option:selected').text();
        
        var portfolio_per_page = jQuery('#portfolio_per_page').val();
        
        var pagination = jQuery('#portfolio_pagination option:selected').text();

        
        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[portfolio  cat="'+cats+'" title="'+title+'" titlelink="'+titlelink+'" desc="'+desc+'" maxlen="'+maxlen+'" more="'+'" filter="'+filter+'" lightbox="'+lightbox+'" group="'+lightbox_group+'" lightboxtitle="'+lightboxtitle+'" order="'+order+'" orderby="'+orderby+'" post_on_page="'+portfolio_per_page+'" pagination="'+pagination+'"]');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
</script>

