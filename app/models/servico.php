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

    public function adicionarServico($dados) {
        try {
            $sql = "INSERT INTO tbl_servico (
                nome_servico, 
                descricao_servico, 
                valor_servico, 
                foto_servico, 
                alt_servico, 
                id_brinquedo, 
                status_servico
            ) VALUES (
                :nome_servico, 
                :descricao_servico, 
                :valor_servico, 
                :foto_servico, 
                :alt_servico, 
                :id_brinquedo, 
                :status_servico
            )";
            
            $stmt = $this->db->prepare($sql);
            
            $stmt->bindValue(':nome_servico', $dados['nome_servico']);
            $stmt->bindValue(':descricao_servico', $dados['descricao_servico']);
            $stmt->bindValue(':valor_servico', $dados['valor_servico']);
            $stmt->bindValue(':foto_servico', $dados['foto_servico']);
            $stmt->bindValue(':alt_servico', $dados['alt_servico']);
            
            // Verifica se id_brinquedo é null
            if (empty($dados['id_brinquedo'])) {
                $stmt->bindValue(':id_brinquedo', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':id_brinquedo', $dados['id_brinquedo'], PDO::PARAM_INT);
            }
            
            $stmt->bindValue(':status_servico', $dados['status_servico']);
            
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao adicionar serviço: " . $e->getMessage());
            return false;
        }
    }

}
