<?php

class Cliente extends Model {
    // Método para buscar todos os clientes
    public function getTodosClientes() {
        try {
            $sql = "SELECT * FROM tbl_cliente ORDER BY nome_cliente ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar clientes: " . $e->getMessage());
            return [];
        }
    }

    // Método para cadastrar um novo cliente
    public function cadastrar($dados) {
        try {
            // Validação dos dados
            if (empty($dados['nome_cliente']) || empty($dados['cpf_cliente']) || empty($dados['email_cliente']) || empty($dados['senha_cliente'])) {
                throw new Exception("Todos os campos obrigatórios devem ser preenchidos.");
            }

            // Verifica se o CPF já está cadastrado
            if ($this->cpfExiste($dados['cpf_cliente'])) {
                throw new Exception("CPF já cadastrado.");
            }

            // Verifica se o e-mail já está cadastrado
            if ($this->emailExiste($dados['email_cliente'])) {
                throw new Exception("E-mail já cadastrado.");
            }

            // Hash da senha
            $senhaHash = password_hash($dados['senha_cliente'], PASSWORD_DEFAULT);

            // Prepara a query de inserção
            $sql = "INSERT INTO tbl_cliente (nome_cliente, cpf_cliente, bairro_cliente, estado_cliente, cidade_cliente, data_nasc_cliente, telefone_cliente, email_cliente, senha_cliente) 
                    VALUES (:nome, :cpf, :bairro, :estado, :cidade, :data_nasc, :telefone, :email, :senha)";
            
            $stmt = $this->db->prepare($sql);

            // Executa a query com os dados
            $stmt->execute([
                ':nome' => $dados['nome_cliente'],
                ':cpf' => $dados['cpf_cliente'],
                ':bairro' => $dados['bairro_cliente'],
                ':estado' => $dados['estado_cliente'],
                ':cidade' => $dados['cidade_cliente'],
                ':data_nasc' => $dados['data_nasc_cliente'],
                ':telefone' => $dados['telefone_cliente'],
                ':email' => $dados['email_cliente'],
                ':senha' => $senhaHash
            ]);

            // Retorna o ID do cliente cadastrado
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Erro ao cadastrar cliente: " . $e->getMessage());
            throw new Exception("Erro ao cadastrar cliente. Tente novamente.");
        }
    }

    // Método para verificar se um CPF já está cadastrado
    private function cpfExiste($cpf) {
        $sql = "SELECT id_cliente FROM tbl_cliente WHERE cpf_cliente = :cpf";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':cpf' => $cpf]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    // Método para verificar se um e-mail já está cadastrado
    private function emailExiste($email) {
        $sql = "SELECT id_cliente FROM tbl_cliente WHERE email_cliente = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    
    
}