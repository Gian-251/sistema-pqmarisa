<form class="form-servico container" method="POST" action="http://localhost/sistema-pqmarisa/public/agente/adicionar" enctype="multipart/form-data">
    <div class="row g-3">
        <div class="col-md-6">
            <label for="nome_agente" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome_agente" name="nome_agente" required>
        </div>

        <div class="col-md-6">
            <label for="cpf_agente" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf_agente" name="cpf_agente" required maxlength="14">
        </div>

        <div class="col-md-6">
            <label for="rua_agente" class="form-label">Rua</label>
            <input type="text" class="form-control" id="rua_agente" name="rua_agente" required>
        </div>

        <div class="col-md-6">
            <label for="bairro_agente" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro_agente" name="bairro_agente" required>
        </div>

        <div class="col-md-6">
            <label for="cidade_agente" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade_agente" name="cidade_agente" required>
        </div>

        <div class="col-md-6">
            <label for="data_nasc_agente" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nasc_agente" name="data_nasc_agente" required>
        </div>

        <div class="col-md-6">
            <label for="telefone_agente" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_agente" name="telefone_agente" required maxlength="15">
        </div>

        <div class="col-md-6">
            <label for="email_agente" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email_agente" name="email_agente" required>
        </div>

        <div class="col-md-6">
            <label for="senha_agente" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha_agente" name="senha_agente" required>
        </div>

        <div class="col-md-6">
            <label for="turno_agente" class="form-label">Turno</label>
            <input type="time" class="form-control" id="turno_agente" name="turno_agente" required>
        </div>

        <div class="col-md-6">
            <label for="status_agente" class="form-label">Status</label>
            <select id="status_agente" name="status_agente" class="form-select" required>
                <option>Ativo</option>
                <option>Inativo</option>
                <option>Desativado</option>
            </select>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Salvar Agente</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>