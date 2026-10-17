<?php
class KategoriModel {
  private $conn;
  private $table_name = "kategori";

  public function __construct($db) {
    $this->conn = $db;
  }

  public function getAll() {
    $query = "SELECT kategori.*, admin.username AS nama_admin FROM ".$this->table_name ." JOIN admin ON kategori.id_admin = admin.id_admin ORDER BY kategori.id_kategori DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id_kategori){
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_kategori = :id_kategori";
        $stmt =  $this->conn->prepare($query);
        $stmt->bindParam(":id_kategori", $id_kategori);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  public function cekKategoriAda($nama_kategori) {
    $query = "SELECT id_kategori FROM ".$this->table_name ." WHERE nama_kategori = :nama LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));
    $stmt->bindParam(":nama", $nama_kategori);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    }
    return false;
  }

  public function create($nama_kategori, $admin_id){
    $query = "INSERT INTO " .$this->table_name ." (nama_kategori, id_admin) VALUES (:nama, :id_admin)";
    $stmt = $this->conn->prepare($query);

    $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));

    $stmt->bindParam(":nama", $nama_kategori);
    $stmt->bindParam(":id_admin", $admin_id);

    return $stmt->execute();
  }  
  

  public function edit($id_kategori) {
    $query = "SELECT kategori.*, admin.username AS nama_admin FROM ".$this->table_name ." JOIN admin ON kategori.id_admin = admin.id_admin WHERE id_kategori = :id_kategori";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id_kategori", $id_kategori);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function editkategori($nama_kategori, $id_kategori){
    $query = "UPDATE ".$this->table_name ." SET nama_kategori = :nama_kategori WHERE id_kategori = :id_kategori";  
    $stmt = $this->conn->prepare($query);

    $nama_kategori = htmlspecialchars(strip_tags($nama_kategori));
    
    $stmt->bindParam(":nama_kategori", $nama_kategori);
    $stmt->bindParam(":id_kategori", $id_kategori);

    return $stmt->execute();
  }

  public function hapus($id_kategori){
    $query = "DELETE FROM " .$this->table_name ." WHERE id_kategori = :id_kategori";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":id_kategori", $id_kategori);

    return $stmt->execute();
  }
  public function jumlahDataKategori(){
    $query = "SELECT COUNT(*) AS total FROM ".$this->table_name;
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function searchkategori($keyword){
        $query = "SELECT kategori.*, admin.username AS nama_admin FROM ".$this->table_name ." JOIN admin ON kategori.id_admin = admin.id_admin 
        WHERE kategori.nama_kategori LIKE :keyword 
        OR admin.username LIKE :keyword
        ORDER BY kategori.id_kategori DESC";
        
        $stmt = $this->conn->prepare($query);

        $search_keyword = "%{$keyword}%";
        $stmt->bindParam(":keyword", $search_keyword);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

}