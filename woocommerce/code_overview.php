<?php

/* woocommerce singleton */
global $woocommerce;

WC_Query – stored in $woocommerce->query

/* WC_Customer – stored in $woocommerce->customer
 the current instantion stores the current user
*/
$customer_country = $woocommerce->customer->get_country();

/*WC_Cart The cart class loads and stores the users cart data in a session. */
$cart_subtotal = $woocommerce->cart->get_cart_subtotal();


WC_Shipping – stored in $woocommerce->shipping
WC_Payment_Gateways – stored in $woocommerce->payment_gateways
WC_Countries – stored in $woocommerce->countries

/*WC_Product product class called on demand
used for loading and outputting product data*/
$product = wc_get_product( $post->ID );
?>
