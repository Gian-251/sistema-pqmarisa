<form class="form-info container" method="POST" action="http://localhost/sistema-pqmarisa/public/info/editarInfo/<?php echo $dadosInfo['id_info'] ?>">
    <div class="row">
        <!-- Coluna do formulário -->
        <div class="col-md-8">
            <div class="row g-3">
                <!-- Nome da Informação -->
                <div class="col-12">
                    <label for="nome_info" class="form-label">Título da Informação</label>
                    <input type="text" class="form-control" id="nome_info" name="nome_info" required 
                        value="<?php echo $dadosInfo['nome_info'] ?>">
                </div>

                <!-- Texto da Informação -->
                <div class="col-12">
                    <label for="informacao_texto_info" class="form-label">Texto da Informação</label>
                    <textarea class="form-control" id="informacao_texto_info" name="informacao_texto_info" rows="6" required><?php echo $dadosInfo['informacao_texto_info'] ?></textarea>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status_info" class="form-label">Status</label>
                    <select id="status_info" name="status_info" class="form-select" required>
                        <option value="ATIVO" <?php echo $dadosInfo['status_info'] == 'ATIVO' ? 'selected' : ''; ?>>Ativo</option>
                        <option value="INATIVO" <?php echo $dadosInfo['status_info'] == 'INATIVO' ? 'selected' : ''; ?>>Desativado</option>
                    </select>
                </div>

                <!-- Botões -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Salvar Informação</button>
                    <a href="http://localhost/sistema-pqmarisa/public/info/listar" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
</form>
