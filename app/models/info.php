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

    public function cadastrarInfo($dados) {
        try {
            // Consulta para inserir uma nova informação
            $sql = "INSERT INTO tbl_info (nome_info, informacao_texto_info, status_info) VALUES (:nome_info, :informacao_texto_info, :status_info)";
            $stmt = $this->db->prepare($sql);
            
            // Bind dos parâmetros
            $stmt->bindParam(':nome_info', $dados['nome_info']);
            $stmt->bindParam(':informacao_texto_info', $dados['informacao_texto_info']);
            $stmt->bindParam(':status_info', $dados['status_info']);
            
            // Executa a consulta
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao cadastrar informação: " . $e->getMessage());
            return false;
        }
    }
    public function editarInfo($dados) {
        try {
            // Consulta para atualizar uma informação
            $sql = "UPDATE tbl_info SET nome_info = :nome_info, informacao_texto_info = :informacao_texto_info, status_info = :status_info WHERE id_info = :id_info";
            $stmt = $this->db->prepare($sql);

            // Bind dos parâmetros
            $stmt->bindParam(':nome_info', $dados['nome_info']);
            $stmt->bindParam(':informacao_texto_info', $dados['informacao_texto_info']);
            $stmt->bindParam(':status_info', $dados['status_info']);
            $stmt->bindParam(':id_info', $dados['id_info']);

            // Executa a consulta
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao editar informação: " . $e->getMessage());
            return false;
        }
        
    }

    public function getInfoById($id) {
        try {
            $sql = "SELECT * FROM tbl_info WHERE id_info = :id_info";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_info', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar informação: " . $e->getMessage());
            return null;
        }
    }

        public function buscarTodosAtivos()
    {
        $sql = "SELECT nome_info, informacao_texto_info FROM info WHERE status_info = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


}
