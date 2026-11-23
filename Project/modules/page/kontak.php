<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

$values = ['nama' => '', 'email' => '', 'pesan' => ''];
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
        if ($values['nama'] === '') {
            $errors['nama'] = 'Nama wajib diisi.';
        }
        if (!validasiEmail($values['email'])) {
            $errors['email'] = 'Format email tidak valid.';
        }
        if (mb_strlen($values['pesan']) < 10) {
            $errors['pesan'] = 'Pesan minimal 10 karakter.';
        }
        if (!$errors) {
            setFlash('success', 'Terima kasih, ' . $values['nama'] . '. Pesan Anda sudah diterima.');
            redirect('kontak');
        }
    }
}
?>
<section>
    <h2>Kontak</h2>
    <p>Kirim pesan melalui form berikut.</p>
    <?php if (isset($errors['umum'])): ?>
        <div class="alert alert-error"><?= e($errors['umum']) ?></div>
    <?php endif; ?>
    <form method="post" action="" novalidate>
        <?= csrfField() ?>
        <div class="field">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?= e($values['nama']) ?>">
            <?php if (isset($errors['nama'])): ?><small class="error"><?= e($errors['nama']) ?></small><?php endif; ?>
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= e($values['email']) ?>">
            <?php if (isset($errors['email'])): ?><small class="error"><?= e($errors['email']) ?></small><?php endif; ?>
        </div>
        <div class="field">
            <label for="pesan">Pesan</label>
            <textarea id="pesan" name="pesan" rows="4"><?= e($values['pesan']) ?></textarea>
            <?php if (isset($errors['pesan'])): ?><small class="error"><?= e($errors['pesan']) ?></small><?php endif; ?>
        </div>
        <button type="submit" class="btn">Kirim</button>
    </form>
</section>