<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Verify Turnstile token
 */
function wzp_verify_turnstile_token() {
    if (empty($_POST['cf-turnstile-response'])) {
        return false;
    }

    $secret_key = get_option('wzp_turnstile_secret_key');
    $response = sanitize_text_field($_POST['cf-turnstile-response']);

    $remote_ip = $_SERVER['REMOTE_ADDR'] ?? '';

    $verify = wp_remote_post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
        'body' => [
            'secret'   => $secret_key,
            'response' => $response,
            'remoteip' => $remote_ip,
        ],
    ]);

    if (is_wp_error($verify)) {
        return false;
    }

    $body = json_decode(wp_remote_retrieve_body($verify), true);
    return isset($body['success']) && $body['success'] === true;
}

/**
 * Hook into form submissions to validate Turnstile
 */

// Comment submission
add_filter('preprocess_comment', function ($commentdata) {
    if (!wzp_verify_turnstile_token()) {
        wp_die(__('Cloudflare Turnstile verification failed. Please try again.', 'wizepress-turnstile'));
    }
    return $commentdata;
});

// Login form
add_filter('wp_authenticate_user', function ($user) {
    if (!wzp_verify_turnstile_token()) {
        return new WP_Error('turnstile_error', __('Cloudflare Turnstile verification failed.', 'wizepress-turnstile'));
    }
    return $user;
}, 10, 1);

// Register form
add_filter('registration_errors', function ($errors, $sanitized_user_login, $user_email) {
    if (!wzp_verify_turnstile_token()) {
        $errors->add('turnstile_error', __('Cloudflare Turnstile verification failed.', 'wizepress-turnstile'));
    }
    return $errors;
}, 10, 3);

// Lost/Reset password forms
add_action('validate_password_reset', function ($errors, $user) {
    if (!wzp_verify_turnstile_token()) {
        $errors->add('turnstile_error', __('Cloudflare Turnstile verification failed.', 'wizepress-turnstile'));
    }
}, 10, 2);
