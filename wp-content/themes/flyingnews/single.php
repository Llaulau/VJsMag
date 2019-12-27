
<?php get_header(); ?>

<!-- Row for main content area -->
<div id="content" class="<?php echo jwLayout::content_width(); ?> columns <?php echo jwLayout::sidebar_layout(); ?>" role="main">
    <div class="post-box">

        <nav id="nav-single">
            <span class="nav-previous"><?php previous_post_link('%link', __('Previous', 'jawtemplates')); ?></span>
            <span class="nav-next"><?php next_post_link('%link', __('Next', 'jawtemplates')); ?></span>
        </nav><!-- #nav-single -->
        <div class="clear"></div>
        
        <?php 

	if (get_post_type() =='portfolio') get_template_part('loop', 'portfolio');
	else get_template_part('loop', 'post'); // for post or other post_types
    
        
        
  
         
        ?>	
        
</div><!-- End Content row -->

    </div>


<?php get_sidebar(); ?>


<?php get_footer(); ?>