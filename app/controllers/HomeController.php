<?php   

class HomeController extends Controller{
    
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Site Mestre dos Motores';
        
        $dados['letreiro'] = $this->letreirosModel->pegarLetreiro();


        $bannerModel = new Banner();
        $bannerAleatorio = $bannerModel->buscarBannerAtivo();
        $dados['bannerAleatorio'] = $bannerAleatorio;

        
        $infoModel = new Info();
        $dados['informacao'] = $infoModel->buscarInfoAleatoria();
        // var_dump ($dados['informacao']);

        $eventoModel = new Eventos();
        $dados['eventosGif'] = $eventoModel->getEventosGifAleatorios(); // Adicione essa linha

        $this->carregarViews('index', $dados);



        //var_dump("chegeui a homecontroller");
    }
    private $letreirosModel;
    

    public function __construct() {
        $this->letreirosModel = new Letreiros(); // Instancia o modelo de letreiros
    }

    
    


}

