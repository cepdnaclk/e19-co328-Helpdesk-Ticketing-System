<?php
include 'db_conn.php';
include('authentication_cus.php');

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

// echo $ticketInvID;

$amount = $row_2['Amount'];
$merchant_id = "";
$invoice_id = $row1['InvoiceId'];
$merchant_secret = "";
$currency = "LKR";
$description = $row_2['InvoiceDes'];

$hash = strtoupper(
    md5(
        $merchant_id . 
        $invoice_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];

$array['Des'] = $description;
$array['amount'] = $amount;
$array['merchant_id'] = $merchant_id;
$array['invoice_id'] = $invoice_id;
$array['merchant_secret'] = $merchant_secret;
$array['currency'] = $currency;
$array['hash'] = $hash;

$array['first_name'] = $row_3['CustomerName'];
// $array['last_name'] = "Perera";
$array['email'] = $row_3['Email'];
$array['phone'] = $row_3['ContactNo'];
// $array['address'] = "No.1, Galle Road";
// $array['city'] = "Colombo";


$json = json_encode($array);


echo $json;

?>