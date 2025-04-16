<a href="http://localhost/sistema-pqmarisa/public/info/adicionar" class="btn btn-primary">Cadastrar informação </a>

<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Informação</th>
      <th scope="col">Status</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($info as $linha): ?>
    <tr>
      <td scope="col"><?php echo $linha['id_info']; ?></td>
      <td scope="col"><?php echo $linha['nome_info']; ?></td>
      <td scope="col"><?php echo $linha['informacao_texto_info']; ?></td>
      <td scope="col"><?php echo $linha['status_info']; ?></td>
      <td>
        <a href="http://localhost/sistema-pqmarisa/public/info/editar/<?php echo $linha['id_info']; ?>"
          type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
      </td>
      <td>
        <a href="desativar_info.php?id=<?php echo $linha['id_info']; ?>" class="btn btn-danger">Desativar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
