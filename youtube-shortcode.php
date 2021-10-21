<?php
/*
Plugin Name: F13 Youtube Shortcode
Plugin URI: https://f13.dev/wordpress-plugin-youtube-shortcode/
Description: Embed a Youtube video into your blog with shortcode
Version: 2.0
Author: Jim Valentine - f13dev
Author URI: http://f13.dev
Text Domain: f13-youtube
License: GPLv3
*/

namespace F13\YouTube;

if (!function_exists('get_plugins')) require_once(ABSPATH.'wp-admin/includes/plugin.php');
if (!defined('F13_YOUTUBE')) define('F13_YOUTUBE', get_plugin_data(__FILE__, false, false));
if (!defined('F13_YOUTUBE_PATH')) define('F13_YOUTUBE_PATH', realpath(plugin_dir_path( __FILE__ )));
if (!defined('F13_YOUTUBE_URL')) define('F13_YOUTUBE_URL', plugin_dir_url(__FILE__));

class Plugin
{
    public function init()
    {
        spl_autoload_register(__NAMESPACE__.'\Plugin::loader');
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));

        $c = new Controllers\Control();
    }

    public static function loader($name)
    {
        $name = trim(ltrim($name, '\\'));
        if (strpos($name, __NAMESPACE__) !== 0) {
            return;
        }
        $file = str_replace(__NAMESPACE__, '', $name);
        $file = ltrim(str_replace('\\', DIRECTORY_SEPARATOR, $file), DIRECTORY_SEPARATOR);
        $file = plugin_dir_path(__FILE__).strtolower($file).'.php';

        if ($file !== realpath($file) || !file_exists($file)) {
            wp_die('Class not found: '.htmlentities($name));
        } else {
            require_once $file;
        }
    }

    public function enqueue()
    {
        wp_enqueue_style('f13-youtube', F13_YOUTUBE_URL.'css/youtube.css', array(), F13_YOUTUBE['Version']);
    }
}

$p = new Plugin();
$p->init();