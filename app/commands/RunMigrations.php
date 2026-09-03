<?php
class RunMigrations
{
    public static $command = 'run:migrations';
    public static $description = 'Run all pending database migrations';
    public static $arguments = [];

    public function handle($input = null, array $flags = [])
    {
        if (!defined('PREVENT_DIRECT_ACCESS')) {
            define('PREVENT_DIRECT_ACCESS', TRUE);
        }

        if (!defined('ROOT_DIR')) {
            define('ROOT_DIR', dirname(__DIR__, 2) . DIRECTORY_SEPARATOR);
        }

        if (!defined('SYSTEM_DIR')) {
            define('SYSTEM_DIR', ROOT_DIR . 'scheme' . DIRECTORY_SEPARATOR);
        }

        require_once SYSTEM_DIR . 'kernel/LavaLust.php';

        $lava = lava_instance();
        $lava->call->library('migration');
        $lava->migration->migrate();
    }
}