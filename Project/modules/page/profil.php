<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

$identitas = require __DIR__ . '/../../config/identitas.php';
?>
<section>
    <h2>Profil</h2>
    <p>Identitas pemilik project praktikum.</p>
    <table class="tabel-kv">
        <tr><th>Nama</th><td><?= e($identitas['nama']) ?></td></tr>
        <tr><th>NIM</th><td><?= e($identitas['nim']) ?></td></tr>
        <tr><th>Kelas</th><td><?= e($identitas['kelas']) ?></td></tr>
        <tr><th>Program Studi</th><td><?= e($identitas['prodi']) ?></td></tr>
        <tr><th>Kampus</th><td><?= e($identitas['kampus']) ?></td></tr>
        <tr><th>Mata Kuliah</th><td>Pemrograman Web - Praktikum 9 (PHP Modular)</td></tr>
    </table>
</section>