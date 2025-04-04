<?php   

class HomeController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Site Mestre dos Motores';
        $dados['letreiro'] = $this->letreirosModel->pegarLetreiro();
        $this->carregarViews('index', $dados);



        //var_dump("chegeui a homecontroller");
    }
    private $letreirosModel;

    public function __construct() {
        $this->letreirosModel = new Letreiros(); // Instancia o modelo de letreiros
    }

    
    


}

