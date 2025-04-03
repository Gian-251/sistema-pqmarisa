<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pagamento</title>
    <link rel="stylesheet" href="assets/css/pagamento.css">
</head>
<body>
    <form id="form-pagamento" action="processar_pagamento.php" method="POST">
        <label for="quantidade">Quantidade de Ingressos:</label>
        <input type="number" id="quantidade" name="quantidade" min="1" required>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Pagar</button>
    </form>

    <script src="assets/js/pagamento.js"></script>
</body>
</html>