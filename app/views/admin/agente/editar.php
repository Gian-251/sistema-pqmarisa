<form class="form-cliente container" method="POST" action="http://localhost/sistema-pqmarisa/public/cliente/editar/<?php echo $dadosCliente['id_cliente'] ?>">
    <div class="row">
        <h2 class="text-center">Editar Cliente</h2>
        
        <!-- Nome Completo -->
        <div class="col-md-6">
            <label for="nome_cliente" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required value="<?php echo $dadosCliente['nome_cliente'] ?>">
        </div>

        <!-- CPF -->
        <div class="col-md-6">
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
        </div>

        <!-- Data de Nascimento -->
        <div class="col-md-6">
            <label for="data_nasc_cliente" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nasc_cliente" name="data_nasc_cliente" required value="<?php echo $dadosCliente['data_nasc_cliente'] ?>">
        </div>

        <!-- Telefone -->
        <div class="col-md-6">
            <label for="telefone_cliente" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_cliente" name="telefone_cliente" required value="<?php echo $dadosCliente['telefone_cliente'] ?>">
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <label for="email_cliente" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email_cliente" name="email_cliente" required value="<?php echo $dadosCliente['email_cliente'] ?>">
        </div>

        <!-- Senha -->
        <div class="col-md-6">
            <label for="senha_cliente" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha_cliente" name="senha_cliente">
            <small class="text-muted">Deixe em branco para manter a senha atual.</small>
        </div>

        <!-- Botões -->
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Salvar Cliente</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </div>
</form>
