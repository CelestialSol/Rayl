<?php
require_once 'database.php';

class User {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Fetch all users
    public function getAllUser() {
        $sql = "SELECT user_id, fname, lname, email, address, username, status, date_created FROM tbl_users";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // User login validation (no changes needed)
    public function login($username, $password): bool {
        $sql = "SELECT * FROM tbl_users WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    
    // Fetch user ID based on credentials
    public function getUserId($username, $password): mixed {
        $sql = "SELECT user_id FROM tbl_users WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['user_id'] ?? null;
    }

    // Fetch user details by ID
    public function getUserById($user_id): mixed {
        $sql = "SELECT user_id, fname, lname, email, address, username, status, date_created FROM tbl_users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Add a new user with extended details
    public function addUser($fname, $lname, $email, $address, $username, $password, $status){
        $sql = "INSERT INTO tbl_users (fname, lname, email, address, username, password, status, date_created) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssi', $fname, $lname, $email, $address, $username, $password, $status);
        return $stmt->execute();
    }

    // Edit user details
    public function editUser($user_id, $fname, $lname, $email, $address, $username, $password, $status){
        $sql = "UPDATE tbl_users SET fname = ?, lname = ?, email = ?, address = ?, username = ?, password = ?, status = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssii', $fname, $lname, $email, $address, $username, $password, $status, $user_id);
        return $stmt->execute();
    }

    // Delete a user
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
