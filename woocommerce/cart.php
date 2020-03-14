
// his function is the last point for ad to cart
add_to_cart_action()
{
  self::add_to_cart_handler_simple( $product_id )
  {
        WC()->cart->add_to_cart( $product_id, $quantity )
        {
            
        }
  }

}

