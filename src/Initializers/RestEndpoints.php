<?php

namespace Inggo\WordPress\MBFilmFest\Initializers;

class RestEndpoints
{
    const __API_VERSION__ = 'v1';
    public $plugin;

    public function __construct($plugin)
    {
        $this->plugin = $plugin;
        \add_action('rest_api_init', [$this, 'registerRestRoutes']);
    }

    public function registerRestRoutes()
    {
        \register_rest_route(
            'mbff/' . self::__API_VERSION__,
            '/current_time',
            [
                'methods'  => 'GET',
                'callback' => [$this, 'getCurrentTime'],
                'permission_callback' => '__return_true'
            ]
        );
    }

    public function getCurrentTime()
    {
        return \current_time('c');
    }
}
