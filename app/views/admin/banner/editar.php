<form class="form-banner container" method="POST" action="http://localhost/sistema-pqmarisa/public/banner/editar/<?php echo $dadosBanner['id_banner'] ?>" enctype="multipart/form-data">
    <div class="row">
        <!-- Coluna da Imagem Fixa -->
        <div class="col-md-6 text-center">
            <label class="form-label">Imagem Fixa</label>
            <img id="previewFoto" 
                src="http://localhost/sistema-pqmarisa/public/<?php echo $dadosBanner['foto_banner'] ?>" 
                alt="<?php echo $dadosBanner['alt_banner'] ?>" 
                class="img-fluid rounded shadow" 
                style="width: 100%; cursor: pointer;" 
                title="Clique na imagem para alterar">
            <input type="file" name="foto_banner" id="foto_banner" style="display: none;" accept="image/*">
        </div>

        <!-- Coluna da Imagem Animada -->
        <div class="col-md-6 text-center">
            <label class="form-label">GIF ou Vídeo (MP4)</label>
            <?php
                $videoPath = "http://localhost/sistema-pqmarisa/public/" . $dadosBanner['video_banner'];
                $ext = pathinfo($videoPath, PATHINFO_EXTENSION);
            ?>
            <?php if (strtolower($ext) === 'gif'): ?>
                <img id="previewGif" 
                    src="<?php echo $videoPath ?>" 
                    alt="<?php echo $dadosBanner['alt_banner'] ?>" 
                    class="img-fluid rounded shadow" 
                    style="width: 100%; cursor: pointer;" 
                    title="Clique para alterar o GIF">
            <?php else: ?>
                <video id="previewGif" width="100%" autoplay muted loop style="cursor: pointer;">
                    <source src="<?php echo $videoPath ?>" type="video/mp4">
                    Seu navegador não suporta vídeo.
                </video>
            <?php endif; ?>
            <input type="file" name="video_banner" id="video_banner" style="display: none;" accept="image/gif,video/mp4">
        </div>

        <!-- Campos do formulário -->
        <div class="col-md-12 mt-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nome_banner" class="form-label">Nome do Banner</label>
                    <input type="text" class="form-control" id="nome_banner" name="nome_banner" required 
                        value="<?php echo $dadosBanner['nome_banner'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="alt_banner" class="form-label">Texto Alternativo</label>
                    <input type="text" class="form-control" id="alt_banner" name="alt_banner" 
                        value="<?php echo $dadosBanner['alt_banner'] ?>">
                </div>

                <div class="col-md-6">
                    <label for="status_banner" class="form-label">Status</label>
                    <select id="status_banner" name="status_banner" class="form-select" required>
                        <option value="Ativo" <?php echo ($dadosBanner['status_banner'] == 'Ativo') ? 'selected' : '' ?>>Ativo</option>
                        <option value="Inativo" <?php echo ($dadosBanner['status_banner'] == 'Inativo') ? 'selected' : '' ?>>Inativo</option>
                    </select>
                </div>

                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success">Salvar Banner</button>
                    <a href="http://localhost/sistema-pqmarisa/public/banner/listar" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const previewFoto = document.getElementById('previewFoto');
        const inputFoto = document.getElementById('foto_banner');
        const previewGif = document.getElementById('previewGif');
        const inputGif = document.getElementById('video_banner');

        previewFoto.addEventListener('click', () => inputFoto.click());
        previewGif.addEventListener('click', () => inputGif.click());

        inputFoto.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => previewFoto.src = e.target.result;
                reader.readAsDataURL(this.files[0]);
            }
        });

        inputGif.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const reader = new FileReader();

                if (file.type === 'video/mp4') {
                    reader.onload = function(e) {
                        previewGif.outerHTML = `<video id="previewGif" width="100%" autoplay muted loop style="cursor: pointer;">
                                                    <source src="${e.target.result}" type="video/mp4">
                                                    Seu navegador não suporta vídeo.
                                                </video>`;
                    };
                } else {
                    reader.onload = function(e) {
                        previewGif.outerHTML = `<img id="previewGif" src="${e.target.result}" class="img-fluid rounded shadow" style="width: 100%; cursor: pointer;">`;
                    };
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
