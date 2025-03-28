<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID Serviço</th>
      <th scope="col">Nome Serviço</th>
      <th scope="col">Descrição</th>
      <th scope="col">Valor</th>
      <th scope="col">Foto</th>
      <th scope="col">Texto Alternativo</th>
      <th scope="col">Brinquedo Relacionado</th>
      <th scope="col">Status</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($servico as $linha): ?>
      <tr>
        <td scope="col"><?php echo $linha['id_servico']; ?></td>
        <td scope="col"><?php echo $linha['nome_servico']; ?></td>
        <td scope="col"><?php echo $linha['descricao_servico']; ?></td>
        <td scope="col"><?php echo 'R$ ' . number_format($linha['valor_servico'], 2, ',', '.'); ?></td>
        <td scope="col">
          <img src="<?php echo $linha['foto_servico']; ?>" alt="<?php echo $linha['alt_servico']; ?>" style="width: 50px; height: 50px;">
        </td>
        <td scope="col"><?php echo $linha['alt_servico']; ?></td>
        <td scope="col"><?php echo $linha['nome_brinquedo']; ?></td>
        <td scope="col"><?php echo $linha['status_servico']; ?></td>
        <td>
          <a href="editar_servico.php?id=<?php echo $linha['id_servico']; ?>" class="btn btn-warning">Editar</a>
        </td>
        <td>
          <a href="desativar_servico.php?id=<?php echo $linha['id_servico']; ?>" class="btn btn-danger">Desativar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
