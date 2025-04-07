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
    public function autenticar(){
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        // var_dump($email, $senha);



        $loginModel = new Login();

        // verrificar funcionario 
        $agente = $loginModel->verificarAgente($email, $senha);
        var_dump($agente);
        
        if($agente){
            $_SESSION['usuario'] = $agente;
            $_SESSION['tipo'] = 'agente';
            header('Location: '. BASE_URL .'admin/perfil');
            exit;
        }

        $cliente = $loginModel->verificarCliente($email, $senha);
        if($cliente){
            $_SESSION['usuario'] = $cliente;
            $_SESSION['tipo'] = 'cliente';
            header('Location: '. BASE_URL .'admin/perfil');
            exit;
        }

        //se não for autenticado 

        $_SESSION['erro_login'] = 'email ou senha inválidos';
        header('Location: '. BASE_URL);
        exit;
    }
    public function sair(){
        session_destroy();
        header('Location: '. BASE_URL);
        exit;

    }

    public function perfil(): void
    {
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $usuario = $_SESSION['usuario'];
        $tipo = $_SESSION['tipo'];

        $dados = array();
        $dados = [
            'usuario' => $usuario,
            'tipo' => $tipo
        ];

        if($tipo == 'agente'){
            $dados['conteudo'] = 'admin/perfil/agente';
            $this->carregarViews('admin/index', $dados);
        }else{
            $dados['conteudo'] = 'admin/perfil/cliente';
            $this->carregarViews('admin/index', $dados);
        }

     
            
        

    }
}