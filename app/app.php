<?php

use Timber\Timber;

if (!isset($paged) || !$paged){
    $paged = 1;
}

$context = Timber::get_context();
$context['params']  = $params;

switch ($params['view']) {
    case 'example':
        /* Silences is gold */
        break;
}

Timber::render('app.twig', $context);
