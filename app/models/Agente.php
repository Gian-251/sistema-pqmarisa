<?php
class Agente extends Model {
    public function getTodosAgentes() {
        try {
            $sql = "SELECT * FROM tbl_agente ORDER BY status_agente ASC"; // Ordena por nome em ordem alfabética
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar agentes: " . $e->getMessage());
            return [];
        }
    }


    // Método para buscar todos os 


}
