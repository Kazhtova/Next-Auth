<?php 

class AdminModel{
    private $conn;

    private $table_name = "admin";

    public function __construct($db){
        $this->conn = $db;
    }

    public function register($username, $password){
        $query = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashed_password);

        if ($stmt->execute()){
            return true;
        }
        return false;
    }

    public function login($username, $password){
        $query = "SELECT id_admin, username, password FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $row['password'])) {
                return $row;
            }
        }
        return false;
    }
}

?>