

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
            <section class="site">
                <div class="ingressoTabela">
                    <?php if ($ingresso): ?>
                        <table class="table table-dark table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Ingresso</th>
                                    <th>Quantidade Comprada</th>
                                    <th>Quantidade Pendente</th>
                                    <th>Valor Unitário</th>
                                    <th>Valor Total</th>
                                    <th>Data da Compra</th>
                                    <th>Status</th>
                                    <th>QR Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $ingresso['id_ingresso']; ?></td>
                                    <td><?php echo $ingresso['qtde_compra_ingresso']; ?></td>
                                    <td><?php echo $ingresso['qtde_pendente_ingresso']; ?></td>
                                    <td>R$ <?php echo number_format($ingresso['valor_unit_ingresso'], 2, ',', '.'); ?></td>
                                    <td>R$ <?php echo number_format($ingresso['valor_total_ingresso'], 2, ',', '.'); ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($ingresso['data_compra_ingresso'])); ?></td>
                                    <td>
                                        <?php if ($ingresso['status_ingresso'] == 'Ativo'): ?>
                                            <span class="badge bg-success">Ativo</span>
                                        <?php elseif ($ingresso['status_ingresso'] == 'Inativo'): ?>
                                            <span class="badge bg-secondary">Inativo</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark"><?php echo $ingresso['status_ingresso']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($ingresso['status_ingresso'] != 'Pendente') {
                                            $dadosQRCode = "ID: {$ingresso['id_ingresso']}\n";
                                            $dadosQRCode .= "Comprados: {$ingresso['qtde_compra_ingresso']}\n";
                                            $dadosQRCode .= "Usos restantes: {$ingresso['qtde_pendente_ingresso']}";

                                            $qrCodePath = gerarQRCode($dadosQRCode, $ingresso['id_ingresso']);
                                            echo "<img src='$qrCodePath' alt='QR Code do Ingresso' width='100'>";
                                        } else {
                                            echo "QR Code indisponível (pendente)";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p><strong>Não há ingresso registrado para você.</strong></p>
                        <a href="compra_ingresso.php" class="btn btn-primary">Comprar Ingresso</a>
                    <?php endif; ?>
                </div>
            </section>

        </section>


    </main>

    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>
</body>

</html>