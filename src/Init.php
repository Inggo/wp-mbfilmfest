<?php

namespace Inggo\WordPress\MBFilmFest;

class Init
{
    const __SHORTCODE__ = 'mbfilmfest';
    public $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
        \add_action('wp_enqueue_scripts', [$this, 'initShortcodeScripts']);
        \add_shortcode(self::__SHORTCODE__, [$this, 'initShortcode']);
    }

    public function initShortcodeScripts()
    {
        \wp_register_script(
            'vue_runtime',
            'https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js',
            [],
            '2.6.12'
        );
        \wp_register_script(
            'mbfilmfest_vendors',
            \plugins_url('dist/js/chunk-vendors.js', $this->plugin->plugin_dir),
            ['vue_runtime'],
            '0.2.0',
            true
        );
        \wp_register_script(
            'mbfilmfest',
            \plugins_url('dist/js/app.js', $this->plugin->plugin_dir),
            ['vue_runtime', 'mbfilmfest_vendors'],
            '0.2.0',
            true
        );

        \wp_register_style(
            'mbfilmfest',
            \plugins_url('/dist/css/app.css', $this->plugin->plugin_dir),
            [],
            '0.2.0'
        );

        global $post;

        if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, self::__SHORTCODE__))
        {
            \add_filter('body_class', [$this, 'bodyClassFilter']);
            \wp_enqueue_style('mbfilmfest');
            \wp_enqueue_script('mbfilmfest');
        }
    }

    public function bodyClassFilter($classes)
    {
        $classes[] = 'has-mbfilmfest-shortcode';
        return $classes;
    }

    public function initShortcode()
    {
        $shortcode_frontend = file_get_contents(__DIR__ . '/../views/shortcode.php'); // Load plugin view file here
        return $shortcode_frontend;
    }
}
