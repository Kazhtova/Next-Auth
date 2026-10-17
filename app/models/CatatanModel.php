<?php
class CatatanModel {
    private $conn;
    
    private $table_name = "catatan";
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT c.*, k.nama_kategori, a.username AS nama_admin FROM " . $this->table_name . " c LEFT JOIN kategori k ON c.id_kategori = k.id_kategori JOIN admin a ON c.id_admin = a.id_admin ORDER BY c.id_admin DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($judul, $isi, $id_kategori, $id_admin) {
        $query = "INSERT INTO " . $this->table_name . " (judul, isi, id_kategori, id_admin) VALUES (:judul, :isi, :id_kategori, :id_admin)";
        $stmt = $this->conn->prepare($query);
        
        $judul = htmlspecialchars(strip_tags($judul));
        $isi = htmlspecialchars(strip_tags($isi));
        
        $id_kategori = !empty($id_kategori) ? $id_kategori : NULL;

        $stmt->bindParam(":judul", $judul);
        $stmt->bindParam(":isi", $isi);
        $stmt->bindParam(":id_kategori", $id_kategori);
        $stmt->bindParam(":id_admin", $id_admin);

        return $stmt->execute();
    }
    
    public function getById($id_catatan){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_catatan = :id_catatan";
        $stmt =  $this->conn->prepare($query);
        $stmt->bindParam(":id_catatan", $id_catatan);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_catatan, $judul, $isi, $id_kategori) {
        $query = "UPDATE " . $this->table_name . " SET judul = :judul, isi = :isi, id_kategori = :id_kategori WHERE id_catatan = :id_catatan";
        $stmt = $this->conn->prepare($query);

        $judul = htmlspecialchars($judul);
        $isi = htmlspecialchars($isi);
        $id_kategori = !empty($id_kategori) ? $id_kategori : NULL;

        $stmt->bindParam(":judul", $judul);
        $stmt->bindParam(":isi", $isi);
        $stmt->bindParam(":id_kategori", $id_kategori);
        $stmt->bindParam(":id_catatan", $id_catatan);

        return $stmt->execute();
    }

    public function delete($id_catatan) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_catatan = :id_catatan";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_catatan", $id_catatan);
        $stmt->execute();
    }
    
    public function searchcatatan($keyword){
        $query = "SELECT c.*, k.nama_kategori 
                FROM ". $this->table_name ." c LEFT JOIN kategori k ON c.id_kategori = k.id_kategori 
                WHERE k.nama_kategori LIKE :keyword 
                OR c.judul LIKE :keyword 
                OR c.isi LIKE :keyword
                ORDER BY c.id_catatan DESC";
              
        $stmt = $this->conn->prepare($query);

        $search_keyword = "%{$keyword}%";
        $stmt->bindParam(":keyword", $search_keyword);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function jumlahDataCatatan(){
    $query = "SELECT COUNT(*) AS total FROM ".$this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}