<?php
/**
 * Mateship and Bayanihan Film Festival
 * 
 * @author          Inggo Espinosa
 * @copyright       2021 Inggo.dev
 * @license         GPLv3
 * 
 * @wordpress-plugin
 * Plugin Name:     Mateship and Bayanihan Film Festival
 * Version:         0.1.1
 * Author URI:      https://inggo.dev
 */
namespace Inggo\WordPress\MBFilmFest;

include_once(\plugin_dir_path(__FILE__) . 'Updater.php');

$updater = new Updater(__FILE__);
$updater->setUsername('inggo');
$updater->setRepository('wp-mbfilmfest');
