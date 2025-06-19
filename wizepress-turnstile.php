<?php
/**
 * Plugin Name: WP Turnstile by WizePress
 * Plugin URI: https://wizepress.id/plugin/wizepress-turnstile
 * Description: Add Cloudflare Turnstile to WordPress forms — simple, secure, lightweight.
 * Version: 1.0.0
 * Author: Ijal Fauzi
 * Author URI: https://ijalfauzi.com
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wizepress-turnstile
 * Domain Path: /languages
 * Requires at least: 5.6
 * Requires PHP: 7.4
 * 
 * @package WizePress_Turnstile
 */

defined('ABSPATH') || exit;

define('WZP_TURNSTILE_VERSION', '1.0.0');
define('WZP_TURNSTILE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WZP_TURNSTILE_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include core files
require_once WZP_TURNSTILE_PLUGIN_DIR . 'includes/settings-page.php';
require_once WZP_TURNSTILE_PLUGIN_DIR . 'includes/render-turnstile.php';
require_once WZP_TURNSTILE_PLUGIN_DIR . 'includes/verify-turnstile.php';
require_once WZP_TURNSTILE_PLUGIN_DIR . 'includes/admin-footer.php';

