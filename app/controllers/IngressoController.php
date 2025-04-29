<?php   

class IngressoController extends Controller{
    public function index(){

        if (isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'cliente') {
            header('Location: login');
            exit();
        }

        $ingresso = new Ingresso();
        $ingresso = $ingresso->getIngressoByClienteId($_SESSION['usuario']['id_cliente']);
        $dados['ingresso'] = $ingresso;
       
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

    function salvarIngresso() {
    
        // Pega o ID do cliente logado
        if (!isset($_SESSION['cliente']['id'])) {
            die('Cliente não está logado.');
        }
        $id_cliente = $_SESSION['cliente']['id'];
    
        // Dados do formulário
        $qtde_compra = $_POST['quantidade'];
        $valor_unit = 10.00;
        $valor_total = $_POST['valor_total'];
        $status = 'pendente';
        $qtde_pendente = 0;
    
        // Gera código QR
        include_once 'assets/phpqrcode/qrlib.php';
        $cod_qr = uniqid('qr_');
        $alt_qr = 'QR Code do ingresso #' . $cod_qr;
    
        // Pasta e imagem do QR
        $pasta_qr = 'uploads/qrcodes/';
        if (!file_exists($pasta_qr)) {
            mkdir($pasta_qr, 0777, true);
        }
        $caminho_qr = $pasta_qr . $cod_qr . '.png';
        QRcode::png($cod_qr, $caminho_qr, QR_ECLEVEL_H, 10);
    
        // Salva no banco
        $this->ingressoListar->salvarIngresso(
            $id_cliente,
            $qtde_compra,
            $valor_unit,
            $valor_total,
            $status,
            $cod_qr
        );
    
        header('Location: /admin/ingresso/ingressoListar');
    }    

    
}



    