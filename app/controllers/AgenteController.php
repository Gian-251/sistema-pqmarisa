<?php   


class AgenteController extends Controller{

   

    private $agenteListar;
    private $agenteModel;
<<<<<<< HEAD
    private $db;
=======
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
    public function __construct()
    {
        $this->agenteListar = new Agente();
        $this->agenteModel = new Agente();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function agenteListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/agente/agenteListar';
        $dados['agentes'] = $this->agenteListar->getTodosAgentes();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }

    public function adicionar(){
        $dados = array();
      
    
        // Se o carregamento da página vem do FORM
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
            // Filtrando e sanitizando os dados recebidos
            $nome_agente = filter_input(INPUT_POST, 'nome_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_agente = filter_input(INPUT_POST, 'cpf_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $rua_agente = filter_input(INPUT_POST, 'rua_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_agente = filter_input(INPUT_POST, 'cidade_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_agente = filter_input(INPUT_POST, 'bairro_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nasc_agente = filter_input(INPUT_POST, 'data_nasc_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone_agente = filter_input(INPUT_POST, 'telefone_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $senha_agente = password_hash(filter_input(INPUT_POST, 'senha_agente', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);
            $email_agente = filter_input(INPUT_POST, 'email_agente', FILTER_VALIDATE_EMAIL);
            $turno_agente = filter_input(INPUT_POST, 'turno_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_agente = filter_input(INPUT_POST, 'status_agente', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Verifica se os campos obrigatórios foram preenchidos
            if ($nome_agente && $cpf_agente && $email_agente && $senha_agente) {
                
                $dadosAgente = array(
                    'nome_agente'      => $nome_agente,
                    'cpf_agente'       => $cpf_agente,
                    'rua_agente'       => $rua_agente,
                    'cidade_agente'    => $cidade_agente,
                    'bairro_agente'    => $bairro_agente,
                    'data_nasc_agente' => $data_nasc_agente,
                    'telefone_agente'  => $telefone_agente,
                    'senha_agente'     => $senha_agente,
                    'email_agente'     => $email_agente,
                    'turno_agente'     => $turno_agente,
                    'status_agente'    => $status_agente
                );
    
                // Chama o modelo para adicionar o agente
                $idAgente = $this->agenteModel->addAgente($dadosAgente);
    
                if ($idAgente) {
                    $_SESSION['mensagem'] = 'Agente adicionado com sucesso!';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/agente/agenteListar');
                    exit;
                } else {
                    $dados['erro'] = 'Erro ao adicionar agente no banco de dados';
                    $dados['tipo-msg'] = 'erro';
                }
    
            } else {
                $dados['erro'] = 'Preencha todos os campos obrigatórios';
                $dados['tipo-msg'] = 'erro';
            }
        }
        
        $dados['conteudo'] = 'admin/agente/adicionar';
        $this->carregarViews('admin/index', $dados);
    }

<<<<<<< HEAD
    public function editar($id_agente) {
        $dados = [];
    
        // Instancia o model
        $agenteModel = new Agente();
    
        // Busca os dados atuais do agente
        $dadosAgente = $agenteModel->getAgenteById($id_agente);
    
        if (!$dadosAgente) {
            $_SESSION['mensagem'] = 'Agente não encontrado.';
            $_SESSION['tipo-msg'] = 'erro';
            header('Location: http://localhost/sistema-pqmarisa/public/agente/agenteListar');
            exit;
        }
    
        // Se enviou o formulário
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_agente       = filter_input(INPUT_POST, 'nome_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cpf_agente        = filter_input(INPUT_POST, 'cpf_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $rua_agente        = filter_input(INPUT_POST, 'rua_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $cidade_agente     = filter_input(INPUT_POST, 'cidade_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $bairro_agente     = filter_input(INPUT_POST, 'bairro_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $data_nasc_agente  = filter_input(INPUT_POST, 'data_nasc_agente');
            $telefone_agente   = filter_input(INPUT_POST, 'telefone_agente', FILTER_SANITIZE_SPECIAL_CHARS);
            $email_agente      = filter_input(INPUT_POST, 'email_agente', FILTER_SANITIZE_EMAIL);
            $senha_agente      = filter_input(INPUT_POST, 'senha_agente'); // Se quiser usar hash, aplicar aqui
            $turno_agente      = filter_input(INPUT_POST, 'turno_agente');
            $status_agente     = filter_input(INPUT_POST, 'status_agente', FILTER_SANITIZE_SPECIAL_CHARS);
    
            // Verifica se os campos obrigatórios foram preenchidos
            if ($nome_agente && $cpf_agente && $email_agente) {
                $dadosAtualizados = [
                    'id_agente'         => $id_agente,
                    'nome_agente'       => $nome_agente,
                    'cpf_agente'        => $cpf_agente,
                    'rua_agente'        => $rua_agente,
                    'cidade_agente'     => $cidade_agente,
                    'bairro_agente'     => $bairro_agente,
                    'data_nasc_agente'  => $data_nasc_agente,
                    'telefone_agente'   => $telefone_agente,
                    'email_agente'      => $email_agente,
                    'senha_agente'      => $senha_agente,
                    'turno_agente'      => $turno_agente,
                    'status_agente'     => $status_agente
                ];
    
                $sucesso = $agenteModel->editarAgente($dadosAtualizados);
    
                if ($sucesso) {
                    $_SESSION['mensagem'] = 'Agente atualizado com sucesso.';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/agente/agenteListar');
                    exit;
                } else {
                    $dados['erro'] = 'Erro ao atualizar agente.';
                }
            } else {
                $dados['erro'] = 'Preencha todos os campos obrigatórios.';
            }
        }
    
        $dados['dadosAgente'] = $dadosAgente;
        $dados['conteudo'] = 'admin/agente/editar';
    
        $this->carregarViews('admin/index', $dados);
    }
    

=======
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
}