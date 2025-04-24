<?php

class UsuarioController extends Controller {

    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario(); // Inicializa o modelo de usuário
    }

    public function index() {
        $dados = array();
        $dados['titulo'] = 'Área do Usuário - Parque Marisa';
        $dados['conteudo'] = 'usuario/index';
        $this->carregarViews('usuario/template/Usuario', $dados);
    }

    public function paginaUsuario($idCliente) {
        $dados = [];

        // Verifica se o ID foi fornecido
        if (!$idCliente) {
            $_SESSION['mensagem'] = 'ID do cliente não fornecido.';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sistema-pqmarisa/public/home');
            exit;
        }

        // Busca os dados do cliente e ingresso
        $cliente = $this->usuarioModel->getClientePorId($idCliente);
        $ingresso = $this->usuarioModel->getIngressoPorCliente($idCliente);

        if (!$cliente) {
            $_SESSION['mensagem'] = 'Cliente não encontrado.';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sistema-pqmarisa/public/home');
            exit;
        }

        $dados['cliente'] = $cliente;
        $dados['ingresso'] = $ingresso;
        $dados['conteudo'] = 'usuario/paginaUsuario';

        $this->carregarViews('usuario/templateUsuario', $dados);
    }

    public function cadastro() {
        $dados = array();
        $dados['titulo'] = 'Cadastro de Usuário - Parque Marisa';
        $dados['conteudo'] = 'usuario/cadastro';
        $this->carregarViews('usuario/templateUsuario', $dados);
    }

    public function cadastrar() {
        // Verifica se o formulário foi submetido
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitiza os dados do formulário
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Processa os dados
            $dados = [
                'nome' => trim($_POST['nome']),
                'email' => trim($_POST['email']),
                'telefone' => trim($_POST['telefone']),
                'senha' => trim($_POST['senha']),
                'confirma_senha' => trim($_POST['confirma_senha']),
                'nome_erro' => '',
                'email_erro' => '',
                'telefone_erro' => '',
                'senha_erro' => '',
                'confirma_senha_erro' => ''
            ];

            // Validação dos campos
            if (empty($dados['nome'])) {
                $dados['nome_erro'] = 'Por favor, informe o nome';
            }

            if (empty($dados['email'])) {
                $dados['email_erro'] = 'Por favor, informe o email';
            }

            if (empty($dados['telefone'])) {
                $dados['telefone_erro'] = 'Por favor, informe o telefone';
            }

            if (empty($dados['senha'])) {
                $dados['senha_erro'] = 'Por favor, informe a senha';
            } elseif (strlen($dados['senha']) < 6) {
                $dados['senha_erro'] = 'A senha deve ter pelo menos 6 caracteres';
            }

            if (empty($dados['confirma_senha'])) {
                $dados['confirma_senha_erro'] = 'Por favor, confirme a senha';
            } elseif ($dados['senha'] != $dados['confirma_senha']) {
                $dados['confirma_senha_erro'] = 'As senhas não conferem';
            }

            // Verifica se não há erros
            if (empty($dados['nome_erro']) && empty($dados['email_erro']) && 
                empty($dados['telefone_erro']) && empty($dados['senha_erro']) && 
                empty($dados['confirma_senha_erro'])) {
                
                // Cadastra o usuário
                if ($this->usuarioModel->cadastrarCliente($dados)) {
                    $_SESSION['mensagem'] = 'Cadastro realizado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/usuario/login');
                    exit;
                } else {
                    $_SESSION['mensagem'] = 'Erro ao cadastrar usuário';
                    $_SESSION['tipo-msg'] = 'erro';
                    $this->carregarViews('usuario/cadastro', $dados);
                }
            } else {
                // Carrega a view com os erros
                $dados['titulo'] = 'Cadastro de Usuário - Parque Marisa';
                $dados['conteudo'] = 'usuario/cadastro';
                $this->carregarViews('usuario/templateUsuario', $dados);
            }
        } else {
            // Se não for POST, redireciona para a página de cadastro
            header('Location: http://localhost/sistema-pqmarisa/public/usuario/cadastro');
            exit;
        }
    }

    public function login() {
        $dados = array();
        $dados['titulo'] = 'Login - Parque Marisa';
        $dados['conteudo'] = 'usuario/login';
        $this->carregarViews('usuario/templateUsuario', $dados);
    }

    public function autenticar() {
        // Verifica se o formulário foi submetido
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitiza os dados do formulário
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Processa os dados
            $dados = [
                'email' => trim($_POST['email']),
                'senha' => trim($_POST['senha']),
                'email_erro' => '',
                'senha_erro' => ''
            ];

            // Validação dos campos
            if (empty($dados['email'])) {
                $dados['email_erro'] = 'Por favor, informe o email';
            }

            if (empty($dados['senha'])) {
                $dados['senha_erro'] = 'Por favor, informe a senha';
            }

            // Verifica se não há erros
            if (empty($dados['email_erro']) && empty($dados['senha_erro'])) {
                // Tenta autenticar o usuário
                $usuario = $this->usuarioModel->login($dados['email'], $dados['senha']);

                if ($usuario) {
                    // Cria a sessão do usuário
                    $_SESSION['usuario_id'] = $usuario->id_cliente;
                    $_SESSION['usuario_nome'] = $usuario->nome;
                    $_SESSION['usuario_email'] = $usuario->email;
                    
                    $_SESSION['mensagem'] = 'Login realizado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/usuario/paginaUsuario/' . $usuario->id_cliente);
                    exit;
                } else {
                    $_SESSION['mensagem'] = 'Email ou senha incorretos';
                    $_SESSION['tipo-msg'] = 'erro';
                    $dados['titulo'] = 'Login - Parque Marisa';
                    $dados['conteudo'] = 'usuario/login';
                    $this->carregarViews('usuario/templateUsuario', $dados);
                }
            } else {
                // Carrega a view com os erros
                $dados['titulo'] = 'Login - Parque Marisa';
                $dados['conteudo'] = 'usuario/login';
                $this->carregarViews('usuario/templateUsuario', $dados);
            }
        } else {
            // Se não for POST, redireciona para a página de login
            header('Location: http://localhost/sistema-pqmarisa/public/usuario/login');
            exit;
        }
    }

    public function perfil() {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['mensagem'] = 'Você precisa estar logado para acessar esta página';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sistema-pqmarisa/public/usuario/login');
            exit;
        }

        $cliente = $this->usuarioModel->getClientePorId($_SESSION['usuario_id']);
        $ingresso = $this->usuarioModel->getIngressoPorCliente($_SESSION['usuario_id']);

        $dados = [
            'titulo' => 'Meu Perfil - Parque Marisa',
            'cliente' => $cliente,
            'ingresso' => $ingresso,
            'conteudo' => 'usuario/perfil'
        ];

        $this->carregarViews('usuario/templateUsuario', $dados);
    }

    public function atualizarPerfil() {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario_id'])) {
            $_SESSION['mensagem'] = 'Você precisa estar logado para acessar esta página';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sistema-pqmarisa/public/usuario/login');
            exit;
        }

        // Verifica se o formulário foi submetido
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitiza os dados do formulário
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Processa os dados
            $dados = [
                'id_cliente' => $_SESSION['usuario_id'],
                'nome' => trim($_POST['nome']),
                'email' => trim($_POST['email']),
                'telefone' => trim($_POST['telefone']),
                'nome_erro' => '',
                'email_erro' => '',
                'telefone_erro' => ''
            ];

            // Validação dos campos
            if (empty($dados['nome'])) {
                $dados['nome_erro'] = 'Por favor, informe o nome';
            }

            if (empty($dados['email'])) {
                $dados['email_erro'] = 'Por favor, informe o email';
            }

            if (empty($dados['telefone'])) {
                $dados['telefone_erro'] = 'Por favor, informe o telefone';
            }

            // Verifica se não há erros
            if (empty($dados['nome_erro']) && empty($dados['email_erro']) && empty($dados['telefone_erro'])) {
                // Atualiza o perfil do usuário
                if ($this->usuarioModel->atualizarCliente($dados)) {
                    $_SESSION['mensagem'] = 'Perfil atualizado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/usuario/perfil');
                    exit;
                } else {
                    $_SESSION['mensagem'] = 'Erro ao atualizar perfil';
                    $_SESSION['tipo-msg'] = 'erro';
                    $this->carregarViews('usuario/perfil', $dados);
                }
            } else {
                // Carrega a view com os erros
                $dados['titulo'] = 'Meu Perfil - Parque Marisa';
                $dados['conteudo'] = 'usuario/perfil';
                $this->carregarViews('usuario/templateUsuario', $dados);
            }
        } else {
            // Se não for POST, redireciona para a página de perfil
            header('Location: http://localhost/sistema-pqmarisa/public/usuario/perfil');
            exit;
        }
    }

    public function logout() {
        // Destrói a sessão
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);
        
        session_destroy();
        
        $_SESSION['mensagem'] = 'Você saiu do sistema';
        $_SESSION['tipo-msg'] = 'info';
        header('Location: http://localhost/sistema-pqmarisa/public/home');
        exit;
    }
}
