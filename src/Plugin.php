<?php

namespace Inggo\WordPress\MBFilmFest;

class Plugin
{
    public $version;
    public $plugin_dir;

    public function __construct($plugin_dir, $version)
    {
        $this->plugin_dir = $plugin_dir;
        $this->version = $version;
    }
}
