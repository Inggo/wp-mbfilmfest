<?php

namespace Inggo\WordPress\MBFilmFest\Initializers;

class CustomFields
{
    const __SHORTCODE__ = 'mbfilmfest';
    public $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
        
        \add_action('acf/init', [$this, 'initFilmInfoCFs']);
        \add_action('acf/init', [$this, 'initMBFFSettingsCFs']);
        \add_action('acf/init', [$this, 'initBannerInfoCFs']);
    }

    public function initFilmInfoCFs()
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

    public function initMBFFSettingsCFs()
    {
        \acf_register_location_type('Inggo\WordPress\MBFilmFest\HasMBFFShortcodeLocation');

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
                    'key' => 'field_60993f1aa841b',
                    'label' => 'Show Primary Link Names',
                    'name' => 'show_primary_link_names',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
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
                array(
                    'key' => 'field_60993efca841a',
                    'label' => 'Show Secondary Link Names',
                    'name' => 'show_secondary_link_names',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
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

    public function initBannerInfoCFs()
    {
        \acf_add_local_field_group(array(
            'key' => 'group_60993a2773a9c',
            'title' => 'Banner Info',
            'fields' => array(
                array(
                    'key' => 'field_60993a2bee164',
                    'label' => 'Banner Link',
                    'name' => 'banner_link',
                    'type' => 'url',
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
                ),
                array(
                    'key' => 'field_6099444070f44',
                    'label' => 'Height',
                    'name' => 'height',
                    'type' => 'number',
                    'instructions' => 'Input the height of the banner in pixels',
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
                    'min' => 0,
                    'max' => '',
                    'step' => 1,
                ),
                array(
                    'key' => 'field_6099699044a45',
                    'label' => 'Width',
                    'name' => 'width',
                    'type' => 'number',
                    'instructions' => 'Input the width of the banner in pixels',
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
                    'min' => 0,
                    'max' => '',
                    'step' => 1,
                ),
                array(
                    'key' => 'field_6099442a70f43',
                    'label' => 'Background Color',
                    'name' => 'background_color',
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
                array(
                    'key' => 'field_60993b309bff2',
                    'label' => 'Opens in New Window',
                    'name' => 'new_window',
                    'type' => 'true_false',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'message' => '',
                    'default_value' => 1,
                    'ui' => 0,
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'mbfilmfest_banner',
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

    public function initLinkInfoCFs()
    {
        \acf_add_local_field_group(array(
            'key' => 'group_60993aef3248f',
            'title' => 'Link Info',
            'fields' => array(
                array(
                    'key' => 'field_60993afa74fe9',
                    'label' => 'Link Url',
                    'name' => 'link_url',
                    'type' => 'url',
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
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'mbff_link',
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
}