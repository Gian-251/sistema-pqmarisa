<?php   

class CadastroController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'cadastro - Marisa Parque Itaquera';
        $this->carregarViews('cadastro', $dados);



        //var_dump("chegeui a Sobrecontroller");
    }
}




