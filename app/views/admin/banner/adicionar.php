<form class="form-banner container" method="POST" action="http://localhost/sistema-pqmarisa/public/banner/adicionar" enctype="multipart/form-data">
    <div class="row">
        <h2 class="text-center"> Banner</h2>

        <!-- Coluna da imagem estática -->
        <div class="col-md-6 text-center">
            <label class="form-label">Imagem Estática (Foto)</label>
            <img id="previewFoto" src="http://localhost/sistema-pqmarisa/public/img/banner/semfoto.png"
                alt="Imagem do Banner"
                class="img-fluid rounded shadow"
                style="width: 100%; cursor: pointer;"
                title="Clique para escolher a imagem">
            <input type="file" name="foto_banner" id="foto_banner" style="display: none;" accept="image/*">
        </div>

        <!-- Coluna do GIF -->
                <div class="col-md-6 text-center">
            <label class="form-label">Imagem Animada (GIF ou Vídeo MP4)</label>

            <!-- Imagem padrão (clique para trocar) -->
            <img id="previewGif" 
                src="http://localhost/sistema-pqmarisa/public/img/banner/semgif.gif"
                alt="GIF ou vídeo do Banner"
                class="img-fluid rounded shadow"
                style="width: 100%; cursor: pointer;"
                title="Clique para escolher um GIF ou vídeo">

            <!-- Campo de upload escondido -->
            <input type="file" name="video_banner" id="video_banner" 
                style="display: none;" accept="image/gif,video/mp4">
        </div>

        <!-- Informações -->
        <div class="col-md-6 mt-3">
            <label for="nome_banner" class="form-label">Nome do Banner</label>
            <input type="text" class="form-control" id="nome_banner" name="nome_banner" required>
        </div>

        <div class="col-md-6 mt-3">
            <label for="alt_banner" class="form-label">Texto Alternativo</label>
            <input type="text" class="form-control" id="alt_banner" name="alt_banner" required>
        </div>

        <div class="col-md-6 mt-3">
            <label for="status_banner" class="form-label">Status</label>
            <select id="status_banner" name="status_banner" class="form-select" required>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
                <option value="Desativado">Desativado</option>
            </select>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end mt-4">
            <button type="submit" class="btn btn-primary">Salvar Banner</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const previewFoto = document.getElementById('previewFoto');
        const previewGif = document.getElementById('previewGif');
        const fotoInput = document.getElementById('foto_banner');
        const gifInput = document.getElementById('video_banner');

        previewFoto.addEventListener('click', function() {
            fotoInput.click();
        });

        previewGif.addEventListener('click', function() {
            gifInput.click();
        });

        fotoInput.addEventListener('change', function() {
            if(fotoInput.files && fotoInput.files[0]){
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewFoto.src = e.target.result;
                }
                reader.readAsDataURL(fotoInput.files[0]);
            }
        });

        gifInput.addEventListener('change', function() {
            if(gifInput.files && gifInput.files[0]){
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewGif.src = e.target.result;
                }
                reader.readAsDataURL(gifInput.files[0]);
            }
        });
    });
</script>

<script>
// Clique na imagem abre seletor de arquivo
document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('video_banner');
    let preview = document.getElementById('previewGif');

    preview.addEventListener('click', function () {
        fileInput.click();
    });

    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const url = URL.createObjectURL(file);
            const ext = file.name.split('.').pop().toLowerCase();

            // Substitui imagem por vídeo se for mp4
            if (ext === 'mp4') {
                preview.outerHTML = `
                    <video id="previewGif" class="img-fluid rounded shadow" 
                        style="width: 100%; cursor: pointer;" autoplay muted loop>
                        <source src="${url}" type="video/mp4">
                        Seu navegador não suporta vídeo.
                    </video>`;
            } else if (ext === 'gif') {
                preview.outerHTML = `
                    <img id="previewGif" src="${url}" 
                         class="img-fluid rounded shadow"
                         style="width: 100%; cursor: pointer;" 
                         alt="Prévia GIF">`;
            }

            // Atualiza a referência do preview após substituição
            preview = document.getElementById('previewGif');
            preview.addEventListener('click', function () {
                fileInput.click();
            });
        }
    });
});
</script>
