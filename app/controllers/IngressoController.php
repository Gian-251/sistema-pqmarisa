<?php   

class IngressoController extends Controller{
    public function index(){
        $dados = array();
        $dados['titulo'] = 'ingresso - Marisa Parque Itaquera';
        $this->carregarViews('ingresso', $dados);



        //var_dump("chegeui a Sobrecontroller");
    }
    private $db;



    private $ingressoListar;
    public function __construct()

    {
        $this->ingressoListar = new Ingresso();
    }
    public function ingressoListar(){

        $dados = array();
        $dados['conteudo'] = 'admin/ingresso/ingressoListar';
        $dados['ingresso'] = $this->ingressoListar->getTodosIngressos();
        // var_dump($dados['servicos']);
       


        
        $this->carregarViews('admin/index', $dados);
    }

    public function getItensAtivos() {
        $sql = "
            SELECT 'servico' AS tipo, id_servico AS id, nome_servico AS nome, descricao_servico AS descricao, 
                   valor_servico AS valor, foto_servico AS foto, alt_servico AS alt
            FROM tbl_servico 
            WHERE status_servico = 'ATIVO'
            UNION ALL
            SELECT 'ingresso' AS tipo, id_ingresso AS id, tipo_ingresso AS nome, descricao_ingresso AS descricao, 
                   valor_ingresso AS valor, foto_ingresso AS foto, alt_ingresso AS alt
            FROM tbl_ingresso 
            WHERE status_ingresso = 'ATIVO'
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

    




    