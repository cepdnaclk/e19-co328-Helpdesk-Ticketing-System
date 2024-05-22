<?php
session_start();

unset($_SESSION['authenticated_customer']);
unset($_SESSION['authenticated_to']);
unset($_SESSION['authenticated_admin']);
unset($_SESSION['authenticated_director']);
unset($_SESSION['authenticated_engineer']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You logged out successfully";
header("Location: sign-in.php");
exit(0);

?>