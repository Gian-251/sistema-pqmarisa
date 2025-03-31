<form class="form-letreiro container" method="POST" action="http://localhost/sistema-pqmarisa/public/letreiro/adicionar" enctype="multipart/form-data">
<div class="mb-3">
        <label for="texto_letreiro" class="form-label">Texto do Letreiro</label>
        <input type="text" class="form-control" id="texto_letreiro" name="texto_letreiro" required>
    </div>

    <div class="mb-3">
        <label for="status_letreiro" class="form-label">Status do Letreiro</label>
        <select class="form-select" id="status_letreiro" name="status_letreiro" required>
            <option value="ATIVO">ATIVO</option>
            <option value="DESATIVADO">DESATIVADO</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Letreiro</button>
</form>