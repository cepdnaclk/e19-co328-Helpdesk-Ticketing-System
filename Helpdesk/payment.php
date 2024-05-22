<?php 

include('db_conn.php');
include('authentication_cus.php');
include('header-back.php');

$user_id= $_SESSION['auth_user']['userid'];

$query= "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Due Payment'";
$result = mysqli_query($conn,$query);
$row1 = mysqli_fetch_assoc($result);

$ticketInvID = $row1['InvoiceId'];
$sql_2 = "SELECT * from invoice WHERE InvoiceId = '$ticketInvID'";
$result_2 = mysqli_query($conn,$sql_2);
$row_2 = mysqli_fetch_assoc($result_2);

$sql_3 = "SELECT * from customer WHERE CustomerId = '$user_id'";
$result_3 = mysqli_query($conn,$sql_3);
$row_3 = mysqli_fetch_assoc($result_3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        .titleSt{
            color: #053B50;
            text-align: center;
        }
        .cardSt{
            background-color: #FAF1E4;
        }
    </style>
    <title>payment Gateway</title>
</head>
<body>
    <div class="container">
        <h2 class="m-4 p-3 titleSt">Payment Gateway</h2>
            <div class="row my-4 ms-5 justify-content-center">
                <div class="col-4 mb-3">
                    <div class="card border-2" style="background-color: #8abae6;">
                    <div class="card-body p-3 cardSt">
                        <h5 class="mb-2 text-center card-title"> 
                            Invoice Payment Details <pre></pre>
                        </h5>
                        <p class="card-text">Customer Name :
                            <?php echo $row_3['CustomerName']; ?>
                        </p>
                        <p class="card-text">Invoice ID :
                            <?php echo $row1['InvoiceId']; ?>
                        </p>
                        <p class="card-text">Invoice Description :
                            <?php echo $row_2['InvoiceDes']; ?>
                        </p>
                        <p class="card-text">Amount :
                            <?php echo $row_2['Amount']; ?>
                        </p>
                        <p class="card-text">Email :
                            <?php echo $row_3['Email']; ?>
                        </p>
                        <p class="card-text">Contact No :
                            <?php echo $row_3['ContactNo']; ?>
                        </p>                        
                        <button class="btn btn-primary w-100 py-2 btn-css" name="reg-btn" onclick="paymentGateway();">Make Payment</button>
                    </div>
                    </div>
                </div>
            </div>
    </div>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>
</html>
