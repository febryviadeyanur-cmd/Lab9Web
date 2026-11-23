<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

// Operasi hanya diproses lewat POST + token CSRF
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setFlash('error', 'Penghapusan hanya dapat dilakukan melalui tombol Hapus.');
    redirect('user/list');
}

if (!csrfValid()) {
    http_response_code(403);
    setFlash('error', 'Token keamanan tidak valid. Data tidak dihapus.');
    redirect('user/list');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    setFlash('error', 'Parameter id tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
$stmt->execute([$id]);

if ($stmt->rowCount() > 0) {
    setFlash('success', 'Pengguna berhasil dihapus.');
} else {
    setFlash('error', 'Pengguna tidak ditemukan.');
}
redirect('user/list');