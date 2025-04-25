<?php require_once('template/topomenu.php'); ?>

<body id="usuario">
    <header>
        <?php require_once('template/menu.php'); ?>
    </header>

    <main>
        <section class="site">
        <h2 class="mb-4">Dados do Cliente</h2>
        <form action="<?= BASE_URL ?>login/sair" method="POST" class="d-inline float-end">
    <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja realmente sair do sistema?')">
        Sair
    </button>
    </form>

            <div class="usuarioInfo">

                <div class="usuarioDados">
                    <p><strong>Nome:</strong> <?php echo $cliente['nome_cliente']; ?></p>
                    <p><strong>Email:</strong> <?php echo $cliente['email_cliente']; ?></p>
                    <p><strong>CPF:</strong> <?php echo $cliente['cpf_cliente']; ?></p>
                    <p><strong>Telefone:</strong> <?php echo $cliente['telefone_cliente']; ?></p>
                </div>
            </div>
        </section>

        <section class="site">
            <h2 class="mb-4">Informações do Ingresso</h2>
            <div class="card-body">
                <?php if ($ingresso): // Verifica se o ingresso existe ?>
                    <p><strong>ID do Ingresso:</strong> <?php echo $ingresso['id_ingresso']; ?></p>
                    <p><strong>Quantidade Comprada:</strong> <?php echo $ingresso['qtde_compra_ingresso']; ?></p>
                    <p><strong>Quantidade Pendente:</strong> <?php echo $ingresso['qtde_pendente_ingresso']; ?></p>
                    <p><strong>Valor Unitário:</strong> R$ <?php echo number_format($ingresso['valor_unit_ingresso'], 2, ',', '.'); ?></p>
                    <p><strong>Valor Total:</strong> R$ <?php echo number_format($ingresso['valor_total_ingresso'], 2, ',', '.'); ?></p>
                    <p><strong>Data da Compra:</strong> <?php echo date('d/m/Y H:i', strtotime($ingresso['data_compra_ingresso'])); ?></p>
                    <p><strong>Status:</strong> <?php echo $ingresso['status_ingresso']; ?></p>
                    <p><strong>Código QR:</strong> <?php echo $ingresso['cod_qr_ingresso']; ?></p>
                <?php else: // Caso não exista ingresso ?>
                    <p><strong>Não há ingresso registrado para você.</strong></p>
                    <a href="compra_ingresso.php" class="btn btn-primary">Comprar Ingresso</a>
                <?php endif; ?>
            </div>
        </section>

    </main>

    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>
</body>

</html>
