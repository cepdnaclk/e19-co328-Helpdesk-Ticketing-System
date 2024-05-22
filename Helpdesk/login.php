<?php 
include('db_conn.php');
session_start();

if(isset($_POST['sign-btn'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    $cus_login_query = "SELECT * FROM customer WHERE Email='$email'";
    $cus_login_query_run = mysqli_query($conn, $cus_login_query);

    $to_login_query = "SELECT * FROM techofficer WHERE Email='$email'";
    $to_login_query_run = mysqli_query($conn, $to_login_query);

    $admin_login_query = "SELECT * FROM admin WHERE Email='$email'";
    $admin_login_query_run = mysqli_query($conn, $admin_login_query);

    if (mysqli_num_rows($cus_login_query_run) > 0) {
        $row = mysqli_fetch_array($cus_login_query_run);

        if (password_verify($pass, $row['CustPassword'])) {
            $_SESSION['authenticated_customer'] = TRUE;
            $_SESSION['auth_user'] = [
                'username' => $row['CustomerName'],
                'userid' => $row['CustomerID'],
                'email' => $row['Email'],
                'password' => $row['CustPassword']
            ];
            $_SESSION['status'] = "Login Successful!";
            header("Location: customer-home.php");
            exit(0);
        }
        else {
            $_SESSION['status'] = "Password is incorrect";
            header("Location: sign-in.php");
            exit(0);
        }
    }
    else if (mysqli_num_rows($to_login_query_run) > 0){
        $row = mysqli_fetch_array($to_login_query_run);

        if (password_verify($pass, $row['TOPassword']) || $pass == $row['TOPassword']) {
            $_SESSION['authenticated_to'] = TRUE;
            $_SESSION['auth_user'] = [
                'username' => $row['TechOfficerName'],
                'userid' => $row['TechOfficerID'],
                'email' => $row['Email'],
                'password' => $row['TOPassword']
            ];
            $_SESSION['status'] = "Login Successful!";
            header("Location: to-home.php");
            exit(0);
        }
        else {
            $_SESSION['status'] = "Password is incorrect";
            header("Location: sign-in.php");
            exit(0);
        }
    }
    else if (mysqli_num_rows($admin_login_query_run) > 0){
        $row = mysqli_fetch_array($admin_login_query_run);

        if (password_verify($pass, $row['AdminPassword']) || $pass == $row['AdminPassword'] && $row['Role'] == 'Admin') {
            $_SESSION['authenticated_admin'] = TRUE;
            $_SESSION['auth_user'] = [
                'username' => $row['AdminName'],
                'userid' => $row['AdminID'],
                'email' => $row['Email'],
                'password' => $row['AdminPassword']
            ];
            $_SESSION['status'] = "Login Successful!";
            header("Location: admin-home.php");
            exit(0);
        }
        if (password_verify($pass, $row['AdminPassword']) || $pass == $row['AdminPassword'] && $row['Role'] == 'Admin') {
            $_SESSION['authenticated_admin'] = TRUE;
            $_SESSION['auth_user'] = [
                'username' => $row['AdminName'],
                'userid' => $row['AdminID'],
                'email' => $row['Email'],
                'password' => $row['AdminPassword']
            ];
            $_SESSION['status'] = "Login Successful!";
            header("Location: admin-home.php");
            exit(0);
        }
        else if (password_verify($pass, $row['AdminPassword']) || $pass == $row['AdminPassword'] && $row['Role'] == 'Engineer') {
            $_SESSION['authenticated_engineer'] = TRUE;
            $_SESSION['auth_user'] = [
                'username' => $row['AdminName'],
                'userid' => $row['AdminID'],
                'email' => $row['Email'],
                'password' => $row['AdminPassword']
            ];
            $_SESSION['status'] = "Login Successful!";
            header("Location: engineer-home.php");
            exit(0);
        }
        else if (password_verify($pass, $row['AdminPassword']) || $pass == $row['AdminPassword'] && $row['Role'] == 'Director') {
            $_SESSION['authenticated_director'] = TRUE;
            $_SESSION['auth_user'] = [
                'username' => $row['AdminName'],
                'userid' => $row['AdminID'],
                'email' => $row['Email'],
                'password' => $row['AdminPassword']
            ];
            $_SESSION['status'] = "Login Successful!";
            header("Location: director-home.php");
            exit(0);
        }

        else {
            $_SESSION['status'] = "Password is incorrect";
            header("Location: sign-in.php");
            exit(0);
        }
    }
    else {
        $_SESSION['status'] = "Email address not found";
        header("Location: sign-in.php");
        exit(0);
    }
    
}

else {
    header("Location: sign-in.php");
    exit(0);
}
?>