

<?php require_once('template/topomenu.php');?>




<!--------------------------------------------inicido do corpo----------------------------------------------->
<body id="home">
    <header> 
    <?php require_once('template/menu.php');?>
        
    </header>
    <!-------------------------------------------fim do header-------------------------------------->
    <!-------------------------------------------inicio dos eventos--------------------------------->
    <main>
        <?php require_once('template/eventos.php');?>
       
        <!------------------------------Fim dos eventos------------------------------------>
        <!------------------------------inicio do sobreContato----------------------------->
        <?php require_once('template/sobreContato.php');?>
        <!--------------------------Fim dos econtato------------------------------------------>
        <!--------------------------inicio do atracoes---------------------------------------->
         <?php require_once('template/infatracao.php');?>
        <!-- Fim atracaoes -->
        <!-- -----------------------Inicio letreiro ------------------------------------------>
        <div class="letreiro">
            <?php if (!empty($dados['letreiro'])): ?>
                
                <?php 
                // Gerar dinamicamente as tags <p> com base nos letreiros
                $quantidade = count($dados['letreiro']); 
                foreach ($dados['letreiro'] as $index => $linha): ?>
                    <p><?php echo htmlspecialchars($linha['texto_letreiro']); ?></p>
                <?php endforeach; ?>

            <?php else: ?>
                <p>Nenhum letreiro disponível.</p>
            <?php endif; ?>
        </div>

    <style>
    @keyframes carrossel {
        0% { opacity: 0; transform: translateX(750%); }  /* Começa fora da tela à direita */
        10% { opacity: 1; transform: translateX(0); }     /* Entra no centro */
        25% { opacity: 1; }  /* Mantém visível */
        35% { opacity: 0; transform: translateX(-750%); } /* Sai da tela à esquerda */
    }

    /* Gerar dinamicamente a animação e o delay com base no número de itens */
    <?php for ($i = 0; $i < $quantidade; $i++): ?>
    .letreiro p:nth-child(<?php echo $i + 1; ?>) {
        animation: carrossel <?php echo $quantidade * 5; ?>s linear infinite; 
        animation-delay: <?php echo $i * 5; ?>s;
    }
<?php endfor; ?>
</style>


        <!-- --------------------------fim letreiro --------------------------------------->
       
        <!-- -----------------------Inicio promo ------------------------------------------>

        <?php require_once('template/promo.php');?>

        <!-------------------------------------- Fim da promo -------------------------->
        <?php require_once('template/brinquedos.php');?>
    </main>
    
 

    <footer>
    <?php require_once('template/rodape.php');?>
    </footer>


</body>

</html>