<?php   

class BrinquedoController extends Controller{

    private $brinquedoListar;
    public function __construct()
    {
        $this->brinquedoListar = new Brinquedo();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function brinquedoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/brinquedo/brinquedoListar';
        $dados['brinquedo'] = $this->brinquedoListar->getTodosBrinquedos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }

}

