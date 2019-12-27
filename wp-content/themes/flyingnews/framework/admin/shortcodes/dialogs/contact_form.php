<?php
$of_options = array();

$of_options[] = array(
    'id' => 'contact_form_title',
    'type' => 'text',
    'name' => 'Title',
    'desc' => 'Title of contact form',
    "std" => 'Contact me'

);

$of_options[] = array(
    'id' => 'contact_form_email',
    'type' => 'text',
    'name' => 'E-mail',
    'desc' => 'E-mail',
    "std" => ''
);

$of_options[] = array(
    'id' => 'contact_form_subject',
    'type' => 'text',
    'name' => 'Subject',
    'desc' => 'Subject of e-mail message',
    "std" => 'Feedback'
);

$of_options[] = array(
    'id' => 'contact_form_question',
    'type' => 'text',
    'name' => 'Captcha question',
    'desc' => 'Simple Captcha question',
    "std" => '1+1='
);
        

$of_options[] = array(
    'id' => 'contact_form_answer',
    'type' => 'text',
    'name' => 'Captcha answer',
    'desc' => 'Simple Captcha answer',
    "std" => '2'
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
        
        
        var out = "";
        if (jQuery("#contact_form_title").val().length > 0) {
            out += " title=" +"\""+jQuery("#contact_form_title").val()+"\" ";
        } else {
            out += "";
        }
     
        if (jQuery("#contact_form_email").val().length > 0) {
            out += " mail=" +"\""+jQuery("#contact_form_email").val()+"\" ";
        } else {
            out += "";
        }
        
        if (jQuery("#contact_form_subject").val().length > 0) {
            out += " subject=" +"\""+jQuery("#contact_form_subject").val()+"\" ";
        } else {
            out += "";
        }
        
        if (jQuery("#contact_form_question").val().length > 0) {
            out += " question=" +"\""+jQuery("#contact_form_question").val()+"\" ";
        } else {
            out += "";
        }
        if (jQuery("#contact_form_answer").val().length > 0) {
            out += " answer=" +"\""+jQuery("#contact_form_answer").val()+"\" ";
        } else {
            out += "";
        }
        
        
        
        
        
        
        tinymce.activeEditor.selection.setContent(tinymce.activeEditor.selection.getContent() + '[contact_form '+out+']');
        
        tb_remove();        
    });
    jQuery("#cancel-button").click(function () {        
        tb_remove();        
    });
    

               
</script>


                