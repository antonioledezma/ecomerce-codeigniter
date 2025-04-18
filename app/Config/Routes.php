<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PublicController::principal');
$routes->get('/principal', 'PublicController::principal');
$routes->get('/home', 'PublicController::principal');
$routes->get('/comercializacion', 'PublicController::comercializacion');
$routes->get('/informacion-de-contacto', 'PublicController::informacionDeContacto');
$routes->get('/quienes-somos', 'PublicController::quienesSomos');
$routes->get('/terminos-y-uso', 'PublicController::terminosYUso');
$routes->get('/product', 'PublicController::productDetail');

/*
1. Principal (proyecto1)
2. Quienes Somos (proyecto 1)
3. Comercialización (proyecto1)
4. Información de Contactos (proyecto 1)
5. Términos y Usos (proyecto 1)

6. Catálogo de productos (proyecto 2)
7. Consultas (proyecto2)
*/
