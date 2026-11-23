<?php

defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');
?>
<form method="post" action="" novalidate>
    <?= csrfField() ?>

    <div class="field">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" maxlength="100" value="<?= e($values['nama']) ?>" required>
        <?php if (isset($errors['nama'])): ?><small class="error"><?= e($errors['nama']) ?></small><?php endif; ?>
    </div>

    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" maxlength="100" value="<?= e($values['email']) ?>" required>
        <?php if (isset($errors['email'])): ?><small class="error"><?= e($errors['email']) ?></small><?php endif; ?>
    </div>

    <div class="field">
        <label for="alamat">Alamat</label>
        <textarea id="alamat" name="alamat" rows="3" maxlength="255"><?= e($values['alamat']) ?></textarea>
        <?php if (isset($errors['alamat'])): ?><small class="error"><?= e($errors['alamat']) ?></small><?php endif; ?>
    </div>

    <button type="submit" class="btn"><?= e($submitLabel) ?></button>
    <a class="btn btn-light" href="<?= e(url('user/list')) ?>">Batal</a>
</form>