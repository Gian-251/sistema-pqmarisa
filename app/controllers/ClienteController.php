<?php   

class ClienteController extends Controller{

    private $clienteListar;
    private $db;
    public function __construct()
    {
        $this->clienteListar = new Cliente();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function clienteListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/cliente/clienteListar';
        $dados['cliente'] = $this->clienteListar->getTodosClientes();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }

    public function adicionar() {
        $dados = array();
    
        // Se a requisição for do tipo POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Capturando e sanitizando os dados do formulário
            $nome_cliente = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_cliente = filter_input(INPUT_POST, 'cpf_cliente', FILTER_SANITIZE_NUMBER_INT);
            $bairro_cliente = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_cliente = filter_input(INPUT_POST, 'estado_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_cliente = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nasc_cliente = filter_input(INPUT_POST, 'data_nasc_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente = filter_input(INPUT_POST, 'email_cliente', FILTER_VALIDATE_EMAIL);
    
            // Validação extra (pode ser expandida conforme necessário)
            if (!$email_cliente) {
                $_SESSION['erro'] = "E-mail inválido!";
                header("Location: /cliente/adicionar");
                exit;
            }
    
            // Verifica se o CPF já existe no banco (para evitar duplicatas)
            $sqlCheck = "SELECT id_cliente FROM tbl_cliente WHERE cpf_cliente = :cpf";
            $stmtCheck = $this->db->prepare($sqlCheck);
            $stmtCheck->bindValue(":cpf", $cpf_cliente);
            $stmtCheck->execute();
    
            if ($stmtCheck->rowCount() > 0) {
                $_SESSION['erro'] = "CPF já cadastrado!";
                header("Location: /cliente/adicionar");
                exit;
            }
    
            // Preparando a inserção no banco
            try {
                $sql = "INSERT INTO tbl_cliente (nome_cliente, cpf_cliente, bairro_cliente, estado_cliente, cidade_cliente, data_nasc_cliente, telefone_cliente, email_cliente) 
                        VALUES (:nome, :cpf, :bairro, :estado, :cidade, :data_nasc, :telefone, :email)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindValue(":nome", $nome_cliente);
                $stmt->bindValue(":cpf", $cpf_cliente);
                $stmt->bindValue(":bairro", $bairro_cliente);
                $stmt->bindValue(":estado", $estado_cliente);
                $stmt->bindValue(":cidade", $cidade_cliente);
                $stmt->bindValue(":data_nasc", $data_nasc_cliente);
                $stmt->bindValue(":telefone", $telefone_cliente);
                $stmt->bindValue(":email", $email_cliente);
    
                if ($stmt->execute()) {
                    $_SESSION['sucesso'] = "Cliente cadastrado com sucesso!";
                    header("Location: /cliente/listar");
                    exit;
                } else {
                    $_SESSION['erro'] = "Erro ao cadastrar cliente!";
                }
            } catch (\PDOException $e) {
                error_log("Erro ao inserir cliente: " . $e->getMessage());
                $_SESSION['erro'] = "Erro ao processar a requisição!";
            }
        }
    
        $dados['conteudo'] = 'admin/cliente/adicionar';
       $this->carregarViews('admin/index', $dados);
    }

    public function editar($id = null) {
        $dados = array();
        
        // Se o formulário foi submetido
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
    
            // Filtrando e sanitizando os inputs
            $nome_cliente = filter_input(INPUT_POST, 'nome_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_cliente = filter_input(INPUT_POST, 'cpf_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_cliente = filter_input(INPUT_POST, 'bairro_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_cliente = filter_input(INPUT_POST, 'cidade_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $estado_cliente = filter_input(INPUT_POST, 'estado_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nasc_cliente = filter_input(INPUT_POST, 'data_nasc_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone_cliente = filter_input(INPUT_POST, 'telefone_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_cliente = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);
            $senha_cliente = filter_input(INPUT_POST, 'senha_cliente', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Se os campos obrigatórios foram preenchidos
            if ($nome_cliente && $cpf_cliente && $email_cliente) {
    
                // Se a senha foi preenchida, criptografamos antes de salvar
                if (!empty($senha_cliente)) {
                    $senha_cliente = password_hash($senha_cliente, PASSWORD_DEFAULT);
                } else {
                    // Mantém a senha atual se não for alterada
                    $senha_cliente = null;
                }
    
                $dadosCliente = array(
                    'id_cliente'        => $id,
                    'nome_cliente'      => $nome_cliente,
                    'cpf_cliente'       => $cpf_cliente,
                    'bairro_cliente'    => $bairro_cliente,
                    'cidade_cliente'    => $cidade_cliente,
                    'estado_cliente'    => $estado_cliente,
                    'data_nasc_cliente' => $data_nasc_cliente,
                    'telefone_cliente'  => $telefone_cliente,
                    'email_cliente'     => $email_cliente,
                    'senha_cliente'     => $senha_cliente
                );
    
                // Editar na base de dados
                $clienteModel = new Cliente();
                $idCliente = $clienteModel->editarCliente($dadosCliente);
    
                if ($idCliente) {
                    $_SESSION['mensagem'] = 'Cliente editado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/cliente/clienteListar');
                    exit;
                } else {
                    $dados['mensagem'] = 'Erro ao editar o cliente - Falha ao atualizar no banco';
                    $dados['tipo-msg'] = 'erro';
                }
    
            } else {
                $dados['mensagem'] = 'Erro ao editar o cliente - Preencha todos os campos obrigatórios';
                $dados['tipo-msg'] = 'erro';
            }
        }
    
        // Obtendo os dados do cliente pelo ID
        $clienteModel = new Cliente();
        $dadosCliente = $clienteModel->getDadosCliente($id);
        $dados['dadosCliente'] = $dadosCliente;
    
        if (!$dadosCliente) { 
            $_SESSION['mensagem'] = 'Cliente não encontrado.';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: ' . BASE_URL . 'cliente/listar');
            exit;
        }
    
        $dados['conteudo'] = 'admin/cliente/editar';
        $this->carregarViews('admin/index', $dados);
    }
    

}