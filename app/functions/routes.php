<?php

use Timber\Timber;

Routes::map('events', function($routeParams) {
    $params = [
        'route' => $routeParams,
        'view'  => 'events',
    ];

    Routes::load('app.php', $params, "", 200);
});
