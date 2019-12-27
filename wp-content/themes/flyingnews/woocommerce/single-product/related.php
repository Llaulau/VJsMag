<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

$related = "";
if(function_exists('is_product') &&  is_product()){
   $related = $product->get_related(); 
}else if(jwUtils::woocommerce_activate() == true){
    $related = (get_post_meta(get_the_ID(),'post_connect_woo',true));
    $orderby = 'ACK';
    $posts_per_page = '-1';
    $columns = 1;
}

if ( $related == "" ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>
   <div class="releated-product">
            <h3><?php _e('Related Product', 'jawtemplates'); ?></h3>
        
	 <div id="elements_iso" class="">

		


                    
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                            
                    
         
                                    <?php    woocommerce_get_template_part( 'content', 'product' ); ?>
                                    
                                    
                                        
			<?php endwhile; // end of the loop. ?>

	
				

	</div>
    </div>

<?php endif;

wp_reset_postdata();
