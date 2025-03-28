<?php
class Info extends Model {

    // Método para buscar todas as informações
    public function getTodasInfos() {
        try {
            // Consulta para selecionar todas as informações ordenadas por nome
            $sql = "SELECT * FROM tbl_info ORDER BY nome_info ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar informações: " . $e->getMessage());
            return [];
        }
    }
}
