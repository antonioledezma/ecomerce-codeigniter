<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::home');
$routes->get('/home', 'Home::home');
$routes->get('/catalogo', 'Home::catalogo');
$routes->get('/contact', 'Home::contact');