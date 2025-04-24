<?php

class Usuario extends Model {

    public function getClientePorId($id) {
        $sql = "SELECT * FROM clientes WHERE id_cliente = " . $this->db->quote($id);
        $result = $this->db->query($sql);
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public function getIngressoPorCliente($idCliente) {
        $sql = "SELECT * FROM ingressos WHERE id_cliente = " . $this->db->quote($idCliente) . " ORDER BY data_compra DESC LIMIT 1";
        $result = $this->db->query($sql);
        return $result->fetch(PDO::FETCH_OBJ);
    }

    public function cadastrarCliente($dados) {
        // Hash da senha
        $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO clientes (nome, email, telefone, senha, data_cadastro) 
                VALUES (" . 
                $this->db->quote($dados['nome']) . ", " . 
                $this->db->quote($dados['email']) . ", " . 
                $this->db->quote($dados['telefone']) . ", " . 
                $this->db->quote($senha_hash) . ", " . 
                "NOW())";
        
        if($this->db->query($sql)) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function login($email, $senha) {
        $sql = "SELECT * FROM clientes WHERE email = " . $this->db->quote($email);
        $result = $this->db->query($sql);
        $row = $result->fetch(PDO::FETCH_OBJ);
        
        if($row) {
            $senha_hash = $row->senha;
            if(password_verify($senha, $senha_hash)) {
                return $row;
            }
        }
        
        return false;
    }

    public function atualizarCliente($dados) {
        $sql = "UPDATE clientes SET 
                nome = " . $this->db->quote($dados['nome']) . ", 
                email = " . $this->db->quote($dados['email']) . ", 
                telefone = " . $this->db->quote($dados['telefone']) . " 
                WHERE id_cliente = " . $this->db->quote($dados['id_cliente']);
        
        if($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function atualizarSenha($id_cliente, $senha) {
        // Hash da senha
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "UPDATE clientes SET senha = " . $this->db->quote($senha_hash) . 
               " WHERE id_cliente = " . $this->db->quote($id_cliente);
        
        if($this->db->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function verificarEmail($email) {
        $sql = "SELECT * FROM clientes WHERE email = " . $this->db->quote($email);
        $result = $this->db->query($sql);
        
        // Se encontrou algum registro, o email já existe
        if($result->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getIngressosCliente($idCliente) {
        $sql = "SELECT i.*, t.nome as tipo_ingresso 
                FROM ingressos i 
                JOIN tipos_ingresso t ON i.id_tipo_ingresso = t.id_tipo_ingresso 
                WHERE i.id_cliente = " . $this->db->quote($idCliente) . " 
                ORDER BY i.data_compra DESC";
        
        $result = $this->db->query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTiposIngresso() {
        $sql = "SELECT * FROM tipos_ingresso WHERE ativo = 1";
        $result = $this->db->query($sql);
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function comprarIngresso($dados) {
        $sql = "INSERT INTO ingressos 
                (id_cliente, id_tipo_ingresso, quantidade, valor_total, data_compra, data_validade) 
                VALUES (" . 
                $this->db->quote($dados['id_cliente']) . ", " . 
                $this->db->quote($dados['id_tipo_ingresso']) . ", " . 
                $this->db->quote($dados['quantidade']) . ", " . 
                $this->db->quote($dados['valor_total']) . ", " . 
                "NOW(), " . 
                $this->db->quote($dados['data_validade']) . ")";
        
        if($this->db->query($sql)) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function excluirCliente($id_cliente) {
        // Primeiro exclui os ingressos relacionados
        $sql1 = "DELETE FROM ingressos WHERE id_cliente = " . $this->db->quote($id_cliente);
        $this->db->query($sql1);
        
        // Depois exclui o cliente
        $sql2 = "DELETE FROM clientes WHERE id_cliente = " . $this->db->quote($id_cliente);
        
        if($this->db->query($sql2)) {
            return true;
        } else {
            return false;
        }
    }
}
