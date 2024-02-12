<?php
/*
Plugin Name: Estatik Bookings
Plugin URI: https://estatik.net/
Description: Test task for Estatik.
Version: 1.0
Author: Estatik
Author URI: https://estatik.net/
Text Domain: estatik_bookings
*/

if (!defined('ABSPATH')) exit;

define('ESTATIK_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ESTATIK_PLUGIN_URL', plugin_dir_url(__FILE__));
define('ESTATIK_PLUGIN_NAME', dirname(plugin_basename(__FILE__)));

// Register the autoload function
spl_autoload_register('estatik_autoload');
function estatik_autoload($class_name) {
    $base_dir = ESTATIK_PLUGIN_DIR . 'src/';
    $prefix = 'Estatik\\';
    $len = strlen($prefix);

    if (strncmp($prefix, $class_name, $len) !== 0) {
        return;
    }

    $relative_class = substr($class_name, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
}

/**
 * Require plugin files
 */
require_once('init/register-post-types.php');
require_once('inc/helpers.php');
require_once('init/metaboxes.php');
require_once('init/filters.php');

/**
 * Enqueue scripts
 */
add_action('admin_enqueue_scripts', 'estatik_enqueue_scripts');
function estatik_enqueue_scripts() {
    // Datepicker
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-ui-datepicker-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    // Estatik styles
    wp_enqueue_style('estatik-styles', ESTATIK_PLUGIN_URL . 'assets/style.css');
    // Estatik scripts
    wp_enqueue_script( 'estatik-scripts', ESTATIK_PLUGIN_URL . 'assets/script.js', ['jquery'], null, true );
}
