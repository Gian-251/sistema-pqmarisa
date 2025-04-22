<?php

class AtracoesController extends Controller
{
    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'atracoes - Marisa Parque Itaquera';

        $brinquedoModel = new Brinquedo();
        
        $dados['brinquedos'] = $brinquedoModel->brinquedosAtivo(); // ou getBrinquedosRadicais(), se tiver

        $dados['conteudo'] = 'atracoes'; // sua view específica



        $this->carregarViews('atracoes', $dados);



        //var_dump("chegeui a Sobrecontroller");
    }
}
