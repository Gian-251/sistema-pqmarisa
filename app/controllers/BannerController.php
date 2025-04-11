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
    
    
    public function uploadBannerImagem($file, $nome, $tipo = 'foto') {
        $dir = 'assets/img/Banner/';
    
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $novoNome = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '-', $nome)));
    
        // Prefixo para diferenciar os arquivos
        $prefixo = ($tipo === 'gif') ? 'gif_' : ($tipo === 'foto' ? 'foto_' : 'mp4_');
    
        $nomeFinal = uniqid($prefixo) . '-' . $novoNome . '.' . $ext;
    
        if (move_uploaded_file($file['tmp_name'], $dir . $nomeFinal)) {
            return 'banner/' . $nomeFinal; // Ex: banner/gif_nome.gif
        }
    
        return false;
    }    

    public function editar($id)
{
    $bannerListar = new Banner();
    $dadosBanner = $bannerListar->buscarPorId($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome_banner'] ?? '';
        $alt = $_POST['alt_banner'] ?? '';
        $status = $_POST['status_banner'] ?? 'Inativo';

        // Caminhos de destino
        $pasta = 'assets/img/Banner/';
        $fotoAntiga = $dadosBanner['foto_banner'];
        $videoAntigo = $dadosBanner['video_banner'];

        // Upload da imagem fixa
        $fotoBanner = $fotoAntiga;
        if (isset($_FILES['foto_banner']) && $_FILES['foto_banner']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['foto_banner']['name'], PATHINFO_EXTENSION);
            $novoNomeFoto = uniqid() . '.' . $ext;
            $destinoFoto = $pasta . $novoNomeFoto;

            if (move_uploaded_file($_FILES['foto_banner']['tmp_name'], __DIR__ . "/../../public/" . $destinoFoto)) {
                // Deleta imagem antiga se necessário
                if ($fotoAntiga && file_exists(__DIR__ . "/../../public/" . $fotoAntiga)) {
                    unlink(__DIR__ . "/../../public/" . $fotoAntiga);
                }
                $fotoBanner = $destinoFoto;
            }
        }

        // Upload do GIF ou vídeo
        $videoBanner = $videoAntigo;
        if (isset($_FILES['video_banner']) && $_FILES['video_banner']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['video_banner']['name'], PATHINFO_EXTENSION);
            $novoNomeVideo = uniqid() . '.' . $ext;
            $destinoVideo = $pasta . $novoNomeVideo;

            if (move_uploaded_file($_FILES['video_banner']['tmp_name'], __DIR__ . "/../../public/" . $destinoVideo)) {
                // Deleta vídeo antigo se necessário
                if ($videoAntigo && file_exists(__DIR__ . "/../../public/" . $videoAntigo)) {
                    unlink(__DIR__ . "/../../public/" . $videoAntigo);
                }
                $videoBanner = $destinoVideo;
            }
        }

        // Dados atualizados
        $dadosAtualizados = [
            'nome_banner' => $nome,
            'alt_banner' => $alt,
            'status_banner' => $status,
            'foto_banner' => $fotoBanner,
            'video_banner' => $videoBanner,
        ];

        if ($bannerListar->editarBanner($id, $dadosAtualizados)) {
            header("Location: http://localhost/sistema-pqmarisa/public/banner/bannerlistar");
            exit;
        } else {
            echo "Erro ao atualizar o banner.";
        }
    }



}



    
}
