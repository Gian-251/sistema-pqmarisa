<?php
// views/ingresso_view.php
require_once('template/topomenu.php');
?>

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
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $ingresso['id_ingresso']; ?></td>
                                <td><?php echo $ingresso['qtde_compra_ingresso']; ?></td>
                                <td id="qtde-pendente"><?php echo $ingresso['qtde_pendente_ingresso']; ?></td>
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
                                    <?php if ($ingresso['status_ingresso'] != 'Pendente' && isset($ingresso['qr_code_path'])): ?>
                                        <img src="<?php echo $ingresso['qr_code_path']; ?>" alt="QR Code do Ingresso" width="100" id="qrcode-img">
                                        <button class="btn btn-sm btn-info mt-2" onclick="atualizarQRCode()">Atualizar QR</button>
                                    <?php else: ?>
                                        QR Code indisponível (pendente)
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($ingresso['status_ingresso'] == 'Ativo'): ?>
                                        <button class="btn btn-sm btn-primary" onclick="usarQRCode(<?php echo $ingresso['id_ingresso']; ?>)">Usar Ingresso</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Modal para visualização do QR Code -->
                    <div class="modal fade" id="qrcodeModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <?php if (isset($ingresso['qr_code_path'])): ?>
                                        <img src="<?php echo $ingresso['qr_code_path']; ?>" alt="QR Code Ampliado" class="img-fluid">
                                        <p class="mt-3">Usos restantes: <span id="modal-qtde-pendente"><?php echo $ingresso['qtde_pendente_ingresso']; ?></span></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p><strong>Não há ingresso registrado para você.</strong></p>
                    <a href="compra_ingresso.php" class="btn btn-primary">Comprar Ingresso</a>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>

    <script>
        // JavaScript para interação com o QR Code
        function usarQRCode(ingressoId) {
            if (confirm('Deseja realmente usar este ingresso? Isso diminuirá a quantidade de usos disponíveis.')) {
                fetch('<?= BASE_URL ?>ingresso/usar/' + ingressoId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('qtde-pendente').textContent = data.qtde_pendente;
                            if (document.getElementById('modal-qtde-pendente')) {
                                document.getElementById('modal-qtde-pendente').textContent = data.qtde_pendente;
                            }
                            alert('Ingresso utilizado com sucesso! Usos restantes: ' + data.qtde_pendente);

                            if (data.qtde_pendente == 0) {
                                // Recarregar a página para atualizar o status
                                location.reload();
                            }
                        } else {
                            alert('Erro ao usar ingresso: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Erro ao comunicar com o servidor');
                    });
            }
        }

        function atualizarQRCode() {
            if (confirm('Atualizar o QR Code invalidará o anterior. Deseja continuar?')) {
                fetch('<?= BASE_URL ?>ingresso/atualizar-qrcode/<?php echo $ingresso['id_ingresso'] ?? 0; ?>', {
                        method: 'POST'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('qrcode-img').src = data.qr_code_path + '?t=' + new Date().getTime();
                            alert('QR Code atualizado com sucesso!');
                        } else {
                            alert('Erro ao atualizar QR Code: ' + data.message);
                        }
                    });
            }
        }

        function downloadQRCode() {
            const qrCodePath = '<?php echo $ingresso['qr_code_path'] ?? ''; ?>';
            if (qrCodePath) {
                const link = document.createElement('a');
                link.href = qrCodePath;
                link.download = 'ingresso_<?php echo $ingresso['id_ingresso'] ?? ''; ?>.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }

        // Mostrar modal quando clicar no QR Code
        document.getElementById('qrcode-img')?.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('qrcodeModal'));
            modal.show();
        });
    </script>
</body>

</html>