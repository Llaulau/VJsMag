<?php get_header();  ?>

		<!-- Row for main content area -->
                <div id="content" class="<?php echo jwLayout::content_width(); ?> columns <?php echo jwLayout::sidebar_layout(); ?> page" role="main">
	
			<div class="post-box">
                            
                            
				<?php

                                get_template_part('loop', 'page'); ?>
			</div>

		</div><!-- End Content row -->

		<?php  get_sidebar(); ?>
		
<?php get_footer(); ?>