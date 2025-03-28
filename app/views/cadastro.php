<?php
require 'assets/phpmailer/src/PHPMailer.php';
require 'assets/phpmailer/src/SMTP.php';
require 'assets/phpmailer/src/Exception.php';

$conn = new mysqli("smpsistema.com.br", "u283879542_marisa", "@MarisaPxLab12", "u283879542_marisa");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome_cliente'];
    $cpf = $_POST['cpf_cliente'];
    $bairro = $_POST['bairro_cliente'];
    $estado = $_POST['estado_cliente'];
    $cidade = $_POST['cidade_cliente'];
    $data_nasc = $_POST['data_nasc_cliente'];
    $telefone = $_POST['telefone_cliente'];
    $email = $_POST['email_cliente'];
    $senha = password_hash($_POST['senha_cliente'], PASSWORD_DEFAULT); // Added password hashing
    
    $sql = "INSERT INTO tbl_cliente (nome_cliente, cpf_cliente, bairro_cliente, 
            estado_cliente, cidade_cliente, data_nasc_cliente, telefone_cliente, email_cliente, senha_cliente) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nome, $cpf, $bairro, $estado, $cidade, $data_nasc, $telefone, $email, $senha);
    
    if ($stmt->execute()) {
        echo '<div class="mensagem sucesso">Cadastro realizado com sucesso!</div>';
    } else {
        echo '<div class="mensagem erro">Erro ao cadastrar o cliente: ' . $stmt->error . '</div>';
    }
    $stmt->close();
}
?>




