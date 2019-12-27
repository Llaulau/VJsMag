<?php

class jwContact_Form extends jw_default_widget {
    


    /**
     *  Defining the widget options
     */

    protected $options = array(
        0 => array('id' => 'form_title',
            'description' => 'Title',
            'type' => 'text',
            'default' => 'Contact Form'),
        1 => array('id' => 'email',
            'description' => 'Your e-mail',
            'type' => 'text',
            'default' => ''),
        2 => array('id' => 'subject',
            'description' => 'Subject of e-mail',
            'type' => 'text',
            'default' => 'Feedback'),
        3 => array('id' => 'question',
            'description' => 'Captcha question',
            'type' => 'text',
            'default' => '1+1='),
        4 => array('id' => 'answer',
            'description' => 'Answer on Captcha',
            'type' => 'text',
            'default' => '2')
    
    );
    
    

     function jwContact_Form() {
        $options = array('classname' => 'jwContact_Form', 'description' => "Theme based contact form.");
        $controls = array('width' => 250, 'height' => 200);
        $this->WP_Widget('jwContact_Form', 'Contact Form - J&W Widget', $options, $controls);
    }

    function widget($args, $instance){
        echo  '<article class="row widget widget_contact_form">' . do_shortcode('[contact_form title="'.$instance['form_title'].'" mail="'.$instance['email'].'" subject="'.$instance['subject'].'" question="'.$instance['question'].'" answer="'.$instance['answer'].'" ]' ) . '</article>';
        
    }

}