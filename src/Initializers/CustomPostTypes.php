<?php

namespace Inggo\WordPress\MBFilmFest\Initializers;

class CustomPostTypes
{
    public $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
        \add_action('init', [$this, 'initFilmsCPT']);
        \add_action('init', [$this, 'initBannersCPT']);
        \add_action('init', [$this, 'initLinksCPT']);
    }

    public function initCPT($name, $label, $icon, $image_label = 'Featured Image', $supports = ['title', 'thumbnail', 'revisions', 'page-attributes'], $label_plural = null)
    {
        $label_plural = $label_plural ?: $label . 's';

        \register_post_type('mbfilmfest_' . $name,
            array(
                'labels' => array(
                    'name'                  => \__('MBFF ' . $label_plural),
                    'singular_name'         => \__('MBFF ' . $label),
                    'add_new'               => \__( 'Add New', 'mbff' ),
                    'add_new_item'          => \__( 'Add New ' . $label, 'mbff' ),
                    'new_item'              => \__( 'New ' . $label, 'mbff' ),
                    'edit_item'             => \__( 'Edit ' . $label, 'mbff' ),
                    'view_item'             => \__( 'View ' . $label, 'mbff' ),
                    'all_items'             => \__( 'All ' . $label_plural, 'mbff' ),
                    'search_items'          => \__( 'Search ' . $label_plural, 'mbff' ),
                    'featured_image'        => \__($image_label, 'mbff'),
                    'set_featured_image'    => \__('Set ' . $image_label),
                    'remove_featured_image' => \__('Remove ' . $image_label),
                    'use_featured_image'    => \__('Use as ' . $image_label)
                ),
                'menu_icon' => $icon,
                'public' => true,
                'publicly_queryable'  => false,
                'has_archive' => false,
                'rewrite' => false,
                'show_in_rest' => true,
                'taxonomies' => array('post_tag'),
                'supports' => $supports
            )
        );
    }
    
    public function initFilmsCPT()
    {
        $this->initCPT('film', 'Film', 'dashicons-format-video', 'Splash Image');
    }
    
    public function initBannersCPT()
    {
        $this->initCPT('banner', 'Banner', 'dashicons-cover-image', 'Banner Image');
    }
    
    public function initLinksCPT()
    {
        $this->initCPT('link', 'Link', 'dashicons-admin-links', 'Logo');
    }
}
