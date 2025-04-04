<?php
class Banner extends Model {
    public function getTodosBanners() {
        try {
            $sql = "SELECT * FROM tbl_banner ORDER BY status_banner ASC"; // Ordena pelo status do banner
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Erro ao buscar banners: " . $e->getMessage());
            return [];
        }
    }
<<<<<<< HEAD
    public function adicionarBanner($dados) {
        $sql = "INSERT INTO tbl_banner 
                (nome_banner, foto_banner, video_banner, alt_banner, status_banner) 
                VALUES 
                (:nome_banner, :foto_banner, :video_banner, :alt_banner, :status_banner)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_banner', $dados['nome_banner']);
        $stmt->bindValue(':foto_banner', $dados['foto_banner']);
        $stmt->bindValue(':video_banner', $dados['video_banner']);
        $stmt->bindValue(':alt_banner', $dados['alt_banner']);
        $stmt->bindValue(':status_banner', $dados['status_banner']);

        return $stmt->execute();
    }

    // Editar um banner existente
    public function editarBanner($dados) {
        $sql = "UPDATE tbl_banner SET 
                    nome_banner = :nome_banner,
                    foto_banner = :foto_banner,
                    video_banner = :video_banner,
                    alt_banner = :alt_banner,
                    status_banner = :status_banner
                WHERE id_banner = :id_banner";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_banner', $dados['nome_banner']);
        $stmt->bindValue(':foto_banner', $dados['foto_banner']);
        $stmt->bindValue(':video_banner', $dados['video_banner']);
        $stmt->bindValue(':alt_banner', $dados['alt_banner']);
        $stmt->bindValue(':status_banner', $dados['status_banner']);
        $stmt->bindValue(':id_banner', $dados['id_banner'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Excluir banner por ID
    public function excluirBanner($id_banner) {
        $sql = "DELETE FROM tbl_banner WHERE id_banner = :id_banner";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_banner', $id_banner, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Buscar banner por ID
    public function buscarPorId($id_banner) {
        $sql = "SELECT * FROM tbl_banner WHERE id_banner = :id_banner";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_banner', $id_banner, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
=======
>>>>>>> aee1b6cfbdb45a40d627b4b6f474c4106c84f650
}
