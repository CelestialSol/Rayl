<?php
require_once __DIR__ . '/../MODEL/user.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result_add = $user->addUser($username, $password);

        if ($result_add) {
            echo '<script>alert("Successfully Added User!")</script>';
            header("location: ../VIEW/list_user.php");
            exit();
        } else {
            echo '<script>alert("Failed to Add User!")</script>';
            header("location: ../VIEW/list_user.php");
            exit();
        }
    }

    if (isset($_POST['edit'])) {
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $result_edit = $user->editUser($user_id, $username, $password);

        if ($result_edit) {
            echo '<script>alert("User Updated Successfully!")</script>';
            header("location: ../VIEW/list_user.php");
            exit();
        } else {
            echo '<script>alert("Failed to Update User!")</script>';
            header("location: ../VIEW/list_user.php");
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    $result_delete = $user->deleteUser($user_id);

    if ($result_delete) {
        echo '<script>alert("User Deleted Successfully!")</script>';
        header("location: ../VIEW/list_user.php");
        exit();
    } else {
        echo '<script>alert("Failed to Delete User!")</script>';
        header("location: ../VIEW/list_user.php");
        exit();
    }
}
?>
