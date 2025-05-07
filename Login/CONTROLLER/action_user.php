<?php
require_once __DIR__ . '/../MODEL/user.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Capture all new fields
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $active = isset($_POST['active']) ? $_POST['active'] : 1; // Default active status

        // Attempt to add user
        $result_add = $user->addUser($fname, $lname, $email, $address, $username, $password, $active);

        if ($result_add) {
            echo '<script>alert("Successfully Added User!")</script>';
            echo '<script>window.location.href="../VIEW/list_user.php";</script>';
            exit();
        } else {
            echo '<script>alert("Failed to Add User!")</script>';
            echo '<script>window.location.href="../VIEW/list_user.php";</script>';
            exit();
        }
    }

    if (isset($_POST['edit'])) {
        $user_id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $active = isset($_POST['active']) ? $_POST['active'] : 1;

        // Attempt to update user
        $result_edit = $user->editUser($user_id, $fname, $lname, $email, $address, $username, $password, $active);

        if ($result_edit) {
            echo '<script>alert("User Updated Successfully!")</script>';
            echo '<script>window.location.href="../VIEW/list_user.php";</script>';
            exit();
        } else {
            echo '<script>alert("Failed to Update User!")</script>';
            echo '<script>window.location.href="../VIEW/list_user.php";</script>';
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    // Attempt to delete user
    $result_delete = $user->deleteUser($user_id);

    if ($result_delete) {
        echo '<script>alert("User Deleted Successfully!")</script>';
        echo '<script>window.location.href="../VIEW/list_user.php";</script>';
        exit();
    } else {
        echo '<script>alert("Failed to Delete User!")</script>';
        echo '<script>window.location.href="../VIEW/list_user.php";</script>';
        exit();
    }
}
?>
