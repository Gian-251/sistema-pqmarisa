<?php   

class BrinquedoController extends Controller{

    private $brinquedoListar;
    public function __construct()
    {
        $this->brinquedoListar = new Brinquedo();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function brinquedoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/brinquedo/brinquedoListar';
        $dados['brinquedo'] = $this->brinquedoListar->getTodosBrinquedos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }
    
    

    public function adicionar() {
        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome_brinquedo', FILTER_SANITIZE_SPECIAL_CHARS);
            $hora = $_POST['hora_parque_brinquedo'];
            $capacidade = filter_input(INPUT_POST, 'capacidade_brinquedo', FILTER_SANITIZE_NUMBER_INT);
            $alt = $nome;
            $duracao = $_POST['duracao_brinquedo'];
            $status = filter_input(INPUT_POST, 'status_brinquedo', FILTER_SANITIZE_SPECIAL_CHARS);
            $genero = filter_input(INPUT_POST, 'genero_brinquedo', FILTER_SANITIZE_SPECIAL_CHARS);
            $informacao = filter_input(INPUT_POST, 'informacao_brinquedo', FILTER_SANITIZE_SPECIAL_CHARS);

            $foto = '';
            if (isset($_FILES['foto_brinquedo']) && $_FILES['foto_brinquedo']['error'] == 0) {
                $foto = $this->uploadFoto($_FILES['foto_brinquedo'], $nome);
            }

            if ($nome && $hora && $capacidade && $duracao && $status) {
                $dadosBrinquedo = [
                    'nome_brinquedo' => $nome,
                    'hora_parque_brinquedo' => $hora,
                    'capacidade_brinquedo' => $capacidade,
                    'alt_brinquedo' => $alt,
                    'foto_brinquedo' => $foto,
                    'duracao_brinquedo' => $duracao,
                    'status_brinquedo' => $status,
                    'genero_brinquedo' => $genero,
                    'informacao_brinquedo' => $informacao
                ];

                $this->brinquedoListar->addBrinquedo($dadosBrinquedo);
                header('Location: http://localhost/sistema-pqmarisa/public/brinquedo/brinquedoListar');
                exit;
            } else {
                $dados['erro'] = 'Preencha todos os campos obrigatórios';
            }
        }

        $dados['conteudo'] = 'admin/brinquedo/adicionar';
        $this->carregarViews('admin/index', $dados);
    }

    public function editar($id) {
        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = filter_input(INPUT_POST, 'nome_brinquedo', FILTER_SANITIZE_SPECIAL_CHARS);
            $hora = $_POST['hora_parque_brinquedo'];
            $capacidade = filter_input(INPUT_POST, 'capacidade_brinquedo', FILTER_SANITIZE_NUMBER_INT);
            $alt = $nome;
            $duracao = $_POST['duracao_brinquedo'];
            $status = filter_input(INPUT_POST, 'status_brinquedo', FILTER_SANITIZE_SPECIAL_CHARS);
            $genero = filter_input(INPUT_POST, 'genero_brinquedo', FILTER_SANITIZE_SPECIAL_CHARS);
            $informacao = filter_input(INPUT_POST, 'informacao_brinquedo', FILTER_SANITIZE_SPECIAL_CHARS);

            $foto = $_POST['foto_atual'] ?? '';
            if (isset($_FILES['foto_brinquedo']) && $_FILES['foto_brinquedo']['error'] == 0) {
                $foto = $this->uploadFoto($_FILES['foto_brinquedo'], $nome);
            }

            $dadosBrinquedo = [
                'nome_brinquedo' => $nome,
                'hora_parque_brinquedo' => $hora,
                'capacidade_brinquedo' => $capacidade,
                'alt_brinquedo' => $alt,
                'foto_brinquedo' => $foto,
                'duracao_brinquedo' => $duracao,
                'status_brinquedo' => $status,
                'genero_brinquedo' => $genero,
                'informacao_brinquedo' => $informacao
            ];

            $this->brinquedoListar->updateBrinquedo($id, $dadosBrinquedo);
            header('Location: http://localhost/sistema-pqmarisa/public/brinquedo/brinquedoListar');
            exit;
        }

        $dados['brinquedo'] = $this->brinquedoListar->getBrinquedoById($id);
        $dados['conteudo'] = 'admin/brinquedo/editar';
        $this->carregarViews('admin/index', $dados);
    }

    private function uploadFoto($arquivo, $nome) {
        $ext = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        $nomeArquivo = md5($nome . time()) . '.' . $ext;
        $destino = 'assets/img/brinquedos/' . $nomeArquivo;

        if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
            return $nomeArquivo;
        }

        return '';
    }
}



