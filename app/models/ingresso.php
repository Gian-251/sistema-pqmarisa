<?php
class Ingresso extends Model {

    // Método para buscar todos os ingressos com nome do cliente
    public function getTodosIngressos() {
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
}