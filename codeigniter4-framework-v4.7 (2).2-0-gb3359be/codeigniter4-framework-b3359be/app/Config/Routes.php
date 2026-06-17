<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');

$routes->get('login', 'LoginController::index');
$routes->post('login/connexion', 'LoginController::connexion');
$routes->get('logout', 'LoginController::logout');

$routes->get('caisse', 'CaisseController::index');
$routes->post('caisse/choisir', 'CaisseController::choisir');

$routes->get('achat', 'AchatController::index');
$routes->post('achat/ajouter', 'AchatController::ajouterProduit');
$routes->post('achat/cloturer', 'AchatController::cloturer');
