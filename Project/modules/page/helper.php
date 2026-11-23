<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

$contohTeks = 'Aplikasi PHP modular memisahkan template, konfigurasi, function, dan modul fitur ke dalam file masing-masing.';
$hasil = [
    ['formatRupiah(150000)',               formatRupiah(150000)],
    ['hitungDiskon(200000)',               formatRupiah(hitungDiskon(200000))],
    ['hitungDiskon(200000, 15)',           formatRupiah(hitungDiskon(200000, 15))],
    ['validasiEmail("rina@example.com")',  validasiEmail('rina@example.com') ? 'true' : 'false'],
    ['validasiEmail("rina@")',             validasiEmail('rina@') ? 'true' : 'false'],
    ['ringkasTeks($contohTeks, 40)',       ringkasTeks($contohTeks, 40)],
    ['konversiCelciusKeFahrenheit(30)',    (string) konversiCelciusKeFahrenheit(30)],
    ['tentukanStatusNilai(78)',            tentukanStatusNilai(78)],
    ['hitungTotal(25000, 3)',              formatRupiah(hitungTotal(25000, 3))],
    ['e(\'<script>alert("uji")</script>\')', e('<script>alert("uji")</script>')],
];
?>
<section>
    <h2>Demo Helper</h2>
    <p>Seluruh function di bawah dimuat dari <code>helpers/functions.php</code>.</p>
    <table>
        <thead><tr><th>Pemanggilan</th><th>Hasil</th></tr></thead>
        <tbody>
        <?php foreach ($hasil as [$panggil, $nilai]): ?>
            <tr><td><code><?= e($panggil) ?></code></td><td><?= e($nilai) ?></td></tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>