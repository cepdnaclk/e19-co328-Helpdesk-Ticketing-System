<?php
    include 'db_conn.php';

    if (isset($_POST['ticketId'])) {
        $ticketID = $_POST['ticketId'];
    }else{
        echo'error fetching ID';
    }
    
    date_default_timezone_set('Asia/Kolkata');
    $ToId= null;
    $status= 'rejected';
    $acceptTime= date("Y-m-d H:i:s");

    $sql="UPDATE ticket SET TStatus=?, TechOfficerId=?, AcceptDateTime=? WHERE TicketId=?";

   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt,$sql)){
       die(mysqli_error($conn));
   }
   mysqli_stmt_bind_param($stmt,"sisi", $status,$ToId, $acceptTime,$ticketID);
   if(mysqli_stmt_execute($stmt)) {
    mysqli_commit($conn);
    header("Location: engineer-ticket-accept.php");
   }
   else {
    mysqli_rollback($conn);
    echo "Error: ". mysqli_stmt_error($stmt);

   }
   mysqli_stmt_close($stmt);
   mysqli_close($conn);

?>