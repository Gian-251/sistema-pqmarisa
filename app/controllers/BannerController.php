<?php   

class BannerController extends Controller{

    private $bannerListar;

    private $bannerModel;
    private $db;

    public function __construct()
    {
        $this->bannerListar = new Banner();
        
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

    public function adicionar() {
        $dados = array();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome_banner = filter_input(INPUT_POST, 'nome_banner', FILTER_SANITIZE_SPECIAL_CHARS);
            $alt_banner = filter_input(INPUT_POST, 'alt_banner', FILTER_SANITIZE_SPECIAL_CHARS);
            $status_banner = filter_input(INPUT_POST, 'status_banner', FILTER_SANITIZE_SPECIAL_CHARS);
    
            $fotoPath = '';
            $gifPath = '';
    
            // Upload da imagem fixa
            if (isset($_FILES['foto_banner']) && $_FILES['foto_banner']['error'] === 0) {
                $fotoPath = $this->uploadBannerFile($_FILES['foto_banner'], $nome_banner, 'img');
            }
    
            // Upload do GIF/vídeo
            if (isset($_FILES['video_banner']) && $_FILES['video_banner']['error'] === 0) {
                $gifPath = $this->uploadBannerFile($_FILES['video_banner'], $nome_banner, 'gif, mp4');
            }
    
            if ($nome_banner && $fotoPath && $gifPath) {
                $dadosBanner = array(
                    'nome_banner' => $nome_banner,
                    'foto_banner' => $fotoPath,
                    'video_banner' => $gifPath,
                    'alt_banner'  => $alt_banner,
                    'status_banner' => $status_banner
                );
    
                $id = $this->bannerModel->addBanner($dadosBanner);
    
                if ($id) {
                    $_SESSION['mensagem'] = 'Banner adicionado com sucesso';
                    $_SESSION['tipo-msg'] = 'sucesso';
                    header('Location: http://localhost/sistema-pqmarisa/public/banner/bannerListar');
                    exit;
                } else {
                    $dados['erro'] = 'Erro ao salvar banner no banco de dados.';
                    $dados['tipo-msg'] = 'erro';
                }
            } else {
                $dados['erro'] = 'Todos os campos devem ser preenchidos.';
                $dados['tipo-msg'] = 'erro';
            }
        }
    
        $dados['conteudo'] = 'admin/banner/adicionar';
        $this->carregarViews('admin/index', $dados);
    }
    
    // Função para salvar arquivos
    public function uploadBannerFile($file, $nome, $tipo) {
        $dir = 'assets/img/Banner/';
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nome_sanitizado = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '-', $nome)));
        $novoNome = uniqid() . '-' . $tipo . '-' . $nome_sanitizado . '.' . $ext;
    
        if (move_uploaded_file($file['tmp_name'], $dir . $novoNome)) {
            return 'assets/img/Banner/' . $novoNome;
        }
    
        return false;
    }

    public function editar($id_banner) {
    $dados = array();
    $dados['banner'] = $this->bannerListar->buscarPorId($id_banner);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome_banner = filter_input(INPUT_POST, 'nome_banner', FILTER_SANITIZE_SPECIAL_CHARS);
        $alt_banner = filter_input(INPUT_POST, 'alt_banner', FILTER_SANITIZE_SPECIAL_CHARS);
        $status_banner = filter_input(INPUT_POST, 'status_banner', FILTER_SANITIZE_SPECIAL_CHARS);

        $fotoPath = $dados['banner']['foto_banner'];
        $gifPath = $dados['banner']['video_banner'];

        // Upload da imagem fixa
        if (isset($_FILES['foto_banner']) && $_FILES['foto_banner']['error'] === 0) {
            $fotoPath = $this->uploadBannerFile($_FILES['foto_banner'], $nome_banner, 'img');
        }

        // Upload do GIF/vídeo
        if (isset($_FILES['video_banner']) && $_FILES['video_banner']['error'] === 0) {
            $gifPath = $this->uploadBannerFile($_FILES['video_banner'], $nome_banner, 'gif, mp4');
        }

        if ($nome_banner && $fotoPath && $gifPath) {
            $dadosBanner = array(
                'id_banner' => $id_banner,
                'nome_banner' => $nome_banner,
                'foto_banner' => $fotoPath,
                'video_banner' => $gifPath,
                'alt_banner'  => $alt_banner,
                'status_banner' => $status_banner
            );

            if ($this->bannerListar->editarBanner($dadosBanner)) {
                $_SESSION['mensagem'] = 'Banner editado com sucesso';
                $_SESSION['tipo-msg'] = 'sucesso';
                header('Location: http://localhost/sistema-pqmarisa/public/banner/bannerListar');
                exit;
            } else {
                $dados['erro'] = 'Erro ao atualizar banner no banco de dados.';
                $dados['tipo-msg'] = 'erro';
            }
        } else {
            $dados['erro'] = 'Todos os campos devem ser preenchidos.';
            $dados['tipo-msg'] = 'erro';
        }
    }

    $dados['conteudo'] = 'admin/banner/editar';
    $this->carregarViews('admin/index', $dados);
}
    
    
    



}



    
