<?php
session_start();

if (isset($_GET['name']) && isset($_GET['role'])) {
    $_SESSION['name'] = $_GET['name'];
    $_SESSION['role'] = $_GET['role'];
    header('Location: dashboard.php');
    exit();
} else {
    header('Location: login.php');
    exit();
}
?>
