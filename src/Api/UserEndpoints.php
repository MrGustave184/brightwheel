<?php

namespace src\Api;

defined('ABSPATH') || exit;

class UserEndpoints
{
    public function __construct()
    {
        add_action ('rest_api_init', [$this, 'routes']);
    }

    public function routes()
    {
        register_rest_route( 'bw/v1', '/users', [
            'methods' => 'POST',
            'callback' => [$this, 'createUser'],
            'permission_callback' => '__return_true'
        ]);
    }

    public function createUser(\WP_REST_Request $request)
    {
        $user = $request->get_json_params();
        $user['role'] = 'customer';

        // quick way for some validation
        // better to add more but short on time
        $userId = wp_insert_user($user);

        // login user
        // wp_set_current_user($userId, $user['user_login']);
        // wp_set_auth_cookie($userId);
        // do_action('wp_login', $user['user_login']);

        return new \WP_REST_Response([
            'res' => $userId
        ]);
    }
}