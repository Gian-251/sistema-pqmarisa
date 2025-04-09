<form class="form-servico container" method="POST" action="http://localhost/sistema-pqmarisa/public/servico/editar/<?php echo $dadosCliente['id_servico'] ?>">
    <div class="row">
        <h2 class="text-center">Editar Cliente</h2>
        
        <form action="<?php echo BASE_URL . 'eventos/editar/' . $dadosServico['id_servico']; ?>" method="post" enctype="multipart/form-data" class="row g-3">

        <!-- Nome do Serviço -->
        <div class="col-md-6">
            <label for="nome_servico" class="form-label">Nome do Evento</label>
            <input type="text" class="form-control" id="nome_servico" name="nome_servico" required 
                value="<?php echo $dadosServico['nome_servico']; ?>">
        </div>

        <!-- Valor do Serviço -->
        <div class="col-md-3">
            <label for="valor_servico" class="form-label">Valor</label>
            <input type="number" step="0.01" class="form-control" id="valor_servico" name="valor_servico" 
                value="<?php echo $dadosServico['valor_servico']; ?>">
        </div>

        <!-- Status -->
        <div class="col-md-3">
            <label for="status_servico" class="form-label">Status</label>
            <select class="form-select" id="status_servico" name="status_servico">
                <option value="ativo" <?php echo ($dadosServico['status_servico'] === 'ativo') ? 'selected' : ''; ?>>Ativo</option>
                <option value="inativo" <?php echo ($dadosServico['status_servico'] === 'inativo') ? 'selected' : ''; ?>>Inativo</option>
            </select>
        </div>

        <!-- Descrição -->
        <div class="col-md-12">
            <label for="descricao_servico" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="4"><?php echo $dadosServico['descricao_servico']; ?></textarea>
        </div>

        <!-- Brinquedo relacionado -->
        <div class="col-md-6">
            <label for="id_brinquedo" class="form-label">Brinquedo Relacionado</label>
            <select class="form-select" id="id_brinquedo" name="id_brinquedo">
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
            <input type="text" class="form-control" id="alt_servico" name="alt_servico" value="<?php echo $dadosServico['alt_servico']; ?>">
        </div>

        <!-- Botões -->
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="<?php echo BASE_URL . 'eventos/eventosListar'; ?>" class="btn btn-secondary">Cancelar</a>
        </div>

</form>


        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Salvar Cliente</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>
