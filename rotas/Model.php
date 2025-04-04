<?php

class Model{

    protected $db;

    public function __construct() 
    {
        try{
            //Criar conexão com o banco de dados
            
            $this->db = new PDO("mysql:host=smpsistema.com.br; dbname=u283879542_marisa", "u283879542_marisa", "@MarisaPxLab12");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Erro ao conectar com o banco de dados: ".$e->getMessage();
        }
    }



}