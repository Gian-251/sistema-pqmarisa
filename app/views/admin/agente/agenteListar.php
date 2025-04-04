<a href="http://localhost/sistema-pqmarisa/public/banner/adicionar" class="btn btn-primary mb-3">
  Cadastrar Banner
</a>

<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Imagem</th>
      <th scope="col">GIF/Vídeo</th>
      <th scope="col">Nome do Banner</th>
      <th scope="col">Texto Alternativo</th>
      <th scope="col">Status</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($banners as $banner): ?>
    <tr>
      <!-- Imagem -->
      <td>
        <?php
          $caminhoBase = "http://localhost/sistema-pqmarisa/public/img/banner/";
          $img = $banner['foto_banner'] ? $caminhoBase . $banner['foto_banner'] : $caminhoBase . 'semfoto.png';
        ?>
        <img src="<?php echo $img; ?>" class="img-thumbnail" alt="<?php echo $banner['alt_banner']; ?>" width="100">
      </td>

      <!-- GIF / Vídeo -->
      <td>
        <?php if (!empty($banner['video_banner'])): ?>
          <img src="<?php echo $caminhoBase . $banner['video_banner']; ?>" class="img-thumbnail" width="100" alt="GIF">
        <?php else: ?>
          <span class="text-muted">Nenhum</span>
        <?php endif; ?>
      </td>

      <!-- Nome -->
      <td><?php echo $banner['nome_banner']; ?></td>

      <!-- Alt -->
      <td><?php echo $banner['alt_banner']; ?></td>

      <!-- Status -->
      <td><?php echo $banner['status_banner']; ?></td>

      <!-- Editar -->
      <td>
        <a href="http://localhost/sistema-pqmarisa/public/banner/editar/<?php echo $banner['id_banner']; ?>"
           class="btn btn-primary" title="Editar">
          <i class="bi bi-pencil-fill"></i>
        </a>
      </td>

      <!-- Desativar -->
      <td>
        <a href="#" class="btn btn-danger" title="Desativar" onclick="abrirModal(<?php echo $banner['id_banner']; ?>); return false;">
          <i class="bi bi-trash-fill"></i>
        </a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
