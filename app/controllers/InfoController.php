<?php   

class InfoController extends Controller{

    private $infoListar;
    public function __construct()
    {
        $this->infoListar = new Info();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function infoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/info/infoListar';
        $dados['info'] = $this->infoListar->getTodasInfos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }

}