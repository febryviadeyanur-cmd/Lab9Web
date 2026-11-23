<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

$configAuth = require __DIR__ . '/../../config/auth.php';

if (isLoggedIn()) {
    redirect('user/list');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrfValid()) {
        $error = 'Token CSRF tidak valid.';
    } else {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (
            $username === $configAuth['username'] &&
            password_verify($password, $configAuth['password_hash'])
        ) {
            session_regenerate_id(true);
            $_SESSION['login'] = true;

            setFlash('success', 'Login berhasil. Selamat datang!');
            redirect('user/list');
        } else {
            $error = 'Username atau password salah.';
        }
    }
}
?>

<div class="login-wrapper">
    <div class="login-card">

        <div class="login-header">
            <h2>Login Admin</h2>
            <p>Silakan masuk untuk mengelola data pengguna.</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error">
                <?= e($error) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <?= csrfField() ?>

            <div class="field">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                name="username"
                placeholder="Masukkan username"
                required
            >
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >
            </div>

            <button type="submit" class="btn login-button">
                Login
            </button>
        </form>

        <div class="login-footer">
            <p>Lab9Web &mdash; PHP Modular</p>
        </div>

    </div>
</div>