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
        \add_action('init', [$this, 'initCPTs']);
        \add_action('acf/init', [$this, 'initCFs']);
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
            '0.3.0',
            true
        );
        \wp_register_script(
            'mbfilmfest',
            \plugins_url('dist/js/app.js', $this->plugin->plugin_dir),
            ['vue_runtime', 'mbfilmfest_vendors'],
            '0.3.0',
            true
        );

        \wp_register_style(
            'mbfilmfest',
            \plugins_url('/dist/css/app.css', $this->plugin->plugin_dir),
            [],
            '0.3.0'
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
        ob_start();
        require(__DIR__ . '/../views/shortcode.php'); // Load plugin view file here
        $shortcode_frontend = ob_get_contents();
        ob_end_clean();
        return $shortcode_frontend;
    }
    
    public function initCPTs()
    {
        \register_post_type('mbfilmfest_film',
            array(
                'labels' => array(
                    'name'                  => \__('MBFF Films'),
                    'singular_name'         => \__('MBFF Film'),
                    'add_new'               => \__( 'Add New', 'textdomain' ),
                    'add_new_item'          => \__( 'Add New Film', 'textdomain' ),
                    'new_item'              => \__( 'New Film', 'textdomain' ),
                    'edit_item'             => \__( 'Edit Film', 'textdomain' ),
                    'view_item'             => \__( 'View Film', 'textdomain' ),
                    'all_items'             => \__( 'All Films', 'textdomain' ),
                    'search_items'          => \__( 'Search Films', 'textdomain' ),
                    'featured_image'        => \__('Splash Image'),
                    'set_featured_image'    => \__('Set splash image'),
                    'remove_featured_image' => \__('Remove splash image'),
                    'use_featured_image'    => \__('Use as splash image')
                ),
                'menu_icon' => 'dashicons-format-video',
                'public' => true,
                'has_archive' => false,
                'rewrite' => false,
                'show_in_rest' => true,
                'taxonomies' => array('post_tag'),
                'supports' => array('title', 'thumbnail', 'revisions', 'page-attributes')
            )
        );
    }

    public function initCFs()
    {
        \acf_add_local_field_group(array(
            'key' => 'group_1',
            'title' => 'Film Info',
            'fields' => array (
                array (
                    'key' => 'field_1',
                    'label' => 'Description',
                    'name' => 'description',
                    'type' => 'textarea',
                ),
                array (
                    'key' => 'field_2',
                    'label' => 'Embed Code',
                    'name' => 'embed_code',
                    'type' => 'textarea',
                    'new_lines' => ''
                )
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'mbfilmfest_film',
                    ),
                ),
            ),
        ));
    }
}
