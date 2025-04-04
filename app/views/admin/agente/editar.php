<<<<<<< HEAD
<form class="form-agente container" method="POST" action="http://localhost/sistema-pqmarisa/public/agente/editar/<?php echo $dadosAgente['id_agente']; ?>">
    <div class="row">
        <h2 class="text-center">Editar Agente</h2>

        <!-- Nome Completo -->
        <div class="col-md-6">
            <label for="nome_agente" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome_agente" name="nome_agente" required value="<?php echo $dadosAgente['nome_agente']; ?>">
=======
<form class="form-cliente container" method="POST" action="http://localhost/sistema-pqmarisa/public/cliente/editar/<?php echo $dadosCliente['id_cliente'] ?>">
    <div class="row">
        <h2 class="text-center">Editar Cliente</h2>
        
        <!-- Nome Completo -->
        <div class="col-md-6">
            <label for="nome_cliente" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required value="<?php echo $dadosCliente['nome_cliente'] ?>">
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
        </div>

        <!-- CPF -->
        <div class="col-md-6">
<<<<<<< HEAD
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
=======
            <label for="cpf_cliente" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf_cliente" name="cpf_cliente" required value="<?php echo $dadosCliente['cpf_cliente'] ?>">
        </div>

        <!-- Bairro -->
        <div class="col-md-4">
            <label for="bairro_cliente" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro_cliente" name="bairro_cliente" required value="<?php echo $dadosCliente['bairro_cliente'] ?>">
        </div>

        <!-- Cidade -->
        <div class="col-md-4">
            <label for="cidade_cliente" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade_cliente" name="cidade_cliente" required value="<?php echo $dadosCliente['cidade_cliente'] ?>">
        </div>

        <!-- Estado -->
        <div class="col-md-4">
            <label for="estado_cliente" class="form-label">Estado (UF)</label>
            <input type="text" class="form-control" id="estado_cliente" name="estado_cliente" required maxlength="2" value="<?php echo $dadosCliente['estado_cliente'] ?>">
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
        </div>

        <!-- Data de Nascimento -->
        <div class="col-md-6">
<<<<<<< HEAD
            <label for="data_nasc_agente" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nasc_agente" name="data_nasc_agente" required value="<?php echo $dadosAgente['data_nasc_agente']; ?>">
=======
            <label for="data_nasc_cliente" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nasc_cliente" name="data_nasc_cliente" required value="<?php echo $dadosCliente['data_nasc_cliente'] ?>">
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
        </div>

        <!-- Telefone -->
        <div class="col-md-6">
<<<<<<< HEAD
            <label for="telefone_agente" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_agente" name="telefone_agente" required maxlength="15" value="<?php echo $dadosAgente['telefone_agente']; ?>">
=======
            <label for="telefone_cliente" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_cliente" name="telefone_cliente" required value="<?php echo $dadosCliente['telefone_cliente'] ?>">
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
        </div>

        <!-- Email -->
        <div class="col-md-6">
<<<<<<< HEAD
            <label for="email_agente" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email_agente" name="email_agente" required value="<?php echo $dadosAgente['email_agente']; ?>">
=======
            <label for="email_cliente" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email_cliente" name="email_cliente" required value="<?php echo $dadosCliente['email_cliente'] ?>">
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
        </div>

        <!-- Senha -->
        <div class="col-md-6">
<<<<<<< HEAD
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
=======
            <label for="senha_cliente" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha_cliente" name="senha_cliente">
            <small class="text-muted">Deixe em branco para manter a senha atual.</small>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Salvar Cliente</button>
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>
