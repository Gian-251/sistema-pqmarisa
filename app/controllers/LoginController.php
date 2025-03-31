 <?php

class LoginController extends Controller {
    protected $clienteModel;

    public function __construct() {
        $this->clienteModel = new Cliente(); // Inicializa o modelo de cliente
    }

    // Método para exibir a página de login
    public function index() {
        $dados = array();
        $dados['titulo'] = 'Login - Marisa Parque Itaquera';
        $this->carregarViews('login', $dados);
    }

    // Método para processar o cadastro
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Dados do formulário
                $dadosCliente = [
                    'nome_cliente' => $_POST['nome_cliente'],
                    'cpf_cliente' => $_POST['cpf_cliente'],
                    'bairro_cliente' => $_POST['bairro_cliente'],
                    'estado_cliente' => $_POST['estado_cliente'],
                    'cidade_cliente' => $_POST['cidade_cliente'],
                    'data_nasc_cliente' => $_POST['data_nasc_cliente'],
                    'telefone_cliente' => $_POST['telefone_cliente'],
                    'email_cliente' => $_POST['email_cliente'],
                    'senha_cliente' => $_POST['senha_cliente']
                ];

                // Cadastra o cliente
                $idCliente = $this->clienteModel->cadastrar($dadosCliente);

                // Redireciona para uma página de sucesso
                echo '<script>alert("Cadastro realizado com sucesso!");</script>';
                exit;
            } catch (Exception $e) {
                // Exibe mensagem de erro
                $dados['erro'] = $e->getMessage();
                $this->carregarViews('login', $dados); // Volta para a página de login com a mensagem de erro
                
            }
            
        }
    }
}