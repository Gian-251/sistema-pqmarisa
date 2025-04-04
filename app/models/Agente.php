<?php
class Agente extends Model {
    public function getTodosAgentes() {
        try {
            $sql = "SELECT * FROM tbl_agente ORDER BY status_agente ASC"; // Ordena por nome em ordem alfabética
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar agentes: " . $e->getMessage());
            return [];
        }
    }


    // Método para buscar todos os 
    public function addAgente($dados) {
        $sql = "INSERT INTO tbl_agente (
                    nome_agente, 
                    cpf_agente, 
                    rua_agente, 
                    cidade_agente, 
                    bairro_agente, 
                    data_nasc_agente, 
                    telefone_agente, 
                    senha_agente, 
                    email_agente, 
                    turno_agente, 
                    status_agente
                ) VALUES (
                    :nome_agente, 
                    :cpf_agente, 
                    :rua_agente, 
                    :cidade_agente, 
                    :bairro_agente, 
                    :data_nasc_agente, 
                    :telefone_agente, 
                    :senha_agente, 
                    :email_agente, 
                    :turno_agente, 
                    :status_agente
                )";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_agente', $dados['nome_agente']);
        $stmt->bindValue(':cpf_agente', $dados['cpf_agente']);
        $stmt->bindValue(':rua_agente', $dados['rua_agente']);
        $stmt->bindValue(':cidade_agente', $dados['cidade_agente']);
        $stmt->bindValue(':bairro_agente', $dados['bairro_agente']);
        $stmt->bindValue(':data_nasc_agente', $dados['data_nasc_agente']);
        $stmt->bindValue(':telefone_agente', $dados['telefone_agente']);
        $stmt->bindValue(':senha_agente', password_hash($dados['senha_agente'], PASSWORD_DEFAULT)); // Criptografia da senha
        $stmt->bindValue(':email_agente', $dados['email_agente']);
        $stmt->bindValue(':turno_agente', $dados['turno_agente']);
        $stmt->bindValue(':status_agente', $dados['status_agente']);
    
        return $stmt->execute();
    }

    public function getAgenteById($id) {
        try {
            $sql = "SELECT * FROM tbl_agente WHERE id_agente = :id_agente";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_agente', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar agente: " . $e->getMessage());
            return false;
        }
    }

    public function editarAgente($dados) {
        try {
            $sql = "UPDATE tbl_agente SET 
                        nome_agente = :nome_agente,
                        cpf_agente = :cpf_agente,
                        rua_agente = :rua_agente,
                        cidade_agente = :cidade_agente,
                        bairro_agente = :bairro_agente,
                        data_nasc_agente = :data_nasc_agente,
                        telefone_agente = :telefone_agente,
                        email_agente = :email_agente,
                        turno_agente = :turno_agente,
                        status_agente = :status_agente
                    WHERE id_agente = :id_agente";
                    
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome_agente', $dados['nome_agente']);
            $stmt->bindValue(':cpf_agente', $dados['cpf_agente']);
            $stmt->bindValue(':rua_agente', $dados['rua_agente']);
            $stmt->bindValue(':cidade_agente', $dados['cidade_agente']);
            $stmt->bindValue(':bairro_agente', $dados['bairro_agente']);
            $stmt->bindValue(':data_nasc_agente', $dados['data_nasc_agente']);
            $stmt->bindValue(':telefone_agente', $dados['telefone_agente']);
            $stmt->bindValue(':email_agente', $dados['email_agente']);
            $stmt->bindValue(':turno_agente', $dados['turno_agente']);
            $stmt->bindValue(':status_agente', $dados['status_agente']);
            $stmt->bindValue(':id_agente', $dados['id_agente'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao atualizar agente: " . $e->getMessage());
            return false;
        }

    

}
}
