<?php
session_start();
require_once __DIR__ . '/../MODEL/user.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($user->login($username, $password)) {
            $_SESSION['user_id'] = $user->getUserId($username, $password);
            header('location: ../VIEW/home.php');
            exit();
        } else {
            header('location: ../index.php?error=Invalid username or password');
            exit();
        }
    }
}
?>
