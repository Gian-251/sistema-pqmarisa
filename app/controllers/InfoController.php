<?php   

class InfoController extends Controller{

    private $infoListar;
    public function __construct()
    {
        $this->infoListar = new Info();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function infoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/info/infoListar';
        $dados['info'] = $this->infoListar->getTodasInfos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }

    public function adicionar() {
        $dados = array();
    
        // Se a requisição for do tipo POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capturando e sanitizando os dados do formulário
            $nome_info = filter_input(INPUT_POST, 'nome_info', FILTER_SANITIZE_SPECIAL_CHARS);
            $informacao_texto_info = filter_input(INPUT_POST, 'informacao_texto_info', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_info = filter_input(INPUT_POST, 'status_info', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Validação extra (pode ser expandida conforme necessário)
            if (empty($nome_info) || empty($informacao_texto_info)) {
                $_SESSION['erro'] = "Nome e informação são obrigatórios!";
                header("Location: http://localhost/sistema-pqmarisa/public/info/adicionar");
                exit;
            }
    
            // Preparando a inserção no banco
            try {
                $dadosParaCadastrar = array(
                    'nome_info' => $nome_info,
                    'informacao_texto_info' => $informacao_texto_info,
                    'status_info' => $status_info
                );
    
                // Chama o método cadastrarInfo do modelo
                if ($this->infoListar->cadastrarInfo($dadosParaCadastrar)) {
                    $_SESSION['sucesso'] = "Informação cadastrada com sucesso!";
                    header("Location: http://localhost/sistema-pqmarisa/public/info/infoListar");
                    exit;
                } else {
                    $_SESSION['erro'] = "Erro ao cadastrar informação!";
                }
            } catch (\PDOException $e) {
                error_log("Erro ao inserir informação: " . $e->getMessage());
                $_SESSION['erro'] = "Erro ao processar a requisição!";
            }
        }
    
        $dados['conteudo'] = 'admin/info/adicionar';
        $this->carregarViews('admin/index', $dados);
    }
    
    //editar da info
    public function editar($id) {
        $dados = array();
    
        // Se a requisição for do tipo POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capturando e sanitizando os dados do formulário
            $nome_info = filter_input(INPUT_POST, 'nome_info', FILTER_SANITIZE_SPECIAL_CHARS);
            $informacao_texto_info = filter_input(INPUT_POST, 'informacao_texto_info', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_info = filter_input(INPUT_POST, 'status_info', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Validação extra (pode ser expandida conforme necessário)
            if (empty($nome_info) || empty($informacao_texto_info)) {
                $_SESSION['erro'] = "Nome e informação são obrigatórios!";
                header("Location: http://localhost/sistema-pqmarisa/public/info/editar/$id");
                exit;
            }
    
            // Preparando os dados para atualização
            $dadosParaAtualizar = array(
                'id_info' => $id,
                'nome_info' => $nome_info,
                'informacao_texto_info' => $informacao_texto_info,
                'status_info' => $status_info
            );
    
            // Chama o método editarInfo do modelo
            if ($this->infoListar->editarInfo($dadosParaAtualizar)) {
                $_SESSION['sucesso'] = "Informação editada com sucesso!";
                header("Location: http://localhost/sistema-pqmarisa/public/info/infoListar");
                exit;
            } else {
                $_SESSION['erro'] = "Erro ao editar informação!";
            }
        }
    
        // Se não for um POST, busca a informação existente
        $dados['info'] = $this->infoListar->getInfoById($id); // Você precisa implementar esse método no modelo
        $dados['conteudo'] = 'admin/info/editar'; // Pode ser a mesma visão de adicionar
        $this->carregarViews('admin/index', $dados);
    }
  
    
    

}