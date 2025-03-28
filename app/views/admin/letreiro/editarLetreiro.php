<form class="form-letreiro container" method="POST" action="http://localhost/sistema-pqmarisa/public/letreiro/editarLetreiro/<?php echo $dadosLetreiro['id_letreiro'] ?>">
    <div class="row">
        <!-- Coluna do formulário -->
        <div class="col-md-8">
            <div class="row g-3">
                <!-- Texto do Letreiro -->
                <div class="col-12">
                    <label for="texto_letreiro" class="form-label">Texto do Letreiro</label>
                    <textarea class="form-control" id="texto_letreiro" name="texto_letreiro" required><?php echo $dadosLetreiro['texto_letreiro'] ?></textarea>
                </div>

                <!-- Status do Letreiro -->
                <div class="col-md-6">
                    <label for="status_letreiro" class="form-label">Status</label>
                    <select id="status_letreiro" name="status_letreiro" class="form-select" required>
                        <option value="ATIVO" <?php echo $dadosLetreiro['status_letreiro'] == 'ATIVO' ? 'selected' : ''; ?>>Ativo</option>
                        <option value="INATIVO" <?php echo $dadosLetreiro['status_letreiro'] == 'INATIVO' ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary">Salvar Letreiro</button>
                    <button type="reset" class="btn btn-secondary">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</form>
