<?php
// If uninstall not called from WordPress, exit
defined('WP_UNINSTALL_PLUGIN') || exit;

// Clean up plugin options
delete_option('wzp_turnstile_site_key');
delete_option('wzp_turnstile_secret_key');
delete_option('wzp_turnstile_theme');
