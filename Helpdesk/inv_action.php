<?php
include 'db_conn.php';
include 'send-email-invoice-created.php';

$userid= $_SESSION['auth_user']['userid'];

try {
    $conn1 = new PDO("mysql:host=localhost;dbname=techub", "root", "1234");

    foreach ($_POST['Inv_des'] as $key => $value) {
        $status= "pending";
        $sql = "INSERT INTO invoice(InvoiceDes, Amount, InvoiceStatus, TicketId) VALUES (:Inv_des, :Amountt, :status, :TicketId)";
        $stmt = $conn1->prepare($sql);

        $stmt->execute([
            "Inv_des" => $value,
            "Amountt" => $_POST["Amountt"][$key],
            "status"=>$status,
            "TicketId" => $_POST["ticketID"][$key],
        ]);

        // Retrieve the generated invoice ID
        $invoiceId = $conn1->lastInsertId();
        $ticketStatus = "inAcPen";
        // Update the ticket table with the invoice ID
        $sql = "UPDATE ticket SET InvoiceId = :invoiceId, TStatus = :status  WHERE TicketId = :ticketID";
        $stmt = $conn1->prepare($sql);

        $stmt->execute([
            "invoiceId" => $invoiceId,
            "ticketID" => $_POST['ticketID'][$key],
            "status" =>$ticketStatus,
        ]);
    }
    $ticketID = $_POST['ticketID'][$key];
    $query= "SELECT * FROM `ticket` WHERE TicketId='$ticketID'";
    $result = mysqli_query($conn,$query);

    if ($result) {
        // Check if there are any rows returned
        if (mysqli_num_rows($result) == 1) {
            // Fetch data from each row
            $row = mysqli_fetch_assoc($result);
            
            $issuetype = $row['IssueType'];
            $description = $row['TicketDes'];
            $cusID = $row['CustomerId'];
            
        }
    }

    send_mail_invoice($conn, "$userid", "$cusID", $_POST['ticketID'][$key], "$issuetype", "$description", "$value", $_POST["Amountt"][$key]);
    header('Location: to-home.php');
} 
catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    
}
?>
