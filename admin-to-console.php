<?php

/**
 * Plugin Name:   Admin To Console
 * Plugin URI:    https://tinypixel.io/
 * Description:   Send admin nags to the browser console.
 * Version:       1.1.0
 * Author:        Tiny Pixel Collective
 * Author URI:    https://tinypixel.io/
 * License:       MIT
 * License URI:   http://opensource.org/licenses/MIT
 */

require __DIR__ . '/vendor/autoload.php';

use TinyPixel\AdminToConsole\AdminToConsole;

(new AdminToConsole(__DIR__))();
