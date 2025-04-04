<?php

class Letreiros extends Model {
    // Método para buscar todos os itens do letreiro
    public function getTodosLetreiros() {
        try {
            $sql = "SELECT * FROM tbl_letreiro ORDER BY id_letreiro ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar letreiros: " . $e->getMessage());
            return [];
        }
    }
    public function pegarLetreiro(){
        try {
            $sql = "SELECT texto_letreiro FROM tbl_letreiro WHERE status_letreiro = 'ATIVO' order by status_letreiro";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (\PDOException $e) {
        error_log("Erro ao buscar letreiros: " . $e->getMessage());
        return [];
    }
    }

    public function addLetreiro($dados) {
        $sql = "INSERT INTO tbl_letreiro (texto_letreiro, status_letreiro) 
                VALUES (:texto_letreiro, :status_letreiro)";
        
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindValue(':texto_letreiro', $dados['texto_letreiro']);
        $stmt->bindValue(':status_letreiro', $dados['status_letreiro']);
        
        return $stmt->execute();
    }
    public function editarLetreiro($id, $dados) {
        try {
            $sql = "UPDATE tbl_letreiro 
                    SET texto_letreiro = :texto_letreiro, 
                        status_letreiro = :status_letreiro 
                    WHERE id_letreiro = :id";
            
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindValue(':texto_letreiro', $dados['texto_letreiro']);
            $stmt->bindValue(':status_letreiro', $dados['status_letreiro']);
            $stmt->bindValue(':id', $id);
            
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao editar letreiro: " . $e->getMessage());
            return false;
        }
    }
    
    // Método para excluir um letreiro
    public function excluirLetreiro($id) {
        try {
            $sql = "DELETE FROM tbl_letreiro WHERE id_letreiro = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao excluir letreiro: " . $e->getMessage());
            return false;
        }
    }
    public function getLetreiroPorId($id) {
        try {
            $sql = "SELECT * FROM tbl_letreiro WHERE id_letreiro = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar letreiro por ID: " . $e->getMessage());
            return false;
        }
    }
}