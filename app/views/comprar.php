<?php
session_start();
if (!isset($_SESSION["id_cliente"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_SESSION["id_cliente"];
    $id_brinquedo = $_POST["id_brinquedo"];
    $qtde = $_POST["qtde"];
    $valor_unitario = $_POST["valor"];

    $valor_total = $qtde * $valor_unitario;

    $conn = new mysqli("smpsistema.com.br", "u283879542_marisa", "@MarisaPxLab12", "u283879542_marisa");

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $sql = "INSERT INTO tbl_ingresso (id_cliente, qtde_compra_ingresso, valor_unit_ingresso, valor_total_ingresso, data_compra_ingresso, status_ingresso)
            VALUES (?, ?, ?, ?, NOW(), 'Pendente')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiid", $id_cliente, $qtde, $valor_unitario, $valor_total);
    if ($stmt->execute()) {
        echo "Compra realizada com sucesso!";
    } else {
        echo "Erro na compra!";
    }

    $stmt->close();
    $conn->close();
}
?>
