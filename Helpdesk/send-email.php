<?php 
include 'db_conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once("PHPMailer-master/src/PHPMailer.php");
require_once("PHPMailer-master/src/SMTP.php");
require_once("PHPMailer-master/src/Exception.php");
// require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'techub.ticketing.system@gmail.com';
$mail->Password = 'TecHub@1234';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$subject = "New Ticket Available";
$message = "hello bye";


$mail->setFrom('techub.ticketing.system@gmail.com');
$mail->Subject = $subject;
$mail->Body = $message;
$mail->IsHTML(true);

$to_email_query = "SELECT Email FROM techofficer";
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


// header("Location: customer-home.php");
?>