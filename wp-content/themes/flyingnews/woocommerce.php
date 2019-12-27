<?php get_header();  
global $jawpage;?>
		<!-- Row for main content area -->
                <div id="content" class="<?php echo jwLayout::content_width(); ?> columns <?php echo jwLayout::sidebar_layout(); ?> page" role="main">
	
			<div class="post-box">
                            <?php if((function_exists('is_product') && is_product())){?>
                            <nav id="nav-single">
                                <span class="nav-previous"><?php previous_post_link('%link', __('Previous', 'jawtemplates')); ?></span>
                                <span class="nav-next"><?php next_post_link('%link', __('Next', 'jawtemplates')); ?></span>
                            </nav><!-- #nav-single -->
                            <div class="clear"></div>
                            <?php }?>
        
        
                          <?php if((function_exists('is_shop') && is_shop()) && get_post_meta(get_option('woocommerce_shop_page_id'), '_display_page_name', true) =='1'){?>
                                    <h1><?php echo get_the_title(get_option('woocommerce_shop_page_id')); ?></h1>
                                    <hr>
                              <?php } ?>
	
                            
				<?php
                                get_template_part('loop', 'products'); ?>
			</div>
                <?php echo jwRender::pagination(jwOpt::get_option('blog_pagination', 'number')); ?>

		</div><!-- End Content row -->
		<?php get_sidebar();?>
                
		
<?php get_footer(); ?>