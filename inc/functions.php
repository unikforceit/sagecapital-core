<?php
function sage_add_login_check()
{
    if ( is_user_logged_in() && is_page(594) ) {
        wp_redirect(site_url() . '/dashboard');
        exit;
    }
    if ( !is_user_logged_in() && is_page(596) ) {
        wp_redirect(site_url() . '/login');
        exit;
    }
}

add_action('wp', 'sage_add_login_check');

add_filter( 'login_redirect', 'sage_login_redirect', 10, 3 );

function sage_login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {
        if ( in_array( 'subscriber', $user->roles )) {
            $redirect_to = home_url("dashboard");
        }
    }
    return $redirect_to;
}
function sage_get_subscriber_meta() {
    // Get all users with the role 'subscriber'
    $subscribers = get_users(array('role' => 'subscriber'));

    // Initialize an array to store user meta data
    $user_meta_array = array();

    // Check if there are subscribers
    if (!empty($subscribers)) {
        // Loop through each subscriber
        foreach ($subscribers as $subscriber) {
            // Get user ID
            $user_id = $subscriber->ID;

            // Get all user meta data
            $user_meta = get_user_meta($user_id);

            // Add user meta data to the array
            $user_meta_array[$user_id] = $user_meta;
        }
    }

    return $user_meta_array;
}
