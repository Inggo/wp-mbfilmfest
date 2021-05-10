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
        \add_action('acf/init', [$this, 'initAdminCFs']);
    }

    public function initSettingsPage()
    {
        require(__DIR__ . '/../views/settings.php'); // Load plugin view file here
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
            '0.3.1',
            true
        );
        \wp_register_script(
            'mbfilmfest',
            \plugins_url('dist/js/app.js', $this->plugin->plugin_dir),
            ['vue_runtime', 'mbfilmfest_vendors'],
            '0.3.1',
            true
        );

        \wp_register_style(
            'mbfilmfest',
            \plugins_url('/dist/css/app.css', $this->plugin->plugin_dir),
            [],
            '0.3.1'
        );

        global $post;

        if (is_a($post, 'WP_Post') && \has_shortcode($post->post_content, self::__SHORTCODE__))
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
                'publicly_queryable'  => false,
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
            'key' => 'group_60991f9d3c7f2',
            'title' => 'Film Info',
            'fields' => array(
                array(
                    'key' => 'field_609922967bb80',
                    'label' => 'Screening Time',
                    'name' => 'screening_time',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_60991f9f6af70',
                    'label' => 'Description',
                    'name' => 'description',
                    'type' => 'textarea',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => 4,
                    'new_lines' => 'br',
                ),
                array(
                    'key' => 'field_609923ac7bb83',
                    'label' => 'Video oEmbed',
                    'name' => 'video_oembed',
                    'type' => 'oembed',
                    'instructions' => 'Input the URL of the video below to generate the oEmbed code',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'width' => '',
                    'height' => '',
                ),
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
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
    }

    public function initAdminCFs()
    {
        \acf_register_location_type(__NAMESPACE__ . '\\HasMBFFShortcodeLocation');

        \acf_add_local_field_group(array(
            'key' => 'group_609923e053989',
            'title' => 'MBFF Settings',
            'fields' => array(
                array(
                    'key' => 'field_609923e667287',
                    'label' => 'Primary Banners Tag Filter',
                    'name' => 'primary_banners_tag_filter',
                    'type' => 'taxonomy',
                    'instructions' => 'Select the tags used by the MBFF Banners to be displayed at the top of the page (header banner images)',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'taxonomy' => 'post_tag',
                    'field_type' => 'select',
                    'allow_null' => 0,
                    'add_term' => 1,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'id',
                    'multiple' => 0,
                ),
                array(
                    'key' => 'field_6099257d67294',
                    'label' => 'Secondary Banners Tag Filter',
                    'name' => 'secondary_banners_tag_filter',
                    'type' => 'taxonomy',
                    'instructions' => 'Select the tag used by the MBFF Banners to be displayed at the top of the page (secondary banner images)',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'taxonomy' => 'post_tag',
                    'field_type' => 'select',
                    'allow_null' => 0,
                    'add_term' => 1,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'id',
                    'multiple' => 0,
                ),
                array(
                    'key' => 'field_6099242667288',
                    'label' => 'Primary Links Title',
                    'name' => 'primary_links_title',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Sip Promo',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_6099243f67289',
                    'label' => 'Primary Links Description',
                    'name' => 'primary_links_description',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_609924626728b',
                    'label' => 'Primary Links Format',
                    'name' => 'primary_links_format',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'default' => 'Default Style',
                        'instax' => 'Instax Style',
                    ),
                    'default_value' => 'instax',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_6099255367293',
                    'label' => 'Primary Links Tag Filter',
                    'name' => 'primary_links_tag_filter',
                    'type' => 'taxonomy',
                    'instructions' => 'Select the tag used by the MBFF Links to filter in this section',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'taxonomy' => 'post_tag',
                    'field_type' => 'select',
                    'allow_null' => 0,
                    'add_term' => 0,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'object',
                    'multiple' => 0,
                ),
                array(
                    'key' => 'field_6099252667291',
                    'label' => 'Primary Links Background Color',
                    'name' => 'primary_links_background_color',
                    'type' => 'color_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '#efe1f9',
                ),
                array(
                    'key' => 'field_6099245b6728a',
                    'label' => 'Secondary Links Title',
                    'name' => 'secondary_links_title',
                    'type' => 'text',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => 'Partners',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'maxlength' => '',
                ),
                array(
                    'key' => 'field_609924aa6728c',
                    'label' => 'Secondary Links Description',
                    'name' => 'secondary_links_description',
                    'type' => 'wysiwyg',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_609924b86728d',
                    'label' => 'Secondary Links Format',
                    'name' => 'secondary_links_format',
                    'type' => 'select',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'choices' => array(
                        'default' => 'Default Style',
                        'instax' => 'Instax Style',
                    ),
                    'default_value' => 'default',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 0,
                    'return_format' => 'value',
                    'ajax' => 0,
                    'placeholder' => '',
                ),
                array(
                    'key' => 'field_6099251867290',
                    'label' => 'Secondary Links Tag Filter',
                    'name' => 'secondary_links_tag_filter',
                    'type' => 'taxonomy',
                    'instructions' => 'Select the tag used by the MBFF Links to filter in this section',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'taxonomy' => 'post_tag',
                    'field_type' => 'select',
                    'allow_null' => 0,
                    'add_term' => 0,
                    'save_terms' => 0,
                    'load_terms' => 0,
                    'return_format' => 'object',
                    'multiple' => 0,
                ),
                array(
                    'key' => 'field_6099253a67292',
                    'label' => 'Secondary Links Background Color',
                    'name' => 'secondary_links_background_color',
                    'type' => 'color_picker',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'default_value' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'has_mbff_shortcode',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'acf_after_title',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));        
    }
}
