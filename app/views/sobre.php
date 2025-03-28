<?php require_once('template/topomenu.php');?>
<!--inicido do corpo-->
<body id="sobre">
    <header> <!--Inicio do topo-->
    <?php require_once('template/menu.php');?>
    </header>
    <main>
    <section class="sobre">
        <h2>MELHOR PARQUE DA REGIÃO METROPOLITANA</h2>
        <article class="site">
            <div class="sobre1">
                <img src="<?php echo BASE_URL?>assets/img/PaginaSobre/parque1.png" alt="">
                <p>O Parque Marisa Itaquera é um dos principais destinos de entretenimento da Zona Leste de São Paulo, oferecendo diversão para toda a família. Com uma ampla variedade de atrações para todas as idades, o parque se destaca por proporcionar experiências inesquecíveis em um ambiente seguro e acolhedor.</p>
            </div>
            <div class="sobre2">
                <img src="<?php echo BASE_URL?>assets/img/PaginaSobre/parque2.png" alt="">
                <p>Fundado em [1973], o Parque Marisa Itaquera nasceu com o objetivo de trazer momentos de alegria e lazer à comunidade de Itaquera e arredores. Ao longo dos anos, o parque cresceu, sempre inovando e oferecendo novas atrações para garantir que cada visita seja única.</p>
            </div>
        </article>
    </section>


    <section class="blogSobre">
        <h2>Criado por quem acredita que alegria se constrói em cada detalhe.</h2>
        <article class="site">
            <div class="blogSobre1">
                <img src="<?php echo BASE_URL?>assets/img/PaginaSobre/blog.png" alt="">
                <p>O parque ainda conta com uma infra-estrutura para receber o público, tais como:  banheiros, fraldário, seguranças, lanchonetes, barracas de guloseimas e jogos tradicionais como: tiro-alvo, pescaria, jogos de argolas entre outros.

                    Venha você também se divertir e fazer parte da nossa história !</p>
            </div>
           
        </article>
    </section>

    <section class="grafico-uso-parque">
        <h2>Melhores Binquedos
        </h2>
        <div>
  <canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart').getContext('2d');

  // Detecta o modo do sistema ou pode ser controlado via classe
  const isDarkMode = document.body.classList.contains('dark-mode');  // Altere conforme necessário para detecção de tema

  // Cores base para modo claro (brancas) e escuro (mais escuras)
  const darkModeColors = [
    '#152FD6', '#263ABD', '#2E2F31', '#292A33', '#2B2D3D', 
    '#343957', '#0020F0', '#3140A3', '#37428A', '#384070'
  ];

  const lightModeColors = [
    '#5A7CFF', '#7A9BFF', '#8C8E92', '#7A7D8D', '#7E8090', 
    '#A0B1D1', '#4D5BF1', '#6886C9', '#6A7DC8', '#6C7A8A'
  ];

  // Define cores com base no tema
  const backgroundColor = isDarkMode ? darkModeColors : lightModeColors;
  const borderColor = isDarkMode ? darkModeColors : lightModeColors;

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Montanha Russa', 'Carrinho de bate bate', 'Kamkase', 'Barco Viken', 'Disko', 'Roda Gigante', 'Trem Fantasma', 'Carrossel', 'Moto Ninja', 'Helicoptero'],
      datasets: [{
        label: '# Visitas',
        data: [400, 120, 52, 350, 500, 350, 52, 200, 80, 60],
        borderWidth: 1,
        backgroundColor: backgroundColor,
        borderColor: borderColor
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
    </section>

    <div class="titulo">
        <h2>Contato-nos</h2>


    </div>

    <?php require_once('template/formulario.php');?>

    </main>
  
    <footer>
    <?php require_once('template/rodape.php');?>
    </footer>


</body>
</html>