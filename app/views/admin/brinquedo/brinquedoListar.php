<a href="http://localhost/sistema-pqmarisa/public/brinquedo/adicionar" class="btn btn-primary mb-3">Cadastrar Brinquedo</a>

<table class="table table-dark table-striped align-middle text-center">
  <thead>
    <tr>
      <th scope="col">Imagem</th>
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
    <?php foreach ($brinquedo as $linha): ?>
      <tr>
        <td>
          <?php if (!empty($linha['foto_brinquedo'])): ?>
            <img src="<?php echo BASE_URL . 'assets/img/atraçõesPag/' . $linha['foto_brinquedo']; ?>" alt="<?php echo $linha['alt_brinquedo']; ?>" width="80" height="80" style="object-fit:cover;">
          <?php else: ?>
            <span>Sem imagem</span>
          <?php endif; ?>
        </td>
        <td><?php echo $linha['nome_brinquedo']; ?></td>
        <td><?php echo $linha['hora_parque_brinquedo']; ?></td>
        <td><?php echo $linha['capacidade_brinquedo']; ?></td>
        <td><?php echo $linha['duracao_brinquedo']; ?></td>
        <td>
          <?php if ($linha['status_brinquedo'] == 'ATIVO'): ?>
            <span class="badge bg-success">Ativo</span>
          <?php else: ?>
            <span class="badge bg-secondary">Inativo</span>
          <?php endif; ?>
        </td>
        <td>
          <a href="http://localhost/sistema-pqmarisa/public/brinquedo/editar/<?php echo $linha['id_brinquedo']; ?>" class="btn btn-primary">
            <i class="bi bi-pencil-fill"></i>
          </a>
        </td>
        <td>
          <a href="desativar_brinquedo.php?id=<?php echo $linha['id_brinquedo']; ?>" class="btn btn-danger">Desativar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


