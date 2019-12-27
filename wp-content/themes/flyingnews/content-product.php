<?php
/**
 * The default template for displaying default/standard content
 */
?>

<?php
global $post;
$class_thumbnail = '';
$cat_bg_color = '';



    $terms = get_the_terms($post->ID, 'product_cat');
    if (!empty($terms)) {
        $terms = array_shift(array_values($terms));
        $term_id = ($terms->term_id );

        $cat_bg_color = jwOpt::get_option('cat_bg_color', 'default', 'category', $term_id);

        if ($cat_bg_color === 'custom') {
            $cat_bg_color .= "_" . $term_id;
        }
    }

    
$product = get_product(get_the_ID());
$terms = get_the_terms(get_the_ID() , 'product_cat' );
if(isset($terms) && is_array($terms) && sizeof($terms)>0){
    $terms = (array_values($terms));
}
?>
<?php if(!isset($term_id)){
    $term_id = 0;
}else{
    echo jwStyle::woo_custom_color_inline($term_id);
}?>




<article id="post-<?php the_ID(); ?>"  <?php post_class(array('element', 'one_col', 'category_' . $cat_bg_color, $class_thumbnail, 'product_cat_'.$term_id)); ?>   
         sort_name="<?php echo(StrToLower(get_the_title())); ?>"  
         sort_date="<?php the_time("Y-m-d H:i:s"); ?>" 
         sort_rating="<?php echo (int) ($product->get_average_rating() *10); ?>" 
         sort_popular="<?php echo get_comments_number(); ?>"
         sort_price="<?php echo get_post_meta(get_the_ID(), '_price', true); ?>"
         sort_sales="<?php echo get_post_meta(get_the_ID(), 'total_sales', true); ?>"
         sort_category="<?php echo (isset($terms) && is_array($terms) && sizeof($terms)>0) ? $terms[0]->slug : '' ?>"
         sort_custom1="0"
         sort_custom2="0"
         >
         

    <div class="box">
        <?php echo jwRender::metaCategory(); ?>
        <div class="image">



            <?php
            if (jwOpt::get_option('std_post_image_clickable') == '1') {
                echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
            }
            the_post_thumbnail('thumbs');
            if (jwOpt::get_option('std_post_image_clickable') == '1') {
                echo '</a>';
            }
            ?>

            <?php echo jwRender::metaPost(); ?>
        </div>

        <div class="content-box"> 
            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <header>
                <h2><a href="<?php the_permalink(); ?>" class="post_name"><?php the_title(); ?></a></h2>
            </header>    
            <p> <?php echo jwRender::get_the_excerpt(); ?></p>
            <br>
            <?php ?>

            <div class="commerce-content">
                <div class="content-price">
                    <?php
                   echo sprintf(get_woocommerce_price_format(),get_woocommerce_currency_symbol(), get_post_meta(get_the_ID(), '_price', true));
                   // echo get_woocommerce_currency_symbol() . get_post_meta(get_the_ID(), '_price', true);
                    ?>
                </div>
                <div class="content-addtocart">
                    <?php woocommerce_get_template( 'loop/add-to-cart.php' );?>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        </div>
</article>

