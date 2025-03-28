<?php   

class ServicoController extends Controller{

    private $servicoListar;
    public function __construct()
    {
        $this->servicoListar = new Servico();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function servicoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/servico/servicoListar';
        $dados['servico'] = $this->servicoListar->getTodosServicos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }

}