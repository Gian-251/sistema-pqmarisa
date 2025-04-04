<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID Ingresso</th>
      <th scope="col">Nome Cliente</th>
      <th scope="col">Quantidade Compra</th>
      <th scope="col">Quantidade Pendente</th>
      <th scope="col">Código QR</th>
      <th scope="col">Foto QR</th>
      <th scope="col">Alteração QR</th>
      <th scope="col">Data Compra</th>
      <th scope="col">Valor Unitário</th>
      <th scope="col">Valor Total</th>
      <th scope="col">Status</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($ingresso as $linha): ?>
      <tr>
        <td scope="col"><?php echo $linha['id_ingresso']; ?></td>
        <td scope="col"><?php echo $linha['nome_cliente']; ?></td> <!-- Aqui mostra o nome do cliente -->
        <td scope="col"><?php echo $linha['qtde_compra_ingresso']; ?></td>
        <td scope="col"><?php echo $linha['qtde_pendente_ingresso']; ?></td>
        <td scope="col"><?php echo $linha['cod_qr_ingresso']; ?></td>
        <td scope="col"><img src="<?php echo $linha['foto_qr_ingresso']; ?>" alt="QR Foto" style="width: 50px; height: 50px;"></td>
        <td scope="col"><?php echo $linha['alt_qr_ingresso']; ?></td>
        <td scope="col"><?php echo date("d/m/Y", strtotime($linha['data_compra_ingresso'])); ?></td>
        <td scope="col"><?php echo 'R$ ' . number_format($linha['valor_unit_ingresso'], 2, ',', '.'); ?></td>
        <td scope="col"><?php echo 'R$ ' . number_format($linha['valor_total_ingresso'], 2, ',', '.'); ?></td>
        <td scope="col"><?php echo $linha['status_ingresso']; ?></td>

        <td>
          <a href="desativar_ingresso.php?id=<?php echo $linha['id_ingresso']; ?>" class="btn btn-danger">Desativar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
