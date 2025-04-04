<form class="form-agente container" method="POST" action="http://localhost/sistema-pqmarisa/public/agente/editar/<?php echo $dadosAgente['id_agente']; ?>">
    <div class="row">
        <h2 class="text-center">Editar Agente</h2>

        <!-- Nome Completo -->
        <div class="col-md-6">
            <label for="nome_agente" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome_agente" name="nome_agente" required value="<?php echo $dadosAgente['nome_agente']; ?>">
        </div>

        <!-- CPF -->
        <div class="col-md-6">
            <label for="cpf_agente" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf_agente" name="cpf_agente" required maxlength="14" value="<?php echo $dadosAgente['cpf_agente']; ?>">
        </div>

        <!-- Rua -->
        <div class="col-md-6">
            <label for="rua_agente" class="form-label">Rua</label>
            <input type="text" class="form-control" id="rua_agente" name="rua_agente" required value="<?php echo $dadosAgente['rua_agente']; ?>">
        </div>

        <!-- Bairro -->
        <div class="col-md-6">
            <label for="bairro_agente" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro_agente" name="bairro_agente" required value="<?php echo $dadosAgente['bairro_agente']; ?>">
        </div>

        <!-- Cidade -->
        <div class="col-md-6">
            <label for="cidade_agente" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade_agente" name="cidade_agente" required value="<?php echo $dadosAgente['cidade_agente']; ?>">
        </div>

        <!-- Data de Nascimento -->
        <div class="col-md-6">
            <label for="data_nasc_agente" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nasc_agente" name="data_nasc_agente" required value="<?php echo $dadosAgente['data_nasc_agente']; ?>">
        </div>

        <!-- Telefone -->
        <div class="col-md-6">
            <label for="telefone_agente" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_agente" name="telefone_agente" required maxlength="15" value="<?php echo $dadosAgente['telefone_agente']; ?>">
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <label for="email_agente" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email_agente" name="email_agente" required value="<?php echo $dadosAgente['email_agente']; ?>">
        </div>

        <!-- Senha -->
        <div class="col-md-6">
            <label for="senha_agente" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha_agente" name="senha_agente">
            <small class="text-muted">Deixe em branco para manter a senha atual.</small>
        </div>

        <!-- Turno -->
        <div class="col-md-6">
            <label for="turno_agente" class="form-label">Turno</label>
            <input type="time" class="form-control" id="turno_agente" name="turno_agente" required value="<?php echo $dadosAgente['turno_agente']; ?>">
        </div>

        <!-- Status -->
        <div class="col-md-6">
            <label for="status_agente" class="form-label">Status</label>
            <select id="status_agente" name="status_agente" class="form-select" required>
                <option value="Ativo" <?php if($dadosAgente['status_agente'] === 'Ativo') echo 'selected'; ?>>Ativo</option>
                <option value="Inativo" <?php if($dadosAgente['status_agente'] === 'Inativo') echo 'selected'; ?>>Inativo</option>
                <option value="Desativado" <?php if($dadosAgente['status_agente'] === 'Desativado') echo 'selected'; ?>>Desativado</option>
            </select>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Salvar Agente</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>
