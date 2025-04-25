// DOCKS/config/auth_functions.php
<?php

function isLoggedIn() {
    return isset($_SESSION['user_id']); // Ou sua verificação de login
}

function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
        header('Location: /login');
        exit();
    }
}

function afterLoginRedirect() {
    if (isset($_SESSION['redirect_url'])) {
        $url = $_SESSION['redirect_url'];
        unset($_SESSION['redirect_url']);
        return $url;
    }
    return '/'; // Página padrão após login
}