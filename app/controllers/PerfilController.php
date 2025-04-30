<?php   

class PerfilController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $usuario = $_SESSION['usuario'];
        $tipo = $_SESSION['tipo'];

        $dados = array();
        $dados = [
            'usuario' => $usuario,
            'tipo' => $tipo
        ];

        if($tipo == 'agente'){
            $dados['conteudo'] = 'admin/perfil/agente';
            $this->carregarViews('admin/index', $dados);
        }else{
            $dados['conteudo'] = 'usuario';
            $this->carregarViews('usuario', $dados);
        }

     
            
        

    }
}

