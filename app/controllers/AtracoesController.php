<?php   

class AtracoesController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'atracoes - Marisa Parque Itaquera';
        $this->carregarViews('atracoes', $dados);



        //var_dump("chegeui a Sobrecontroller");
    }
}
