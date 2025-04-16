<section class="atracoes">
    <article class="site">
        <div class="brinquedosRadical">
            <div>
                <img src="<?php echo BASE_URL ?>assets/img/atracaoes/rad.png" alt="">
                <div>
                    <h2><?= htmlspecialchars($informacao[0]['nome_info']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($informacao[0]['informacao_texto_info'])) ?></p>
                </div>

            </div>

            <div>
                <img src="<?php echo BASE_URL ?>assets/img/atracaoes/infantil.png" alt="">
                <div>
                    <h2><?= htmlspecialchars($informacao[1]['nome_info']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($informacao[1]['informacao_texto_info'])) ?></p>
                </div>

            </div>

            <div>
                <img src="<?php echo BASE_URL ?>assets/img/atracaoes/inf.png" alt="">

                <div>
                    <h2><?= htmlspecialchars($informacao[2]['nome_info']) ?></h2>
                    <p><?= nl2br(htmlspecialchars($informacao[2]['informacao_texto_info'])) ?></p>
                </div>
            </div>
    </article>
</section>