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
 * Version:         0.1.3
 * Author:          Inggo Espinosa
 * Author URI:      https://inggo.dev
 * License:         GPLv3
 * License URI:     https://www.gnu.org/licenses/quick-guide-gplv3.html
 * Text Domain:     mb-filmfest
 */

include_once(\plugin_dir_path(__FILE__) . 'Updater.php');

$updater = new Updater(__FILE__);
$updater->setUsername('inggo');
$updater->setRepository('wp-mbfilmfest');
