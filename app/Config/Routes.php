<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
define('PAGE_PRINCIPAL_HANDLER', 'PageController::principal');

$routes->get('/', PAGE_PRINCIPAL_HANDLER);
$routes->get('/principal', PAGE_PRINCIPAL_HANDLER);
$routes->get('/home', PAGE_PRINCIPAL_HANDLER);

$routes->get('/comercializacion', 'PageController::comercializacion');

$routes->get('/informacion-de-contacto', 'PageController::informacionDeContacto');

$routes->get('/quienes-somos', 'PageController::quienesSomos');

$routes->get('/terminos-y-uso', 'PageController::terminosYUso');

$routes->get('/product', 'PageController::productDetail');

$routes->get('/catalogo', 'PageController::catalogo');


/** API */
$routes->get('/api/v1/product', 'ProductController::findAll');
$routes->get('/api/v1/product/(:num)', 'ProductController::findById/$1');

/*
1. Principal (proyecto1)
2. Quienes Somos (proyecto 1)
3. Comercialización (proyecto1)
4. Información de Contactos (proyecto 1)
5. Términos y Usos (proyecto 1)

6. Catálogo de productos (proyecto 2)
7. Consultas (proyecto2)
*/
