<?php

namespace TinyPixel\AdminToConsole;

use function \wp_get_current_user;
use function \register_script;
use function \wp_enqueue_script;
use \WP_User;

/**
 * Admin to Console
 */
class AdminToConsole
{
    /**
     * User object
     *
     * @var \WP_User
     */
    protected $user;

    /**
     * Script path.
     *
     * @var string
     */
    protected static $scriptPath;

    /**
     * Class constructor
     *
     * @param string $baseDir
     */
    public function __construct(string $baseDir)
    {
        self::$scriptPath = "{$baseDir}/dist/write-to-console.js";
    }

    /**
     * Class invocation.
     *
     * @return void
     */
    public function __invoke() : void
    {
        $noticeHook = $this->noticeAction();

        add_action($noticeHook, [$this, 'startBuffer']);
        add_action('all_admin_notices', [$this, 'writeToConsole']);
    }

    /**
     * Returns notification hook appropriate for current user.
     *
     * @return string
     */
    public function noticeAction() : string
    {
        return is_user_admin()
            ? 'user_admin_notices'
            : 'admin_notices';
    }

    /**
     * Start buffer.
     *
     * @return void
     */
    public function startBuffer() : void
    {
        ob_start();
    }

    /**
     * Write log to inline script.
     *
     * @return void
     */
    public function writeToConsole() : void
    {
        if (!$this->log = strip_tags(trim(ob_get_clean()))) {
            return;
        }

        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_script('admin-to-console', self::$scriptPath, []);

            wp_localize_script('admin-to-console', 'adminToConsole', [
                'log' => $this->log,
            ]);
        });
    }
}
