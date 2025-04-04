<?php   

class BannerController extends Controller{

    private $bannerListar;

<<<<<<< HEAD
    private $bannerModel;
    private $db;

    public function __construct()
    {
        $this->bannerListar = new Banner();
        $this->bannerModel = new Banner();
=======
    public function __construct()
    {
        $this->bannerListar = new Banner();
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
    }

    public function index(){
        $dados = array();
        $dados['titulo'] = 'Dashboard - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
    }

    public function bannerListar(){
        $dados = array();
        $dados['conteudo'] = 'admin/banner/bannerListar';
        $dados['banners'] = $this->bannerListar->getTodosBanners();

        $this->carregarViews('admin/index', $dados);
    }
<<<<<<< HEAD

    public function adicionar() {
        $dados = [];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Valida os campos obrigatórios
            if (
                !empty($_POST['nome_banner']) &&
                !empty($_POST['alt_banner']) &&
                !empty($_POST['status_banner']) &&
                isset($_FILES['foto_banner']) &&
                isset($_FILES['video_banner'])
            ) {
                // Faz o upload da imagem e do gif
                $foto = $this->uploadBannerImagem($_FILES['foto_banner'], $_POST['nome_banner'], 'foto');
                $gif = $this->uploadBannerImagem($_FILES['video_banner'], $_POST['nome_banner'], 'gif');
    
                if ($foto && $gif) {
                    // Dados prontos para inserção
                    $bannerData = [
                        'nome_banner' => $_POST['nome_banner'],
                        'foto_banner' => $foto, // exemplo: banner/foto_nome.png
                        'video_banner' => $gif, // exemplo: banner/gif_nome.gif
                        'alt_banner' => $_POST['alt_banner'],
                        'status_banner' => $_POST['status_banner']
                    ];
    
                    // Chama o model para inserir no banco
                    if ($this->bannerModel->adicionarBanner($bannerData)) {
                        header('Location: ' . BASE_URL . 'banner/bannerListar');
                        exit;
                    } else {
                        $dados['erro'] = 'Erro ao salvar o banner no banco de dados.';
                    }
                } else {
                    $dados['erro'] = 'Erro ao fazer upload da imagem ou do GIF.';
                }
            } else {
                $dados['erro'] = 'Preencha todos os campos obrigatórios.';
            }
        }
    
        // Carrega a view
        $dados['conteudo'] = 'admin/banner/adicionar';
        $dados['titulo'] = 'Adicionar Banner - Parque Marisa';
        $this->carregarViews('admin/index', $dados);
    }
    
    public function uploadBannerImagem($file, $nome, $tipo = 'foto') {
        $dir = '/public/assets/img/banner/';
    
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $novoNome = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '-', $nome)));
    
        // Prefixo para diferenciar os arquivos
        $prefixo = ($tipo === 'gif') ? 'gif_' : 'foto_';
    
        $nomeFinal = uniqid($prefixo) . '-' . $novoNome . '.' . $ext;
    
        if (move_uploaded_file($file['tmp_name'], $dir . $nomeFinal)) {
            return 'banner/' . $nomeFinal; // Ex: banner/gif_nome.gif
        }
    
        return false;
    }
    


    
=======
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
}
