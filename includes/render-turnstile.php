<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Enqueue Turnstile script globally
 */
add_action('wp_enqueue_scripts', 'wzp_enqueue_turnstile_script');
add_action('login_enqueue_scripts', 'wzp_enqueue_turnstile_script');

function wzp_enqueue_turnstile_script() {
    wp_enqueue_script('cf-turnstile', 'https://challenges.cloudflare.com/turnstile/v0/api.js', [], null, true);
}

/**
 * Render Turnstile widget HTML
 */
function wzp_render_turnstile_widget() {
    $site_key = get_option('wzp_turnstile_site_key');
    if (!$site_key) {
        return;
    }

    echo '<div class="cf-turnstile" data-sitekey="' . esc_attr($site_key) . '"></div>';
}

/**
 * Inject Turnstile into standard WordPress forms
 */
add_action('comment_form_after_fields', 'wzp_render_turnstile_widget');
add_action('comment_form_logged_in_after', 'wzp_render_turnstile_widget');

add_action('login_form', 'wzp_render_turnstile_widget');
add_action('register_form', 'wzp_render_turnstile_widget');
add_action('lostpassword_form', 'wzp_render_turnstile_widget');
add_action('resetpassword_form', 'wzp_render_turnstile_widget');