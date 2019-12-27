<?php

/**
 * This class loads all the methods and helpers specific to build a meta box.
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */
class jwMetabox {
    /* variable to store the meta box array */

    private $meta_box;

    /**
     * PHP5 constructor method.
     *
     * This method adds other methods of the class to specific hooks within WordPress.
     * 
     * @uses      add_action()
     *
     * @return    void
     *
     * @access    public
     * @since     1.0
     */
    function __construct($meta_box) {
	if (!is_admin())
	    return;

	$this->meta_box = $meta_box;

	add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
	add_action('save_post', array(&$this, 'save_meta_box'), 1, 2);
    }

    /**
     * id ,title,array(pages),
     */

    /**
     * Adds meta box to any post type
     *
     * @uses      add_meta_box()
     *
     * @return    void
     *
     * @access    public
     * @since     1.0
     */
    function add_meta_boxes() {
	foreach ((array) $this->meta_box['pages'] as $page) {

	    add_meta_box($this->meta_box['id'], $this->meta_box['title'], array(&$this, 'build_meta_box'), $page, $this->meta_box['context'], $this->meta_box['priority']);
	}
    }

    /**
     * Meta box view
     *
     * @return    string
     *
     * @access    public
     * @since     1.0
     */
    function build_meta_box($post, $metabox) {
	$outputs = $menu = $defaults = '';
	if (isset($this->meta_box['js']) && !empty($this->meta_box['js'])) {
	    echo '<script type="text/javascript">';
	    echo $this->meta_box['js'];
	    echo '</script>';
	}

	echo '<div class="ot-metabox-wrapper">';

	/* Use nonce for verification */
	echo '<input type="hidden" name="' . $this->meta_box['id'] . '_nonce" value="' . wp_create_nonce($this->meta_box['id']) . '" />';

	/* meta box description */
	echo isset($this->meta_box['desc']) ? '<div class="description" style="padding-top:10px;">' . htmlspecialchars_decode($this->meta_box['desc']) . '</div>' : '';


	/* get the option HTML */
	/*
	 * ID v metaboxes [fields] musí být s podtržítkem na začátku
	 */
	foreach ($this->meta_box['fields'] as $filed) {
	    $data = get_post_meta($post->ID, $filed['id'], true);
	    if ($data == '')
		$data = null;        
	    $outputs.= Elements::elements_machine($filed, $data, 'metabox');
	}

	echo $outputs;
	echo '</div>';
    }

    /**
     * Saves the meta box values
     *
     * @return    void
     *
     * @access    public
     * @since     1.0
     */
    function save_meta_box($post_id, $post_object) {

	global $pagenow;

	/* don't save during quick edit */
	if ($pagenow == 'admin-ajax.php')
	    return $post_id;

	/* don't save during autosave */
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
	    return $post_id;

	/* don't save if viewing a revision */
	if ($post_object->post_type == 'revision')
	    return $post_id;

	/* verify nonce */
	if (isset($_POST[$this->meta_box['id'] . '_nonce']) && !wp_verify_nonce($_POST[$this->meta_box['id'] . '_nonce'], $this->meta_box['id']))
	    return $post_id;

	/* check permissions */
	if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
	    if (!current_user_can('edit_page', $post_id))
		return $post_id;
	} else {
	    if (!current_user_can('edit_post', $post_id))
		return $post_id;
	}
	foreach ($this->meta_box['fields'] as $field) {
         
	    $old = get_post_meta($post_id, $field['id'], true);
	    $new = '';

	    /* there is data to validate */
	    if (isset($_POST[$field['id']])) {
		/* set up new data with validated data */
		$new = $_POST[$field['id']];
	    }
            
         
	    if ($new !== $old) {
		update_post_meta($post_id, $field['id'], $new);
	    }
	}
        
    }

}

?>