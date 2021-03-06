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
//  Order Data array. This is the core order data exposed in APIs since 3.0.0.
protected $data = array(
	// Abstract order props.
	'parent_id'            => 0,
	'status'               => '',
	'currency'             => '',
	'version'              => '',
	'prices_include_tax'   => false,
	'date_created'         => null,
	'date_modified'        => null,
	'discount_total'       => 0,
	'discount_tax'         => 0,
	'shipping_total'       => 0,
	'shipping_tax'         => 0,
	'cart_tax'             => 0,
	'total'                => 0,
	'total_tax'            => 0,

	// Order props.
	'customer_id'          => 0,
	'order_key'            => '',
	'billing'              => array(
		'first_name' => '',
		'last_name'  => '',
		'company'    => '',
		'address_1'  => '',
		'address_2'  => '',
		'city'       => '',
		'state'      => '',
		'postcode'   => '',
		'country'    => '',
		'email'      => '',
		'phone'      => '',
	),
	'shipping'             => array(
		'first_name' => '',
		'last_name'  => '',
		'company'    => '',
		'address_1'  => '',
		'address_2'  => '',
		'city'       => '',
		'state'      => '',
		'postcode'   => '',
		'country'    => '',
	),
	'payment_method'       => '',
	'payment_method_title' => '',
	'transaction_id'       => '',
	'customer_ip_address'  => '',
	'customer_user_agent'  => '',
	'created_via'          => '',
	'customer_note'        => '',
	'date_completed'       => null,
	'date_paid'            => null,
	'cart_hash'            => '',
);
additional data
array(
	'meta_data'      => $this->get_meta_data(),
	'line_items'     => $this->get_items( 'line_item' ),
	'tax_lines'      => $this->get_items( 'tax' ),
	'shipping_lines' => $this->get_items( 'shipping' ),
	'fee_lines'      => $this->get_items( 'fee' ),
	'coupon_lines'   => $this->get_items( 'coupon' ),
)

/*WC_Abstract_Order Abstract class All public functions */
$order = wc_get_order( $order_id ); // post id == order id

//Getters	
$order->get_data() // Get all class data in array format.
$order->get_base_data() // Get basic order data in array format.
$order->get_parent_id();
$order->get_currency();
$order->get_version();
$order->get_prices_include_tax();
$order->get_date_created();
$order->get_date_modified();
$order->get_status();
$order->get_discount_total();
$order->get_discount_tax();
$order->get_shipping_total();
$order->get_shipping_tax();
$order->get_cart_tax();
$order->get_total();
$order->get_total_tax();

// non CRUD getter t.e. wrapper functions
$order->get_total_discount($ex_tax = true); // Gets the total discount amount.
$order->get_subtotal(); // Gets order subtotal.
$order->get_tax_totals(); // Get taxes, merged by code, formatted ready for output

//setters - these should not update anything in the databse but only in the data arrays
$order->set_parent_id( $value );
$order->set_status( $new_status ); //Set order status
$order->update_status( $new_status, $note = '', $manual = false ); //Updates status of order immediately. Uses set_status()
$order->maybe_set_date_paid(); // Maybe set date paid.
$order->set_version( $value ); // Set order_version.
$order->set_currency( $value ); // Set order_currency.
$order->set_prices_include_tax( $value ); // Set prices_include_tax.
$order->set_date_created( $date = null );
$order->set_date_modified( $date = null );
$order->set_discount_total( $value );
$order->set_discount_tax( $value );
$order->set_shipping_total( $value );
$order->set_shipping_tax( $value );
$order->set_cart_tax( $value );
$order->set_total( $value, $deprecated = '' );

// Order item handling functions, used for products, taxes, shipping, and fees within each order
$item == product, shipping, fee, coupon, tax
$order->remove_order_items( $type = null ); // Remove all line items (products, coupons, shipping, taxes) from the order.
$order->get_items( $types = 'line_item' ); // Return an array of items/products within this order.
$order->get_coupons(); // Return an array of coupons within this order.
$order->get_fees(); // Return an array of fees within this order.
$order->get_taxes(); // Return an array of taxes within this order.
$order->get_shipping_methods(); // Return an array of shipping costs within this order.
$order->get_shipping_method(); // Gets formatted shipping method title.
$order->get_coupon_codes(); // Get used coupon codes only.
$order->get_item_count( $item_type = '' ); // Gets the count of order items of a certain type.
$order->get_item( $item_id, $load_from_db = true ); // Get an order item object, based on its type.
//must save order to persist remove/add !
$order->remove_item( $item_id ); // Remove item from the order.
$order->add_item( $item ); // Adds an order item to this order. The order item will not persist until save.
$order->hold_applied_coupons( $billing_email ); // Check and records coupon usage tentatively so that counts validation is correct
$order->apply_coupon( $raw_coupon ); // Apply a coupon to the order and recalculate totals.
$order->remove_coupon( $code ); // Remove a coupon from the order and recalculate totals.
$order->recalculate_coupons(); // Apply all coupons in this order again to all line items.
$order->add_product( $product, $qty = 1, $args = array() ); //Add a product line item to the order. This is the only line item type with its own method because it saves looking up order amounts (costs are added up for you).

//payment tokens handling - Payment tokens are hashes used to take payments by certain gateways.
$order->add_payment_token( $token ); // Add a payment token to an order
$order->get_payment_tokens(); // Returns a list of all payment tokens associated with the current order

//calculations
$order->calculate_shipping(); // Calculate shipping total.
$order->get_items_tax_classes(); // Get all tax classes for items in the order.
$order->calculate_taxes( $args = array()); // Calculate taxes for all line items and shipping, and store the totals and tax rows.
$order->get_total_fees(); // Calculate fees for all line items.
$order->update_taxes(); // Update tax lines for the order based on the line item taxes themselves.
$order->calculate_totals( $and_taxes = true ); //Calculate totals by looking at the contents of the order. Stores the totals and returns the orders final total.
get_item_subtotal( $item, $inc_tax = false, $round = true ); // Get item subtotal - this is the cost before discount.
get_line_subtotal( $item, $inc_tax = false, $round = true ); // Get line subtotal - this is the cost before discount.
get_item_total( $item, $inc_tax = false, $round = true ); // Calculate item cost - useful for gateways.
get_line_total( $item, $inc_tax = false, $round = true ); // Calculate line total - useful for gateways.
get_item_tax( $item, $round = true ); // Get item tax - useful for gateways.
get_line_tax( $item ); // Get line tax - useful for gateways.
get_formatted_line_subtotal( $item, $tax_display = '' ); // Gets line subtotal - formatted for display.

$order->get_formatted_order_total(); // Gets order total - formatted for display.
$order->get_subtotal_to_display( $compound = false, $tax_display = '' ); // Gets subtotal - subtotal is shown before discounts, but with localised taxes.
$order->get_shipping_to_display( $tax_display = '' ); // Gets shipping (formatted).
$order->get_discount_to_display( $tax_display = '' ); // Get the discount amount (formatted).

$order->get_order_item_totals( $tax_display = '' ); // Get totals for display on pages and in emails.

// booleans

$order->has_status( $status ); // Checks the order status against a passed in status.
$order->has_shipping_method( $method_id ); // Check whether this order has a specific shipping method or not.
$order->has_free_item(); // Returns true if the order contains a free product.

/*End Abstract class All public functions */

// WC_Order extending the abstract class, which is being instantiated
$order->save(); // Save all current data to the database.
$order->payment_complete( $transaction_id = '' ); //  When a payment is complete this function is called.
$order->get_status();
$order->get_discount_total();
$order->get_discount_tax();
$order->get_shipping_total();
$order->get_shipping_tax();









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
