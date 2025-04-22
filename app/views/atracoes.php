<?php require_once('template/topomenu.php'); ?>
<!-- inicio  do corpo -->

<body id="atracao">
    <!-- inicio do topo -->
    <header> <!--Inicio do topo-->
        <?php require_once('template/menu.php'); ?>
        <!--fecha menu-->
    </header>

    <section class="banner1">
        <article class="site">
            <h2>Atrações</h2>
            <h3>Parque Marisa</h3>
        </article>
    </section>
    <main>
        <section class="brinquedos">
            <article class="site">
                <div class="conteudoBrinquedo">
                    <h6>Brinquedos Radicais</h6>

                    <?php foreach ($brinquedos as $linha): ?>
                        <?php if (strtolower($linha['genero_brinquedo']) == 'radical' || strtolower($linha['genero_brinquedo']) == 'manutenção' || strtolower($linha['genero_brinquedo']) == 'destaque'): ?>
                            <div class="radicais">
                                <img src="<?php echo BASE_URL . 'assets/img/atraçõesPag/' . $linha['foto_brinquedo']; ?>" alt="">
                                <div>
                                    <h4><?php echo $linha['nome_brinquedo']; ?></h4>
                                    <p><?php echo $linha['informacao_brinquedo']; ?></p>

                                    <?php if (strtolower($linha['status_brinquedo']) == 'desativado'): ?>
                                        <p class="text-danger"><strong>Brinquedo Desativado</strong></p>
                                    <?php elseif (strtolower($linha['status_brinquedo']) == 'manutenção'): ?>
                                        <p class="text-warning"><strong>Em Manutenção</strong></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <h5>Brinquedos Familiar </h5>

                    <?php foreach ($brinquedos as $linha): ?>
                        <?php if (strtolower($linha['genero_brinquedo']) == 'familiar' || strtolower($linha['genero_brinquedo']) == 'manutenção' || strtolower($linha['genero_brinquedo']) == 'destaque'): ?>
                            <div class="radicais">
                                <img src="<?php echo BASE_URL . 'assets/img/atraçõesPag/' . $linha['foto_brinquedo']; ?>" alt="">
                                <div>
                                    <h4><?php echo $linha['nome_brinquedo']; ?></h4>
                                    <p><?php echo $linha['informacao_brinquedo']; ?></p>

                                    <?php if (strtolower($linha['status_brinquedo']) == 'manutenção'): ?>
                                        <p class="text-warning"><strong>Em Manutenção</strong></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>


                </div>

                </div>
            </article>
        </section>
    </main>
    <footer>
        <?php require_once('template/rodape.php'); ?>
    </footer>

</body>

</html>