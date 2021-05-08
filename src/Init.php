<?php

namespace Inggo\WordPress\MBFilmFest;

class Init
{
    public function __construct()
    {
        \add_shortcode('mbfilmfest', [$this, 'initShortcode']);
    }

    public function initShortcode()
    {
        $shortcode_frontend = "Test"; // Load plugin view file here
        return $shortcode_frontend;
    }
}
