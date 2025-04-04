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

<<<<<<< HEAD
    

=======
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
}