<?php
class Banner extends Model {
    public function getTodosBanners() {
        try {
            $sql = "SELECT * FROM tbl_banner ORDER BY status_banner ASC"; // Ordena pelo status do banner
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar banners: " . $e->getMessage());
            return [];
        }
    }
}
