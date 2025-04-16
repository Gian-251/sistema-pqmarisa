<form class="container mt-4" method="POST" action="http://localhost/sistema-pqmarisa/public/info/adicionar">
    <h4 class="mb-4">Cadastrar Nova Informação</h4>

    <!-- Nome da Informação -->
    <div class="mb-3">
        <label for="nome_info" class="form-label">Título da Informação</label>
        <input type="text" class="form-control" id="nome_info" name="nome_info" required>
    </div>

    <!-- Texto da Informação -->
    <div class="mb-3">
        <label for="informacao_texto_info" class="form-label">Descrição / Texto</label>
        <textarea class="form-control" id="informacao_texto_info" name="informacao_texto_info" rows="5" required></textarea>
    </div>

    <!-- Status da Informação -->
    <div class="mb-3">
        <label for="status_info" class="form-label">Status</label>
        <select class="form-select" id="status_info" name="status_info" required>
            <option selected disabled value="">Selecione o status</option>
            <option value="Ativo">Ativo</option>
            <option value="Inativo">Inativo</option>
        </select>
    </div>

    <!-- Botão -->
    <button type="submit" class="btn btn-success">Salvar Informação</button>
    <a href="http://localhost/sistema-pqmarisa/public/info/listar" class="btn btn-secondary">Cancelar</a>
</form>
