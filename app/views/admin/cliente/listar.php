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
    foreach ($clientes as $cliente): ?>
    <tr>
      <td scope="col"><?php echo $cliente['id_cliente']; ?></td>
      <td scope="col"><?php echo $cliente['nome_cliente']; ?></td>
      <td scope="col"><?php echo $cliente['cpf_cliente']; ?></td>
      <td scope="col"><?php echo $cliente['bairro_cliente']; ?></td>
      <td scope="col"><?php echo $cliente['estato_cliente']; ?></td>
      <td scope="col"><?php echo $cliente['cidade_cliente']; ?></td>
      <td scope="col"><?php echo date("d/m/Y", strtotime($cliente['data_nasc_cliente'])); ?></td>
      <td scope="col"><?php echo $cliente['telefone_cliente']; ?></td>
      <td scope="col"><?php echo $cliente['email_cliente']; ?></td>
      <td>
        <a href="editar_cliente.php?id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-warning">Editar</a>
      </td>
      <td>
        <a href="desativar_cliente.php?id=<?php echo $cliente['id_cliente']; ?>" class="btn btn-danger">Desativar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
