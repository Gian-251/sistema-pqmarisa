<a href="http://localhost/sistema-pqmarisa/public/banner/adicionar" class="btn btn-primary mb-3">Cadastrar banner</a>

<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Imagem</th>''
      <th scope="col">GIF / Vídeo</th>
      <th scope="col">Texto Alternativo</th>
      <th scope="col">Status</th>
      <th scope="col">Editar</th>
      <th scope="col">Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $caminho_base = "http://localhost/sistema-pqmarisa/public/img/banner/";

    foreach ($banners as $linha): ?>
      <tr>
        <td><?php echo $linha['id_banner']; ?></td>
        <td><?php echo $linha['nome_banner']; ?></td>

        <td>
          <img 
            src="<?php echo $caminho_base . $linha['foto_banner']; ?>" 
            alt="<?php echo $linha['alt_banner']; ?>" 
            class="img-thumbnail" 
            width="120">
        </td>

        <td>
          <video width="150" autoplay muted loop>
            <source src="<?php echo $caminho_base . $linha['video_banner']; ?>" type="video/mp4">
            Seu navegador não suporta vídeos.
          </video>
        </td>

        <td><?php echo $linha['alt_banner']; ?></td>
        <td><?php echo $linha['status_banner']; ?></td>

        <td>
          <a href="http://localhost/sistema-pqmarisa/public/banner/editar/<?php echo $linha['id_banner']; ?>" 
             class="btn btn-warning">
             Editar
          </a>
        </td>

        <td>
          <a href="http://localhost/sistema-pqmarisa/public/banner/desativar/<?php echo $linha['id_banner']; ?>" 
             class="btn btn-danger" 
             onclick="return confirm('Deseja desativar este banner?');">
             Desativar
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
