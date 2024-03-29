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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get("/lang/{locale}", "Home::setLanguage");
$routes->get('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->get('/logout', 'Auth::logout');
$routes->get('/verify_email', "Auth::verifyEmail");
$routes->group('password', function ($routes) {
	$routes->get('reset', 'Auth::passwordReset');
	$routes->get('change', 'Auth::passwordChange');
});

$routes->group('api', ['filter' => 'jwtauth', 'namespace' => $routes->getDefaultNamespace() . 'Api'], function ($routes) {
    $routes->get('tupoksi', 'Tupoksi::index');
    $routes->get('tupoksi/(:segment)', 'Tupoksi::show/$1');
    $routes->get('calonsiswa', 'Calonsiswa::index');
    $routes->post('calonsiswa/save', 'Calonsiswa::create');
    $routes->put('calonsiswa/update/(:segment)', 'Calonsiswa::update/$1');
    $routes->get('jenismhs', 'JenisMhs::index');
    $routes->get('jenismhs/get', 'JenisMhs::getJenismhs');
    $routes->get('programstudi', 'ProgramStudi::index');
    $routes->get('programstudi/get', 'ProgramStudi::getProdi');
    $routes->get('kabupaten', 'Kabupaten::index');
    $routes->get('kabupaten/get', 'Kabupaten::getProvinsi');
    $routes->get('provinsi', 'Provinsi::index');
});

$routes->group('calonsiswa', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Siswa::index');
    $routes->get('formulir', 'Siswa::formulir');
    $routes->get('slideshow/(:segment)', 'Slideshow::show/$1');
    $routes->get('tupoksi', 'Tupoksi::index');
    $routes->get('tupoksi/(:segment)', 'Tupoksi::show/$1');
});

$routes->group('openapi', ['namespace' => $routes->getDefaultNamespace() . 'Api'], function ($routes) {
	$routes->get('slideshow', 'Slideshow::index');
    $routes->get('slideshow/(:segment)', 'Slideshow::show/$1');
});

$routes->group('auth', ['namespace' => $routes->getDefaultNamespace() . 'Api'], function ($routes) {
	$routes->post('login', 'Auth::login');
    $routes->post('register', 'Auth::register');
});


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
