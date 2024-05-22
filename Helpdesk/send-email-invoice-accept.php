<?php
    include 'db_conn.php';
    include('authentication_director.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once("PHPMailer-master/src/PHPMailer.php");
    require_once("PHPMailer-master/src/SMTP.php");
    require_once("PHPMailer-master/src/Exception.php");

    function send_mail_invoice_accept($conn, $invID, $toID, $detail, $amount, $cusEmail){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'techub.ticketing.system@gmail.com';
        $mail->Password = 'cqng ranj lzjd jtaa';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $subject1 = "Invoice Accpeted";
        $message1 = "<h4 style='display: inline;'>Invoice ID : </h4> $invID<br>
                    <h4 style='display: inline;'>Invoice Details      : </h4> $detail<br>
                    <h4 style='display: inline;'>Invoiced Amount      : </h4> $amount LKR<br>
                    <br>
                    <h4 style='display: inline; font-weight: normal;'>This invoice is approved by the director and will be sent to the customer for the payment.</h4>";


        $mail->setFrom('techub.ticketing.system@gmail.com');
        $mail->Subject = $subject1;
        $mail->Body = $message1;
        $mail->IsHTML(true);

        $to_email_query = "SELECT Email FROM techofficer WHERE TechOfficerID = '$toID'";
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

        $subject2 = "Your Repair is Compeleted";
        $message2 = "<h4 style='display: inline; font-weight: normal;'>Please find the invoice details for your repair below.</h4><br><br>
                    <h4 style='display: inline;'>Invoice ID : </h4> $invID<br>
                    <h4 style='display: inline;'>Invoice Details      : </h4> $detail<br>
                    <h4 style='display: inline;'>Invoiced Amount      : </h4> $amount LKR<br>
                    <br>
                    <h4 style='display: inline; font-weight: normal;'>Click the below link to complete your payment.</h4><br>
                    <a href='http://localhost/e19-co227-TecHub-help-desk-ticketing-system/TecHub/payment.php'>Pay Here</a>";

        $mail->setFrom('techub.ticketing.system@gmail.com');
        $mail->Subject = $subject2;
        $mail->Body = $message2;
        $mail->IsHTML(true);

        $mail->addAddress($cusEmail);

        // Send the email
        if (!$mail->send()) {
            echo "Error sending email to: " . $cusEmail . "<br>";
        } else {
            echo "Email sent to: " . $cusEmail . "<br>";
        }

        // Clear addresses for the next email
        $mail->clearAddresses();
    }