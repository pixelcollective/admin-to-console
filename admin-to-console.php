<?php
/**
 * Plugin Name:   🙅‍ Admin To Console
 * Plugin URI:    https://tinypixel.io/
 * Description:   Send admin nags to the browser console.
 * Version:       1.0.0
 * Author:        Tiny Pixel Collective
 * Author URI:    https://tinypixel.io/
 * License:       MIT
 * License URI:   http://opensource.org/licenses/MIT
 **/

namespace TinyPixel\Plugins;

add_action(
    'plugins_loaded',
    __NAMESPACE__ .'\\admin_to_console'
);

function admin_to_console()
{
    start_logger(set_type());

    add_action(
        'all_admin_notices',
        __NAMESPACE__ .'\\log',
    );
}

function set_type()
{
    return is_user_admin()
            ? 'user_admin_notices'
            : 'admin_notices';
}

function start_logger($action)
{
    add_action(
        $action,
        function () {
            ob_start();
        }
    );
}

function log()
{
    $log = strip_tags(trim(ob_get_clean()));

    if (!$log) :
        return;
    else :
        send_to_console($log);
    endif;
}

function send_to_console($nags)
{
    add_action('wp_enqueue_scripts', function () {
        register_script();

        wp_add_inline_script(
            'admin-to-console',
            'console.log(`'. $log .'`);'
        );
    });
}
