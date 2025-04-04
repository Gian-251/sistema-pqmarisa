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

    public function editarCliente($dadosCliente) {
        try {
            $sql = "UPDATE tbl_cliente 
                    SET nome_cliente = :nome, cpf_cliente = :cpf, bairro_cliente = :bairro, 
                        cidade_cliente = :cidade, estado_cliente = :estado, 
                        data_nasc_cliente = :data_nasc, telefone_cliente = :telefone, 
                        email_cliente = :email";

            // Adiciona a senha à query apenas se ela for alterada
            if (!empty($dadosCliente['senha_cliente'])) {
                $sql .= ", senha_cliente = :senha";
            }

            $sql .= " WHERE id_cliente = :id";

            $stmt = $this->db->prepare($sql);

            // Bind dos parâmetros
            $stmt->bindValue(':id', $dadosCliente['id_cliente'], PDO::PARAM_INT);
            $stmt->bindValue(':nome', $dadosCliente['nome_cliente'], PDO::PARAM_STR);
            $stmt->bindValue(':cpf', $dadosCliente['cpf_cliente'], PDO::PARAM_STR);
            $stmt->bindValue(':bairro', $dadosCliente['bairro_cliente'], PDO::PARAM_STR);
            $stmt->bindValue(':cidade', $dadosCliente['cidade_cliente'], PDO::PARAM_STR);
            $stmt->bindValue(':estado', $dadosCliente['estado_cliente'], PDO::PARAM_STR);
            $stmt->bindValue(':data_nasc', $dadosCliente['data_nasc_cliente'], PDO::PARAM_STR);
            $stmt->bindValue(':telefone', $dadosCliente['telefone_cliente'], PDO::PARAM_STR);
            $stmt->bindValue(':email', $dadosCliente['email_cliente'], PDO::PARAM_STR);

            // Apenas vincula a senha se houver uma nova senha
            if (!empty($dadosCliente['senha_cliente'])) {
                $stmt->bindValue(':senha', $dadosCliente['senha_cliente'], PDO::PARAM_STR);
            }

            return $stmt->execute(); // Retorna true se a edição for bem-sucedida
        } catch (PDOException $e) {
            echo "Erro ao editar cliente: " . $e->getMessage();
            return false;
        }
    }

    public function getDadosCliente($id_cliente) {
        try {
            $sql = "SELECT * FROM tbl_cliente WHERE id_cliente = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id_cliente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao buscar cliente: " . $e->getMessage();
            return false;
        }
    }
    
        
    }
    
    
    
