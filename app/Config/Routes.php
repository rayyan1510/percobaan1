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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Admin/Dashboard::index', ['filter' => 'ceklogin']);

$routes->add('tentang', 'Tentang::index');


// Auth Routes
$routes->add('login', 'Auth/Auth::index');
$routes->add('loginsiswa', 'Auth/AuthSiswa::index');
$routes->add('logout', 'Auth/Auth::logout');


// Admin Routes
$routes->group('admin', ['filter' => 'ceklogin'], function ($routes) {
    $routes->add('/', 'Admin/Dashboard::index');
    
    // admin user routes
    $routes->add('users', 'Admin/Users::index', ['filter' => 'cekadmin']);
    $routes->add('user/add', 'Admin/Users::add', ['filter' => 'cekadmin']);
    $routes->add('user/delete', 'Admin/Users::delete', ['filter' => 'cekadmin']);
    $routes->add('user/edit/(:num)', 'Admin/Users::edit', ['filter' => 'cekadmin']);
    $routes->add('user/change_password', 'Admin/Users::change_password');
    
    // admin siswa routes
    $routes->add('siswa', 'Admin/Siswa::index', ['filter' => 'cekadmin']);
    $routes->add('siswa/add', 'Admin/Siswa::add', ['filter' => 'cekadmin']);
    $routes->add('siswa/delete', 'Admin/Siswa::delete', ['filter' => 'cekadmin']);
    $routes->add('siswa/edit/(:num)', 'Admin/Siswa::edit', ['filter' => 'cekadmin']);
    
    // admin SPP routes
    $routes->add('spp', 'Admin/Spp::index', ['filter' => 'cekadmin']);
    $routes->add('spp/add', 'Admin/Spp::add', ['filter' => 'cekadmin']);
    $routes->add('spp/delete', 'Admin/Spp::delete', ['filter' => 'cekadmin']);
    $routes->add('spp/edit/(:num)', 'Admin/Spp::edit', ['filter' => 'cekadmin']);
    
    // admin Kelas routes
    $routes->add('kelas', 'Admin/Kelas::index', ['filter' => 'cekadmin']);
    $routes->add('kelas/add', 'Admin/Kelas::add', ['filter' => 'cekadmin']);
    $routes->add('kelas/delete', 'Admin/Kelas::delete', ['filter' => 'cekadmin']);
    $routes->add('kelas/edit/(:num)', 'Admin/Kelas::edit', ['filter' => 'cekadmin']);
    
    // admin Transaksi Pembayaran routes
    $routes->add('bayar', 'Admin/Bayar::index', ['filter' => 'cekpetugas']);
    $routes->add('bayar/add', 'Admin/Bayar::add', ['filter' => 'cekpetugas']);
    $routes->add('bayar/hapusbayar', 'Admin/Bayar::hapusbayar', ['filter' => 'cekpetugas']);
    $routes->add('bayar/delete', 'Admin/Bayar::delete', ['filter' => 'cekpetugas']);
    $routes->add('bayar/edit/(:num)', 'Admin/Bayar::edit', ['filter' => 'cekpetugas']);
    $routes->add('bayar/print/(:num)', 'Admin/Bayar::print', ['filter' => 'cekpetugas']);
    
    // admin Histori Pembayaran
    $routes->add('histori', 'Admin/Histori::index', ['filter' => 'cekpetugas']);
    $routes->add('laporan', 'Admin/Histori::laporan', ['filter' => 'cekpetugas']);
});

$routes->group('siswa', ['filter' => 'ceklogin'], function ($routes) {
    $routes->add('/', 'Admin/Dashboard::index');
    // siswa Histori Pembayaran
    $routes->add('histori', 'Admin/Histori::historisiswa', ['filter' => 'ceksiswa']);
    $routes->add('change_password', 'Admin/Siswa::change_password');
});

// ajax routes
$routes->group('ajax', ['filter' => 'ceklogin'], function ($routes) {
    $routes->add('get_users', 'Admin/Users::get_users_ajax', ['filter' => 'cekadmin']);
    $routes->add('get_siswa', 'Admin/Siswa::get_siswa_ajax', ['filter' => 'cekadmin']);
    $routes->add('get_spp', 'Admin/Spp::get_spp_ajax', ['filter' => 'cekadmin']);
    $routes->add('get_bayar', 'Admin/Bayar::get_bayar_ajax', ['filter' => 'cekpetugas']);
    $routes->add('get_hapusbayar', 'Admin/Bayar::get_hapusbayar_ajax', ['filter' => 'cekpetugas']);
    $routes->add('get_histori', 'Admin/Histori::get_histori_ajax', ['filter' => 'cekpetugas']);
    $routes->add('get_historisiswa', 'Admin/Histori::get_historisiswa_ajax', ['filter' => 'ceksiswa']);
    $routes->add('get_kelas', 'Admin/Kelas::get_kelas_ajax', ['filter' => 'cekadmin']);
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
