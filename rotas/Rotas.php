<?php

class Rotas{

    // Método inicializar todas as ROTAS (URLs) da aplicação
    public function executar(){


        $url = '/';

        //var_dump($url);

        // verifica se a variavel esta definida na $_GET
        if(isset($_GET['url'])){
            $url .= $_GET['url'];
            // /senac/ti26
            
        }

        //var_dump($url);


        //Definir uma variável para armazenar parametros
        $parametro = array();

        // Verfique se a URL não está vazia e nao é só uma /
        if(!empty($url) && $url != '/'){

            // Controlador (Controller)
            // Ação (Método)
            // Informação Unica(Parametro)

            $url = explode('/',$url);

            array_shift($url); //Remover a primeira posição da ARRAY


            $controladorAtual = ucfirst($url[0]) . 'Controller';

            array_shift($url); 

            if(isset($url[0]) && !empty($url)){
                $acaoAtual = $url[0];
                //var_dump('Nome da ação atual: ' . $acaoAtual);
                array_shift($url);
            }else{
                $acaoAtual = 'index';
                
                // var_dump('Nome da ação atual: ' . $acaoAtual);
            }

            // Os parametros
            // count - Conta todos os elementos de um array ou de um objeto
            if(count($url) > 0){
                //var_dump(count($url));
                $parametro = $url;
            }
        }else{
            $controladorAtual = 'HomeController';
            $acaoAtual = 'index';
            //var_dump($controladorAtual);
            //var_dump($acaoAtual);
        }

        //Verificar se o arquivo do CONTROLLER e a AÇÃO (método) existe 
        if(!file_exists('../app/controllers/'.$controladorAtual.'.php')|| 
        !method_exists($controladorAtual, $acaoAtual)){
            
            
           // var_dump('Não existe!' . $controladorAtual);
           //var_dump('Não existe o método: ', $acaoAtual );

            // Se não existir definir o Controller e um Método padrão 
            $controladorAtual = 'ErroController';
            $acaoAtual = 'index';


        }
        
        $controller = new $controladorAtual();
        

        call_user_func_array(array($controller, $acaoAtual), $parametro);



        



    }



}