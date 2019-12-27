<?php get_header(); ?>

		<!-- Row for main content area -->
		<div id="content" class="eight columns" role="main">
		    <div class="post-box">
			<?php
                        
                 
                        echo jwOpt::get_option('error_custom_html', '<div class="post-box">
				<img src="http://i.imgur.com/62wcKsm.png">
				<h1>File Not Found</h1>
				<div class="error">
					<p class="bottom">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
				</div>
				<p>Please try the following:</p>
				<ul> 
					<li>Return to the <a href="'.SITE_URL.'">home page</a></li>
				</ul>
			</div>')   ;
                               
                                ?> 

		</div><!-- End postbox -->
		</div><!-- End Content row -->
		<?php get_sidebar(); ?>
		
<?php get_footer(); ?>