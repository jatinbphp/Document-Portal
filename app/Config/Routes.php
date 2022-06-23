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
$routes->get('dashboard', 'Dashboard::index',['filter' => 'adminauth']);
$routes->get('userdashboard', 'UserDashboard::index',['filter' => 'auth']);

//useer
$routes->get('users', 'Users::index',['filter' => 'adminauth']);
$routes->get('users/(:any)', 'Users::$1',['filter' => 'adminauth']);
$routes->get('Users', 'Users::index',['filter' => 'adminauth']);
$routes->get('Users/(:any)', 'Users::$1',['filter' => 'adminauth']);

$routes->get('user_types', 'User_types::index',['filter' => 'adminauth']);
$routes->get('user_types/(:any)', 'User_types::$1',['filter' => 'adminauth']);
$routes->get('User_types', 'User_types::index',['filter' => 'adminauth']);
$routes->get('User_types/(:any)', 'User_types::$1',['filter' => 'adminauth']);

//company
$routes->get('company', 'Company::index',['filter' => 'adminauth']);
$routes->get('company/(:any)', 'Company::$1',['filter' => 'adminauth']);
$routes->get('Company', 'Company::index',['filter' => 'adminauth']);
$routes->get('Company/(:any)', 'Company::$1',['filter' => 'adminauth']);

//Document Managemant
$routes->get('documents', 'Documents::index',['filter' => 'adminauth']);
$routes->get('documents/(:any)', 'Documents::$1',['filter' => 'adminauth']);
$routes->get('Documents', 'Documents::index',['filter' => 'adminauth']);
$routes->get('Documents/(:any)', 'Documents::$1',['filter' => 'adminauth']);

//category
$routes->get('category', 'Category::index',['filter' => 'adminauth']);
$routes->get('category/(:any)', 'Category::$1',['filter' => 'adminauth']);
$routes->get('category/add', 'Category::add',['filter' => 'adminauth']);
$routes->get('category/(:any)', 'Category::$1',['filter' => 'adminauth']);

//sub-category
$routes->get('subcategory', 'SubCategory::index',['filter' => 'adminauth']);
$routes->get('subcategory/(:any)', 'SubCategory::$1',['filter' => 'adminauth']);
$routes->get('subcategory/add', 'SubCategory::add',['filter' => 'adminauth']);
$routes->post('subcategory/add', 'SubCategory::create',['filter' => 'adminauth']);
$routes->put('subcategory/update/(:any)', 'SubCategory::update/$1',['filter' => 'adminauth']);
$routes->get('subcategory/(:any)', 'SubCategory::$1',['filter' => 'adminauth']);

//Reporting
$routes->get('reporting', 'Reporting::index',['filter' => 'adminauth']);
$routes->get('reporting/export', 'Reporting::export',['filter' => 'adminauth']);
$routes->get('reporting/category', 'ReportingCategory::index',['filter' => 'adminauth']);
$routes->get('uploadedDocuments', 'UploadedDocuments::index',['filter' => 'adminauth']);
$routes->get('editedDocuments', 'DocumentEdit::index',['filter' => 'adminauth']);
$routes->get('outstandingDocuments', 'OutstandingDocuments::index',['filter' => 'adminauth']);
$routes->get('Expired-Documents', 'ExpiredDocuments::index',['filter' => 'adminauth']);


$routes->get('docs', 'ManageDocuments::index',['filter' => 'adminauth']);
$routes->get('docs/(:any)', 'ManageDocuments::$1',['filter' => 'adminauth']);
$routes->get('Docs', 'ManageDocuments::index',['filter' => 'adminauth']);
$routes->get('Docs/(:any)', 'ManageDocuments::$1',['filter' => 'adminauth']);

$routes->get('workflow', 'Workflow::index',['filter' => 'adminauth']);
$routes->get('workflow/(:any)', 'Workflow::$1');
$routes->get('Workflow', 'Workflow::index');
$routes->get('Workflow/(:any)', 'Workflow::$1');

$routes->get('subadminworkflow', 'SubadminWorkflow::index',['filter' => 'auth']);
$routes->get('subadminworkflow/(:any)', 'SubadminWorkflow::$1',['filter' => 'auth']);
$routes->get('SubadminWorkflow', 'SubadminWorkflow::index',['filter' => 'auth']);
$routes->get('SubadminWorkflow/(:any)', 'SubadminWorkflow::$1',['filter' => 'auth']);

$routes->get('SubadminWorkflowView', 'SubadminWorkflowView::index',['filter' => 'auth']);
$routes->get('SubadminWorkflowView/(:any)', 'SubadminWorkflowView::$1',['filter' => 'auth']);
$routes->get('SubadminWorkflowView', 'SubadminWorkflowView::index',['filter' => 'auth']);
$routes->get('SubadminWorkflowView/(:any)', 'SubadminWorkflowView::$1',['filter' => 'auth']);



$routes->match(['get','post'],'subdocuments', 'SubDocuments::index',['filter' => 'auth']);
$routes->match(['get','post'],'subdocuments/(:any)', 'SubDocuments::$1',['filter' => 'auth']);

//sub-admin documents
$routes->get('subadminDocuments', 'SubadminDocument::index',['filter' => 'auth']);


//$routes->get('reporting/documents', 'UploadedDocuments::index',['filter' => 'auth']);
//$routes->post('reporting/getData', 'Reporting::getData',['filter' => 'auth']);




// User Routes
//Document Managemant
$routes->get('userDocuments', 'UserDocuments::index',['filter' => 'artistauth']);
$routes->get('userDocuments/(:any)', 'UserDocuments::$1',['filter' => 'artistauth']);
$routes->get('UserDocuments', 'UserDocuments::index',['filter' => 'artistauth']);
$routes->get('UserDocuments/(:any)', 'UserDocuments::$1',['filter' => 'artistauth']);

$routes->match(['get','post'],'userdocs', 'UserDocs::index',['filter' => 'artistauth']);
$routes->match(['get','post'],'userdocs/(:any)', 'UserDocs::$1',['filter' => 'artistauth']);







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
