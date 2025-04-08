<form class="form-eventos container" method="POST" action="http://localhost/sistema-pqmarisa/public/eventos/editar/<?php echo $dadosEvento['id_eventos']; ?>" enctype="multipart/form-data">
    <div class="row">
        <h2 class="text-center">Editar evento</h2>
        
        <div class="mb-3">
            <label for="nome_eventos" class="form-label">Nome do Evento</label>
            <input type="text" class="form-control" id="nome_eventos" name="nome_eventos" value="<?php echo $evento['nome_eventos']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="foto_eventos" class="form-label">Foto do Evento</label>
            <input type="file" class="form-control" id="foto_eventos" name="foto_eventos" accept="image/*">
            <?php if($evento['foto_eventos']): ?>
                <div class="mt-2">
                    <img src="<?php echo BASE_URL . 'assets/img/Eventos/' . $evento['foto_eventos']; ?>" 
                         alt="<?php echo $evento['alt_eventos']; ?>" 
                         class="img-thumbnail" style="max-width: 200px">
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="data_inicio_eventos" class="form-label">Data de Início</label>
            <input type="date" class="form-control" id="data_inicio_eventos" name="data_inicio_eventos" value="<?php echo $evento['data_inicio_eventos']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="data_fim_eventos" class="form-label">Data de Término</label>
            <input type="date" class="form-control" id="data_fim_eventos" name="data_fim_eventos" value="<?php echo $evento['data_fim_eventos']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="alt_eventos" class="form-label">Texto Alternativo da Imagem</label>
            <input type="text" class="form-control" id="alt_eventos" name="alt_eventos" value="<?php echo $evento['alt_eventos']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="status_eventos" class="form-label">Status do Evento</label>
            <select class="form-select" id="status_eventos" name="status_eventos" required>
                <option value="ativo" <?php echo $evento['status_eventos'] == 'ativo' ? 'selected' : ''; ?>>Ativo</option>
                <option value="inativo" <?php echo $evento['status_eventos'] == 'inativo' ? 'selected' : ''; ?>>Inativo</option>
            </select>
        </div>
        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Salvar evento</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>


