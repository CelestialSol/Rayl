<?php
require_once 'database.php';
class User{

    private $conn;
    
    public function __construct(){
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllUser(){
        $sql = "SELECT * FROM tbl_user";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($user_id){
        $sql = "SELECT * FROM tbl_user WHERE user_id = ?";
        $query = $this->conn->prepare($sql);
        $query->bind_param('i', $user_id) ;
        $query->execute() ;
        $result = $query->get_result();
        return $result->fetch_assoc();
    }
    
    public function addUser($fname,$lname,$email,$address,$username,$password,$status){
        $sql = "INSERT INTO tbl_user SET fname = ?, lname = ?, email = ?, address = ?, 
        username = ?, password = ?, active = ?, date_created =  NOW()";
        $result = $this -> conn -> prepare($sql);
        $result -> bind_param('ssssssi', $fname,$lname,$email,$address,$username,$password,$status);
        return $result -> execute();
    }

    public function editUser($fname,$lname,$email,$address,$username,$password,$status){
        $sql = "UPDATE tbl_user SET fname = ?, lname = ?, email = ?, address = ?, 
        username = ?, password = ?, active = ?, WHERE user_id = ?";
        $result = $this -> conn -> prepare($sql);
        $result -> bind_param('ssssssii', $fname,$lname,$email,$address,$username,$password,$status, $user_id);
        return $result -> execute();
    }

    public function deleteUser($user_id){
        $sql = "DELETE FROM tbl_user WHERE user_id = ?";
        $query = $this->conn->prepare($sql);
        $query->bind_param('i', $user_id) ;
        return $query->execute() ;
    }

   
}
?>