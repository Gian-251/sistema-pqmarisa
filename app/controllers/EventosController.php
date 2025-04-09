<?php   
class EventosController extends Controller {
    private $eventosModel;

    public function __construct() {
        $this->eventosModel = new Eventos();
    }

    public function index() {
        $dados = array();
        $dados['titulo'] = 'Eventos - Marisa Parque Itaquera';

        $eventoModel = new Eventos();
        $dados['eventosGif'] = $eventoModel->todosEventos(); // Adicione essa linha

        
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

                if ($this->eventosModel->cadastrar($dadosEvento)) {
                    $_SESSION['mensagem'] = 'Evento cadastrado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: ' . BASE_URL . 'eventos/eventosListar');
                    exit;
                }
            }
        }

        $this->carregarViews('admin/index', $dados);
    }

 
    public function editar($id = null){
        $dados = array();
    
        $eventoModel = new Eventos();
        $eventoAtual = $eventoModel->getEventoPorId($id);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_eventos = filter_input(INPUT_POST, 'nome_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_inicio_eventos = filter_input(INPUT_POST, 'data_inicio_eventos');
            $data_fim_eventos = filter_input(INPUT_POST, 'data_fim_eventos');
            $status_eventos = filter_input(INPUT_POST, 'status_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_eventos = $nome_eventos;
    
            // Mantém a imagem antiga como padrão
            $arquivo = $eventoAtual['foto_eventos'];
    
            if (isset($_FILES['foto_eventos']) && $_FILES['foto_eventos']['error'] == 0) {
                $arquivo = $this->uploadFoto($_FILES['foto_eventos'], $nome_eventos);
            }
    
            if ($nome_eventos && $data_inicio_eventos && $data_fim_eventos) {
                $dadosEvento = array(
                    'id_eventos'         => $id,
                    'nome_eventos'       => $nome_eventos,
                    'data_inicio_eventos'=> $data_inicio_eventos,
                    'data_fim_eventos'   => $data_fim_eventos,
                    'status_eventos'     => $status_eventos,
                    'alt_eventos'        => $alt_eventos,
                    'foto_eventos'       => $arquivo
                );
    
                $idEditado = $eventoModel->editarEventos($dadosEvento);
    
                if ($idEditado) {
                    $_SESSION['mensagem'] = 'Evento editado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: ' . BASE_URL . 'eventos/eventosListar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao editar o evento na base de dados.';
                    $dados['tipo-msg'] = 'erro';
                }
            } else {
                $dados['mensagem'] = 'Informe todos os dados obrigatórios.';
                $dados['tipo-msg'] = 'erro';
            }
        }
    
        if (!$eventoAtual) {
            $_SESSION['mensagem'] = 'Evento não encontrado.';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: ' . BASE_URL . 'eventos/eventosListar');
            exit;
        }
    
        $dados['dadosEvento'] = $eventoAtual;
        $dados['conteudo'] = 'admin/eventos/editar';
    
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