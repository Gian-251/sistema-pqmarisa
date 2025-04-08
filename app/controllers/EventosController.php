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

    public function listar() {
        $dados = array();
        $dados['conteudo'] = 'admin/eventos/eventosListar'; // Use 'eventos' com S se sua pasta for com S
        $dados['eventos'] = $this->eventosModel->getTodosEventos();

        $this->carregarViews('admin/index', $dados);
    }

    public function adicionar(): void {
        $dados = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_eventos        = filter_input(INPUT_POST, 'nome_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_inicio_eventos = filter_input(INPUT_POST, 'data_inicio_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_fim_eventos    = filter_input(INPUT_POST, 'data_fim_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_eventos      = filter_input(INPUT_POST, 'status_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_eventos         = $nome_eventos;

            $arquivo = '';

            if ($nome_eventos && $data_inicio_eventos && $data_fim_eventos && $status_eventos) {
                if (isset($_FILES['foto_eventos']) && $_FILES['foto_eventos']['error'] === 0) {
                    $arquivo = $this->uploadFoto($_FILES['foto_eventos'], $nome_eventos);
                } else {
                    $dados['erro'] = 'Imagem do evento é obrigatória';
                    $dados['tipo-msg'] = 'erro';
                }

                $dadosEvento = [
                    'nome_eventos'        => $nome_eventos,
                    'data_inicio_eventos' => $data_inicio_eventos,
                    'data_fim_eventos'    => $data_fim_eventos,
                    'alt_eventos'         => $alt_eventos,
                    'status_eventos'      => $status_eventos,
                    'foto_eventos'        => $arquivo
                ];

                try {
                    $idEvento = $this->eventosModel->cadastrar($dadosEvento);

                    if ($idEvento) {
                        $_SESSION['mensagem'] = 'Evento cadastrado com sucesso!';
                        $_SESSION['tipo-msg'] = 'sucesso';
                        header('Location: ' . BASE_URL . 'eventos/listar');
                        exit;
                    } else {
                        $dados['erro'] = 'Erro ao adicionar evento no banco de dados.';
                        $dados['tipo-msg'] = 'erro';
                    }
                } catch (Exception $e) {
                    $dados['erro'] = $e->getMessage();
                    $dados['tipo-msg'] = 'erro';
                }
            } else {
                $dados['erro'] = 'Todos os campos devem ser preenchidos.';
                $dados['tipo-msg'] = 'erro';
            }
        }

        $dados['conteudo'] = 'admin/eventos/adicionar'; // Certifique-se de que o caminho existe
        $this->carregarViews('admin/index', $dados);
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