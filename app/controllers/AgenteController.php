<?php   


class AgenteController extends Controller{

   

    private $agenteListar;
    public function __construct()
    {
        $this->agenteListar = new Agente();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function agenteListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/agente/agenteListar';
        $dados['agentes'] = $this->agenteListar->getTodosAgentes();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }

}