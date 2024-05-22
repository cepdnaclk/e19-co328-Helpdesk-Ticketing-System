<?php
    include 'db_conn.php';
    include 'send-email-invoice-accept.php';
    include 'send-email-invoice-reject.php';
  
    if (isset($_POST['ticketId'])) {
        $ticketID = $_POST['ticketId'];
    } else {
        echo 'Error fetching ID';
        exit(); // Exit the script if ticketId is not set
    }
    if (isset($_POST['invoiceId'])) {
        $invoiceId = $_POST['invoiceId'];
        $details = $_POST['InvoiceDes'];
        $amounts = $_POST['Amount'];
        $cusEmail = $_POST['cusEmail'];

    } else {
        echo 'Error fetching ID';
        exit(); // Exit the script if invoiceId is not set
    }
    if (isset($_POST['toID'])) {
        $toID = $_POST['toID'];
    } else {
        echo 'Error fetching ID';
        exit(); // Exit the script if invoiceId is not set
    }

    if(isset($_POST['accept'])){
        $Tstatus= 'Due payment';
        $Istatus = 'Accepted';
        // First, update the ticket
        $sql = "UPDATE ticket SET TStatus=? WHERE TicketId=?";
        $stmt = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            die(mysqli_error($conn));
        }
        mysqli_stmt_bind_param($stmt, "si", $Tstatus, $ticketID);
        if (!mysqli_stmt_execute($stmt)) {
            mysqli_rollback($conn);
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    
        // Then, update the invoice
        $sql1 = "UPDATE invoice SET InvoiceStatus=? WHERE InvoiceId=?";
        $stmt1 = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt1, $sql1)) {
            die(mysqli_error($conn));
        }
        var_dump($Istatus, $invoiceId);
        mysqli_stmt_bind_param($stmt1, "si", $Istatus, $invoiceId);
        if (mysqli_stmt_execute($stmt1)) {
            mysqli_commit($conn);
            send_mail_invoice_accept($conn,$invoiceId,$toID,$details,$amounts,$cusEmail);
            header("Location: Dire_InvForm.php");
            exit(); // Exit the script after redirecting
        } else {
            mysqli_rollback($conn);
            echo "Error: " . mysqli_stmt_error($stmt1);
        }
    
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt1);
        mysqli_close($conn);
    }
    

    if (isset($_POST['reject'])) {
        $tstatus = 'In Progress';
        $istatus = 'rejected';
        
    
        // First, update the invoice status
        $sql1 = "UPDATE invoice SET InvoiceStatus=? WHERE InvoiceId=?";
        $stmt1 = mysqli_stmt_init($conn);
    
        if (!mysqli_stmt_prepare($stmt1, $sql1)) {
            die(mysqli_error($conn));
        }
    
        mysqli_stmt_bind_param($stmt1, "si", $istatus, $invoiceId);
        if (mysqli_stmt_execute($stmt1)) {
            mysqli_stmt_close($stmt1); // Close the statement after execution
            
            $invoiceId = null;
            // Now, update the ticket
            $sql = "UPDATE ticket SET TStatus=?, InvoiceId=? WHERE TicketId=?";
            $stmt = mysqli_stmt_init($conn);
    
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                die(mysqli_error($conn));
            }
    
            mysqli_stmt_bind_param($stmt, "sii", $tstatus, $invoiceId, $ticketID);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_commit($conn);
                send_mail_invoice_reject($conn,$invoiceId,$toID,$details,$amounts);
                header("Location: Dire_InvForm.php");
                exit(); // Exit the script after redirecting
            } else {
                mysqli_rollback($conn);
                echo "Error: " . mysqli_stmt_error($stmt);
            }
    
            mysqli_stmt_close($stmt); // Close the statement after execution
        } else {
            mysqli_rollback($conn);
            echo "Error: " . mysqli_stmt_error($stmt1);
        }
    
        mysqli_close($conn);
    }
    
    


?>
