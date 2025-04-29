<?php
class Ingresso extends Model
{

    // Método para buscar todos os ingressos com nome do cliente
    public function getTodosIngressos()
    {
        try {
            // Realizando o JOIN entre tbl_ingresso e tbl_cliente para pegar o nome do cliente
            $sql = "SELECT i.*, c.nome_cliente 
                    FROM tbl_ingresso i 
                    JOIN tbl_cliente c ON i.id_cliente = c.id_cliente 
                    ORDER BY i.data_compra_ingresso DESC"; // Ordena por data de compra
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar ingressos: " . $e->getMessage());
            return [];
        }
    }

    public function getServicosAtivos()
    {
        $sql = "SELECT * FROM tbl_servico WHERE status_servico = 'ATIVO'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getIngressoByClienteId($id_cliente)
    {
        $sql = "SELECT * FROM tbl_ingresso WHERE id_cliente = :id_cliente LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function salvarIngresso(
        $id_cliente,
        $qtde_compra,
        $qtde_pendente,
        $valor_unit,
        $valor_total,
        $status
    ) {
        $sql = "INSERT INTO tbl_ingresso (
            id_cliente, 
            qtde_compra_ingresso, 
            qtde_pendente_ingresso, 
            valor_unit_ingresso, 
            valor_total_ingresso, 
            status_ingresso, 
            data_compra_ingresso,
            cod_qr_ingresso,
            foto_qr_ingresso,
            alt_qr_ingresso
        ) VALUES (
            :id_cliente,
            :qtde_compra, 
            :qtde_pendente, 
            :valor_unit,
            :valor_total,
            :tatus,

        )";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindValue(':qtde_compra', $qtde_compra, PDO::PARAM_INT);
        $stmt->bindValue(':qtde_pendente', $qtde_pendente, PDO::PARAM_INT);
        $stmt->bindValue(':valor_unit', $valor_unit);
        $stmt->bindValue(':valor_total', $valor_total);
        $stmt->bindValue(':tatus', $status);
    
        if ($stmt->execute()) {
            $lastId = $this->db->lastInsertId();
            echo json_encode(['success' => true, 'id_ingresso' => $lastId]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->errorInfo()[2]]);
        }
        exit();
    }
}    