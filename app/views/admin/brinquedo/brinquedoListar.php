<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Hora de Funcionamento</th>
      <th scope="col">Capacidade</th>
      <th scope="col">Duração</th>
      <th scope="col">Status</th>
      <th scope="col">Editar</th>
      <th scope="col">Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($brinquedo as $linha): ?>
    <tr>
      <td scope="col"><?php echo $linha['id_brinquedo']; ?></td>
      <td scope="col"><?php echo $linha['nome_brinquedo']; ?></td>
      <td scope="col"><?php echo $linha['hora_parque_brinquedo']; ?></td>
      <td scope="col"><?php echo $linha['capacidade_brinquedo']; ?></td>
      <td scope="col"><?php echo $linha['duracao_brinquedo']; ?></td>
      <td scope="col"><?php echo $linha['status_brinquedo']; ?></td>
      <td>
        <a href="editar_brinquedo.php?id=<?php echo $linha['id_brinquedo']; ?>" class="btn btn-warning">Editar</a>
      </td>
      <td>
        <a href="desativar_brinquedo.php?id=<?php echo $linha['id_brinquedo']; ?>" class="btn btn-danger">Desativar</a>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
