<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

// id dari URL harus berupa bilangan bulat positif
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    setFlash('error', 'Parameter id tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('SELECT id, nama, email, alamat FROM users WHERE id = ?');
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) {
    setFlash('error', 'Pengguna tidak ditemukan.');
    redirect('user/list');
}

$values = [
    'nama'   => $user['nama'],
    'email'  => $user['email'],
    'alamat' => (string) $user['alamat'],
];
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
            $cek = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = ? AND id <> ?');
            $cek->execute([$values['email'], $id]);
            if ($cek->fetchColumn() > 0) {
                $errors['email'] = 'Email sudah dipakai pengguna lain.';
            }
        }
        if (mb_strlen($values['alamat']) > 255) {
            $errors['alamat'] = 'Alamat maksimal 255 karakter.';
        }

        if (!$errors) {
            $upd = $pdo->prepare('UPDATE users SET nama = ?, email = ?, alamat = ? WHERE id = ?');
            $upd->execute([$values['nama'], $values['email'], $values['alamat'] ?: null, $id]);
            setFlash('success', 'Data pengguna berhasil diubah.');
            redirect('user/list');
        }
    }
}

$submitLabel = 'Simpan Perubahan';
?>
<section>
    <h2>Ubah Pengguna</h2>
    <?php if (isset($errors['umum'])): ?>
        <div class="alert alert-error"><?= e($errors['umum']) ?></div>
    <?php endif; ?>
    <?php require __DIR__ . '/../../views/user_form.php'; ?>
</section>