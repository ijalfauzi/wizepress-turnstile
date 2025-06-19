<?php

add_filter('admin_footer_text', 'wzp_turnstile_custom_footer_credit', 11);
function wzp_turnstile_custom_footer_credit($footer_text) {
    $screen = get_current_screen();

    if ($screen && strpos($screen->base, 'wizepress-turnstile') !== false) {
        $custom_credit = '<span style="font-style: italic;">You\'re using <a href="https://wizepress.id/plugin/wizepress-turnstile" target="_blank" style="text-decoration:underline;">WizePress Turnstile</a> v1.0.0 by <a href="https://ijalfauzi.com" target="_blank" style="text-decoration:underline;">Ijal Fauzi</a></span><br>';
        return $custom_credit . $footer_text;
    }

    return $footer_text;
}
