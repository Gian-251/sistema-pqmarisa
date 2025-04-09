<form class="form-evento container" method="POST" action="http://localhost/sistema-pqmarisa/public/eventos/editar/<?php echo $dadosEvento['id_eventos'] ?>" enctype="multipart/form-data">
    <div class="row">
        <!-- Coluna da imagem -->
        <div class="col-md-4 text-center">
            <img id="preview" 
                src="http://localhost/sistema-pqmarisa/public/assets/img/Eventos/<?php echo $dadosEvento['foto_eventos'] ?>" 
                alt="<?php echo $dadosEvento['alt_eventos'] ?>" 
                class="img-fluid rounded shadow" 
                style="width: 100%; cursor: pointer;" 
                title="Clique na imagem para alterar">
            <input type="file" name="foto_eventos" id="foto_eventos" style="display: none;" accept="image/*">
        </div>

        <!-- Coluna do formulário -->
        <div class="col-md-8">
            <div class="row g-3">
                <!-- Nome do Evento -->
                <div class="col-md-12">
                    <label for="nome_eventos" class="form-label">Nome do Evento</label>
                    <input type="text" class="form-control" id="nome_eventos" name="nome_eventos" required 
                        value="<?php echo $dadosEvento['nome_eventos'] ?>">
                </div>

                <!-- Data Início -->
                <div class="col-md-6">
                    <label for="data_inicio_eventos" class="form-label">Data de Início</label>
                    <input type="date" class="form-control" id="data_inicio_eventos" name="data_inicio_eventos" required 
                        value="<?php echo $dadosEvento['data_inicio_eventos'] ?>">
                </div>

                <!-- Data Fim -->
                <div class="col-md-6">
                    <label for="data_fim_eventos" class="form-label">Data de Fim</label>
                    <input type="date" class="form-control" id="data_fim_eventos" name="data_fim_eventos" required 
                        value="<?php echo $dadosEvento['data_fim_eventos'] ?>">
                </div>

                <!-- ALT da Imagem -->
                <div class="col-md-6">
                    <label for="alt_eventos" class="form-label">Texto Alternativo da Imagem</label>
                    <input type="text" class="form-control" id="alt_eventos" name="alt_eventos" 
                        value="<?php echo $dadosEvento['alt_eventos'] ?>">
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status_eventos" class="form-label">Status</label>
                    <select id="status_eventos" name="status_eventos" class="form-select" required>
                        <option value="Ativo" <?php echo ($dadosEvento['status_eventos'] == 'Ativo') ? 'selected' : '' ?>>Ativo</option>
                        <option value="Inativo" <?php echo ($dadosEvento['status_eventos'] == 'Inativo') ? 'selected' : '' ?>>Inativo</option>
                        <option value="Encerrado" <?php echo ($dadosEvento['status_eventos'] == 'Encerrado') ? 'selected' : '' ?>>Encerrado</option>
                    </select>
                </div>

                <!-- Botões -->
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-success">Salvar Evento</button>
                    <a href="http://localhost/sistema-pqmarisa/public/eventos/listar" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const visualizarImg = document.getElementById('preview');
        const arquivo = document.getElementById('foto_eventos');

        visualizarImg.addEventListener('click', function(){
            arquivo.click();
        });

        arquivo.addEventListener('change', function(){
            if (arquivo.files && arquivo.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    visualizarImg.src = e.target.result;
                }
                reader.readAsDataURL(arquivo.files[0]);
            }
        });
    });
</script>
