<?php require_once __DIR__ . '/helpers.php'; ?>
<h3>Latihan 1: Konversi Celcius ke Fahrenheit</h3>
<?php
$suhu = 30;
echo "$suhu &deg;C = " . konversiCelciusKeFahrenheit($suhu) . " &deg;F";
?>

<h3>Latihan 2: Status Nilai</h3>
<?php
$nilai = 78;
echo "Nilai $nilai = " . e(tentukanStatusNilai($nilai));
?>

<h3>Latihan 3: Total Belanja</h3>
<?php
$harga = 25000;
$jumlah = 3;
echo "$jumlah x " . formatRupiah($harga) . " = " . formatRupiah(hitungTotal($harga, $jumlah));
?>