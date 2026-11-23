<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

// Daftar menu
$menu = [
    ['Dashboard', 'dashboard', 'dashboard'],
    ['Profil',    'profil', 'profil'],
    ['Kontak',   'kontak', 'kontak'],
    ['Helper',   'demo/helper', 'demo'],
    ['Pengguna', 'user/list', 'user'],
];

$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?> - Lab9Web</title>
    <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body>
<div class="container">
    <header>
        <h1>Lab9Web</h1>
        <p>Praktikum 9 - PHP Modular: template, function, dan routing</p>
    </header>

    <nav>
        <?php foreach ($menu as [$label, $rute, $prefix]): ?>
            <a href="<?= e(url($rute)) ?>"<?= isActive($page, $prefix) ? ' class="active"' : '' ?>>
                <?= e($label) ?>
            </a>
        <?php endforeach; ?>

        <?php if (isLoggedIn()): ?>
            <form action="<?= e(url('logout')) ?>" method="post" class="nav-right">
                <?= csrfField() ?>
                <button type="submit">Logout</button>
            </form>
        <?php else: ?>
            <a href="<?= e(url('login')) ?>" class="nav-right">Login</a>
        <?php endif; ?>
    </nav>

    <main>
        <?php if ($flash): ?>
            <div class="alert alert-<?= e($flash['tipe']) ?>">
                <?= e($flash['pesan']) ?>
            </div>
        <?php endif; ?>