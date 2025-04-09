<a href="http://localhost/sistema-pqmarisa/public/eventos/adicionar" class="btn btn-primary">Cadastrar eventos </a>

<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Foto</th>
      <th scope="col">ID</th>
      <th scope="col">Nome do Evento</th>
      <th scope="col">Status</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($eventos as $linha): ?>
<tr>
<td scope="col">
    <?php
        $caminhoBase = "http://localhost/sistema-pqmarisa/public/assets/img/Eventos";
        $nomeArquivo = $linha['foto_eventos'] ?? 'semfoto.png';

        // Adiciona timestamp para evitar cache (opcional, útil pra GIFs que mudam)
        $urlFoto = $caminhoBase . '/' . $nomeArquivo . '?v=' . time();
    ?>
    <img src="<?php echo $urlFoto; ?>"
         class="img-thumbnail"
         alt="<?php echo htmlspecialchars($linha['nome_eventos']); ?>"
         style="max-width: 120px;">
</td>
  <td scope="col"><?php echo $linha['id_eventos']; ?></td>
  <td scope="col"><?php echo $linha['nome_eventos']; ?></td>
  <td scope="col"><?php echo $linha['status_eventos']; ?></td>
  <td>
        <a href="http://localhost/sistema-pqmarisa/public/eventos/editar/<?php echo $linha['id_eventos']; ?>"
          type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
      </td>
  <td>
    <a href="desativar_evento.php?id=<?php echo $linha['id_eventos']; ?>" class="btn btn-danger">Desativar</a>
  </td>
</tr>
<?php endforeach; ?>

  </tbody>
</table>
