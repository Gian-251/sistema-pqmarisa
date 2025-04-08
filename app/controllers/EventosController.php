<?php   

class EventosController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'eventos - Marisa Parque Itaquera';
        $this->carregarViews('eventos', $dados);

        //var_dump("chegeui a controller");
    }
    private $eventosListar;
    public function __construct()
    {
        $this->eventosListar = new Eventos();
    }
    public function eventosListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/eventos/eventosListar';
        $dados['eventos'] = $this->eventosListar->getTodosEventos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }
    private $db;
    public function adicionar() {
        
        $dados = array();
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Captura e sanitiza os dados do formulário
            $nome_eventos = filter_input(INPUT_POST, 'nome_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_inicio_eventos = filter_input(INPUT_POST, 'data_inicio_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_fim_eventos = filter_input(INPUT_POST, 'data_fim_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_eventos = filter_input(INPUT_POST, 'alt_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_eventos = filter_input(INPUT_POST, 'status_eventos', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Upload de imagem (foto_eventos)
            $foto_eventos = '';
            if (isset($_FILES['foto_eventos']) && $_FILES['foto_eventos']['error'] == 0) {
                $ext = pathinfo($_FILES['foto_eventos']['name'], PATHINFO_EXTENSION);
                $nome_arquivo = md5(time() . rand(0, 9999)) . '.' . $ext;
                $caminho = 'assets/imagens/eventos/' . $nome_arquivo;
    
                if (move_uploaded_file($_FILES['foto_eventos']['tmp_name'], $caminho)) {
                    $foto_eventos = $nome_arquivo;
                } else {
                    $_SESSION['erro'] = "Erro ao fazer upload da imagem.";
                    header("Location: /eventos/adicionar");
                    exit;
                }
            }

            
    
            // Inserção no banco
            try {
                $sql = "INSERT INTO tbl_eventos (nome_eventos, foto_eventos, data_inicio_eventos, data_fim_eventos, alt_eventos, status_eventos)
                        VALUES (:nome, :foto, :inicio, :fim, :alt, :status)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(':nome', $nome_eventos);
                $stmt->bindValue(':foto', $foto_eventos);
                $stmt->bindValue(':inicio', $data_inicio_eventos);
                $stmt->bindValue(':fim', $data_fim_eventos);
                $stmt->bindValue(':alt', $alt_eventos);
                $stmt->bindValue(':status', $status_eventos);
    
                if ($stmt->execute()) {
                    $_SESSION['sucesso'] = "Evento cadastrado com sucesso!";
                    header("Location: /eventos/listar");
                    exit;
                } else {
                    $_SESSION['erro'] = "Erro ao cadastrar evento!";
                }
            } catch (\PDOException $e) {
                error_log("Erro ao inserir evento: " . $e->getMessage());
                $_SESSION['erro'] = "Erro ao processar a requisição!";
            }
        }
    
        $dados['conteudo'] = 'admin/eventos/adicionar';
        $this->carregarViews('admin/index', $dados);
    }
    

}
    