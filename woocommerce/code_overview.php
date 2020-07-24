<?php

/* woocommerce singleton */
global $woocommerce == WC()

 /*Singletons contained in the global singleton */
WC_Query – stored in WC()->query

/* WC_Customer – stored in WC()->customer
 the current instantion stores the current user
*/
$customer_country = WC()->customer->get_country();

/*WC_Cart The cart class loads and stores the users cart data in a session. */
$cart_subtotal = WC()->cart->get_cart_subtotal();
 WC()->cart->add_to_cart( $product_id, $quantity ); //adds product to the card

/*
WC_Shipping – stored in WC()->shipping
WC_Payment_Gateways – stored in WC()->payment_gateways
WC_Countries – stored in WC()->countries*/

 
/*On demand classes which are instantiating new objects */
 
/*WC_Product*/
$product = wc_get_product($id); // post id
$product->get_type();
$product->get_name();
$product->get_slug();
$product->get_date_created();
$product->get_date_modified();
$product->get_status();
$product->get_featured();
$product->get_catalog_visibility();
$product->get_description();
$product->get_short_description();
$product->get_sku();
$product->get_price();
$product->get_regular_price();
$product->get_sale_price();
$product->get_date_on_sale_from();
$product->get_date_on_sale_to();
$product->get_total_sales();
$product->get_tax_status();
$product->get_tax_class();
$product->get_manage_stock();
$product->get_stock_quantity();
$product->get_stock_status();
$product->get_backorders();
$product->get_low_stock_amount();
$product->get_sold_individually();
$product->get_weight();
$product->get_length();
$product->get_width();
$product->get_height();
$product->get_dimensions();
$product->get_upsell_ids();
$product->get_cross_sell_ids();
$product->get_parent_id();
$product->get_reviews_allowed();
$product->get_purchase_note();
$product->get_attributes();
$product->get_default_attributes();
$product->get_menu_order();
$product->get_post_password();
$product->get_category_ids();
$product->get_tag_ids();
$product->get_virtual();
$product->get_gallery_image_ids();
$product->get_shipping_class_id();
$product->get_downloads();
$product->get_download_expiry();
$product->get_downloadable();
$product->get_download_limit();
$product->get_image_id();
$product->get_rating_counts();
$product->get_average_rating();
$product->get_review_count();

/*WC_Order*/
$order = wc_get_order( $order_id ); // post id == order id

//meta
$order->add_meta_data( 'PayPal Transaction Fee', wc_clean( $posted['mc_fee'] ) );
$order->get_meta( '_paypal_status', true )  // geta meta of an order
update_post_meta( $order->get_id(), '_paypal_status', $result->PAYMENTSTATUS );

//booleans
$order->needs_payment();
$order->has_status( wc_get_is_paid_statuses() );

//setters
$order->payment_complete( $txn_id );
$order->set_transaction_id( $transaction );
$order->update_status( 'on-hold', sprintf( __( 'Validation error: PayPal currencies do not match (code %s).', 'woocommerce' ), $currency ) );////update status of an order and add note
$order->add_order_note(
					/* translators: 1: Refund amount, 2: Refund ID */
					sprintf( __( 'Refunded %1$s - Refund ID: %2$s', 'woocommerce' ), $result->GROSSREFUNDAMT, $result->REFUNDTRANSACTIONID ) // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar
				);

//getters
$order->get_transaction_id(); // transaction id
$order->get_order_number();
$order->get_id();
$order->get_order_key();
$order_id = wc_get_order_id_by_order_key( $order_key );
$order->get_payment_method(); // get the payment method id
$order->get_cancel_order_url_raw();
$order->get_currency();

//fields
$order->get_billing_first_name();
$order->get_billing_last_name();
$order->get_billing_address_1();
$order->get_billing_address_2();
$order->get_billing_city();
$order->get_billing_country();
$order->get_billing_state();
$order->get_billing_postcode();
$order->get_billing_email();
$order->get_billing_phone();

//variables
$order->get_total();
$order->get_shipping_total();
$order->get_shipping_tax();
$order->get_total_discount();
$order->get_total_tax();
$order->get_items()


?>
