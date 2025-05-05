<?php




class IngressoController extends Controller
{


    public function index()
    {




        if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo']) == 'cliente') {
            header('Location: login.php'); // Redireciona para a página de login
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
    public function ingressoListar()
    {

        $dados = array();
        $dados['conteudo'] = 'admin/ingresso/ingressoListar';
        $dados['ingresso'] = $this->ingressoListar->getTodosIngressos();
        // var_dump($dados['servicos']);




        $this->carregarViews('admin/index', $dados);
    }

    public function getItensAtivos()
    {
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

    public function salvarIngresso()
    {
        if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'cliente') {
            header('Location: login.php');
            exit();
        }
    
        $qtde_compra = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
        $valor_total = filter_input(INPUT_POST, 'valor_total', FILTER_VALIDATE_FLOAT);
    
        if ($qtde_compra === false || $qtde_compra <= 0) {
            throw new Exception("Quantidade de ingressos inválida");
        }
    
        if ($valor_total === false || $valor_total <= 0) {
            throw new Exception("Valor total inválido");
        }
    
        $id_cliente = $_SESSION['usuario']['id_cliente'];
        $valor_unit = 10.00;
        $status = 'pendente';
        $qtde_pendente = $qtde_compra;

      
        
    
        $cod_qr = 'qr_' . uniqid() . '_' . bin2hex(random_bytes(4));
        $alt_qr = 'QR Code do ingresso #' . $cod_qr;

        
    
        // Inclui o gerador de QR Code
        include_once $_SERVER['DOCUMENT_ROOT'] . '/sistema-pqmarisa/app/models/qrcode.php';
    
        // Texto do QR code será o código gerado
        $text = $cod_qr;
        $name = md5(time()) . ".png";
        $file = "uploads\qrcode{$name}";

       
    
        $options = ['w' => 500, 'h' => 500];
        $generator = new QRCode($text, $options);
        $image = $generator->render_image();
        imagepng($image, $file);

    
        $dadosIngresso = array (          
       'id_cliente' => $id_cliente,
        'qtde_compra_ingresso' => $qtde_compra,
        'qtde_pendente_ingresso' => $qtde_pendente,
        'valor_unit_ingresso' => $valor_unit,
        'valor_total_ingresso' => $valor_total,
        'status_ingresso' => $status,
        'cod_qr_ingresso' => $cod_qr,
        'foto_qr_ingresso' => $file,
        'alt_qr_ingresso' => $alt_qr,
        'data_compra_ingresso' => date('Y-m-d H:i:s'));

        $ingresso = new Ingresso();
        $ingresso->salvarIngresso($dadosIngresso);

    
        $_SESSION['mensagem_sucesso'] = "Ingresso salvo com sucesso!";
        header('Location: usuario');
        exit();
    }
    
}
