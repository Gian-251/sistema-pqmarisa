<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parque de Diversão Marisa</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>
    <link rel="icon" type="image/x-icon" href="img/LOGOMARISA.svg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body id="carrinho">

<header>
    <?php require_once('conteudo/menu.php'); ?>
</header>

<main>
    <section id="carrinho-list">
        <h2>Carrinho de Compras</h2>
        <ul id="lista-carrinho">
            <!-- Itens do carrinho serão exibidos aqui -->
        </ul>
        <p id="total-carrinho">Total: R$0.00</p>
        <button id="finalizar-compra" onclick="finalizarCompra()">Finalizar Compra</button>
    </section>
</main>

<footer>
<?php require_once('conteudo/rodape.php');?>
</footer>

<script>
    // Função para atualizar o contador de itens no carrinho
    function atualizarContadorCarrinho() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];  // Recupera o carrinho do localStorage
        const contadorCarrinho = document.getElementById("contador-carrinho");  // Pega o elemento do contador

        // Atualiza o texto do contador com a quantidade de itens no carrinho
        contadorCarrinho.textContent = cart.length > 0 ? cart.length : 0;
    }

    // Função para atualizar o carrinho na página
    function atualizarCarrinho() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        const listaCarrinho = document.getElementById("lista-carrinho");
        const totalCarrinho = document.getElementById("total-carrinho");

        listaCarrinho.innerHTML = ""; // Limpa a lista do carrinho
        let total = 0;

        cart.forEach((item, index) => {
            // Cria o item da lista
            const li = document.createElement("li");
            li.innerHTML = `${item.quantity}x ${item.attraction} - R$${item.total} 
                            <button class="remover" onclick="removerItem(${index})">X</button>`;
            listaCarrinho.appendChild(li);
            total += parseFloat(item.total);
        });

        totalCarrinho.textContent = `Total: R$${total.toFixed(2)}`;
    }

    // Função para remover um item do carrinho
    function removerItem(index) {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart.splice(index, 1); // Remove o item do carrinho
        localStorage.setItem("cart", JSON.stringify(cart)); // Atualiza o carrinho no localStorage
        atualizarCarrinho(); // Atualiza a página
        atualizarContadorCarrinho(); // Atualiza o contador no ícone do carrinho
    }

    // Função de finalizar compra
    function finalizarCompra() {
        const cart = JSON.parse(localStorage.getItem("cart")) || [];
        if (cart.length === 0) {
            alert("Seu carrinho está vazio!");
            return;
        }

        // Finaliza a compra, aqui você pode adicionar a lógica de pagamento ou confirmação
        alert("Compra finalizada! Obrigado por comprar no Parque de Diversão Marisa.");
        localStorage.removeItem("cart"); // Limpa o carrinho após a compra
        atualizarCarrinho(); // Atualiza a tela
        atualizarContadorCarrinho(); // Atualiza o contador no ícone
    }

    // Atualiza o carrinho e o contador ao carregar a página
    window.onload = function() {
        atualizarCarrinho();
        atualizarContadorCarrinho();
    };
</script>

</body>
</html>
