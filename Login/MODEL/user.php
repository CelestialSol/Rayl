<?php
require_once 'database.php';
class User{

    private $conn;
    
    public function __construct(){
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllUser(){
        $sql = "SELECT * FROM tbl_users";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

   public function login($username, $password): bool {
    $sql = "SELECT * FROM tbl_users 
    WHERE username = ? AND password = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
    
    public function getUserId($username, $password): mixed {
        $sql = "SELECT user_id FROM tbl_users 
        WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['user_id'];
    }

    public function getUserById($user_id): mixed {
        $sql = "SELECT * FROM tbl_users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addUser($username, $password){
        $sql = "INSERT INTO tbl_users (username, password) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $username, $password);
        return $stmt -> execute();
    }
    public function editUser($user_id, $username, $password){
        $sql = "UPDATE tbl_users SET username = ?, password = ? WHERE user_id = ?";
        $result = $this->conn->prepare($sql);
        $result->bind_param('ssi', $username, $password, $user_id);
        return $result->execute();
    }
    
    public function deleteUser($user_id){
        $sql = "DELETE FROM tbl_users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $user_id);
        
        if (!$stmt->execute()) {
            die("Error deleting user: " . $stmt->error);
        }    
        return true;
    }
    
}

?>