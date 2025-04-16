<section class="atracoes">
    <article class="site">
        <div class="brinquedosRadical">
            <div>
                <img src="<?php echo BASE_URL ?>assets/img/atracaoes/rad.png" alt="">
                <div>
                    <h2>Brinquedos Radicais</h2>
                    <p>No Parque Marisa Itaquera, adultos podem se divertir com atrações radicais como a Montanha-Russa Insana, que oferece inversões e quedas vertiginosas. Esses brinquedos são ideais para quem busca emoções fortes e uma experiência emocionante. </p>
                </div>

            </div>

            <div>
                <img src="<?php echo BASE_URL ?>assets/img/atracaoes/infantil.png" alt="">
                <div>
                    <h2>Brinquedos Infantis</h2>
                    <p>No Parque Marisa Itaquera, as crianças têm várias opções de diversão. O Carrossel Encantado proporciona
                        voltas mágicas em cavalinhos coloridos, enquanto o Mundo das Bolhas oferece estruturas seguras para escalar e explorar.
                        O Mini-Playground é ideal para os menores, com atividades lúdicas em um ambiente protegido. </p>
                </div>

            </div>

            <div>
                <img src="<?php echo BASE_URL ?>assets/img/atracaoes/inf.png" alt="">
                
                <?php foreach ($dados['informacao'] as $info): ?>
                    <h3><?= htmlspecialchars($info['nome_info']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($info['informacao_texto_info'])) ?></p>
                <?php endforeach; ?>
            </div>
    </article>
</section>