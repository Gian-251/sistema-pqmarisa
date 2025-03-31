<?php
require_once '../config/config.php';
require_once '../vendor/autoload.php'; // Para usar o PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Recebe os dados do formulário
$quantidade = $_POST['quantidade'];
$nome = $_POST['nome'];
$email = $_POST['email'];

// Gera um ID único para a compra
$id_compra = uniqid();

// Gera o QR code
require_once 'phpqrcode/qrlib.php'; // Biblioteca para gerar QR code
$qr_code_path = "../public/assets/img/qrcodes/$id_compra.png";
QRcode::png($id_compra, $qr_code_path);

// Salva os dados no banco de dados
$valor_unitario = 50.00; // Valor fixo por ingresso (exemplo)
$valor_total = $quantidade * $valor_unitario;

$sql = "INSERT INTO tbl_ingresso (id_cliente, qtde_compra_ingresso, qtde_pendente_ingresso, cod_qr_ingresso, foto_qr_ingresso, alt_qr_ingresso, data_compra_ingresso, valor_unit_ingresso, valor_total_ingresso, status_ingresso)
        VALUES (1, $quantidade, $quantidade, '$id_compra', '$qr_code_path', 'QR Code', NOW(), $valor_unitario, $valor_total, 'Pendente')";
// Execute a query no banco de dados...

// Envia o QR code por e-mail
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smpsistema.com.br';
    $mail->SMTPAuth = true;
    $mail->Username = 'glvm0506@gmail.com';
    $mail->Password = '@MarisaPxLab12';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('seu_email@exemplo.com', 'Parque de Diversões');
    $mail->addAddress($email, $nome);

    $mail->isHTML(true);
    $mail->Subject = 'Seu QR Code de Ingresso';
    $mail->Body = "Olá, $nome! Aqui está seu QR code para o ingresso.";
    $mail->addAttachment($qr_code_path);

    $mail->send();
    echo "E-mail enviado com sucesso!";
} catch (Exception $e) {
    echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
}

// Redireciona para a página de confirmação
header("Location: confirmacao.php?id=$id_compra");
?>