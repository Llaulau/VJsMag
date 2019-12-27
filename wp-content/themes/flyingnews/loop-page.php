<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
       <?php if(get_post_meta(get_the_id(), '_display_page_name', '1') =='1'){?>
            <h1><?php the_title(); ?></h1>
            <hr>
      <?php  } ?>
	
	<?php the_content(); ?>
	<?php wp_link_pages(array('before' => '<nav id="page-nav"><p>' . __('Pages:', 'jawtemplates'), 'after' => '</p></nav>' )); ?>
<?php endwhile; // End the loop ?>