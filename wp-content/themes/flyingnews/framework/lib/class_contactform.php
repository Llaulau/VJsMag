<?php

/**
 * Contact form captcha
 *
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class contactform {

    var $render = null;
    var $captcha = 1;
    var $mailto = 'yourmail@domain.tld';
    var $thanks = 'Your email has been sent. Thank you.';
    var $subject = 'Contact Form';
    var $error_name = 'Your name is required';
    var $error_mail = 'E-mail address entered is invalid';
    var $error_text = 'Please enter a message';
    var $error_captcha = 'Incorrect security code';
    var $label_name = "Name *";
    var $label_mail = "E-mail *";
    var $submit_button = 'Send message';
    var $id = null;

    function __construct($use_captcha = 1, $options = null) {
	$this->id = md5(microtime());
	$this->captcha = $use_captcha;
	$GLOBALS['jaw_use_captcha'] = $this->captcha;


	// var_dump($options); 
	//var_dump($GLOBALS['jaw_mailto']);
	if ($options && is_array($options)) {
	    foreach ($options as $key => $option) {
		if (isset($this->{$key})) {
		    $this->{$key} = $option;
		}
	    }
	}
    }

    function render() {
	global $gantry;
	//session_start();
	$_SESSION['jaw_mailto_' . $this->id] = $this->mailto;
	$_SESSION['jaw_subject_' . $this->id] = $this->subject;
	$_SESSION['jaw_use_captcha_' . $this->id] = $this->captcha;

	if ($_SESSION['jaw_use_captcha_' . $this->id]) {

	    require_once get_template_directory() . '/lib/securimage/securimage.php';
	    $src = get_template_directory_uri() . "/lib/securimage/captcha.php";
	    $securimage = new Securimage();
	}

	$send = get_template_directory_uri() . "/lib/securimage/send.php";


	ob_start();
	?>
	<script>

	    jQuery(document).ready(function() {




		jQuery('#id<?php echo $this->id; ?> .fc_mod_email,#id<?php echo $this->id; ?> .fc_mod_name').change(function() {
		    jQuery('#id<?php echo $this->id; ?> .jawcaptcha').fadeIn('slow');
		});
		function  clean(formObject) {
		    jQuery(":input", formObject).not(":button, :submit, :reset, :hidden").val("");
		    jQuery('#id<?php echo $this->id; ?> .jawcaptcha').hide('medium');
	<?php if ($_SESSION['jaw_use_captcha_' . $this->id]) { ?>
	    	    reloadCaptcha();
	<?php } ?>
		}



		function reloadCaptcha() {
		    document.getElementById('captcha<?php echo $this->id; ?>').src = '<?php echo $src ?>?' + Math.random();
		}
		function thanks() {
		    jQuery('<div class="form-done"><?php echo $this->thanks; ?></div>').prependTo('#id<?php echo $this->id; ?> .jaw_mod_contact');
		}
		jQuery('#id<?php echo $this->id; ?> form').submit(function() {
		    jQuery('#id<?php echo $this->id; ?> .error').fadeOut('fast');
		    var form = jQuery(this);
		    jQuery.post('<?php echo $send; ?>',
			    form.serialize(),
			    function(data) {
				if (data.error == '0') {
				    form.fadeOut(600);
				    thanks();

				    clean('#id<?php echo $this->id; ?> form');


				    jQuery('body').bind('click', function() {
					jQuery('#id<?php echo $this->id; ?> .form-done').fadeIn(600).remove();
					form.fadeIn(600);

				    });
				} else {

				    if (data.type.e_name)
				jQuery('#id<?php echo $this->id; ?> .e_name').fadeIn(500);
				    if (data.type.e_mail)
				jQuery('#id<?php echo $this->id; ?> .e_mail').fadeIn(500);
				    if (data.type.e_text)
				jQuery('#id<?php echo $this->id; ?> .e_text').fadeIn(500);
	<?php if ($_SESSION['jaw_use_captcha_' . $this->id]) { ?>
	    			    if (data.type.e_captcha)
	    			jQuery('.e_captcha').fadeIn(500);
	<?php } ?>
				    jQuery('#id<?php echo $this->id; ?> .jawcaptcha').fadeIn('fast');
	<?php if ($_SESSION['jaw_use_captcha_' . $this->id]) { ?>
	    			    reloadCaptcha();
	<?php } ?>


				}
			    }, 'JSON');
		    return false;
		});

	    });
	</script>



	<div id="id<?php echo $this->id; ?>">
	    <div class="jaw_mod_contact">
		<form method="post" action="#">
		    <div class="jaw_mod_contact-item">
			<input type="text" class="fc_mod_name" name="fc_mod_name" value="">
			<label for="fc_mod_name"><?php echo $this->label_name; ?></label>
			<div style="display:none" class="e_name error"><?php echo $this->error_name; ?></div>
		    </div>
		    <div class="jaw_mod_contact-item">
			<input type="text" class="fc_mod_email" name="fc_mod_email" value="">
			<label for="fc_mod_name"><?php echo $this->label_mail; ?></label>
			<div style="display:none" class="e_mail error"><?php echo $this->error_mail ?></div>
		    </div>
		    <div class="jaw_mod_contact-item">
			<textarea rows="10" name="fc_mod_text" class="fc_mod_text" cols="10"></textarea>			
			<div style="display:none" class="e_text error"><?php echo $this->error_text ?></div>
		    </div>
		    <p style="display:none;">
			<input type="hidden" value="1" name="fc_mod_send_email">
			<input type="hidden" name="do" value="contact" />
			<input type="hidden" name="id" value="<?php echo $this->id; ?>" /></p> 



	<?php if ($_SESSION['jaw_use_captcha_' . $this->id]) { ?>
	    	    <div class="jawcaptcha">

	    		<div><img id="captcha<?php echo $this->id; ?>" class="captcha" src="<?php echo $src; ?>" alt="CAPTCHA Image" />
	    		    <a href="#" class="reload" style="float:right" onclick="document.getElementById('captcha<?php echo $this->id; ?>').src = '<?php echo $src ?>?' + Math.random();
	    		return false" title="Different Image">
	    		    </a>
	    		    <div class="clear"></div>
	    		</div>    
	    		<input type="text" class="captcha_code" onfocus="if (this.value == 'enter code')
	    		    this.value = '';" onblur="if (this.value == '')
	    		    this.value = 'enter code';" value="enter code" name="captcha_code" size="10" maxlength="6" />
	    		<div style="display:none" class="e_captcha error"><?php echo $this->error_captcha ?></div>


	    	    </div>
			<?php } ?>
		    <p class="send_message">
			<input type="submit" name="fc_mod_submit" class="btn_b fc_mod_submit" tabindex="5" value="<?php echo $this->submit_button; ?>">
		    </p>
		    <div class="clear"></div>
		</form>
	    </div>
	</div>



	<?php
	$this->render = ob_get_flush();
	//echo  $this->render;
    }

    function getForm() {
	return $this->render;
    }

}
?>
