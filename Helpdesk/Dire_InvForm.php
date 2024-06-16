<?php 
    include 'db_conn.php';
    include('authentication_director.php');
    include('header-back.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        .searchBtn{
            background-color: #022b51;
            color: white;
        }
        .titleSt{
            color: white;
            text-align: center;
        }
        .cardSt{
            background-color: #fff0ad;
        }
    </style>

    <title>Invoice Details</title>
</head>
<body>
    <section>
        <h2 class="m-4 p-3 titleSt">Invoice Details</h2>
        <div class="container">
            <div class="row">
                <?php       
                    $status = 'pending';
                    $sql1 = "SELECT * FROM invoice WHERE InvoiceStatus=?";
                    $stmt = mysqli_prepare($conn, $sql1);
                    mysqli_stmt_bind_param($stmt, "s", $status);
                    mysqli_stmt_execute($stmt);
                    $result1 = mysqli_stmt_get_result($stmt);
                    $resultcheck1 = mysqli_num_rows($result1);
            
                    if ($resultcheck1 > 0) {
                        while($row = mysqli_fetch_assoc($result1)){ 
                            $invoiceId = $row['InvoiceId'];
                        
                                                            

                        $sql = "SELECT * FROM ticket WHERE InvoiceId =$invoiceId";
                        $result = mysqli_query($conn,$sql);
                        $trow = mysqli_fetch_assoc($result);
                        $ticketID = $trow['TicketId'];    
                                    echo '<div class="col-lg-3 mb-3">';
                                    echo '<div class="card">';
                                    echo '<div class="card-border">';
                                    echo '<div class="card-body p-3 cardSt">';
                                    echo '<p class="card-text">Invoice ID: '.$row['InvoiceId'].'</p>';
                                    echo '<p class="card-text">Issue Type: '.$trow['IssueType'].'</p>';
                                    echo '<p class="card-text">Issue Description: '.$trow['TicketDes'].'</p>'; 
                                    echo '<p class="card-text">Ticket Priority: '.$trow['TPriority'].'</p>';                               
                                    echo '<p class="card-text">Description: '.$row['InvoiceDes'].'</p>';
                                    echo '<p class="card-text">Amount: '.$row['Amount'].'</p>';
                                    echo '<form action="Dire_updateStatus.php" method = "post">';
                                    echo '<input type="hidden" name="ticketId" value="'. $ticketID .'">';
                                    echo '<input type="hidden" name="invoiceId" value="'. $invoiceId .'">';
                                    echo '<input type="hidden" name="toID" value="'.$trow['TechOfficerId'].'">';
                                    echo '<input type="hidden" name="InvoiceDes" value="'.$row['InvoiceDes'].'">';
                                    echo '<input type="hidden" name="Amount" value="'.$row['Amount'].'">';
                                    echo '<input type="hidden" name="cusEmail" value="'.$trow['customerEmail'].'">';
                                    echo '<button class="btn btn-success m-2 border rounded border-2" name="accept">Accept</button>'; 
                                    echo '</form>';    

                                    echo '<form action="Dire_updateStatus.php" method = "post">';
                                    echo '<input type="hidden" name="ticketId" value="'. $ticketID.'">';
                                    echo '<input type="hidden" name="invoiceId" value="'. $invoiceId .'">'; 
                                    echo '<input type="hidden" name="toID" value="'.$trow['TechOfficerId'].'">';
                                    echo '<input type="hidden" name="InvoiceDes" value="'.$row['InvoiceDes'].'">';
                                    echo '<input type="hidden" name="Amount" value="'.$row['Amount'].'">';
                                    echo '<button class="btn btn-danger m-2 border rounded border-2" name="reject">Reject</button>'; 
                                    echo '</form>';                                
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                
                            
                        }
                    } else {
                        echo '<div class="col-12"><h4 class="m-4" style="color:grey;">No invoices for Pending Tickets.</h4></div>';
                    }
                ?>
            </div>
        </div>
    </section>

</body>
</html>