<form class="form-brinquedo container" method="POST" action="">
    <div class="row">
        <h2 class="text-center">Editar Brinquedo</h2>

        <!-- Foto Atual -->
        <div class="col-md-6">
            <label class="form-label d-block">Foto Atual:</label>
            <?php if (!empty($brinquedo['foto_brinquedo'])): ?>
                <img src="<?php echo BASE_URL . 'assets/img/atraçõesPag/' . $brinquedo['foto_brinquedo']; ?>" class="img-thumbnail" width="200">
            <?php else: ?>
                <p class="text-muted">Nenhuma imagem disponível.</p>
            <?php endif; ?>
        </div>

        <!-- Nova Foto -->
        <div class="col-md-6">
            <label for="foto_brinquedo" class="form-label">Alterar Imagem</label>
            <input type="file" class="form-control" id="foto_brinquedo" name="foto_brinquedo" accept="image/*">
        </div>

        <!-- Nome do Brinquedo -->
        <div class="col-md-6">
            <label for="nome_brinquedo" class="form-label">Nome do Brinquedo</label>
            <input type="text" class="form-control" id="nome_brinquedo" name="nome_brinquedo" required value="<?php echo $brinquedo['nome_brinquedo']; ?>">
        </div>

        <!-- Hora de Funcionamento -->
        <div class="col-md-6">
            <label for="hora_parque_brinquedo" class="form-label">Hora de Funcionamento</label>
            <input type="time" class="form-control" id="hora_parque_brinquedo" name="hora_parque_brinquedo" required value="<?php echo $brinquedo['hora_parque_brinquedo']; ?>">
        </div>

        <!-- Capacidade -->
        <div class="col-md-6">
            <label for="capacidade_brinquedo" class="form-label">Capacidade</label>
            <input type="number" class="form-control" id="capacidade_brinquedo" name="capacidade_brinquedo" required value="<?php echo $brinquedo['capacidade_brinquedo']; ?>">
        </div>

        <!-- Altura -->
        <div class="col-md-6">
            <label for="alt_brinquedo" class="form-label">Altura Mínima</label>
            <input type="text" class="form-control" id="alt_brinquedo" name="alt_brinquedo" required value="<?php echo $brinquedo['alt_brinquedo']; ?>">
        </div>



        <!-- Duração -->
        <div class="col-md-6">
            <label for="duracao_brinquedo" class="form-label">Duração</label>
            <input type="time" class="form-control" id="duracao_brinquedo" name="duracao_brinquedo" required value="<?php echo $brinquedo['duracao_brinquedo']; ?>">
        </div>

        <!-- Status -->
        <div class="col-md-6">
            <label for="status_brinquedo" class="form-label">Status</label>
            <input type="text" class="form-control" id="status_brinquedo" name="status_brinquedo" required value="<?php echo $brinquedo['status_brinquedo']; ?>">
        </div>

        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Salvar Brinquedo</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>