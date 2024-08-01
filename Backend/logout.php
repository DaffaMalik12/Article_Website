<?php
// logout.php

session_start(); // Memulai sesi

// Hapus semua variabel sesi
$_SESSION = array();

// Hapus sesi cookie jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Hapus sesi
session_destroy();

// Redirect ke halaman login atau halaman utama
header("Location: ../Frontend/src/pages/tailwind-admin/login.php");
exit();
