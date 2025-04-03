<form class="form-servico container" method="POST" action="http://localhost/sistema-pqmarisa/public/servico/adicionar" enctype="multipart/form-data">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="nome_servico" class="form-label">Nome do Serviço</label>
            <input type="text" class="form-control" id="nome_servico" name="nome_servico" required maxlength="50">
        </div>

        <div class="col-md-6">
            <label for="valor_servico" class="form-label">Valor</label>
            <input type="number" step="0.01" class="form-control" id="valor_servico" name="valor_servico" required>
        </div>

        <div class="col-12">
            <label for="descricao_servico" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="4" required></textarea>
        </div>

        <div class="col-md-6">
            <label for="foto_servico" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto_servico" name="foto_servico" required>
        </div>

        <div class="col-md-6">
            <label for="alt_servico" class="form-label">Texto Alternativo (para acessibilidade)</label>
            <input type="text" class="form-control" id="alt_servico" name="alt_servico" required maxlength="50">
        </div>

        <div class="col-md-6">
            <label for="id_brinquedo" class="form-label">Brinquedo Relacionado</label>
            <select class="form-select" id="id_brinquedo" name="id_brinquedo">
                <option value="">Selecione um brinquedo (opcional)</option>
                <!-- Aqui você pode adicionar um loop PHP para listar os brinquedos do banco de dados -->
                <?php if(isset($brinquedos)): ?>
                    <?php foreach($brinquedos as $brinquedo): ?>
                        <option value="<?php echo $brinquedo['id_brinquedo']; ?>"><?php echo $brinquedo['nome_brinquedo']; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>  

        <div class="col-md-6">
            <label for="status_servico" class="form-label">Status</label>
            <select id="status_servico" name="status_servico" class="form-select" required>
                <option value="Ativo">Ativo</option>
                <option value="Inativo">Inativo</option>
                <option value="Destaque">Destaque</option>
            </select>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Salvar Serviço</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>
