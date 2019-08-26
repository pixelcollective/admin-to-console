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

(new class {
    /**
     * Invoke class.
     *
     * @return void
     */
    public function __invoke() : void
    {
        add_action('admin_notices', [$this, 'startBuffer']);

        add_action('user_admin_notices', [$this, 'startBuffer']);

        add_action('all_admin_notices', [$this, 'processNotices']);
    }

    /**
     * Start buffer
     */
    public function startBuffer()
    {
        ob_start();
    }

    /**
     * Process admin notifications
     *
     * @return string
     */
    public function processNotices()
    {
        $notices = trim(strip_tags(ob_get_clean()));

        if (! $notices) {
            $notices = 'No admin notices';
        }

        $this->consoleOutput($notices);
    }

    /**
     * Console output
     */
    public function consoleOutput(string $bufferOut)
    {
        wp_register_script('admin-to-console', '');
        wp_enqueue_script('admin-to-console');
        wp_add_inline_script('admin-to-console', 'console.log(`'. $bufferOut .'`);');
    }
})();
