<?php   

class SobreController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'sobre - Marisa Parque Itaquera';
        $this->carregarViews('sobre', $dados);



        //var_dump("chegeui a Sobrecontroller");
    }
}




