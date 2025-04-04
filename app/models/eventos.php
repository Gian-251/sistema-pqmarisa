<?php
class Eventos extends Model {
    public function getTodosEventos() {
        try {
            $sql = "SELECT * FROM tbl_eventos ORDER BY nome_eventos ASC"; 
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar eventos: " . $e->getMessage());
            return [];
        }
    }
}
