<?php
// Exit if accessed directly
defined('ABSPATH') || exit;

/**
 * Register settings menu
 */
add_action('admin_menu', function () {
    add_options_page(
        'WP Turnstile Settings',
        'Turnstile',
        'manage_options',
        'wizepress-turnstile',
        'wzp_render_turnstile_settings_page'
    );
});

/**
 * Register settings
 */
add_action('admin_init', function () {
    register_setting('wzp_turnstile_settings', 'wzp_turnstile_site_key');
    register_setting('wzp_turnstile_settings', 'wzp_turnstile_secret_key');
    register_setting('wzp_turnstile_settings', 'wzp_turnstile_theme');
});

/**
 * Render settings page
 */
function wzp_render_turnstile_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('WP Turnstile Settings', 'wizepress-turnstile'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wzp_turnstile_settings');
            do_settings_sections('wzp_turnstile_settings');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e('Site Key', 'wizepress-turnstile'); ?></th>
                    <td>
                        <input type="text" name="wzp_turnstile_site_key" class="regular-text" value="<?php echo esc_attr(get_option('wzp_turnstile_site_key')); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Secret Key', 'wizepress-turnstile'); ?></th>
                    <td>
                        <input type="text" name="wzp_turnstile_secret_key" class="regular-text" value="<?php echo esc_attr(get_option('wzp_turnstile_secret_key')); ?>" />
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Theme', 'wizepress-turnstile'); ?></th>
                    <td>
                        <select name="wzp_turnstile_theme">
                            <?php
                            $current = get_option('wzp_turnstile_theme', 'auto');
                            $themes = ['auto' => 'Auto', 'light' => 'Light', 'dark' => 'Dark'];
                            foreach ($themes as $value => $label) {
                                echo '<option value="' . esc_attr($value) . '" ' . selected($current, $value, false) . '>' . esc_html($label) . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
