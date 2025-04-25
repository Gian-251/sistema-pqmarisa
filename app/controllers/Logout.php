<?php

class Logout extends Controller {

public function logout() {
    // Inicia a sessão se não estiver iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Limpa todos os dados da sessão
    $_SESSION = array();
    
    // Se quiser destruir o cookie de sessão também
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destroi a sessão
    session_destroy();
    
    // Redireciona para a página de login
    header("Location: " . BASE_URL . "login");
    exit;
}
}