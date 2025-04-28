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





    public function editar($id = null) {
        $dados = array();
    
        // Buscar dados do serviço antes de qualquer processamento
        $dadosServico = $this->servicoListar->getDadosServicos($id);
    
        if (!$dadosServico) { 
            $_SESSION['mensagem'] = 'Serviço não encontrado.';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: ' . BASE_URL . 'servico/listar');
            exit;
        }
    
        $dados['dadosServico'] = $dadosServico;
    
        // Se carregamento da página está vindo do FORM
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Dados dos campos de input -> name
            $nome_servico = filter_input(INPUT_POST, 'nome_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $descricao_servico = filter_input(INPUT_POST, 'descricao_servico', FILTER_SANITIZE_SPECIAL_CHARS);
            $valor_servico = str_replace('.', ',', filter_input(INPUT_POST, 'valor_servico'));
            $alt_servico = $nome_servico;
            $id_brinquedo = filter_input(INPUT_POST, 'id_brinquedo', FILTER_SANITIZE_NUMBER_INT);
            $status_servico = filter_input(INPUT_POST, 'status_servico', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Validação dos dados do formulário
            if (!$nome_servico || !$descricao_servico || !is_numeric($valor_servico) || !$id_brinquedo) {
                $dados['mensagem'] = 'Erro: Todos os campos são obrigatórios e valores devem ser válidos.';
                $dados['tipo-msg'] = 'erro';
                $this->carregarViews('admin/index', $dados);
                return;
            }
    
            // Inicializa com a foto atual
            $arquivo = $dadosServico['foto_servico'];
    
            // Só atualiza a foto se uma nova for enviada
            if (isset($_FILES['foto_servico']) && $_FILES['foto_servico']['error'] == 0) {
                // Verifica o tipo de arquivo
                $tipoArquivo = $_FILES['foto_servico']['type'];
                if (!in_array($tipoArquivo, ['image/jpeg', 'image/png', 'image/gif'])) {
                    $dados['mensagem'] = 'Erro: Apenas imagens JPEG, PNG e GIF são permitidas.';
                    $dados['tipo-msg'] = 'erro';
                    $this->carregarViews('admin/index', $dados);
                    return;
                }
    
                // Verifica o tamanho do arquivo (max 2MB)
                if ($_FILES['foto_servico']['size'] > 2 * 1024 * 1024) {
                    $dados['mensagem'] = 'Erro: O tamanho do arquivo deve ser no máximo 2MB.';
                    $dados['tipo-msg'] = 'erro';
                    $this->carregarViews('admin/index', $dados);
                    return;
                }
    
                // Realizar o upload da imagem
                $novaFoto = $this->uploadFoto($_FILES['foto_servico'], $nome_servico);
                if ($novaFoto) {
                    $arquivo = $novaFoto;
                }
            }
    
            // Preparar os dados para atualização
            $dadosServico = array(
                'id_servico' => $id,
                'nome_servico' => $nome_servico,
                'descricao_servico' => $descricao_servico,
                'valor_servico' => $valor_servico,
                'alt_servico' => $alt_servico,
                'id_brinquedo' => $id_brinquedo,
                'status_servico' => $status_servico,
                'foto_servico' => $arquivo
            );
    
            // Editar na base de dados
            if ($this->servicoListar->editarServico($dadosServico)) {
                $_SESSION['mensagem'] = 'Serviço editado com sucesso';
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: ' . BASE_URL . 'servico/listar');
                exit;
            } else {
                $dados['mensagem'] = 'Erro ao editar o serviço - Ao enviar para a base de dados';
                $dados['tipo-msg'] = 'erro';
            }
        }
    var_dump($dadosServico);
        // Buscar as especialidades
        $brinquedoModel = new Brinquedo();
        $dados['brinquedos'] = $brinquedoModel->getTodosBrinquedos();
    
        $dados['conteudo'] = 'admin/servico/editar';
        $this->carregarViews('admin/index', $dados);
    }
    
    
    









    public function uploadFoto($file, $nome){

        $dir = '../public/uploads/servicos/';

        if(!file_exists($dir)){
            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $novoNome = strtolower(trim(preg_replace('/[^a-zA-z0-9]/', '-', $nome)));

        $nome_foto = uniqid() . $novoNome . '.' . $ext;
        

        if(move_uploaded_file($file['tmp_name'], $dir . $nome_foto)){
            return 'servico/' . $nome_foto; //servico/16165135165nomeDoServico.png

        }


        return false;
    }

}