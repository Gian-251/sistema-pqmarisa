<?php

class Login extends Model{
        public function verificarAgente($email, $senha): mixed
        {
            $sql = "SELECT * FROM tbl_agente WHERE email_agente = :email AND senha_agente = :senha AND status_agente = 'ATIVO'";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(param: ':email', value: $email);
            $stmt->bindValue(param: ':senha', value: $senha);
            $stmt->execute();
    
            return $stmt->fetch(mode: PDO::FETCH_ASSOC);
        }
    
        public function verificarCliente($email, $senha): mixed
        {
            $sql = "SELECT * FROM tbl_cliente WHERE email_cliente = :email AND senha_cliente = :senha";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(param: ':email', value: $email);
            $stmt->bindValue(param: ':senha', value: $senha);
            $stmt->execute();
    
            return $stmt->fetch(mode: PDO::FETCH_ASSOC);
        }
}