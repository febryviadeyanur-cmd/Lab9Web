<?php
require_once __DIR__ . '/helpers.php';

// Latihan 1: Konversi Celsius ke Fahrenheit
$celsius = 30;
$fahrenheit = konversiCelciusKeFahrenheit($celsius);

// Latihan 2: Menentukan status nilai
$nilai = 78;
$status = tentukanStatusNilai($nilai);

// Latihan 3: Menghitung total harga
$harga = 25000;
$jumlah = 3;
$total = hitungTotal($harga, $jumlah);
?>

<h2>Latihan Function</h2>

<h3>1. Konversi Celsius ke Fahrenheit</h3>
<p><?php echo $celsius; ?>°C = <?php echo $fahrenheit; ?>°F</p>

<h3>2. Menentukan Status Nilai</h3>
<p>Nilai: <?php echo $nilai; ?></p>
<p>Status: <?php echo $status; ?></p>

<h3>3. Menghitung Total Harga</h3>
<p>Harga: <?php echo formatRupiah($harga); ?></p>
<p>Jumlah: <?php echo $jumlah; ?></p>
<p>Total: <?php echo formatRupiah($total); ?></p>
