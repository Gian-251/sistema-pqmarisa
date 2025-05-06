<?php

class UsuarioController extends Controller
{
    public function index()
    {
        // Verifica se o usuário está logado e é do tipo 'cliente'
        if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'cliente') {
            header('Location: login');
            exit();
        }

        $dados = [];

        // Busca ingressos do cliente
        $ingressoModel = new Ingresso();
        $ingressos = $ingressoModel->getIngressoByClienteId($_SESSION['usuario']['id_cliente']);

        // Se retornar apenas um ingresso como array associativo, transforma em array de arrays
        if (!empty($ingressos) && isset($ingressos['id_ingresso'])) {
            $ingressos = [$ingressos];
        }

        $dados['ingresso'] = $ingressos;
        $dados['titulo'] = 'Usuário - Marisa Parque Itaquera';
        $dados['cliente'] = $_SESSION['usuario'];

        $this->carregarViews('usuario', $dados);
    }

    public function sair()
    {
        session_destroy();
        header("Location: " . BASE_URL . "login");
        exit();
    }
}
