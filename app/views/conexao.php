<?php
$hostname = "smpsistema.com.br";
$database = "u283879542_marisa";
$username = "u283879542_marisa";
$password = "@MarisaPxLab12";

try {
    $conexao = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
