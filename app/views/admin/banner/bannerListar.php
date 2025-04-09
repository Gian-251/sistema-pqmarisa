<a href="http://localhost/sistema-pqmarisa/public/banner/adicionar" class="btn btn-primary">Cadastrar banner</a>

<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Imagem</th>
      <th scope="col">Vídeo / GIF</th>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">Alt</th>
      <th scope="col">Status</th>
      <th scope="col">Editar</th>
      <th scope="col">Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($banners as $linha): ?>
      <tr>
        <!-- Imagem -->
        <td>
          <?php
            $caminhoBase = "http://localhost/sistema-pqmarisa/public/img/banner/";
            $foto = $linha['foto_banner'] ?? 'semfoto.png';
            $urlFoto = $caminhoBase . $foto . '?v=' . time();
          ?>
          <img src="<?php echo $urlFoto; ?>"
               class="img-thumbnail"
               alt="<?php echo htmlspecialchars($linha['alt_banner']); ?>"
               style="max-width: 120px;">
        </td>

        <!-- Vídeo ou GIF -->
        <td>
          <?php if (!empty($linha['video_banner'])): ?>
            <?php
              $ext = strtolower(pathinfo($linha['video_banner'], PATHINFO_EXTENSION));
              $urlVideo = $caminhoBase . $linha['video_banner'] . '?v=' . time();
            ?>
            <?php if ($ext === 'gif'): ?>
              <img src="<?php echo $urlVideo; ?>"
                   class="img-thumbnail"
                   alt="<?php echo htmlspecialchars($linha['alt_banner']); ?>"
                   style="max-width: 120px;">
            <?php else: ?>
              <video width="150" autoplay muted loop>
                <source src="<?php echo $urlVideo; ?>" type="video/mp4">
                Seu navegador não suporta vídeos.
              </video>
            <?php endif; ?>
          <?php else: ?>
            <span>Sem vídeo</span>
          <?php endif; ?>
        </td>

        <!-- ID -->
        <td><?php echo $linha['id_banner']; ?></td>

        <!-- Nome -->
        <td><?php echo htmlspecialchars($linha['nome_banner']); ?></td>

        <!-- Texto Alternativo -->
        <td><?php echo htmlspecialchars($linha['alt_banner']); ?></td>

        <!-- Status -->
        <td><?php echo htmlspecialchars($linha['status_banner']); ?></td>

        <!-- Editar -->
        <td>
          <a href="http://localhost/sistema-pqmarisa/public/banner/editar/<?php echo $linha['id_banner']; ?>"
             class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
        </td>

        <!-- Desativar -->
        <td>
          <a href="http://localhost/sistema-pqmarisa/public/banner/desativar/<?php echo $linha['id_banner']; ?>"
             class="btn btn-danger"
             onclick="return confirm('Deseja desativar este banner?');">Desativar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
