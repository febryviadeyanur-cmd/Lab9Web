<?php

defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

//Tampilan & URL
function e(?string $nilai): string
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}

function baseUrl(): string
{
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    return rtrim($dir, '/');
}

function asset(string $path): string
{
    return baseUrl() . '/assets/' . ltrim($path, '/');
}

function url(string $page = 'dashboard', array $params = []): string
{
    if (defined('PRETTY_URL') && PRETTY_URL) {
        $u = baseUrl() . '/' . ($page === 'dashboard' ? '' : $page);
        return $params ? $u . '?' . http_build_query($params) : $u;
    }
    return baseUrl() . '/index.php?' . http_build_query(['page' => $page] + $params);
}

function redirect(string $page, array $params = []): void
{
    header('Location: ' . url($page, $params));
    exit;
}

//Menu navigasi aktif
function isActive(string $current, string $prefix): bool
{
    return $current === $prefix || str_starts_with($current, $prefix . '/');
}

//Format & validasi

function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function hitungDiskon(float $harga, float $persen = 10): float
{
    return $harga * ($persen / 100);
}

function validasiEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function ringkasTeks(string $teks, int $batas = 50): string
{
    $teks = trim($teks);
    if (mb_strlen($teks) <= $batas) {
        return $teks;
    }
    return rtrim(mb_substr($teks, 0, $batas)) . '...';
}

function konversiCelciusKeFahrenheit(float $c): float
{
    return ($c * 9 / 5) + 32;
}

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

function hitungTotal(float $harga, int $jumlah): float
{
    return $harga * $jumlah;
}

//Pesan sukses / gagal (flash message)

function setFlash(string $tipe, string $pesan): void
{
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

function getFlash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}

//Perlindungan CSRF

function csrfToken(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrfField(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrfToken()) . '">';
}

function csrfValid(): bool
{
    $kirim = $_POST['csrf'] ?? '';
    return is_string($kirim) && hash_equals(csrfToken(), $kirim);
}

//Autentikasi / Login

function isLoggedIn(): bool
{
    return !empty($_SESSION['login']);
}
