<?php
include 'db_conn.php';
include 'authentication_cus.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticketID = $_POST['ticketId'];
    $amount = $_POST['amount'];

    // Simulate payment process (this should be replaced with actual payment logic)
    $paymentSuccess = true; // Change this based on actual payment result

    if ($paymentSuccess) {
        // Fetch ticket details including ToId from the ticket table
        $sql = "SELECT TechOfficerId FROM ticket WHERE TicketId=?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $ticketID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $ToId);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        } else {
            die(mysqli_error($conn));
        }

        date_default_timezone_set('Asia/Kolkata');
        $status = 'Completed';
        $acceptTime = date("Y-m-d H:i:s");

        // Update ticket status and Tech Officer ID in the ticket table
        $updateSql = "UPDATE ticket SET TStatus=?, TechOfficerId=?, ClosedDateTime=? WHERE TicketId=?";
        $updateStmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($updateStmt, $updateSql)) {
            mysqli_stmt_bind_param($updateStmt, "sisi", $status, $ToId, $acceptTime, $ticketID);
            if (mysqli_stmt_execute($updateStmt)) {
                mysqli_commit($conn);
                header("Location: display-tickets.php");
            } else {
                mysqli_rollback($conn);
                echo "Error updating ticket status: " . mysqli_stmt_error($updateStmt);
            }
            mysqli_stmt_close($updateStmt);
        } else {
            die(mysqli_error($conn));
        }
    } else {
        // Handle payment failure (e.g., redirect to an error page)
        header("Location: paymentFailure.php");
    }
    mysqli_close($conn);
}
?>
