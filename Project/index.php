<?php

define('APP_RUN', true);
define('PRETTY_URL', true);

session_start();
ob_start();

require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/config/database.php';

$routes = [
    'dashboard'   => __DIR__ . '/views/dashboard.php',
    'profil'      => __DIR__ . '/modules/page/profil.php',
    'kontak'      => __DIR__ . '/modules/page/kontak.php',
    'demo/helper' => __DIR__ . '/modules/page/helper.php',
    'login'       => __DIR__ . '/modules/auth/login.php',
    'logout'      => __DIR__ . '/modules/auth/logout.php',
    'user/list'   => __DIR__ . '/modules/user/list.php',
    'user/add'    => __DIR__ . '/modules/user/add.php',
    'user/edit'   => __DIR__ . '/modules/user/edit.php',
    'user/delete' => __DIR__ . '/modules/user/delete.php',
];

$titles = [
    'dashboard'   => 'Dashboard',
    'profil'      => 'Profil',
    'kontak'      => 'Kontak',
    'demo/helper' => 'Demo Helper',
    'login'       => 'Login',
    'logout'      => 'Logout',
    'user/list'   => 'Data Pengguna',
    'user/add'    => 'Tambah Pengguna',
    'user/edit'   => 'Ubah Pengguna',
    'user/delete' => 'Hapus Pengguna',
];

$page = $_GET['page'] ?? 'dashboard';

if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $page        = '404';
    $pageTitle   = '404 - Halaman tidak ditemukan';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    // Proteksi halaman CRUD
    $protectedRoutes = [
        'user/list',
        'user/add',
        'user/edit',
        'user/delete',
    ];

    if (in_array($page, $protectedRoutes) && !isLoggedIn()) {
        redirect('login');
    }

    $pageTitle   = $titles[$page];
    $contentFile = $routes[$page];
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
ob_end_flush();