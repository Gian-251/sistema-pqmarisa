<?php   
class EventosController extends Controller {
    private $eventosModel;

    public function __construct() {
        $this->eventosModel = new Eventos();
    }

    public function index() {
        $dados = array();
        $dados['titulo'] = 'Eventos - Marisa Parque Itaquera';
        $this->carregarViews('eventos', $dados);
    }

    public function eventosListar() {
        $dados = array();
        $dados['conteudo'] = 'admin/eventos/eventosListar';
        $dados['eventos'] = $this->eventosModel->getTodosEventos();
        $this->carregarViews('admin/index', $dados);
    }

    public function adicionar() {
        $dados = [];
        $dados['titulo'] = 'Adicionar Evento';
        $dados['conteudo'] = 'admin/eventos/adicionar';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_eventos = filter_input(INPUT_POST, 'nome_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_inicio_eventos = filter_input(INPUT_POST, 'data_inicio_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_fim_eventos = filter_input(INPUT_POST, 'data_fim_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_eventos = filter_input(INPUT_POST, 'status_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_eventos = $nome_eventos;

            if (isset($_FILES['foto_eventos']) && $_FILES['foto_eventos']['error'] === 0) {
                $arquivo = $this->uploadFoto($_FILES['foto_eventos'], $nome_eventos);
                
                $dadosEvento = [
                    'nome_eventos' => $nome_eventos,
                    'data_inicio_eventos' => $data_inicio_eventos,
                    'data_fim_eventos' => $data_fim_eventos,
                    'alt_eventos' => $alt_eventos,
                    'status_eventos' => $status_eventos,
                    'foto_eventos' => $arquivo
                ];

                if ($this->eventosModel->adicionarEvento($dadosEvento)) {
                    $_SESSION['mensagem'] = 'Evento cadastrado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: ' . BASE_URL . 'eventos/eventosListar');
                    exit;
                }
            }
        }

        $this->carregarViews('admin/index', $dados);
    }

    public function editar($id) {
        $dados = array();
        $dados['titulo'] = 'Editar Evento';
        $dados['conteudo'] = 'admin/eventos/editar';
        $dados['evento'] = $this->eventosModel->getEventoPorId($id);
        $this->carregarViews('admin/index', $dados);
    }

    public function atualizarEvento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dadosEvento = [
                'id_eventos' => filter_input(INPUT_POST, 'id_eventos', FILTER_SANITIZE_NUMBER_INT),
                'nome_eventos' => filter_input(INPUT_POST, 'nome_eventos', FILTER_SANITIZE_SPECIAL_CHARS),
                'data_inicio_eventos' => filter_input(INPUT_POST, 'data_inicio_eventos', FILTER_SANITIZE_SPECIAL_CHARS),
                'data_fim_eventos' => filter_input(INPUT_POST, 'data_fim_eventos', FILTER_SANITIZE_SPECIAL_CHARS),
                'status_eventos' => filter_input(INPUT_POST, 'status_eventos', FILTER_SANITIZE_SPECIAL_CHARS),
                'alt_eventos' => filter_input(INPUT_POST, 'alt_eventos', FILTER_SANITIZE_SPECIAL_CHARS)
            ];

            if (isset($_FILES['foto_eventos']) && $_FILES['foto_eventos']['error'] === 0) {
                $arquivo = $this->uploadFoto($_FILES['foto_eventos'], $dadosEvento['nome_eventos']);
                $dadosEvento['foto_eventos'] = $arquivo;
            }

            if ($this->eventosModel->atualizarEvento($dadosEvento)) {
                $_SESSION['mensagem'] = 'Evento atualizado com sucesso!';
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: ' . BASE_URL . 'eventos/eventosListar');
                exit;
            }
        }
        
        header('Location: ' . BASE_URL . 'eventos/eventosListar');
    }

    private function uploadFoto($arquivo, $nome): string {
        $diretorio = 'assets/img/Eventos/';
        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nomeArquivo = 'evento_' . md5($nome . time()) . '.' . $extensao;
        $caminhoCompleto = $diretorio . $nomeArquivo;

        if (move_uploaded_file($arquivo['tmp_name'], $caminhoCompleto)) {
            return $nomeArquivo;
        }

        return '';
    }
}