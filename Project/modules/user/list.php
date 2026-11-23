<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

$users = $pdo->query('SELECT id, nama, email, alamat FROM users ORDER BY id DESC')->fetchAll();
?>
<section>
    <h2>Data Pengguna</h2>
    <p><a class="btn" href="<?= e(url('user/add')) ?>">Tambah Pengguna</a></p>

    <table>
        <thead>
            <tr><th>No</th><th>Nama</th><th>Email</th><th>Alamat</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php if (!$users): ?>
            <tr><td colspan="5">Belum ada data pengguna.</td></tr>
        <?php endif; ?>
        <?php foreach ($users as $no => $u): ?>
            <tr>
                <td><?= $no + 1 ?></td>
                <td><?= e($u['nama']) ?></td>
                <td><?= e($u['email']) ?></td>
                <td><?= e(ringkasTeks((string) $u['alamat'], 40)) ?></td>
                <td class="aksi">
                    <a class="btn btn-small" href="<?= e(url('user/edit', ['id' => $u['id']])) ?>">Ubah</a>
                    <form method="post" action="<?= e(url('user/delete')) ?>" data-confirm="Hapus pengguna ini?">
                        <?= csrfField() ?>
                        <input type="hidden" name="id" value="<?= (int) $u['id'] ?>">
                        <button type="submit" class="btn btn-small btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>