<?php
defined('ABSPATH') || exit;

require __DIR__ . '/vendor/autoload.php';

use src\Api\UserEndpoints;
use src\Api\DiscountEndpoint;

new UserEndpoints();
new DiscountEndpoint();

add_action('wp_enqueue_scripts', 'brightw_scripts');

if (!function_exists('brightw_scripts')) {
    function brightw_scripts() {
        // Storefront child theme styles
        wp_enqueue_style('brightw-child-style', get_stylesheet_uri(), ['own-shop-main'], wp_get_theme()->get('Version'));

        // bootstrap css
        wp_enqueue_style('bootstrap-styles', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css');

        // Bootstrap scripts
        wp_enqueue_script( 'bootstrap-scripts-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', [], '1', true);
    
        // custom JS
        if (is_checkout()) {
            wp_enqueue_script( 'brightw-child--scripts-js', get_theme_file_uri() . '/assets/js/checkoutModal.js', [], '1', true);
        }

        wp_enqueue_script( 'brightw-app-rele', get_theme_file_uri() . '/assets/js/app.js');

        wp_localize_script( 'brightw-app-rele', 'bw', [
            'restUrl' => rtrim(get_rest_url(), '/')
        ]);
    }
}

add_action('woocommerce_before_checkout_form', 'bw_add_checkout_modal');

// TODO put text in textdomain

if (!function_exists('bw_add_checkout_modal')) {
    function bw_add_checkout_modal()
    { 
        $checkoutModal = file_get_contents(get_theme_file_uri() . '/templates/components/checkoutModal.php');
        echo $checkoutModal;
    }
}

// better to hook into WC jquery events but they are not behaving as expected
add_filter( 'woocommerce_order_button_html', 'bw_custom_order_button_html');

if (!function_exists('bw_custom_order_button_html')) {
    function bw_custom_order_button_html($button) {

        if (is_user_logged_in()) {
            return $button;
        }

        $orderBtnText = esc_attr(__('Place order', 'woocommerce'));
        $preventDefaultSubmit = true;

        $button = <<<BTN
            <input
                type="submit"
                onClick="showCheckoutModal(event, {$preventDefaultSubmit});"
                class="button alt"
                name="woocommerce_checkout_place_order"
                id="place_order"
                value={$orderBtnText}
                data-value={$orderBtnText}
            />
        BTN;

        return $button;
    }
}