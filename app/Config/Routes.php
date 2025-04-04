<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::principal');
$routes->get('/principal', 'Home::principal');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');