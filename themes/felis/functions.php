<?php
/**
 * Cactus Functions and Definitions
 *
 * @package cactus
 */

require get_parent_theme_file_path('/app/theme.php');

/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */

function sww_add_account_refund_order_action( $actions, $order ) {

    if ( $order->is_paid() ) {
        $actions['refund_request'] = array(
            'url'  => sww_get_order_refund_request_url( $order ),
            'name' => __( 'Request Return', 'woocommerce' ),
        );
    }

    return $actions;
}
add_filter( 'woocommerce_my_account_my_orders_actions', 'sww_add_account_refund_order_action', 10, 2 );


function sww_get_order_refund_request_url( $order ) {

    // enter the ID for your page that contains the refund request form
    $page_id = 3629;

    // now we'll build the right refund URL from it
    $refund_url = trailingslashit( get_page_link( $page_id ) ) . '?order=' . $order->get_order_number();
    return $refund_url;
}


// adds notice at single product page above add to cart
add_action( 'woocommerce_single_product_summary', 'return_policy', 20 );
function return_policy() {
echo '<p style="color:#999">30-day return policy offered. <a href="#">See Terms and Conditions</a> for details.</p>';
}


function wc_empty_cart_redirect_url() {
	return ('http://storefront.dev/');
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');


function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();

add_filter( 'add_to_cart_text', 'woo_custom_single_add_to_cart_text' );                // < 2.1
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' );  // 2.1 +
  
function woo_custom_single_add_to_cart_text() {
  
    return __( 'Checkout', 'woocommerce' );
  
}    
?>
<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
<?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}




