<form class="form-servico container" method="POST" action="<?php echo BASE_URL . 'servico/editar/' . $dadosServico['id_servico']; ?>" enctype="multipart/form-data">
    <div class="row">
        <h2 class="text-center">Editar Serviço</h2>

        <!-- Nome do Serviço -->
        <div class="col-md-6">
            <label for="nome_servico" class="form-label">Nome do Serviço</label>
            <input type="text" class="form-control" id="nome_servico" name="nome_servico" 
                value="<?php echo $dadosServico['nome_servico']; ?>" 
                <?php echo (isset($dadosServico['nome_servico']) && !empty($dadosServico['nome_servico'])) ? 'required' : ''; ?>>
        </div>

        <!-- Valor do Serviço -->
        <div class="col-md-3">
            <label for="valor_servico" class="form-label">Valor (R$)</label>
            <input type="number" step="0.01" class="form-control" id="valor_servico" name="valor_servico" 
                value="<?php echo $dadosServico['valor_servico']; ?>" 
                <?php echo (isset($dadosServico['valor_servico']) && !empty($dadosServico['valor_servico'])) ? 'required' : ''; ?>>
        </div>

        <!-- Status -->
        <div class="col-md-3">
            <label for="status_servico" class="form-label">Status</label>
            <select class="form-select" id="status_servico" name="status_servico" 
                <?php echo (isset($dadosServico['status_servico']) && !empty($dadosServico['status_servico'])) ? 'required' : ''; ?>>
                <option value="ativo" <?php echo ($dadosServico['status_servico'] === 'ativo') ? 'selected' : ''; ?>>Ativo</option>
                <option value="inativo" <?php echo ($dadosServico['status_servico'] === 'inativo') ? 'selected' : ''; ?>>Inativo</option>
            </select>
        </div>

        <!-- Descrição -->
        <div class="col-md-12">
            <label for="descricao_servico" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="4" 
                <?php echo (isset($dadosServico['descricao_servico']) && !empty($dadosServico['descricao_servico'])) ? 'required' : ''; ?>><?php echo $dadosServico['descricao_servico']; ?></textarea>
        </div>

        <!-- Brinquedo relacionado -->
        <div class="col-md-6">
            <label for="id_brinquedo" class="form-label">Brinquedo Relacionado</label>
            <select class="form-select" id="id_brinquedo" name="id_brinquedo" 
                <?php echo (isset($dadosServico['id_brinquedo']) && !empty($dadosServico['id_brinquedo'])) ? 'required' : ''; ?>>
                <option value="">Selecione um brinquedo</option>
                <?php foreach ($brinquedos as $brinquedo): ?>
                    <option value="<?php echo $brinquedo['id_brinquedo']; ?>" 
                        <?php echo ($brinquedo['id_brinquedo'] == $dadosServico['id_brinquedo']) ? 'selected' : ''; ?>>
                        <?php echo $brinquedo['nome_brinquedo']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Foto Atual -->
        <div class="col-md-6">
            <label class="form-label d-block">Foto Atual:</label>
            <?php if (!empty($dadosServico['foto_servico'])): ?>
                <img src="<?php echo BASE_URL . 'assets/img/Eventos/' . $dadosServico['foto_servico']; ?>" class="img-thumbnail" width="200">
            <?php else: ?>
                <p class="text-muted">Nenhuma imagem disponível.</p>
            <?php endif; ?>
        </div>

        <!-- Nova Foto -->
        <div class="col-md-6">
            <label for="foto_servico" class="form-label">Alterar Imagem</label>
            <input type="file" class="form-control" id="foto_servico" name="foto_servico" accept="image/*">
        </div>

        <!-- ALT da imagem -->
        <div class="col-md-6">
            <label for="alt_servico" class="form-label">Texto Alternativo da Imagem</label>
            <input type="text" class="form-control" id="alt_servico" name="alt_servico" 
                value="<?php echo $dadosServico['alt_servico']; ?>" 
                <?php echo (isset($dadosServico['alt_servico']) && !empty($dadosServico['alt_servico'])) ? 'required' : ''; ?>>
        </div>

        <!-- Botões -->
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="<?php echo BASE_URL . 'servico/listar'; ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function(){
        const visualizarImg = document.getElementById('preview');
        const arquivo = document.getElementById('foto_servico');

        visualizarImg.addEventListener('click', function(){
            arquivo.click();

            arquivo.addEventListener('change', function(){
                if(arquivo.files && arquivo.files[0]){
                    let render = new FileReader();
                    render.onload = function(e){
                        visualizarImg.src = e.target.result
                    }
                    render.readAsDataURL(arquivo.files[0])
                }
            })
        })
    })
</script>
