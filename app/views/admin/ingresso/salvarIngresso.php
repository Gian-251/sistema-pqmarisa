<?php 
session_start();
require_once('../../../../config/config.php');
require_once('../../../app/controllers/salvar_ingresso.php');
die("a");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_SESSION['cliente']['id'];
    $qtde_compra = $_POST['quantidade'];
    $valor_unit = 10.00;
    $valor_total = $_POST['valor_total'];
    $status = 'pendente';
    $data_compra = date('Y-m-d H:i:s');
    $qtde_pendente=0;

    $db = Config::getConexao();

    salvarIngresso($db,$id_cliente, $qtde_compra, $qtde_pendente, 
    $valor_unit, $valor_total, $status, $data_compra ); 


}