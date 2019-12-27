
<?php
/*WC Order related methods used in gateways */
$order->get_id(); // post id == order id
$order->get_order_key();// ?
$order = wc_get_order( $order_id ); // get order by id
$order->get_payment_method(); // get the payment method id
$order->set_transaction_id( $transaction );
$order->get_transaction_id(); // transaction id
$order->get_order_number()
$order->get_cancel_order_url_raw()
$order->get_currency()
WC_Payment_Gateway::get_transaction_url( $order );
// We have an invalid $order_id, probably because invoice_prefix has changed.
$order_id = wc_get_order_id_by_order_key( $order_key );
$order->has_status( wc_get_is_paid_statuses() ) // ?
//update status of an order and add note
$order->update_status( 'on-hold', sprintf( __( 'Validation error: PayPal currencies do not match (code %s).', 'woocommerce' ), $currency ) );
// add order notes
$order->add_order_note(
					/* translators: 1: Refund amount, 2: Refund ID */
					sprintf( __( 'Refunded %1$s - Refund ID: %2$s', 'woocommerce' ), $result->GROSSREFUNDAMT, $result->REFUNDTRANSACTIONID ) // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar
				);
$order->needs_payment()

//meta
$order->add_meta_data( 'PayPal Transaction Fee', wc_clean( $posted['mc_fee'] ) );
$order->get_meta( '_paypal_status', true )  // geta meta of an order
update_post_meta( $order->get_id(), '_paypal_status', $result->PAYMENTSTATUS );
  
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
>?
