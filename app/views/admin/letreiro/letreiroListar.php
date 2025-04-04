<a href="http://localhost/sistema-pqmarisa/public/letreiro/adicionarLetreiro" class="btn btn-primary">Cadastrar novo Letreiro </a>

<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Texto do Letreiro</th>
      <th scope="col">Status</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($letreiro as $linha): ?>
    <tr>
      <td scope="col"><?php echo $linha['id_letreiro']; ?></td>
      <td scope="col"><?php echo $linha['texto_letreiro']; ?></td>
      <td scope="col"><?php echo $linha['status_letreiro']; ?></td>
      <td>
        <a href="http://localhost/sistema-pqmarisa/public/letreiro/editarLetreiro/<?php echo $linha['id_letreiro']; ?>"
          type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
      </td>
      <td>
        <a href="#"
          type="button" class="btn btn-danger" title="Desativar" onclick="abrirModal(<?php echo $linha['id_letreiro']; ?>); return false;">
          <i class="bi bi-trash-fill"></i></a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
