<?php
    include 'db_conn.php';
    include('authentication_cus.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once("PHPMailer-master/src/PHPMailer.php");
    require_once("PHPMailer-master/src/SMTP.php");
    require_once("PHPMailer-master/src/Exception.php");

    function send_mail($conn,$userid, $issuetype, $description, $priority, $phoneNo, $email){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'techub.ticketing.system@gmail.com';
        $mail->Password = 'cqng ranj lzjd jtaa';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $subject = "New Ticket Available";
        $message = "<h4 style='display: inline;'>Customer ID      : </h3> $userid<br>
                    <h4 style='display: inline;'>Issue Type       : </h4> $issuetype<br>
                    <h4 style='display: inline;'>Description      : </h4> $description<br>
                    <h4 style='display: inline;'>Priority         : </h4> $priority<br>
                    <h4 style='display: inline;'>Customer Contact : </h4> $phoneNo<br>
                    <h4 style='display: inline;'>Customer Email   : </h4> $email<br>
                    <br>
                    <a href='http://localhost/e19-co227-TecHub-help-desk-ticketing-system/TecHub/engineer-ticket-accept.php'>View Ticket</a>";


        $mail->setFrom('techub.ticketing.system@gmail.com');
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->IsHTML(true);

        $to_email_query = "SELECT Email FROM admin WHERE Role='Engineer'";
        $to_email_query_run = mysqli_query($conn, $to_email_query);

        // $recipientEmail = "pasindurangana1@gmail.com";
        //     $mail->addAddress($recipientEmail);

        //     // Send the email
        //     if (!$mail->send()) {
        //         echo "Error sending email to: " . $recipientEmail . "<br>";
        //     } else {
        //         echo "Email sent to: " . $recipientEmail . "<br>";
        //     }


        while ($row = mysqli_fetch_assoc($to_email_query_run)) {
            $recipientEmail = $row["Email"];
            $mail->addAddress($recipientEmail);

            // Send the email
            if (!$mail->send()) {
                echo "Error sending email to: " . $recipientEmail . "<br>";
            } else {
                echo "Email sent to: " . $recipientEmail . "<br>";
            }

            // Clear addresses for the next email
            $mail->clearAddresses();
        }
    }

    date_default_timezone_set('Asia/Kolkata');

    $userid= $_SESSION['auth_user']['userid'];
    $email = $_POST["email"];
    $issuetype = $_POST["repairment"];
    $phoneNo = $_POST["telephone"];
    
    if (isset($_POST["prioritylevel"]) && $_POST["prioritylevel"] == "1") {
        $priority = 1; // Set priority to 1 when checked
    } else {
        $priority = 0; // Set priority to 0 when not checked or not provided
    }
    
    $description = $_POST["description"];
    $openDate = date("Y-m-d H:i:s");
    $closedDate = null;
    $status= "Pending";

    if(mysqli_connect_errno()){
        die("connection error: ".mysqli_connect_error());
    }

    $sql = "INSERT INTO ticket (OpenDateTime, ClosedDateTime,TStatus,TPriority, ticketDes, customerEmail, IssueType, Telephone,CustomerId)
    
    VALUES(?,?,?,?,?,?,?,?,?)
    ";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        die(mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt,"sssissssi",
    $openDate,
    $closedDate,
    $status,
    $priority,
    $description,
    $email,
    $issuetype,
    $phoneNo,
    $userid    
);
if (mysqli_stmt_execute($stmt)) {
    // Commit the transaction
    mysqli_commit($conn);
    send_mail($conn,"$userid", "$issuetype", "$description", "$priority", "$phoneNo", "$email");
    echo "Record saved successfully.";
    // header("Location: send-email.php");
    header("Location: customer-home.php");
} else {
    // Rollback the transaction if there's an error
    mysqli_rollback($conn);
    echo "Error: " . mysqli_stmt_error($stmt);
}

// Close the prepared statement and the database connection
mysqli_stmt_close($stmt);


mysqli_close($conn);
?>