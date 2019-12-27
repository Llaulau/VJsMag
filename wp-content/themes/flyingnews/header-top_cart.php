<div class="reverie-header-banner">
<?php global $woocommerce; ?>

    
    <div class="top_cart">
                <div class="top_cart_icon">
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                       <img src="<?php echo THEME_URI.'/images/icons/cart.png' ?>" />
                   </a>
               </div>
               <div class="top_cart_items">
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                       <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> 
                   </a>
               </div>
               <div class="top_cart_price">
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                       <?php echo $woocommerce->cart->get_cart_total(); ?> 
                   </a>
               </div>

                <div class="top_cart_button">
                   <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">
                       <?php _e('View cart', 'jawtemplates'); ?> 
                   </a>
               </div>
           </div>
 
</div>

