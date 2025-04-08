<form class="form-banner container" method="POST" action="http://localhost/sistema-pqmarisa/public/eventos/adicionar" enctype="multipart/form-data">

<div class="container">
    <h2 class="mt-4 mb-4">Adicionar Novo Evento</h2>
    
    
        <div class="mb-3">
            <label for="nome_eventos" class="form-label">Nome do Evento</label>
            <input type="text" class="form-control" id="nome_eventos" name="nome_eventos" required>
        </div>

        <div class="mb-3">
            <label for="foto_eventos" class="form-label">Foto do Evento</label>
            <input type="file" class="form-control" id="foto_eventos" name="foto_eventos" accept="image/*" required>
        </div>

        <div class="mb-3">
            <label for="data_inicio_eventos" class="form-label">Data de Início</label>
            <input type="date" class="form-control" id="data_inicio_eventos" name="data_inicio_eventos" required>
        </div>

        <div class="mb-3">
            <label for="data_fim_eventos" class="form-label">Data de Término</label>
            <input type="date" class="form-control" id="data_fim_eventos" name="data_fim_eventos" required>
        </div>

        <div class="mb-3">
            <label for="alt_eventos" class="form-label">Texto Alternativo da Imagem</label>
            <input type="text" class="form-control" id="alt_eventos" name="alt_eventos" required>
        </div>

        <div class="mb-3">
            <label for="status_eventos" class="form-label">Status do Evento</label>
            <select class="form-select" id="status_eventos" name="status_eventos" required>
                <option selected>Selecione o status</option>
                <option value="ativo">Ativo</option>
                <option value="inativo">Inativo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Evento</button>
    </form>
</div>


