<?php


class UsuarioController extends Controller
{

    public function index()
    {
        

        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo']) == 'cliente') {
            header('Location: login.php'); // Redireciona para a página de login
            exit();
        }



        $dados = array();

        $ingresso = new Ingresso();
        $ingresso = $ingresso->getIngressoByClienteId($_SESSION['usuario']['id_cliente']);
        $dados['ingresso'] = $ingresso;

        $dados['titulo'] = 'usuario - Marisa Parque Itaquera';
        $dados['cliente'] = $_SESSION['usuario'];

       

        $this->carregarViews('usuario', $dados);
    }}
