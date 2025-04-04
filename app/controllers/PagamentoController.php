<?php   

class PagamentoController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Site Mestre dos Motores';
        $this->carregarViews('pagamento', $dados);



        //var_dump("chegeui a homecontroller");
    }
    public function confirmacao(){
        $dados = array();
        $dados['titulo'] = 'Site Mestre dos Motores';
        $this->carregarViews('confirmacao', $dados);
    }
}
