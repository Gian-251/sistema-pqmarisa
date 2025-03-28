<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Rua</th>
      <th scope="col">Cidade</th>
      <th scope="col">Bairro</th>
      <th scope="col">Data de Nascimento</th>
      <th scope="col">Telefone</th>
      <th scope="col">E-mail</th>
      <th scope="col">Turno</th>
      <th scope="col">Status</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
  foreach ($agentes as $linha): ?>
  <tr>
    <td scope="col"><?php echo $linha['id_agente']; ?></td>
    <td scope="col"><?php echo $linha['nome_agente']; ?></td>
    <td scope="col"><?php echo $linha['cpf_agente']; ?></td>
    <td scope="col"><?php echo $linha['rua_agente']; ?></td>
    <td scope="col"><?php echo $linha['cidade_agente']; ?></td>
    <td scope="col"><?php echo $linha['bairro_agente']; ?></td>
    <td scope="col"><?php echo date("d/m/Y", strtotime($linha['data_nasc_agente'])); ?></td>
    <td scope="col"><?php echo $linha['telefone_agente']; ?></td>
    <td scope="col"><?php echo $linha['email_agente']; ?></td>
    <td scope="col"><?php echo $linha['turno_agente']; ?></td>
    <td scope="col"><?php echo $linha['status_agente']; ?></td>
    
  
    
   
    <td>
      <a href="editar_agente.php?id=<?php echo $linha['id_agente']; ?>" class="btn btn-warning">Editar</a>
    </td>
    <td>
      <a href="desativar_agente.php?id=<?php echo $linha['id_agente']; ?>" class="btn btn-danger">Desativar</a>
    </td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
