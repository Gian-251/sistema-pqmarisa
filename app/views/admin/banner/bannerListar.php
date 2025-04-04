<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Imagem</th>
      <th scope="col">Vídeo</th>
      <th scope="col">Texto Alternativo</th>
      <th scope="col">Status</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($banners as $linha): ?>
    <tr>
      <td scope="col"><?php echo $linha['id_banner']; ?></td>
      <td scope="col"><?php echo $linha['nome_banner']; ?></td>
      <td scope="col">
        <img src="<?php echo $linha['foto_banner']; ?>" alt="<?php echo $linha['alt_banner']; ?>" class="img-thumbnail" width="100">
      </td>
      <td scope="col">
        <video width="150" controls>
          <source src="<?php echo $linha['video_banner']; ?>" type="video/mp4">
          Seu navegador não suporta vídeos.
        </video>
      </td>
      <td scope="col"><?php echo $linha['alt_banner']; ?></td>
      <td scope="col"><?php echo $linha['status_banner']; ?></td>
      <td>
        <a href="editar_banner.php?id=<?php echo $linha['id_banner']; ?>" class="btn btn-warning">Editar</a>
      </td>
      <td>
        <a href="desativar_banner.php?id=<?php echo $linha['id_banner']; ?>" class="btn btn-danger">Desativar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
