<?php 


/*
tables on create

adds in wp_term-taxonomy - new taxonomy types with new terms in wp_terms
product_type - terms - simple grouped variable external
product_visibility - exclude from search exclude from catalog featured outofstock rated 1-5
product_cat - uncategorizied

tags?
attributes?

Create new tables , all clean on creation only fill one session
wp_wc_download_log 
wp_wc_webhooks 
wp_woocommerce_api_keys 
wp_woocommerce_attribute_taxonomies 
wp_woocommerce_downloadable_product_permissions 
wp_woocommerce_log 
wp_order_itemmeta 
wp_woocommerce_order_items 
wp_woocommerce_payment_tokenmeta
wp_woocommerce_payment_tokens
wp_woocommerce_sessions - 1 session
wp_woocommerce_shipping_zones
wp_woocommerce_shipping_zone_locations
wp_woocommerce_shipping_zone_methods
wp_woocommerce_tax_rates
wp_woocommerce_tax_rate_locations

*/
//archive-product.php /shop - 
//This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.

//single-product.php

//cart.php

//checkout - form-checkout.php 


//order complete

//my account


/*

filter hooks
woocommerce_product_add_to_cart_text - function return __('Buy me', 'woocommerce') - text for button on archive 
woocommerce_product_single_add_to_cart_text - same but for a single product page button

*/

$product = wc_get_product($id);
$product->get_name();
$product->get_price();
$product->get_categories();
$product->get_short_description();
// <a href='/shop/?add-to-cart=".$id."'> ADD to cart </a>


$wp_query1= new WP_query(array("post_type"=>"product","nopaging"=>true));
$wp_query->max_num_pages=1;
// var_dump($wp_query);
do_action( 'woocommerce_before_shop_loop' );

woocommerce_product_loop_start();

if ( wc_get_loop_prop( 'total' ) ) {
    while ( $wp_query1->have_posts() ) {
        $wp_query1->the_post();
        
      // $arr= get_the_terms(get_the_id(),"prduct_cat");
       $args = array( 'taxonomy' => 'product_cat',);
$terms = wp_get_post_terms(get_the_id(),'product_cat', $args);
      // var_dump($terms);
      if($terms[0]->term_id!=402)
            {
                continue;
            }
        /**
         * Hook: woocommerce_shop_loop.
         *
         * @hooked WC_Structured_Data::generate_product_data() - 10
         */
        do_action( 'woocommerce_shop_loop' );

        wc_get_template_part( 'content', 'product' );
    }
}
?>
