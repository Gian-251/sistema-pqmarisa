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
                        status_brinquedo = :status_brinquedo,
                        genero_brinquedo = :genero_brinquedo,
                        informacao_brinquedo = :informacao_brinquedo
                    WHERE id_brinquedo = :id_brinquedo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome_brinquedo', $dados['nome_brinquedo']);
            $stmt->bindParam(':hora_parque_brinquedo', $dados['hora_parque_brinquedo']);
            $stmt->bindParam(':capacidade_brinquedo', $dados['capacidade_brinquedo']);
            $stmt->bindParam(':alt_brinquedo', $dados['alt_brinquedo']);
            $stmt->bindParam(':foto_brinquedo', $dados['foto_brinquedo']);
            $stmt->bindParam(':duracao_brinquedo', $dados['duracao_brinquedo']);
            $stmt->bindParam(':status_brinquedo', $dados['status_brinquedo']);
            $stmt->bindParam(':genero_brinquedo', $dados['genero_brinquedo']);
            $stmt->bindParam(':informacao_brinquedo', $dados['informacao_brinquedo']);
            $stmt->bindParam(':id_brinquedo', $dados['id_brinquedo']);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao atualizar brinquedo: " . $e->getMessage());
            return false;
        }
    }
    public function adicionarBrinquedo($dados) {
        try {
            $sql = "INSERT INTO tbl_brinquedo (nome_brinquedo, hora_parque_brinquedo, capacidade_brinquedo, alt_brinquedo, foto_brinquedo, duracao_brinquedo, status_brinquedo,                        genero_brinquedo = :genero_brinquedo,
                        informacao_brinquedo, informacao_brinquedo;) 
                    VALUES (:nome_brinquedo, :hora_parque_brinquedo, :capacidade_brinquedo, :alt_brinquedo, :foto_brinquedo, :duracao_brinquedo, :status_brinquedo, :informacao_brinquedo, :informacao_brinquedo;)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nome_brinquedo', $dados['nome_brinquedo']);
            $stmt->bindParam(':hora_parque_brinquedo', $dados['hora_parque_brinquedo']);
            $stmt->bindParam(':capacidade_brinquedo', $dados['capacidade_brinquedo']);
            $stmt->bindParam(':alt_brinquedo', $dados['alt_brinquedo']);
            $stmt->bindParam(':foto_brinquedo', $dados['foto_brinquedo']);
            $stmt->bindParam(':duracao_brinquedo', $dados['duracao_brinquedo']);
            $stmt->bindParam(':status_brinquedo', $dados['status_brinquedo']);
            $stmt->bindParam(':genero_brinquedo', $dados['genero_brinquedo']);
            $stmt->bindParam(':informacao_brinquedo', $dados['informacao_brinquedo']);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao adicionar brinquedo: " . $e->getMessage());
            return false;
        }
    }

    public function addBrinquedo($dados) {
        $sql = "INSERT INTO tbl_brinquedo 
                (nome_brinquedo, hora_parque_brinquedo, capacidade_brinquedo, alt_brinquedo, foto_brinquedo, duracao_brinquedo, status_brinquedo, genero_brinquedo, informacao_brinquedo)
                VALUES (:nome, :hora, :capacidade, :alt, :foto, :duracao, :status, :genero, :info)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome_brinquedo'],
            ':hora' => $dados['hora_parque_brinquedo'],
            ':capacidade' => $dados['capacidade_brinquedo'],
            ':alt' => $dados['alt_brinquedo'],
            ':foto' => $dados['foto_brinquedo'],
            ':duracao' => $dados['duracao_brinquedo'],
            ':status' => $dados['status_brinquedo'],
            ':genero' => $dados['genero_brinquedo'],
            ':info' => $dados['informacao_brinquedo']
        ]);
        return $this->db->lastInsertId();
    }

    public function updateBrinquedo($id, $dados) {
        $sql = "UPDATE tbl_brinquedo SET
                nome_brinquedo = :nome,
                hora_parque_brinquedo = :hora,
                capacidade_brinquedo = :capacidade,
                alt_brinquedo = :alt,
                foto_brinquedo = :foto,
                duracao_brinquedo = :duracao,
                status_brinquedo = :status,
                genero_brinquedo = :genero,
                informacao_brinquedo = :info
                WHERE id_brinquedo = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nome' => $dados['nome_brinquedo'],
            ':hora' => $dados['hora_parque_brinquedo'],
            ':capacidade' => $dados['capacidade_brinquedo'],
            ':alt' => $dados['alt_brinquedo'],
            ':foto' => $dados['foto_brinquedo'],
            ':duracao' => $dados['duracao_brinquedo'],
            ':status' => $dados['status_brinquedo'],
            ':genero' => $dados['genero_brinquedo'],
            ':info' => $dados['informacao_brinquedo'],
            ':id' => $id
        ]);
    }

    public function getBrinquedoById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tbl_brinquedo WHERE id_brinquedo = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



}


    

