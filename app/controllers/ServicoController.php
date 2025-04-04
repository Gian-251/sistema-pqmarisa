<?php   

class ServicoController extends Controller{

    private $servicoListar;
    public function __construct()
    {
        $this->servicoListar = new Servico();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function servicoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/servico/servicoListar';
        $dados['servico'] = $this->servicoListar->getTodosServicos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }
    public function adicionar(){
        $dados = array();
        
        // Se for um POST, processa o formulário
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se os campos obrigatórios foram preenchidos
            if(
                !empty($_POST['nome_servico']) && 
                !empty($_POST['descricao_servico']) && 
                !empty($_POST['valor_servico']) && 
                !empty($_POST['status_servico']) &&
                isset($_FILES['foto_servico']) &&
                !empty($_POST['alt_servico'])
            ) {
                // Processa o upload da imagem
                $foto = $_FILES['foto_servico'];
                $nomeArquivo = time() . '_' . $foto['name'];
                $diretorio = 'assets/img/servicos/';
                
                // Verifica se o diretório existe, se não, cria
                if(!is_dir($diretorio)) {
                    mkdir($diretorio, 0777, true);
                }
                
                // Move o arquivo para o diretório
                if(move_uploaded_file($foto['tmp_name'], $diretorio . $nomeArquivo)) {
                    // Prepara os dados para inserção
                    $servicoData = [
                        'nome_servico' => $_POST['nome_servico'],
                        'descricao_servico' => $_POST['descricao_servico'],
                        'valor_servico' => $_POST['valor_servico'],
                        'foto_servico' => $diretorio . $nomeArquivo,
                        'alt_servico' => $_POST['alt_servico'],
                        'id_brinquedo' => !empty($_POST['id_brinquedo']) ? $_POST['id_brinquedo'] : null,
                        'status_servico' => $_POST['status_servico']
                    ];
                    
                    // Insere no banco de dados
                    if($this->servicoListar->adicionarServico($servicoData)) {
                        // Redireciona para a listagem com mensagem de sucesso
                        header('Location: ' . BASE_URL . 'servico/servicoListar?success=1');
                        exit;
                    } else {
                        $dados['erro'] = 'Erro ao salvar o serviço no banco de dados.';
                    }
                } else {
                    $dados['erro'] = 'Erro ao fazer upload da imagem.';
                }
            } else {
                $dados['erro'] = 'Preencha todos os campos obrigatórios.';
            }
        }
        
        // Carrega os brinquedos para o select
        $brinquedoModel = new Brinquedo();
        $dados['brinquedos'] = $brinquedoModel->getTodosBrinquedos();
        
        // Carrega a view
        $dados['conteudo'] = 'admin/servico/adicionar';
        $dados['titulo'] = 'Adicionar Serviço - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
    }

}