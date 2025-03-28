<a href="http://localhost/sistema-pqmarisa/public/cliente/adicionar" class="btn btn-primary">Cadastrar Cliente </a>


<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Bairro</th>
      <th scope="col">Estado</th>
      <th scope="col">Cidade</th>
      <th scope="col">Data de Nascimento</th>
      <th scope="col">Telefone</th>
      <th scope="col">E-mail</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
  foreach ($cliente as $linha): ?>
  <tr>
    <td scope="col"><?php echo $linha['id_cliente']; ?></td>
    <td scope="col"><?php echo $linha['nome_cliente']; ?></td>
    <td scope="col"><?php echo $linha['cpf_cliente']; ?></td>
    <td scope="col"><?php echo $linha['bairro_cliente']; ?></td>
    <td scope="col"><?php echo $linha['estado_cliente']; ?></td>
    <td scope="col"><?php echo $linha['cidade_cliente']; ?></td>
    <td scope="col"><?php echo date("d/m/Y", strtotime($linha['data_nasc_cliente'])); ?></td>
    <td scope="col"><?php echo $linha['telefone_cliente']; ?></td>
    <td scope="col"><?php echo $linha['email_cliente']; ?></td>
    <td>
      <a href="editar_cliente.php?id=<?php echo $linha['id_cliente']; ?>" class="btn btn-warning">Editar</a>
    </td>
    <td>
      <a href="desativar_cliente.php?id=<?php echo $linha['id_cliente']; ?>" class="btn btn-danger">Desativar</a>
    </td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
