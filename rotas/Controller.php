<?php

class Controller{
    public function carregarViews($views, $dados = array())
    {
        extract($dados);
        require_once '../app/views/'.$views.'.php';
                    //app/views/admin/index Está puxando a view
        
        
 
 
 
        
    }


}