<a href="http://localhost/sistema-pqmarisa/public/agente/adicionar" class="btn btn-primary">Cadastrar Agente </a>

<table class="table table-dark table-striped">
  <thead>
    <tr>

      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">Cidade</th>
      <th scope="col">Bairro</th>
      <th scope="col">Data de Nascimento</th>
      <th scope="col">Telefone</th>
      <th scope="col">E-mail</th>
      <th scope="col">Turno</th>
      <th scope="col">Status</th>
      <th>Editar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
  foreach ($agentes as $linha): ?>
  <tr>

    <td scope="col"><?php echo $linha['nome_agente']; ?></td>
    <td scope="col"><?php echo $linha['cpf_agente']; ?></td>
    <td scope="col"><?php echo $linha['cidade_agente']; ?></td>
    <td scope="col"><?php echo $linha['bairro_agente']; ?></td>
    <td scope="col"><?php echo date("d/m/Y", strtotime($linha['data_nasc_agente'])); ?></td>
    <td scope="col"><?php echo $linha['telefone_agente']; ?></td>
    <td scope="col"><?php echo $linha['email_agente']; ?></td>
    <td scope="col"><?php echo $linha['turno_agente']; ?></td>
    <td scope="col"><?php echo $linha['status_agente']; ?></td>
    
  
    
   
    <td>
        <a href="http://localhost/sistema-pqmarisa/public/agente/editar/<?php echo $linha['id_agente']; ?>"
          type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
      </td>
    <td>

    

  </tr>
<?php endforeach; ?>
  </tbody>
</table>
