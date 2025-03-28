<div class="mb-3">
        <label for="nome_cliente" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required>
    </div>

    <div class="mb-3">
        <label for="cpf_cliente" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf_cliente" name="cpf_cliente" required maxlength="14">
    </div>

    <div class="mb-3">
        <label for="bairro_cliente" class="form-label">Bairro</label>
        <input type="text" class="form-control" id="bairro_cliente" name="bairro_cliente" required>
    </div>

    <div class="mb-3">
        <label for="estado_cliente" class="form-label">Estado</label>
        <select class="form-select" id="estado_cliente" name="estado_cliente" required>
            <option selected>Selecione um estado</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AP">Amapá</option>
            <option value="AM">Amazonas</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MT">Mato Grosso</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MG">Minas Gerais</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PR">Paraná</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="SC">Santa Catarina</option>
            <option value="SP">São Paulo</option>
            <option value="SE">Sergipe</option>
            <option value="TO">Tocantins</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="cidade_cliente" class="form-label">Cidade</label>
        <input type="text" class="form-control" id="cidade_cliente" name="cidade_cliente" required>
    </div>

    <div class="mb-3">
        <label for="data_nasc_cliente" class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" id="data_nasc_cliente" name="data_nasc_cliente" required>
    </div>

    <div class="mb-3">
        <label for="telefone_cliente" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone_cliente" name="telefone_cliente" required maxlength="15">
    </div>

    <div class="mb-3">
        <label for="email_cliente" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email_cliente" name="email_cliente" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Cliente</button>
</form>
