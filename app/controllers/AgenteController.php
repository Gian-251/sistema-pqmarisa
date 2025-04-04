<?php   


class AgenteController extends Controller{

   

    private $agenteListar;
    private $agenteModel;
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

}