<?php

namespace Inggo\WordPress\MBFilmFest;

class Plugin
{
    public $plugin_dir;

    public function __construct($plugin_dir)
    {
        $this->plugin_dir = $plugin_dir;
    }
}