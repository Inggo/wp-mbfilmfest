<?php

namespace Inggo\WordPress\MBFilmFest;

class HasMBFFShortcodeLocation extends \ACF_Location {
    const __SHORTCODE__ = 'mbfilmfest';
    
    public function initialize() {
        $this->name = 'has_mbff_shortcode';
        $this->label = \__("Has MBFF Shortcode");
        $this->category = 'post';
        $this->object_type = 'post';
    }

    public function match($rule, $screen, $field_group) {
        if (!isset($screen['post_id'])) {
            return false;
        }

        $post_id = $screen['post_id'];

        $post = get_post( $post_id );

        if (!$post) {
            return false;
        }

        $result = \has_shortcode($post->post_content, self::__SHORTCODE__);

        return $rule['operator'] == '==' ? $result : !$result;
    }

    public function get_values($rule) {
        return array(
            1 => 'Yes',
            0 => 'No'
        );
    }
}
