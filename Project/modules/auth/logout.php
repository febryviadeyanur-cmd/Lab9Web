<?php
defined('APP_RUN') || exit('Akses langsung tidak diizinkan.');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !csrfValid()) {
    http_response_code(403);
    exit('Permintaan tidak valid.');
}

$_SESSION = [];
session_regenerate_id(true);

setFlash('success', 'Anda berhasil logout.');
redirect('login');
