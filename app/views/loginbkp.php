<?php require_once('template/topomenu.php');?>
<body id = "login">
    <header> 
        <?php require_once('template/menu.php');?>
        
    </header>

    <div class="pagina">
        <form method="POST" class="formularioLogin">
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Digite seu e-mail" autofocus="true" />
            <label for="password">Senha</label>
            <input type="password" name="password" placeholder="Digite sua senha" />
            <a href="/">Esqueci minha senha</a>
            <input type="submit" value="Acessar" class="btn" />
            <input type="button" value="Cadastrar" class="btn-cadastrar" onclick="window.location.href='<?php echo BASE_URL?>login/cadastro'" />



        </form>


</body>
    </div>

    <footer>
        <?php require_once('template/rodape.php');?>
    </footer>



</html>


