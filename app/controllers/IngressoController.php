<?php

use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCode;

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

    function salvarIngresso()
    {
        try {
            // Verifica se o cliente está logado
            if (!isset($_SESSION['usuario']) && !isset($_SESSION['tipo']) == 'cliente') {
                header('Location: login.php'); // Redireciona para a página de login
                exit();
            }


            // Valida dados do formulário
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
            $qtde_pendente = $qtde_compra; // Quantidade pendente deve ser igual à comprada inicialmente

            // Gera código QR único
            $cod_qr = 'qr_' . uniqid() . '_' . bin2hex(random_bytes(4));
            $alt_qr = 'QR Code do ingresso #' . $cod_qr;

            // Define a pasta onde será salvo o QR code (com permissões mais seguras)
            $pasta_qr = 'public/uploads/qrcodes/';
            if (!file_exists($pasta_qr)) {
                if (!mkdir($pasta_qr, 0755, true)) {
                    throw new Exception("Falha ao criar diretório para QR Codes");
                }
            }

            // Inclui a biblioteca QR Code
            include_once('../../public/assets/php-qrcode-5.0.3/src/QRCode.php');



            // Caminho completo do arquivo PNG
            $caminho_qr = $pasta_qr . $cod_qr . '.png';

            // Gera o QR Code
            QRcode::png($cod_qr, $caminho_qr, QR_ECLEVEL_H, 10);

            // Verifica se o QR code foi gerado
            if (!file_exists($caminho_qr)) {
                throw new Exception("Falha ao gerar QR Code");
            }

            // Prepara dados para salvar
            $dadosIngresso = [
                'id_cliente' => $id_cliente,
                'qtde_compra_ingresso' => $qtde_compra,
                'qtde_pendente_ingresso' => $qtde_pendente,
                'valor_unit_ingresso' => $valor_unit,
                'valor_total_ingresso' => $valor_total,
                'status_ingresso' => $status,
                'cod_qr_ingresso' => $cod_qr,
                'foto_qr_ingresso' => $caminho_qr,
                'alt_qr_ingresso' => $alt_qr
            ];

            // Salva no banco - assumindo que $this->ingressoModel existe
            if (!$this->ingressoListar->salvarIngresso(
                $id_cliente,
                $qtde_compra,
                $qtde_pendente,
                $valor_unit,
                $valor_total,
                $status
            )) {
                // Remove o QR code gerado se falhar no banco
                if (file_exists($caminho_qr)) {
                    unlink($caminho_qr);
                }
                throw new Exception("Falha ao salvar ingresso no banco de dados");
            }

            $_SESSION['mensagem_sucesso'] = "Ingresso salvo com sucesso!";
            header('Location: /admin/ingresso/ingressoListar');
            exit();
        } catch (Exception $e) {
            // Log do erro
            error_log("Erro ao salvar ingresso: " . $e->getMessage());

            // Mensagem de erro para o usuário
            $_SESSION['mensagem_erro'] = "Erro ao salvar ingresso: " . $e->getMessage();
            header('Location: ingresso'); // Redireciona de volta ao formulário
            exit();
        }
    }
}
