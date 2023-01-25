<?php

namespace src\Library;

defined('ABSPATH') || exit;

class CheckoutDiscount
{
    public function __construct()
    {
        add_action('woocommerce_after_checkout_billing_form', [$this, 'addCheckoutHiddenField']);
        add_action('woocommerce_cart_calculate_fees', [$this, 'addFeeToCart']);
    }

    public function addCheckoutHiddenField($checkout) {
        echo '<div id="message_fields">';
        
        woocommerce_form_field( 'trigger_discount', [
            'type'  => 'hidden',
            'name'  => 'trigger_discount'
        ], false);
    
        echo '</div>';
    }


    public function addFeeToCart()
    {
        if (isset($_POST['post_data'])) {
            parse_str($_POST['post_data'], $post_data);
        } else {
            $post_data = $_POST;
        }

        if (isset($post_data['trigger_discount']) && $post_data['trigger_discount']) {
            $fee = WC()->cart->cart_contents_total * -0.1;
            WC()->cart->add_fee('New user 10% discount', $fee);
        }
    }
}