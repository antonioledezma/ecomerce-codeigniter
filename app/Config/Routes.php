<?php

/** COMMON */
$routes->get('/', "CommonController::principal");
$routes->get('/principal', "CommonController::principal");
$routes->get('/home', "CommonController::principal");
$routes->get('/comercializacion', 'CommonController::comercializacion');
$routes->get('/informacion-de-contacto', 'CommonController::informacionDeContacto');
$routes->get('/quienes-somos', 'CommonController::quienesSomos');
$routes->get('/terminos-y-uso', 'CommonController::terminosYUso');
$routes->get('/product', 'CommonController::productDetail');
$routes->get('/catalogo', 'CommonController::catalogo');

/** SESSION */
$routes->post('/session/login', 'SessionController::login');
$routes->post('/session/register', 'SessionController::register');
$routes->get('/session/logout', 'SessionController::logout');
$routes->get('/session/login', 'SessionController::loginPage');
$routes->get('/session/register', 'SessionController::registerPage');

/** ADMIN */
$routes->get('/admin/panel', 'AdminController::panel');
$routes->post('/admin/update/(:num)', 'AdminController::update/$1');
$routes->get('/admin/delete/(:num)', 'AdminController::delete/$1');
$routes->get('/admin/create', 'AdminController::create');

/** CART */
$routes->post('/cart/add', 'CardController::add');