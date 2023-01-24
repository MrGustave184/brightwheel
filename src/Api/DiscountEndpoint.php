<?php

namespace src\Api;

defined('ABSPATH') || exit;
// require_once( WC_ABSPATH . 'includes/wc-cart-functions.php' );
// require_once( WC_ABSPATH . 'includes/wc-notice-functions.php' );

class DiscountEndpoint
{
    public function __construct()
    {
        add_action ('rest_api_init', [$this, 'routes']);
    }

    public function routes()
    {
        register_rest_route( 'bw/v1', '/discount', [
            'methods' => 'POST',
            'callback' => [$this, 'applyDiscount'],
            'permission_callback' => '__return_true'
        ]);
    }

    public function applyDiscount(\WP_REST_Request $request)
    {
        global $woocommerce;

        add_action('woocommerce_cart_calculate_fees', [$this, 'add_cart_fee_discount']);

        return new \WP_REST_Response([
            'res' => 'success',
            'cart' => WC()->cart
        ]);
    }

    function add_cart_fee_discount()
    {
        global $woocommerce;
        $fee = WC()->cart->cart_contents_total * 0.1;
        $woocommerce->cart->add_fee(__('Discount', 'woocommerce'), $fee);
    }
}