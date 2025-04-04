<?php
class Brinquedo extends Model {
    public function getTodosBrinquedos() {
        try {
            $sql = "SELECT * FROM tbl_brinquedo ORDER BY nome_brinquedo ASC"; 
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar brinquedos: " . $e->getMessage());
            return [];
        }
    }
<<<<<<< HEAD


    
=======
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
}
