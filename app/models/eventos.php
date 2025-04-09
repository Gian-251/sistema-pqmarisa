<?php
class Eventos extends Model {
    public function getTodosEventos() {
        try {
            $sql = "SELECT * FROM tbl_eventos ORDER BY nome_eventos ASC"; 
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar eventos: " . $e->getMessage());
            return [];
        }
    }

    public function cadastrar($dados)
    {
        try {
            // Validação básica
            if (
                empty($dados['nome_eventos']) ||
                empty($dados['data_inicio_eventos']) ||
                empty($dados['data_fim_eventos']) ||
                empty($dados['alt_eventos']) ||
                empty($dados['status_eventos']) ||
                empty($dados['foto_eventos']) // Certifique-se de enviar o nome do arquivo
            ) {
                throw new Exception("Todos os campos obrigatórios devem ser preenchidos.");
            }

            // Inserção no banco de dados
            $sql = "INSERT INTO tbl_eventos 
                    (nome_eventos, foto_eventos, data_inicio_eventos, data_fim_eventos, alt_eventos, status_eventos)
                    VALUES (:nome, :foto, :data_inicio, :data_fim, :alt, :status)";
            
            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':nome' => $dados['nome_eventos'],
                ':foto' => $dados['foto_eventos'],
                ':data_inicio' => $dados['data_inicio_eventos'],
                ':data_fim' => $dados['data_fim_eventos'],
                ':alt' => $dados['alt_eventos'],
                ':status' => $dados['status_eventos']
            ]);

            // Retorna o ID do evento cadastrado
            return $this->db->lastInsertId();

        } catch (\PDOException $e) {
            error_log("Erro ao cadastrar evento: " . $e->getMessage());
            throw new Exception("Erro ao cadastrar evento. Tente novamente.");
        }
    }

    public function getEventoPorId($id) {
        try {
            $sql = "SELECT * FROM tbl_eventos WHERE id_eventos = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar evento: " . $e->getMessage());
            return false;
        }
    }

    public function editarEventos($dados) {
        try {
            $sql = "UPDATE tbl_eventos SET 
                    nome_eventos = :nome,
                    foto_eventos = :foto,
                    data_inicio_eventos = :data_inicio,
                    data_fim_eventos = :data_fim,
                    alt_eventos = :alt,
                    status_eventos = :status
                    WHERE id_eventos = :id";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome', $dados['nome_eventos']);
            $stmt->bindValue(':foto', $dados['foto_eventos']);
            $stmt->bindValue(':data_inicio', $dados['data_inicio_eventos']);
            $stmt->bindValue(':data_fim', $dados['data_fim_eventos']);
            $stmt->bindValue(':alt', $dados['alt_eventos']);
            $stmt->bindValue(':status', $dados['status_eventos']);
            $stmt->bindValue(':id', $dados['id_eventos']);
            
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao atualizar evento: " . $e->getMessage());
            return false;
        }
    }

    public function deletarEvento($id) {
        try {
            $sql = "DELETE FROM tbl_eventos WHERE id_eventos = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            return $stmt->execute();
        } catch (\PDOException $e) {
            error_log("Erro ao deletar evento: " . $e->getMessage());
            return false;
        }
    }
    public function getEventosGifAleatorios($limite = 3) {
        $sql = "SELECT * FROM tbl_eventos WHERE status_eventos = 'ativo' ORDER BY RAND() LIMIT :limite";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function todosEventos() {
        $sql = "SELECT * FROM tbl_eventos 
                WHERE status_eventos = 'ativo' 
                ORDER BY RAND()";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }   



}
