<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/Auth/SignIn', 'Auth::index');
$routes->get('/Auth/SignUp', 'Auth::SignUp');
$routes->get('/Auth/ForgotPassword', 'Auth::ForgotPassword');
$routes->get('/', 'Shop::index');
$routes->get('/Shop', 'Shop::Shop');
$routes->get('/About', 'Shop::About');
$routes->get('/Product/(:any)', 'Shop::ProductDetail/$1');
$routes->get('/Checkout/', 'Shop::Checkout', ['filter' => 'authuser']);
$routes->post('/Checkout/AddShippingAddress', 'Shop::AddNewShippingAddress');
$routes->post('/Order', 'Shop::CreateOrder');
$routes->get('/Cart/Add/(:any)', 'Shop::CartAdd/$1');
$routes->get('/Cart/Delete/(:any)', 'Shop::CartDelete/$1');

$routes->get('/Admin/', 'Admin::index', ['filter' => 'authadmin']);
$routes->get('/Admin/Product', 'Admin::Product', ['filter' => 'authadmin']);
$routes->get('/Admin/ProductStatus/(:num)/(:any)', 'Admin::ProductStatus/$1/$2', ['filter' => 'authadmin']);
$routes->post('/Admin/Product/Add', 'Admin::AddNewProduct', ['filter' => 'authadmin']);
$routes->post('/Admin/Product/Edit', 'Admin::EditProduct', ['filter' => 'authadmin']);
$routes->get('/Admin/DetailOrder/(:any)', 'Admin::DetailOrder/$1', ['filter' => 'authadmin']);
$routes->get('/Admin/OrderStatus/(:alpha)/(:any)', 'Admin::OrderStatusUpdate/$1/$2', ['filter' => 'authadmin']);

// Routes API request via ajax
$routes->get('/api/getshippingaddress', 'Shop::GetShippingAddressData');
$routes->get('/api/updateqtyoncart', 'Shop::UpdateQtyOnCart');
$routes->get('/api/getdataproduct/(:any)', 'Admin::GetDataProduct/$1');
// Routes API request via ajax

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
