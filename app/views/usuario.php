<?php require_once('template/topomenu.php'); ?>

<body id="usuario">
    <header>
        <?php require_once('template/menu.php'); ?>
    </header>

    <main>
        <section class="site">
            <h2 class="mb-4">Dados do Cliente</h2>
            <a href="<?= BASE_URL ?>logout" class="btn btn-danger float-end" onclick="return confirm('Sair do sistema?')">
                Sair
            </a>

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
                <p><strong>ID do Ingresso:</strong> <?php echo $ingresso['id_ingresso']; ?></p>
                <p><strong>Quantidade Comprada:</strong> <?php echo $ingresso['qtde_compra_ingresso']; ?></p>
                <p><strong>Quantidade Pendente:</strong> <?php echo $ingresso['qtde_pendente_ingresso']; ?></p>
                <p><strong>Valor Unitário:</strong> R$ <?php echo number_format($ingresso['valor_unit_ingresso'], 2, ',', '.'); ?></p>
                <p><strong>Valor Total:</strong> R$ <?php echo number_format($ingresso['valor_total_ingresso'], 2, ',', '.'); ?></p>
                <p><strong>Data da Compra:</strong> <?php echo date('d/m/Y H:i', strtotime($ingresso['data_compra_ingresso'])); ?></p>
                <p><strong>Status:</strong> <?php echo $ingresso['status_ingresso']; ?></p>
                <p><strong>Código QR:</strong> <?php echo $ingresso['cod_qr_ingresso']; ?></p>


            </div>
        </section>



    </main>

    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>
</body>

</html>