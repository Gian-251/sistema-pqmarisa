<?php

class LetreiroController extends Controller {
    private $letreiroListar;
    private $letreiroadd;
    private $db;
    

    public function __construct() {
        $this->letreiroListar = new Letreiros(); // Inicializa o modelo de letreiros
        $this->letreiroadd = new Letreiros();
    }

    public function index() {
        $dados = array();
        $dados['titulo'] = 'Dashboard - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
    }

    // Método para listar os letreiros na área administrativa
    public function letreiroListar() {
        $dados = array();
        $dados['conteudo'] = 'admin/letreiro/letreiroListar';
        $dados['letreiro'] = $this->letreiroListar->getTodosLetreiros();

        $this->carregarViews('admin/index', $dados);
    }

    // Método para buscar os itens do letreiro e exibi-los na página principal

    

    public function adicionarLetreiro(){
        $dados = array();
        // Verifica se a requisição é do tipo POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtra e sanitiza os dados dos campos de input
            $texto_letreiro = filter_input(INPUT_POST, 'texto_letreiro', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_letreiro = filter_input(INPUT_POST, 'status_letreiro', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Verifica se o texto do letreiro foi preenchido
            if ($texto_letreiro && $status_letreiro) {
    
                // Se necessário, realizar upload de algum arquivo (não é necessário neste caso, pois não temos campos de foto)
                // $arquivo = $this->uploadFoto($_FILES['foto_letreiro'], $texto_letreiro); // Exemplo de upload
    
                // Organiza os dados para enviar para o modelo
                $dadosLetreiro = array(
                    'texto_letreiro' => $texto_letreiro,
                    'status_letreiro' => $status_letreiro
                );
    
                // Chama o método do modelo para adicionar o letreiro
                $idLetreiro = $this->letreiroadd->addLetreiro($dadosLetreiro);
    
                // Verifica se o letreiro foi adicionado com sucesso
                if ($idLetreiro) {
                    $_SESSION['mensagem'] = 'Letreiro adicionado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/letreiro');
                    exit;
                } else {
                    $dados['erro'] = 'Erro ao adicionar letreiro - ao enviar para a base de dados';
                    $dados['tipo-msg'] = 'erro';
                }
    
            } else {
                // Se algum campo obrigatório não for preenchido
                $dados['erro'] = 'Preencha todos os campos corretamente';
                $dados['tipo-msg'] = 'erro';
            }
        }
    
        // Carrega as views
        $dados['conteudo'] = 'admin/letreiro/adicionarLetreiro'; // O caminho da view
        $this->carregarViews('admin/index', $dados); // Carrega a view principal com o conteúdo
    }
    public function editarLetreiro($id = null) {
        $dados = array();
        
        // Verifica se o ID foi fornecido
        if (!$id) {
            $_SESSION['mensagem'] = 'ID do letreiro não especificado';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sistema-pqmarisa/public/letreiro');
            exit;
        }
        
        // Busca o letreiro pelo ID
        $letreiro = $this->letreiroListar->getLetreiroPorId($id);
        
        if (!$letreiro) {
            $_SESSION['mensagem'] = 'Letreiro não encontrado';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sistema-pqmarisa/public/letreiro');
            exit;
        }
        
        // Verifica se a requisição é do tipo POST (formulário enviado)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Filtra e sanitiza os dados dos campos de input
            $texto_letreiro = filter_input(INPUT_POST, 'texto_letreiro', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_letreiro = filter_input(INPUT_POST, 'status_letreiro', FILTER_SANITIZE_SPECIAL_CHARS);
            
            // Verifica se os campos obrigatórios foram preenchidos
            if ($texto_letreiro && $status_letreiro) {
                // Organiza os dados para enviar para o modelo
                $dadosLetreiro = array(
                    'texto_letreiro' => $texto_letreiro,
                    'status_letreiro' => $status_letreiro
                );
                
                // Chama o método do modelo para editar o letreiro
                $resultado = $this->letreiroListar->editarLetreiro($id, $dadosLetreiro);
                
                // Verifica se o letreiro foi editado com sucesso
                if ($resultado) {
                    $_SESSION['mensagem'] = 'Letreiro atualizado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/letreiro/letreiroListar');
                    exit;
                } else {
                    $dados['erro'] = 'Erro ao atualizar letreiro';
                    $dados['tipo-msg'] = 'erro';
                }
            } else {
                // Se algum campo obrigatório não for preenchido
                $dados['erro'] = 'Preencha todos os campos corretamente';
                $dados['tipo-msg'] = 'erro';
            }
        }
        
        // Passa os dados do letreiro para a view
        $dados['dadosLetreiro'] = $letreiro; // Aqui estamos definindo a variável para a view
        $dados['conteudo'] = 'admin/letreiro/editarLetreiro';
        $this->carregarViews('admin/index', $dados);
    }
    

    
    // Método para excluir um letreiro
    public function excluirLetreiro($id = null) {
        // Verifica se o ID foi fornecido
        if (!$id) {
            $_SESSION['mensagem'] = 'ID do letreiro não especificado';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sistema-pqmarisa/public/editarLetreiro');
            exit;
        }
        
        // Chama o método do modelo para excluir o letreiro
        $resultado = $this->letreiroListar->excluirLetreiro($id);
        
        if ($resultado) {
            $_SESSION['mensagem'] = 'Letreiro excluído com sucesso';
            $_SESSION['tipo-msg'] = 'sucesso';
        } else {
            $_SESSION['mensagem'] = 'Erro ao excluir letreiro';
            $_SESSION['tipo-msg'] = 'erro';
        }
        
        header('Location: http://localhost/sistema-pqmarisa/public/editarLetreiro');
        exit;
    }
    
    
}