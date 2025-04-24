<?php
    include '../MODEL/user.php';
    $user = new User();

    if($_SERVER ['REQUEST_METHOD']=== 'POST'){
        if(isset($_POST['add'])){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $adress = $_POST['address'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $status = $_POST['status'];

            $result_add = $user->addUser($fname, $lname, $adress, $email, $username, $password, $status);

        if($result_add){
            echo '<script>alert("Successfully Added User!")</script>';
            header ("location: ../VIEW/list_user.php");
            exit();
        }else{
            echo '<script>alert("Unsuccessfully Added User")</script>';
            header ("location: ../VIEW/list_user.php");
            exit();
        }
        
    }     
        }else if($_SERVER ['REQUEST_METHOD']=== 'GET' && isset($_GET['delete'])){
        $get_id = $_GET['delete'];

        $result = $user->deleteUser( $get_id );
    

        if($result){
            echo '<script>alert("DELETE Successfully!")</script>';
            header ("location: ../VIEW/list_user.php");
            exit();
        }else {
            echo '<script>alert("DELETE Unsuccessfully!")</script>';
            header("location: ../VIEW/list_user.php");
        }
    }
?>