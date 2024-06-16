<?php
include 'db_conn.php';
include('authentication_cus.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once("PHPMailer-master/src/PHPMailer.php");
require_once("PHPMailer-master/src/SMTP.php");
require_once("PHPMailer-master/src/Exception.php");

function send_mail($conn, $userid, $issuetype, $description, $priority, $phoneNo, $email) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'techub.ticketing.system@gmail.com';
    $mail->Password = 'cqng ranj lzjd jtaa';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $subject = "New Ticket Available";
    $message = "<h4 style='display: inline;'>Customer ID: </h4> $userid<br>
                <h4 style='display: inline;'>Issue Type: </h4> $issuetype<br>
                <h4 style='display: inline;'>Description: </h4> $description<br>
                <h4 style='display: inline;'>Priority: </h4> $priority<br>
                <h4 style='display: inline;'>Customer Contact: </h4> $phoneNo<br>
                <h4 style='display: inline;'>Customer Email: </h4> $email<br>
                <br>
                <a href='http://localhost/e19-co227-TecHub-help-desk-ticketing-system/TecHub/engineer-ticket-accept.php'>View Ticket</a>";

    $mail->setFrom('techub.ticketing.system@gmail.com');
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->IsHTML(true);

    $to_email_query = "SELECT Email FROM admin WHERE Role='Engineer'";
    $to_email_query_run = mysqli_query($conn, $to_email_query);

    while ($row = mysqli_fetch_assoc($to_email_query_run)) {
        $recipientEmail = $row["Email"];
        $mail->addAddress($recipientEmail);

        if (!$mail->send()) {
            echo json_encode(['success' => false, 'message' => "Error sending email to: " . $recipientEmail]);
            exit;
        }

        $mail->clearAddresses();
    }
}

date_default_timezone_set('Asia/Kolkata');
$userid = $_SESSION['auth_user']['userid'];
$email = $_POST["email"];
$issuetype = $_POST["repairment"];
$phoneNo = $_POST["telephone"];
$priority = isset($_POST["prioritylevel"]) && $_POST["prioritylevel"] == "1" ? 1 : 0;
$description = $_POST["description"];
$openDate = date("Y-m-d H:i:s");
$closedDate = null;
$status = "Pending";

if (mysqli_connect_errno()) {
    die(json_encode(['success' => false, 'message' => "Connection error: " . mysqli_connect_error()]));
}

$sql = "INSERT INTO ticket (OpenDateTime, ClosedDateTime, TStatus, TPriority, ticketDes, customerEmail, IssueType, Telephone, CustomerId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    die(json_encode(['success' => false, 'message' => mysqli_error($conn)]));
}
mysqli_stmt_bind_param($stmt, "sssissssi", $openDate, $closedDate, $status, $priority, $description, $email, $issuetype, $phoneNo, $userid);

if (mysqli_stmt_execute($stmt)) {
    mysqli_commit($conn);
    send_mail($conn, $userid, $issuetype, $description, $priority, $phoneNo, $email);
    echo json_encode(['success' => true, 'message' => "Record saved successfully."]);
} else {
    mysqli_rollback($conn);
    echo json_encode(['success' => false, 'message' => "Error: " . mysqli_stmt_error($stmt)]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
