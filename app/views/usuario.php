<?php require_once('template/topomenu.php'); ?>

<body id="usuario">
    <header>
        <?php require_once('template/menu.php'); ?>
    </header>

    <main>
        <section class="site">
            <h2 class="mb-4">Dados do Cliente</h2>

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
        </section>



    </main>

    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>
</body>

</html>