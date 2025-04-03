<?php
$id_compra = $_GET['id'];
$qr_code_path = "assets/img/qrcodes/$id_compra.png";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Confirmação</title>
</head>
<body>
    <h1>Compra realizada com sucesso!</h1>
    <p>Seu QR code:</p>
    <img src="<?= $qr_code_path ?>" alt="QR Code">
</body>
</html>