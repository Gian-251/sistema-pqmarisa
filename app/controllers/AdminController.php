<?php   

class AdminController extends Controller{
    
    public function index(){
        if (!isset($_SESSION['agente']) || $_SESSION['tipo'] !== 'agente') {
            header('Location: perfil'); // Redireciona para a página de login
            exit();
        }

        $dados = array();
        $dados['titulo'] = 'Dashbord - Site Mestre dos Motores';
        $this->carregarViews('admin/index', $dados);



        //var_dump("chegeui a Sobrecontroller");
    }


    
}
