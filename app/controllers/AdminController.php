<?php   

class AdminController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Site Mestre dos Motores';
        $this->carregarViews('admin/index', $dados);



        //var_dump("chegeui a Sobrecontroller");
    }


    
}
