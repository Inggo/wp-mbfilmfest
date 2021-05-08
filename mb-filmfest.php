<?php
namespace Inggo\WordPress\MBFilmFest;

/**
 * Mateship and Bayanihan Film Festival
 * 
 * @author          Inggo Espinosa
 * @copyright       2021 Inggo.dev
 * @license         GPLv3
 * 
 * @wordpress-plugin
 * Plugin Name:     Mateship and Bayanihan Film Festival
 * Version:         0.1.5
 * Author:          Inggo Espinosa
 * Author URI:      https://inggo.dev
 * License:         GPLv3
 * License URI:     https://www.gnu.org/licenses/quick-guide-gplv3.html
 * Text Domain:     mb-filmfest
 */

spl_autoload_register(__NAMESPACE__ . "\autoloader");

function autoloader($class_name)
{
    $classes_dir = realpath(\plugin_dir_path(__FILE__ )) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
    $class_file = str_replace('_', DIRECTORY_SEPARATOR, $class_name) . '.php';
    require_once $classes_dir . $class_file;
}

// Check for updates
$updater = new Updater(__FILE__);
$updater->setUsername('inggo');
$updater->setRepository('wp-mbfilmfest');

// Initialize plugin
new Init();
