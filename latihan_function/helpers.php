<?php
// helpers.php

function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function e(string $nilai): string
{
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

function hitungDiskon(float $harga, float $persen = 10): float
{
    return $harga * ($persen / 100);
}

// Latihan 1
function konversiCelciusKeFahrenheit(float $c): float
{
    return ($c * 9 / 5) + 32;
}

// Latihan 2
function tentukanStatusNilai(float $nilai): string
{
    if ($nilai >= 85) {
        return 'A (Sangat Baik)';
    } elseif ($nilai >= 70) {
        return 'B (Baik)';
    } elseif ($nilai >= 55) {
        return 'C (Cukup)';
    } elseif ($nilai >= 40) {
        return 'D (Kurang)';
    }
    return 'E (Tidak Lulus)';
}

// Latihan 3
function hitungTotal(float $harga, int $jumlah): float
{
    return $harga * $jumlah;
}