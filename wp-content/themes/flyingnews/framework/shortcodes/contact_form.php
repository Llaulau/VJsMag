<?php

add_shortcode('contact_form', 'jawtheme_shortcode_contact_form');

function jawtheme_shortcode_contact_form($atts, $content = null, $code) {

    $opts = shortcode_atts(array(
        'title' => 'Contact me',
        'mail' => '',
        'subject' => 'Feedback',
        'question' => '1+1=',
        'answer' => '2'
            ), $atts);

    extract($opts);


    $out = '';

    $out .= '<div class="contact_form">';
    if (strlen($title) > 0) {
        $out .= '<h2><strong>' . $title . '</strong></h2>';
    }

    if (isset($_POST['submit'])) {
        if ($_POST['captcha'] == $answer && $_POST['myname'] != '' && $_POST['mail'] != '' && $_POST['message'] != '') {
            $message = "A message was submitted from the contact form.  The following information was provided. \n \n"
                    . "Name: " . $_POST['myname'] . " \n"
                    . "Email: " . $_POST['mail'] . "\n"
                    . "Message:\n"
                    . $_POST['message'] . "\n"
                    . "IP Address: {$_SERVER['REMOTE_ADDR']}\n"
                    . "Browser: {$_SERVER['HTTP_USER_AGENT']}\n";

            submit($mail, $subject . ' from:' . $_POST['mail'], $message, $_POST['myname'] . $_POST['mail']);
            $out .= __('Feedback sent...', 'jawtemplates');
        } else {
            $_POST['captcha'] = '';
            $out .= render_form($question, $answer, $_POST);
        }
    } else {
        $out .= render_form($question, $answer);
    }
    $out .= '</div>';
    return $out;
}

function submit($to, $subject, $message, $headers) {
    wp_mail($to, $subject, $message, $headers);
}

function render_form($question, $answer, $post_var = null) {
    
    $error_log = '';
    $error_name = '';
    $error_email = '';
    $error_mess = '';
    $error_capcha = '';
    
    if ( isset($post_var['submit']) ) {

        if ( strlen($post_var['myname'] ) <= 0 ) {
            $error_log .= "<li>" . __('Incorrectly entered name', 'jawtemplates') ."</li>";
            $error_name = ' required';
        }
        
        if ( strlen($post_var['mail']) <= 0 || isEmail($post_var['mail']) <= 0 ) {
            $error_log .= "<li>" . __('Wrong e-mail', 'jawtemplates') ."</li>";
            $error_email = ' required';
        }
        if ( strlen($post_var['message'] ) <= 0 || $post_var['message'] == "Message" ) {
            $error_log .= "<li>" . __('Wrong text format', 'jawtemplates') ."</li>";
            $error_mess = ' required';
        }
        
        if ( strlen($post_var['captcha'] ) <= 0 ) {
            $error_log .= "<li>" . __('Wrong CAPCHA Code', 'jawtemplates') ."</li>";
            $error_capcha = ' required';
        }
    }
    
    $out = '';
    
    $out .= '<form class="jw_contact_form" name="contact_form" method="post"  enctype="multipart/form-data">';
    
    if (strlen($error_log) > 0 ) {
        $out .= '<div class="jw_contact_error active_log"><ol>' . $error_log . '</ol></div>';
    } else {
        $out .= '<div class="jw_contact_error"></div>';
    }
    
    $out .= '<input class="jw_contact_name'.$error_name.'" placeholder="' . __('Name', 'jawtemplates') . '" type="text" name="myname" value="' . $post_var['myname'] . '"/>';
    $out .= '<input class="jw_contact_email'.$error_email.'" placeholder="' . __('E-mail', 'jawtemplates') . '" type="email" name="mail" value="' . $post_var['mail'] . '"/>';
    if (isset($post_var['message'])) {
        $out .= '<textarea class="jw_contact_message'.$error_mess.'" name="message" rows="5">' . $post_var['message'] . '</textarea>';
    } else {
        $out .= '<textarea class="jw_contact_message'.$error_mess.'" name="message" rows="5">' . __('Message', 'jawtemplates') . '</textarea>';
    }
    $out .= '<br>';

    $out .= '<div class="contact_form_button">';
    $out .= '<div class="captcha_form"  >';
    $out .= '<span id="captcha_question"  >';
    $out .= $question;
    $out .= '</span>';
    $out .= '<input class="jw_contact_capcha_answer'.$error_capcha.'" id="form_answer" type="text" name="captcha" style=" width:' . (strlen($answer) * 7 + 20) . 'px;"/>';
    $out .= '</div>';
    $out .= '<div class="contact_submit_button">';
    $out .= '<input id="form_submit" type="submit" value="' . __('Send message', 'jawtemplates') . '"  name="submit"  class="contact_submit">';
    $out .= '</div>';
    $out .= '<div class="clear"></div>';
    $out .= '<div class="contact_form_arrow"></div>';
    $out .= '</div>';
    
    $out .= '<input type="hidden" name="short_contact_error_name" class="short_contact_error_name" value="'.__('Incorrectly entered name', 'jawtemplates').'">';
    $out .= '<input type="hidden" name="short_contact_error_email" class="short_contact_error_email" value="'.__('Wrong e-mail', 'jawtemplates').'">';
    $out .= '<input type="hidden" name="short_contact_error_message" class="short_contact_error_message" value="'.__('Wrong text format', 'jawtemplates').'">';
    $out .= '<input type="hidden" name="short_contact_error_capcha" class="short_contact_error_capcha" value="'.__('Wrong CAPCHA Code', 'jawtemplates').'">';

    $out .= '</form>';


    $out .= '<script>';
    $out .= 'jQuery(document).ready(function () {';
    $out .= 'jQuery(".captcha_form").hide();';
    $out .= 'jQuery(".contact_form").click(function () {';
    $out .= 'jQuery(this).find(".captcha_form").show();';
    $out .= '});';


    if (isset($post_var) && $post_var['myname'] == '') {
        $out .= 'jQuery("#form_name").css("color","#CA181F");';
        $out .= 'jQuery("#captcha_form").show();';
    }
    if (isset($post_var) && $post_var['mail'] == '') {
        $out .= 'jQuery("#form_mail").css("color","#CA181F");';
        $out .= 'jQuery("#captcha_form").show();';
    }
    if (isset($post_var) && $post_var['message'] == '') {
        $out .= 'jQuery("#form_message").css("color","#CA181F");';
        $out .= 'jQuery("#captcha_form").show();';
    }
    if (isset($post_var) && $post_var['captcha'] == '') {
        $out .= 'jQuery("#captcha_question").css("color","#CA181F");';
        $out .= 'jQuery("#captcha_form").show();';
    }

    $out .= '});';

    $out .= '</script>';
    return $out;
}

function isEmail($to_validate) {
        $RegExp = "/^([a-zA-Z0-9_\-])+(\.([a-zA-Z0-9_\-])+)*@((\[(((([0-1])?";
        $RegExp.="([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?";
        $RegExp.="([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?";
        $RegExp.="([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5])))\.(((([0-1])?";
        $RegExp.="([0-9])?[0-9])|(2[0-4][0-9])|(2[0-5][0-5]))\]))|";
        $RegExp.="((([a-zA-Z0-9])+(([\-])+([a-zA-Z0-9])+)*\.)+([a-zA-Z])+";
        $RegExp.= "(([\-])+([a-zA-Z0-9])+)*))$/";
        return preg_match($RegExp, $to_validate);
    }

?>
