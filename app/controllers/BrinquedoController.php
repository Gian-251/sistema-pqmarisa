<?php   

class BrinquedoController extends Controller{

    private $brinquedoListar;
    public function __construct()
    {
        $this->brinquedoListar = new Brinquedo();
    }
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashbord - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
        //var_dump("chegeui a Sobrecontroller");
    }
    public function brinquedoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/brinquedo/brinquedoListar';
        $dados['brinquedo'] = $this->brinquedoListar->getTodosBrinquedos();
        // var_dump($dados['servicos']);


        
        $this->carregarViews('admin/index', $dados);
    }
    public function editar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Captura os dados do formulário
            $dados = [
                'id_brinquedo' => $id,
                'nome_brinquedo' => $_POST['nome_brinquedo'],
                'hora_parque_brinquedo' => $_POST['hora_parque_brinquedo'],
                'capacidade_brinquedo' => $_POST['capacidade_brinquedo'],
                'alt_brinquedo' => $_POST['alt_brinquedo'],
                'foto_brinquedo' => $_POST['foto_brinquedo'],
                'duracao_brinquedo' => $_POST['duracao_brinquedo'],
                'status_brinquedo' => $_POST['status_brinquedo'],
            ];

            // Atualiza o brinquedo no banco de dados
            if ($this->brinquedoListar->atualizarBrinquedo($dados)) {
                header('Location: /admin/brinquedo/brinquedoListar'); // Redireciona após a edição
                exit;
            }
        } else {
            $brinquedo = $this->brinquedoListar->getBrinquedoPorId($id);
            $this->carregarViews('admin/index', ['conteudo' => 'admin/brinquedo/editar', 'brinquedo' => $brinquedo]);
        }   
    }

}

