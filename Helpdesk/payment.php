<?php 
include('db_conn.php');
include('authentication_cus.php');
include('header-back.php');

$user_id = $_SESSION['auth_user']['userid'];

$query = "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Due Payment'";
$result = mysqli_query($conn, $query);

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    $row1 = mysqli_fetch_assoc($result);

    $ticketInvID = $row1['InvoiceId'];
    $sql_2 = "SELECT * FROM invoice WHERE InvoiceId = '$ticketInvID'";
    $result_2 = mysqli_query($conn, $sql_2);
    
    // Check if there are results from the second query
    if (mysqli_num_rows($result_2) > 0) {
        $row_2 = mysqli_fetch_assoc($result_2);
    } else {
        $row_2 = array(); // Initialize as empty array if no results
    }

    $sql_3 = "SELECT * FROM customer WHERE CustomerId = '$user_id'";
    $result_3 = mysqli_query($conn, $sql_3);
    
    // Check if there are results from the third query
    if (mysqli_num_rows($result_3) > 0) {
        $row_3 = mysqli_fetch_assoc($result_3);
    } else {
        $row_3 = array(); // Initialize as empty array if no results
    }
} else {
    $row1 = array(); // Initialize as empty array if no results
    $row_2 = array(); // Initialize as empty array if no results
    $row_3 = array(); // Initialize as empty array if no results
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .titleSt {
            color: #053B50;
            text-align: center;
        }
        .cardSt {
            background-color: #FAF1E4;
        }
    </style>
    <title>Payment Gateway</title>
</head>
<body>
    <div class="container">
        <h2 class="m-4 p-3 titleSt" style="color: white;">Payment Gateway</h2>
        <div class="row my-4 ms-5 justify-content-center">
            <div class="col-4 mb-3">
                <div class="card border-2" style="background-color: #8abae6;">
                    <div class="card-body p-3 cardSt">
                        <h5 class="mb-2 text-center card-title"> 
                            Invoice Payment Details <pre></pre>
                        </h5>
                        <p class="card-text">Customer Name: <?php echo isset($row_3['CustomerName']) ? $row_3['CustomerName'] : ''; ?></p>
                        <p class="card-text">Invoice ID: <?php echo isset($row1['InvoiceId']) ? $row1['InvoiceId'] : ''; ?></p>
                        <p class="card-text">Invoice Description: <?php echo isset($row_2['InvoiceDes']) ? $row_2['InvoiceDes'] : ''; ?></p>
                        <p class="card-text">Amount: <?php echo isset($row_2['Amount']) ? $row_2['Amount'] : ''; ?></p>
                        <p class="card-text">Email: <?php echo isset($row_3['Email']) ? $row_3['Email'] : ''; ?></p>
                        <p class="card-text">Contact No: <?php echo isset($row_3['ContactNo']) ? $row_3['ContactNo'] : ''; ?></p>                        
                        <form action="payhereProcess.php" method="POST">
                            <input type="hidden" name="ticketId" value="<?php echo isset($row1['TicketId']) ? $row1['TicketId'] : ''; ?>">
                            <input type="hidden" name="amount" value="<?php echo isset($row_2['Amount']) ? $row_2['Amount'] : ''; ?>">
                            <button type="submit" class="btn btn-warning w-100 py-2 btn-css">Make Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
