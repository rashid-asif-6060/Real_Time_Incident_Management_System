<?php
// src/controllers/auth/logout.php

// Start session safely (for later when you add session)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =====================
   CLEAR SESSION (future)
   ===================== */
$_SESSION = [];
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
session_destroy();

/* =====================
   CLEAR AUTH COOKIES (current)
   ===================== */
setcookie("user_id", "", time() - 3600, "/");
setcookie("user_role", "", time() - 3600, "/");
setcookie("user_name", "", time() - 3600, "/");

/* =====================
   REDIRECT TO LOGIN
   ===================== */
header("Location: ../views/auth/login.php");
exit;

?>