<?php   

class IngressoController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'ingresso - Marisa Parque Itaquera';
        $this->carregarViews('ingresso', $dados);



        //var_dump("chegeui a Sobrecontroller");
    }

    private $ingressoListar;
    public function __construct()
    {
        $this->ingressoListar = new Ingresso();
    }
    public function ingressoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/ingresso/ingressoListar';
        $dados['ingresso'] = $this->ingressoListar->getTodosIngressos();
        // var_dump($dados['servicos']);
       


        
        $this->carregarViews('admin/index', $dados);
    }



}
    