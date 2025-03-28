<?php
class Servico extends Model {
    public function getTodosServicos() {
        try {
            $sql = "SELECT * FROM tbl_servico ORDER BY status_servico ASC"; // Ordena por nome em ordem alfabética
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar servico: " . $e->getMessage());
            return [];
        }
    }

}
