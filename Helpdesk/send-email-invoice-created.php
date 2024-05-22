<?php
    include 'db_conn.php';
    include('authentication_to.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once("PHPMailer-master/src/PHPMailer.php");
    require_once("PHPMailer-master/src/SMTP.php");
    require_once("PHPMailer-master/src/Exception.php");

    function send_mail_invoice($conn,$userid, $cusID, $ticketID, $issuetype, $description, $detail, $amount){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'techub.ticketing.system@gmail.com';
        $mail->Password = 'cqng ranj lzjd jtaa';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $subject = "New Invoice Available";
        $message = "<h4 style='display: inline;'>Technical Officer ID : </h4> $userid<br>
                    <h4 style='display: inline;'>Customer ID          : </h3> $cusID<br>
                    <h4 style='display: inline;'>Ticket ID            : </h3> $ticketID<br>
                    <h4 style='display: inline;'>Issue Type           : </h4> $issuetype<br>
                    <h4 style='display: inline;'>Description          : </h4> $description<br>
                    <h4 style='display: inline;'>Invoice Details      : </h4> $detail<br>
                    <h4 style='display: inline;'>Invoiced Amount      : </h4> $amount LKR<br>
                    <br>
                    <a href='http://localhost/e19-co227-TecHub-help-desk-ticketing-system/TecHub/Dire_InvForm.php'>View Invoice</a>";


        $mail->setFrom('techub.ticketing.system@gmail.com');
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->IsHTML(true);

        $director_email_query = "SELECT Email FROM admin WHERE Role = 'Director'";
        $director_email_query_run = mysqli_query($conn, $director_email_query);

        // $recipientEmail = "pasindurangana1@gmail.com";
        //     $mail->addAddress($recipientEmail);

        //     // Send the email
        //     if (!$mail->send()) {
        //         echo "Error sending email to: " . $recipientEmail . "<br>";
        //     } else {
        //         echo "Email sent to: " . $recipientEmail . "<br>";
        //     }


        while ($row = mysqli_fetch_assoc($director_email_query_run)) {
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