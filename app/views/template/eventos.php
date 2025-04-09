<div class="letreiroEventos">
            <p>Eventos</p>
            <p>Eventos</p>
            <p>Eventos</p>
        </div>
        <section class="eventos">
            <article class="topoMenu">
            <?php if (!empty($eventosGif)): ?>
            <?php foreach ($eventosGif as $evento): ?>
                <div>
                    <a href="">
                        <img src="<?php echo BASE_URL . 'assets/img/Eventos/' . $evento['foto_eventos']; ?>"
                             alt="<?php echo htmlspecialchars($evento['nome_eventos']); ?>">
                    </a>
                    <button>SAIBA MAIS</button>        
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum evento encontrado.</p>
        <?php endif; ?>
            </div> 
            </article>
        </section>