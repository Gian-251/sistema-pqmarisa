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

}