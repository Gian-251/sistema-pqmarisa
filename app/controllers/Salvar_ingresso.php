<?php
session_start();

function salvarIngresso($db,$id_cliente, $qtde_compra, $qtde_pendente, 
$valor_unit, $valor_total, $status, $data_compra ) {
    $sql = "INSERT INTO tbl_ingresso (id_cliente, qtde_compra_ingresso, qtde_pendente_ingresso, 
            valor_unit_ingresso, valor_total_ingresso, status_ingresso, data_compra_ingresso) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $db->prepare($sql);
    $stmt->bind_param("iiiddss", $id_cliente, $qtde_compra, $qtde_pendente, 
                      $valor_unit, $valor_total, $status, $data_compra);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    exit();
}