<?php

namespace Inggo\WordPress\MBFilmFest;

class Init
{
    const __SHORTCODE__ = 'mbfilmfest';
    public $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;

        new Initializers\CustomPostTypes($this->plugin);
        new Initializers\CustomFields($this->plugin);
        new Initializers\Shortcodes($this->plugin);
        new Initializers\RestEndpoints($this->plugin);
    }
}
