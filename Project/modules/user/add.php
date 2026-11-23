<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

$values = ['nama' => '', 'email' => '', 'alamat' => ''];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfValid()) {
        http_response_code(403);
        $errors['umum'] = 'Token keamanan tidak valid. Muat ulang halaman lalu coba lagi.';
    } else {
        foreach ($values as $k => $_) {
            $v = $_POST[$k] ?? '';
            $values[$k] = is_string($v) ? trim($v) : '';
        }

        if ($values['nama'] === '' || mb_strlen($values['nama']) > 100) {
            $errors['nama'] = 'Nama wajib diisi (maksimal 100 karakter).';
        }
        if (!validasiEmail($values['email'])) {
            $errors['email'] = 'Format email tidak valid.';
        } else {
            $cek = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
            $cek->execute([$values['email']]);
            if ($cek->fetchColumn() > 0) {
                $errors['email'] = 'Email sudah terdaftar.';
            }
        }
        if (mb_strlen($values['alamat']) > 255) {
            $errors['alamat'] = 'Alamat maksimal 255 karakter.';
        }

        if (!$errors) {
            $stmt = $pdo->prepare('INSERT INTO users (nama, email, alamat) VALUES (?, ?, ?)');
            $stmt->execute([$values['nama'], $values['email'], $values['alamat'] ?: null]);
            setFlash('success', 'Pengguna "' . $values['nama'] . '" berhasil ditambahkan.');
            redirect('user/list');
        }
    }
}

$submitLabel = 'Simpan';
?>
<section>
    <h2>Tambah Pengguna</h2>
    <?php if (isset($errors['umum'])): ?>
        <div class="alert alert-error"><?= e($errors['umum']) ?></div>
    <?php endif; ?>
    <?php require __DIR__ . '/../../views/user_form.php'; ?>
</section>