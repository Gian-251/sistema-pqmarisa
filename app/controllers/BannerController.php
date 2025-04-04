<?php   

class BannerController extends Controller{

    private $bannerListar;

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
}
