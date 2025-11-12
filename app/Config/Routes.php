<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Search::principal');
$routes->get('/search', 'Search::index');
$routes->get('/history', 'Search::history');
$routes->get('/responses', 'Search::responses');
$routes->get('/sources', 'Search::sources');