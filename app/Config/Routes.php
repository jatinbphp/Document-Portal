<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
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




$routes->get('/', 'Auth::login',['filter' => 'nouserauth']);
$routes->get('appAdmin', 'Auth::login',['filter' => 'nouserauth']);
$routes->get('auth/login', 'Auth::login',['filter' => 'nouserauth']);
$routes->get('logout', 'Auth::logout'); 
$routes->get('dashboard', 'Dashboard::index',['filter' => 'auth']);
$routes->get('userdashboard', 'UserDashboard::index',['filter' => 'auth']);

//useer
$routes->get('users', 'Users::index',['filter' => 'auth']);
$routes->get('users/(:any)', 'Users::$1',['filter' => 'auth']);
$routes->get('Users', 'Users::index',['filter' => 'auth']);
$routes->get('Users/(:any)', 'Users::$1',['filter' => 'auth']);

$routes->get('user_types', 'User_types::index',['filter' => 'auth']);
$routes->get('user_types/(:any)', 'User_types::$1',['filter' => 'auth']);
$routes->get('User_types', 'User_types::index',['filter' => 'auth']);
$routes->get('User_types/(:any)', 'User_types::$1',['filter' => 'auth']);

//company
$routes->get('company', 'Company::index',['filter' => 'auth']);
$routes->get('company/(:any)', 'Company::$1',['filter' => 'auth']);
$routes->get('Company', 'Company::index',['filter' => 'auth']);
$routes->get('Company/(:any)', 'Company::$1',['filter' => 'auth']);

//Document Managemant
$routes->get('documents', 'Documents::index',['filter' => 'auth']);
$routes->get('documents/(:any)', 'Documents::$1',['filter' => 'auth']);
$routes->get('Documents', 'Documents::index',['filter' => 'auth']);
$routes->get('Documents/(:any)', 'Documents::$1',['filter' => 'auth']);

//category
$routes->get('category', 'Category::index',['filter' => 'auth']);
$routes->get('category/(:any)', 'Category::$1',['filter' => 'auth']);
$routes->get('category/add', 'Category::add',['filter' => 'auth']);
$routes->get('category/(:any)', 'Category::$1',['filter' => 'auth']);

//sub-category
$routes->get('subcategory', 'SubCategory::index',['filter' => 'auth']);
$routes->get('subcategory/(:any)', 'SubCategory::$1',['filter' => 'auth']);
$routes->get('subcategory/add', 'SubCategory::add',['filter' => 'auth']);
$routes->post('subcategory/add', 'SubCategory::create',['filter' => 'auth']);
$routes->put('subcategory/update/(:any)', 'SubCategory::update/$1',['filter' => 'auth']);
$routes->get('subcategory/(:any)', 'SubCategory::$1',['filter' => 'auth']);

//Reporting
$routes->get('reporting', 'Reporting::index',['filter' => 'auth']);
$routes->get('reporting/export', 'Reporting::export',['filter' => 'auth']);
//$routes->post('reporting/getData', 'Reporting::getData',['filter' => 'auth']);

//Reporting Category
$routes->get('reporting/category', 'ReportingCategory::index',['filter' => 'auth']);



// $routes->get('invoice', 'Invoice::index',['filter' => 'auth']);
// $routes->get('invoice/(:any)', 'Invoice::$1',['filter' => 'auth']);
// $routes->get('Invoice', 'Invoice::index',['filter' => 'auth']);
// $routes->get('Invoice/(:any)', 'Invoice::$1',['filter' => 'auth']);

// $routes->get('customers', 'Customers::index',['filter' => 'auth']);
// $routes->get('customers/(:any)', 'Customers::$1',['filter' => 'auth']);
// $routes->get('Customers', 'Customers::index',['filter' => 'auth']);
// $routes->get('Customers/(:any)', 'Customers::$1',['filter' => 'auth']);

// $routes->get('createpdf', 'Createpdf::index',['filter' => 'auth']);


// $routes->get('datalist', 'Crud::index');
// $routes->get('adduser', 'Crud::create');
// $routes->post('submit-form', 'Crud::store');
// $routes->get('edituser/(:num)', 'Crud::singleUser/$1');
// $routes->post('updateuser/(:num)', 'Crud::updateuser/$1');
// $routes->get('delete/(:num)', 'Crud::delete/$1');

// $routes->get('users-list', 'UserCrud::index');
// $routes->get('user-form', 'UserCrud::create');
// $routes->post('submit-form', 'UserCrud::store');
// $routes->get('edit-view/(:num)', 'UserCrud::singleUser/$1');
// $routes->post('update', 'UserCrud::update');
// $routes->get('delete/(:num)', 'UserCrud::delete/$1');

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
