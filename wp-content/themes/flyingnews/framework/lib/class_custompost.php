<?php

/*
 * Base class for defination custom post types 
 * 
 * Child of this class must be loaded and running for the whole site or post 
 * type not working
 * 
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 */

class jwCustomPost {

    var $slug = null;
    var $args = null;
    var $labels = null;
    var $taxonomy = null;
    var $tag = null;
    var $metabox = null;

    function __construct() {
	parent::__construct();
    }

    function init() {
	$this->registerPost();

	if (!is_null($this->taxonomy)) {

	    $this->registerTaxonomy();
	}

	if (isset($this->tag) && !is_null($this->tag)) {
	    $this->registerTaxonomyTag();
	}
    }

    function registerTaxonomyTag() {
	register_taxonomy($this->slug . '-tag', $this->slug, $this->tag);
	register_taxonomy_for_object_type($this->slug . '-tag', $this->slug);
    }

    function registerTaxonomy() {
	register_taxonomy($this->slug . '-category', $this->slug, $this->taxonomy);
	register_taxonomy_for_object_type($this->slug . '-category', $this->slug);
    }

    function registerPost() {
	$this->args['labels'] = $this->labels;
	register_post_type($this->slug, $this->args);
    }

    function metabox() {
	if (!is_null($this->metabox) && is_admin())
	    $metabox = new jwMetabox($this->metabox);
    }

    function custom_columns() {
	
    }

    function column() {
	
    }

}

?>
