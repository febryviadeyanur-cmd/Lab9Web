<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

$totalUser = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$hargaContoh = 250000;
?>
<section>
    <h2>Dashboard</h2>
    <p>Aplikasi ini sudah dimodularisasi: tampilan, konfigurasi, function, dan fitur dipisah ke folder masing-masing.</p>

    <div class="cards">
        <div class="card">
            <span class="card-label">Total pengguna</span>
            <strong class="card-value"><?= $totalUser ?></strong>
            <a href="<?= e(url('user/list')) ?>">Lihat data</a>
        </div>
        <div class="card">
            <span class="card-label">Contoh harga</span>
            <strong class="card-value"><?= e(formatRupiah($hargaContoh)) ?></strong>
            <span>Diskon 10%: <?= e(formatRupiah(hitungDiskon($hargaContoh))) ?></span>
        </div>
    </div>

    <h3>Daftar rute</h3>
    <table>
        <thead><tr><th>Parameter page</th><th>Keterangan</th></tr></thead>
        <tbody>
            <tr><td>dashboard</td><td>Halaman ini</td></tr>
            <tr><td>profil</td><td>Identitas pemilik project</td></tr>
            <tr><td>kontak</td><td>Form kontak dengan validasi</td></tr>
            <tr><td>demo/helper</td><td>Demo seluruh function pada helpers</td></tr>
            <tr><td>user/list</td><td>Daftar pengguna</td></tr>
            <tr><td>user/add</td><td>Tambah pengguna</td></tr>
            <tr><td>user/edit</td><td>Ubah pengguna (butuh parameter id)</td></tr>
            <tr><td>user/delete</td><td>Hapus pengguna (hanya lewat POST)</td></tr>
        </tbody>
    </table>
</section>