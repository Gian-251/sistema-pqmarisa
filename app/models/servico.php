<?php
class Servico extends Model {

    public function getTodosServicos() {
        try {
            $sql = "SELECT * FROM tbl_servico ORDER BY status_servico ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar serviços: " . $e->getMessage());
            return [];
        }
    }

    public function getDadosServicos($id){
        $sql = "SELECT * FROM tbl_servico WHERE id_servico = :id";
        $sql = "SELECT s.*, c.nome_brinquedo
        FROM tbl_servico s
        INNER JOIN tbl_brinquedo c ON s.id_brinquedo = c.id_brinquedo
        WHERE s.id_servico = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function editarServico($dados) {
        $sql = "UPDATE tbl_servico SET 
                    nome_servico = :nome_servico, 
                    descricao_servico = :descricao_servico, 
                    valor_servico = :valor_servico, 
                    foto_servico = :foto_servico, 
                    alt_servico = :alt_servico, 
                    id_brinquedo = :id_brinquedo, 
                    status_servico = :status_servico
                WHERE id_servico = :id_servico";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_servico', $dados['nome_servico']);
        $stmt->bindValue(':descricao_servico', $dados['descricao_servico']);
        $stmt->bindValue(':valor_servico', $dados['valor_servico']);
        $stmt->bindValue(':foto_servico', $dados['foto_servico']);
        $stmt->bindValue(':alt_servico', $dados['alt_servico']);
        $stmt->bindValue(':id_brinquedo', $dados['id_brinquedo']);
        $stmt->bindValue(':status_servico', $dados['status_servico']);
        $stmt->bindValue(':id_servico', $dados['id_servico'], PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    
    public function desativarServico($id){
        $sql = "UPDATE tbl_servico SET status_servico = 'Inativo' WHERE id_servico = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
