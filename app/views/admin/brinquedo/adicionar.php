<form class="form-brinquedo container" method="POST" action="">
    <div class="row">
        <h2 class="text-center">Adicionar Brinquedo</h2>
        
        <!-- Nome do Brinquedo -->
        <div class="col-md-6">
            <label for="nome_brinquedo" class="form-label">Nome do Brinquedo</label>
            <input type="text" class="form-control" id="nome_brinquedo" name="nome_brinquedo" required>
        </div>

        <!-- Hora de Funcionamento -->
        <div class="col-md-6">
            <label for="hora_parque_brinquedo" class="form-label">Hora de Funcionamento</label>
            <input type="time" class="form-control" id="hora_parque_brinquedo" name="hora_parque_brinquedo" required>
        </div>

        <!-- Capacidade -->
        <div class="col-md-6">
            <label for="capacidade_brinquedo" class="form-label">Capacidade</label>
            <input type="number" class="form-control" id="capacidade_brinquedo" name="capacidade_brinquedo" required>
        </div>

        <!-- Altura -->
        <div class="col-md-6">
            <label for="alt_brinquedo" class="form-label">Altura Mínima</label>
            <input type="text" class="form-control" id="alt_brinquedo" name="alt_brinquedo" required>
        </div>

        <!-- Foto -->
        <div class="col-md-6">
            <label for="foto_brinquedo" class="form-label">Foto</label>
            <input type="text" class="form-control" id="foto_brinquedo" name="foto_brinquedo" required>
        </div>

        <!-- Duração -->
        <div class="col-md-6">
            <label for="duracao_brinquedo" class="form-label">Duração</label>
            <input type="time" class="form-control" id="duracao_brinquedo" name="duracao_brinquedo" required>
        </div>

        <!-- Status -->
        <div class="col-md-6">
            <label for="status_brinquedo" class="form-label">Status</label>
            <input type="text" class="form-control" id="status_brinquedo" name="status_brinquedo" required>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Adicionar Brinquedo</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>
