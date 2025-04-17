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



    public function getBrinquedoPorId($id) {
        try {
            $sql = "SELECT * FROM tbl_brinquedo WHERE id_brinquedo = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar brinquedo: " . $e->getMessage());
            return null;
        }
    }

    public function atualizarBrinquedo($dados) {
        try {
            $sql = "UPDATE tbl_brinquedo SET 
                        nome_brinquedo = :nome_brinquedo, 
                        hora_parque_brinquedo = :hora_parque_brinquedo, 
                        capacidade_brinquedo = :capacidade_brinquedo, 
                        alt_brinquedo = :alt_brinquedo, 
                        foto_brinquedo = :foto_brinquedo, 
                        duracao_brinquedo = :duracao_brinquedo, 
                        status_brinquedo = :status_brinquedo 
                    WHERE id_brinquedo = :id_brinquedo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome_brinquedo', $dados['nome_brinquedo']);
            $stmt->bindParam(':hora_parque_brinquedo', $dados['hora_parque_brinquedo']);
            $stmt->bindParam(':capacidade_brinquedo', $dados['capacidade_brinquedo']);
            $stmt->bindParam(':alt_brinquedo', $dados['alt_brinquedo']);
            $stmt->bindParam(':foto_brinquedo', $dados['foto_brinquedo']);
            $stmt->bindParam(':duracao_brinquedo', $dados['duracao_brinquedo']);
            $stmt->bindParam(':status_brinquedo', $dados['status_brinquedo']);
            $stmt->bindParam(':id_brinquedo', $dados['id_brinquedo']);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao atualizar brinquedo: " . $e->getMessage());
            return false;
        }
    }
}


    

