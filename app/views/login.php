<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    
    <link rel="stylesheet" href="<?php echo BASE_URL?>assets/css/login.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>assets/css/estilo.css">

    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL?>assets/img/Logos/LOGOMARISA.svg">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
    <header> 
    <?php require_once('template/menu.php');?>
        
    </header>
    <div class="container">
        <div class="content first-content">

            <div class="first-column">

                <h2 class="title title-primary">Bem vindo!</h2>
                <p class="description description-primary">Clique aqui para continuar</p>
                <p class="description description-primary">por favor faça login com suas informações pessoais</p>
                <button id="signin" class="btn btn-primary">Login</button>

            </div>    

            <div class="second-column">

                <h2 class="title title-second">Crie sua conta</h2>
<form method="POST" action="<?php echo BASE_URL; ?>login/cadastrar" class="form-cadastro">
    <section>

                <label class="label-input" for="nome_cliente">
                    <i class="far fa-user icon-modify"></i>
                    <input type="text" name="nome_cliente" id="nome_cliente" placeholder="Nome" required>
                </label>

                <label class="label-input" for="cpf_cliente">
                    <i class="fas fa-id-card icon-modify"></i>
                    <input type="text" name="cpf_cliente" id="cpf_cliente" placeholder="CPF" maxlength="11" required>
                </label>

                <label class="label-input" for="email_cliente">
                    <i class="far fa-envelope icon-modify"></i>
                    <input type="email" name="email_cliente" id="email_cliente" placeholder="Email" required>
                </label>

                <label class="label-input" for="senha_cliente">
                    <i class="fas fa-lock icon-modify"></i>
                    <input type="password" name="senha_cliente" id="senha_cliente" placeholder="Senha" required>
                </label>

                <label class="label-input" for="data_nasc_cliente">
                    <i class="fas fa-calendar-alt icon-modify"></i>
                    <input type="date" name="data_nasc_cliente" id="data_nasc_cliente" required>
                </label>

                <label class="label-input" for="telefone_cliente">
                    <i class="fas fa-phone icon-modify"></i>
                    <input type="text" name="telefone_cliente" id="telefone_cliente" placeholder="Telefone" required>
                </label>

                <label class="label-input" for="bairro_cliente">
                    <i class="fas fa-map-marker-alt icon-modify"></i>
                    <input type="text" name="bairro_cliente" id="bairro_cliente" placeholder="Bairro" required>
                </label>

                <label class="label-input" for="cidade_cliente">
                    <i class="fas fa-city icon-modify"></i>
                    <input type="text" name="cidade_cliente" id="cidade_cliente" placeholder="Cidade" required>
                </label>

                <label class="label-input" for="estado_cliente">

                    <i class="fas fa-flag icon-modify"></i>
                    <select name="estado_cliente" id="estado_cliente" required>
                        <option value="" disabled selected>Selecione o Estado</option>
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
                </label>

                <button type="submit" class="btn-cadastrar">Cadastrar</button>
    </section>
</form>

        </div><!-- second column -->
        </div><!-- first content -->
        <div class="content second-content">

            <div class="first-column">
                <h2 class="title title-primary">Ola, amigo!</h2>
                <p class="description description-primary">ou use seu e-mail para registro</p>
                <p class="description description-primary"></p>
                <button id="signup" class="btn btn-primary">Cadastro</button>
            </div>

            <div class="second-column">

                <h2 class="title title-second">Acesse sua conta</h2>
                <p class="description description-second">use seu email para entrar na conta:</p>

                <form class="form" method="POST" action="<?php echo BASE_URL; ?>login/autenticar">

                    <label class="label-input" for="email_agente">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" name="email" id="email_agente" placeholder="Email" required>
                    </label>

                    <label class="label-input" for="senha_agente">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" name="senha" id="senha_agente" placeholder="Senha" required>
                    </label>

                    <?php if (isset($_SESSION['erro_login'])): ?>
                        <p class="text-danger"><?= $_SESSION['erro_login'] ?></p>
                        <?php unset($_SESSION['erro_login']); ?>
                    <?php endif; ?>

                    <a class="password" href="#">Esqueceu a senha?</a>
                    <button type="submit" class="btn btn-second">Logar</button>
                </form>


            </div><!-- second column -->
        </div><!-- second-content -->
    </div>
 
</body>
    <footer>
    <?php require_once('template/rodape.php');?>
    </footer>
</html>