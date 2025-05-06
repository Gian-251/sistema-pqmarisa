<?php

//define a base 
define('BASE_URL', 'http://localhost/sistema-pqmarisa/public/');

//configuração da data base 
define('DB_HOST', 'smpsistema.com.br');
define('DB_USER', 'u283879542_marisa');
define('DB_PASS', '@MarisaPxLab12');
define('DB_NAME', 'u283879542_marisa');

// define('DB_HOST', 'localhost');
// define('DB_USER', 'root');
// define('DB_PASS', '');
// define('DB_NAME', 'u283879542_marisa');


//configuração do emails 
define('EMAIL_HOST', 'smtp.hostinger.com');
define('EMAIL_USER', 'ti26@smpsistema.com.br');
define('EMAIL_PASS', 'glvm0506@gmail.com');
define('EMAIL_PORT', '465');



//configuração autoload das classes 
spl_autoload_register(function($class){
    
    if(file_exists('../app/controllers/' . $class . '.php')){
        require_once('../app/controllers/' .$class. '.php');

    }

    if(file_exists('../app/models/'.$class.'.php')){ 
        require_once('../app/models/'.$class.'.php');
    }

    if(file_exists('../rotas/'.$class.'.php')){ 
        require_once('../rotas/'.$class.'.php');
        //var_dump($class);
    } 

});

//Carregar a rota (Url da Aplicação)



// Configuração da base de dados
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

class Config {
    private static $pdo;

    public static function getConexao() {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
                    DB_USER,
                    DB_PASS
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro de conexão: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

?>

