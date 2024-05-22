<?php 
session_start();

if (!isset($_SESSION['authenticated_customer'])) {
    $_SESSION['status'] = "Please login to continue";
    unset($_SESSION['authenticated_to']);
    unset($_SESSION['authenticated_admin']);
    unset($_SESSION['authenticated_director']);
    unset($_SESSION['authenticated_engineer']);
    header("Location: sign-in.php");
    exit(0);
}
?>