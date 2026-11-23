<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

return [
    'username' => 'admin',
    'password_hash' => password_hash('admin123', PASSWORD_DEFAULT),
];