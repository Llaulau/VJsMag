<?php
$of_options = array();

$of_options[] = array(
    'id' => 'blog_cat',
    'type' => 'multidropdown',
    'name' => 'Exclude blog category',
    'desc' => 'This is the description field, again good for additional info.',
    "std" => array(),
    "page" => null,
    "chosen" => "true",
    "target" => 'cat',
    "prompt" => "Choose category..",
);

$of_options[] = array(
    'id' => 'blog_postscount',
    'type' => 'range',
    'name' => 'Count Posts',
    'desc' => 'Count posts per page.',
    'std' => '6',
    'min' => '1',
    'max' => '40',
    'step' => '1',
    'unit' => ''
);



        $of_options[] = array(
            'id' => 'blog_pagination',
            'type' => 'select',
            'name' => 'Pagination Style',
            'desc' => 'Choose the pagination style you prefer.',
            'std' => 'ajax',
            'mod' => 'medium',
            'options' => array("ajax" => "ajax", "infinite" => "infinite", "infinitemore"=>"infinite with more", "none" => "none", "number" => "number", "wordpress" => "wordpress"),
        );

        $of_options[] = array(
            'id' => 'blog_order',
            'type' => 'select',
            'name' => 'Post Order',
            'desc' => 'Posts order (ascending or descending).',
            'std' => 'desc',
            'mod' => 'small',
            'options' => array("desc" => "Desc", "asc" => "Asc")
        );

        $of_options[] = array(
            'id' => 'blog_orderby',
            'type' => 'select',
            'name' => 'Post Order by',
            'desc' => 'Order posts by parameters. Help on <a target="_blank" href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters">Order by Parameters</a>',
            'std' => 'date',
            'mod' => 'medium',
            'options' => array("date" => "Date", "none" => "None", "ID" => "ID",
                "author" => "Author", "title" => "Title", "modified" => "Modified",
                "parent" => "Parent", "rand" => "Rand", "comment_count" => "Comment count")
        );

        $of_options[] = array(
            'id' => 'blog_dateformat',
            'type' => 'text',
            'name' => 'Post Date Format',
            'desc' => '<a target="_blank" href="http://codex.wordpress.org/Formatting_Date_and_Time">Formatting Date and Time in Wordpress</a>',
            'std' => "F j, Y",
            'mod' => 'mini'
        );


        $of_options[] = array("name" => "Number of Words Excerpt",
            "desc" => "This is a number of words in a preview content.",
            "id" => "blog_excerpt",
            "std" => 20,
            "mod" => 'micro',
            'maxlength' => 4,
            "type" => "text"
        );

        
        
        $of_options[] = array(
            "name" => "Meta",
            "type" => "sectionstart");


        $of_options[] = array(
            "name" => "Bar Transitions",
            "desc" => "Choose your meta bar transition style or switch the bar on/off. This bar is displayed in the post preview.",
            "id" => "blog_metacaption",
            "std" => "toggle",
            "type" => "select",
            "options" => array(
                "off" => "Off",
                "on" => "On",
                "toggle" => "Toggle",
                "fadeEffect" => "Fade Effect"
            )
        );

        $of_options[] = array(
            'id' => 'blog_metaauthor',
            'type' => 'toggle',
            'name' => 'Meta Author',
            'desc' => 'Choose whether the autors name is displayed or not in the post preview.',
            'std' => '1'
        );

        $of_options[] = array(
            'id' => 'blog_metacategory',
            'type' => 'toggle',
            'name' => 'Meta Category',
            'desc' => 'Choose whether the category name is displayed or not in the post preview.',
            'std' => '0'
        );

        $of_options[] = array(
            'id' => 'blog_metadate',
            'type' => 'toggle',
            'name' => 'Meta Date',
            'desc' => 'Choose whether the date is displayed or not in the post preview.',
            'std' => '1'
        );

        $of_options[] = array(
            'id' => 'blog_metacomments',
            'type' => 'toggle',
            'name' => 'Meta Comments',
            'desc' => 'Choose whether the comments are displayed or not in the post preview.',
            'std' => '1'
        );

        $of_options[] = array(
            'id' => 'blog_ratings',
            'type' => 'toggle',
            'name' => 'Ratings',
            'desc' => 'Choose whether the ratings are displayed or not in the post preview.',
            'std' => '1'
        );

        $of_options[] = array(
            "type" => "sectionend");
        
        

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
        
        var values = jQuery("select[id='blog_cat']").map(function(){return jQuery(this).val();}).get();
        var catsId = [];
        jQuery(values).each(function() {
            catsId.push(this);
        });
        var cats = catsId.join();
        var out = "";
        if (jQuery("#blog_postscount").val().length > 0) {
            out += " count=" +"\""+jQuery("#blog_postscount").val()+"\" ";
        } else {
            out += "";
        }
     
        if (jQuery("#blog_order").val().length > 0) {
            out += " order=" +"\""+jQuery("#blog_order").val()+"\" ";
        } else {
            out += "";
        }
        
        if (jQuery("#blog_orderby").val().length > 0) {
            out += " orderby=" +"\""+jQuery("#blog_orderby").val()+"\" ";
        } else {
            out += "";
        }
        
        if (jQuery("#blog_dateformat").val().length > 0) {
            out += " dateformat=" +"\""+jQuery("#blog_dateformat").val()+"\" ";
        } else {
            out += "";
        }
        if (jQuery("#blog_pagination").val().length > 0) {
            out += " pagination=" +"\""+jQuery("#blog_pagination").val()+"\" ";
        } else {
            out += "";
        }
        if (jQuery("#blog_excerpt").val().length > 0) {
            out += " excerpt=" +"\""+jQuery("#blog_excerpt").val()+"\" ";
        } else {
            out += "";
        }
        if (jQuery("#blog_metaauthor").attr("checked")) {
            out += " metaauthor=" +"\""+jQuery("#blog_metaauthor").val()+"\" ";
        } else {
            out += "";
        }
        if (jQuery("#blog_metacategory").attr("checked")) {
            out += " metacategory=" +"\""+jQuery("#blog_metacategory").val()+"\" ";
        } else {
            out += "";
        }
        if (jQuery("#blog_metadate").attr("checked")) {
            out += " metadate=" +"\""+jQuery("#blog_metadate").val()+"\" ";
        } else {
            out += "";
        }
        if (jQuery("#blog_metacomments").attr("checked")) {
            out += " metacomments=" +"\""+jQuery("#blog_metacomments").val()+"\" ";
        } else {
            out += "";
        }
        
        if (jQuery("#blog_metacaption").val().length > 0) {
            out += " metacaption=" +"\""+jQuery("#blog_metacaption").val()+"\" ";
        } else {
            out += "";
        }
        if (jQuery("#blog_ratings").attr("checked")) {
            out += " ratings=" +"\""+jQuery("#blog_ratings").val()+"\" ";
        } else {
            out += "";
        }
        
        
        
        
        
        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[blog cats="'+cats+'" '+out+']');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
    

               
</script>


                