<?php require_once('template/topomenu.php'); ?>

<body id="cliente">
    <header> 
        <?php require_once('template/menu.php'); ?>
    </header>

    <main class="container mt-5">
        <h2 class="mb-4">Dados do Cliente</h2>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>Nome:</strong> <?php echo $cliente['nome']; ?></p>
                <p><strong>Email:</strong> <?php echo $cliente['email']; ?></p>
                <p><strong>CPF:</strong> <?php echo $cliente['cpf']; ?></p>
                <p><strong>Telefone:</strong> <?php echo $cliente['telefone']; ?></p>
            </div>
        </div>

        <h2 class="mb-4">Informações do Ingresso</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>ID do Ingresso:</strong> <?php echo $ingresso['id']; ?></p>
                <p><strong>Data da Compra:</strong> <?php echo date('d/m/Y', strtotime($ingresso['data_compra'])); ?></p>
                <p><strong>Tipo de Ingresso:</strong> <?php echo $ingresso['tipo']; ?></p>
                <p><strong>Valor:</strong> R$ <?php echo number_format($ingresso['valor'], 2, ',', '.'); ?></p>
                <p><strong>Status:</strong> <?php echo $ingresso['status']; ?></p>
            </div>
        </div>
    </main>

    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>
</body>
</html>
