<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Nome do Banner</th>
      <th scope="col">Imagem</th>
      <th scope="col">GIF / Vídeo</th>
      <th scope="col">Alt</th>
      <th scope="col">Status</th>
      <th scope="col">Editar</th>
      <th scope="col">Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($banners as $linha): ?>
      <tr>
        <!-- Nome -->
        <td><?php echo htmlspecialchars($linha['nome_banner']); ?></td>

        <!-- Imagem -->
        <td>
          <?php
            $caminhoBase = "http://localhost/sistema-pqmarisa/public/";
            $foto = $linha['foto_banner'] ?? 'assets/img/Banner/semfoto.png';
            $urlFoto = $caminhoBase . $foto;
          ?>
          <img src="<?php echo $urlFoto; ?>"
               class="img-thumbnail"
               alt="<?php echo htmlspecialchars($linha['alt_banner']); ?>"
               style="max-width: 120px;">
        </td>

        <!-- GIF / Vídeo -->
        <td>
          <?php
            if (!empty($linha['video_banner'])) {
              $videoPath = $linha['video_banner'];
              $ext = strtolower(pathinfo($videoPath, PATHINFO_EXTENSION));
              $urlVideo = $caminhoBase . $videoPath;

              if ($ext === 'gif') {
                echo '<img src="' . $urlVideo . '" class="img-thumbnail" style="max-width: 120px;" alt="GIF">';
              } elseif ($ext === 'mp4') {
                echo '<video width="150" autoplay muted loop>
                        <source src="' . $urlVideo . '" type="video/mp4">
                        Seu navegador não suporta vídeos.
                      </video>';
              } else {
                echo '<span>Formato inválido</span>';
              }
            } else {
              echo '<span>Sem vídeo</span>';
            }
          ?>
        </td>

        <!-- Alt -->
        <td><?php echo htmlspecialchars($linha['alt_banner']); ?></td>

        <!-- Status -->
        <td><?php echo htmlspecialchars($linha['status_banner']); ?></td>

        <!-- Editar -->
        <td>
        <a href="http://localhost/sistema-pqmarisa/public/banner/editar/<?php echo $linha['id_banner']; ?>"
          type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
        </td>

        <!-- Desativar -->
        <td>
          <a href="http://localhost/sistema-pqmarisa/public/banner/desativar/<?php echo $linha['id_banner']; ?>"
             class="btn btn-danger btn-sm"
             onclick="return confirm('Deseja desativar este banner?');">Desativar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
