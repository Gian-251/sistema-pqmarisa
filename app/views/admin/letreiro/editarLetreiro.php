<form class="form-info container" method="POST" action="http://localhost/sistema-pqmarisa/public/letreiro/editarLetreiro/<?php echo $letreiro['id_letreiro']; ?>">
    <div class="row">
        <!-- Coluna do formulário -->
        <div class="col-md-8">
            <div class="row g-3">

                <!-- Texto do Letreiro -->
                <div class="col-12">
                    <label for="texto_letreiro" class="form-label">Texto do Letreiro</label>
                    <textarea class="form-control" id="texto_letreiro" name="texto_letreiro" rows="6" required><?php echo isset($letreiro['texto_letreiro']) ? htmlspecialchars($letreiro['texto_letreiro']) : ''; ?></textarea>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label for="status_letreiro" class="form-label">Status</label>
                    <select id="status_letreiro" name="status_letreiro" class="form-select" required>
                        <option value="ATIVO" <?php echo isset($letreiro['status_letreiro']) && $letreiro['status_letreiro'] == 'ATIVO' ? 'selected' : ''; ?>>Ativo</option>
                        <option value="INATIVO" <?php echo isset($letreiro['status_letreiro']) && $letreiro['status_letreiro'] == 'INATIVO' ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>

                <!-- Botões -->
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    <a href="http://localhost/sistema-pqmarisa/public/letreiro/letreiroListar" class="btn btn-secondary">Cancelar</a>
                </div>

            </div>
        </div>
    </div>
</form>
