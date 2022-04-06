<?php

use Timber\Timber;

$context = Timber::get_context();

Timber::render('app.twig', $context);
