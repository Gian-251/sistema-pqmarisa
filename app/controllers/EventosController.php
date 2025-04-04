<?php   

class EventosController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'eventos - Marisa Parque Itaquera';
        $this->carregarViews('eventos', $dados);

        //var_dump("chegeui a controller");
    }
    private $eventosListar;
    public function __construct()
    {
        $this->eventosListar = new Eventos();
    }
    public function eventosListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/eventos/eventosListar';
        $dados['eventos'] = $this->eventosListar->getTodosEventos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }

}
    