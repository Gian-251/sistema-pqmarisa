<form class="form-evento container" method="POST" action="http://localhost/sistema-pqmarisa/public/info/editar/<?php echo $info['id_info']; ?>">
    <div class="row g-3">

        <!-- Nome da Informação -->
        <div class="col-md-12">
            <label for="nome_info" class="form-label">Título da Informação</label>
            <input type="text" class="form-control" id="nome_info" name="nome_info" required 
                   value="<?php echo $info['nome_info']; ?>">
        </div>

        <!-- Texto da Informação -->
        <div class="col-md-12">
            <label for="informacao_texto_info" class="form-label">Texto da Informação</label>
            <textarea class="form-control" id="informacao_texto_info" name="informacao_texto_info" rows="6" required><?php echo $info['informacao_texto_info']; ?></textarea>
        </div>

        <!-- Status -->
        <div class="col-md-6">
            <label for="status_info" class="form-label">Status</label>
            <select id="status_info" name="status_info" class="form-select" required>
                <option value="Ativo" <?php echo ($info['status_info'] == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                <option value="Inativo" <?php echo ($info['status_info'] == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
            </select>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end mt-3">
            <button type="submit" class="btn btn-success">Salvar Informação</button>
            <a href="http://localhost/sistema-pqmarisa/public/info/infolistar" class="btn btn-secondary">Cancelar</a>
        </div>

    </div>
</form>
