<?php
session_start();
require_once('template/topomenu.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha seu Ingresso</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
</head>
<body id="ingresso">
<header>
    <?php require_once('template/menu.php'); ?>
</header>

<main>
    <section class="calendario">
        <h2>Escolha a data</h2>
        <input type="date" id="dataIngresso">
    </section>
    
    <section class="ingressos">
        <h2>Ingressos</h2>
        <button onclick="adicionarIngresso()">Ingresso - R$10</button>
        <section class="servicosingresso" id="servico-list">
        <h2>Serviços Disponíveis</h2>
        <label class="select-servico" for="servico-select">Selecione um serviço (opcional):</label>
        <select class="servicovenda" id="servico-select" name="servico-select">
            <option value="" selected>Nenhum serviço selecionado</option>
            <option value="1">Pipoca - R$ 15,00 (Saco de pipoca frito)</option>
            <option value="2">Sorvete - R$ 6,00 (Picolé de sorvete)</option>
            <option value="3">Fast Pass - R$ 50,00 (Evite filas nos brinquedos)</option>
            <option value="4">Aluguel de Armários - R$ 10,00 (Guarde seus pertences)</option>
            <option value="5">Passe VIP - R$ 120,99 (5 meses para acessar qualquer brinquedo)</option>
            <option value="6">Pastel Cremoso - R$ 15,00 (Pastel bem recheado + suco 350 ml)</option>
        </select>
        <button class="addservico" id="adicionar-servico" onclick="adicionarServico()">Adicionar ao Carrinho</button>
        <ul id="carrinho-list"></ul>
        <p>Total de Serviços: R$ <span id="total-value">0.00</span></p>
    </section>
    </section>
    
    <aside class="carrinho">
        <h2>Itens Selecionados</h2>
        <ul id="listaCarrinho"></ul>
        <p>Total: R$<span id="total">0</span></p>
    </aside>
</main>

<footer>
    <?php require_once('template/rodape.php'); ?>
</footer>

</body>
</html>
