<?php
// index.php - Landing page for the authentication system

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
} else {

    header("Location: login.php");
    exit;
}
?>
