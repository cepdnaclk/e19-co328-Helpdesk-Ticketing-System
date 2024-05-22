<?php 
include('db_conn.php');
session_start();

if (isset($_POST['reg-btn'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $regno = validate($_POST['regno']);
    $tel = validate($_POST['tel']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $confpass = validate($_POST['confpass']);

    // Email and Registration number exist or not, password matching  
    $check_email_query = "SELECT Email FROM customer WHERE Email = '$email'";
    $check_regno_query = "SELECT RegNo FROM customer WHERE RegNo = '$regno'";

    $check_email_query_run = mysqli_query($conn, $check_email_query);
    $check_regno_query_run = mysqli_query($conn, $check_regno_query);

    if (mysqli_num_rows($check_regno_query_run) > 0) {
        $_SESSION['status'] = "Registation Number already exists";
        header("Location: sign-up.php");
    }
    else if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['status'] = "Email Address already exists";
        header("Location: sign-up.php");
    }
    else if ($password != $confpass) {
        $_SESSION['status'] = "Passwords do not match";
        header("Location: sign-up.php");
    }
    else {
        // encoding the password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        //inserting data into the table
        $query = "INSERT INTO customer (CustomerName, Email, ContactNo, RegNo, CustPassword) VALUES ('$name','$email','$tel','$regno','$hash')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            $_SESSION['authenticated_customer'] = TRUE;

            $cus_login_query = "SELECT * FROM customer WHERE Email='$email'";
            $cus_login_query_run = mysqli_query($conn, $cus_login_query);
            $row = mysqli_fetch_array($cus_login_query_run);
            $_SESSION['auth_user'] = [
                'username' => $name,
                'email' => $email,
                'userid' => $row['CustomerID'],
                'password' => $password
            ];

            $_SESSION['status'] = "Register Successful!";
            header("Location: customer-home.php");
            exit(0);
        }
        else {
            $_SESSION['status'] = "Registration failed!";
            header("Location: sign-up.php");
        }
    }
}

?>