<?php
include ('db_conn.php');
include ('authentication_cus.php');
include ('header-back.php');
?>

<?php
$user_id = $_SESSION['auth_user']['userid'];

function getInvoices($conn, $user_id)
{
    $query = "SELECT * FROM `invoice` 
              INNER JOIN `ticket` ON invoice.InvoiceId = ticket.InvoiceId 
              WHERE ticket.CustomerId = '$user_id' 
              AND invoice.InvoiceStatus != 'rejected_by_customer'";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $invoiceId = $_POST['invoiceId'];
    $action = $_POST['action'];

    if ($action == 'accept') {
        header("Location: payhereProcess.php?invoiceId=$invoiceId");
        exit();
    } elseif ($action == 'reject') {
        $query = "UPDATE `invoice` SET `InvoiceStatus` = 'rejected_by_customer' WHERE `InvoiceId` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $invoiceId);
        $stmt->execute();
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/header.css">
    <title>Show Invoices</title>
    <style>
        .invoice-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 10px;
        }

        .invoice {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
            transition: box-shadow 0.3s ease;
        }

        .invoice:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .invoice h3 {
            margin-bottom: 10px;
            color: #007bff;
        }

        .invoice ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .invoice li {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .accept-btn,
        .reject-btn {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .accept-btn {
            background-color: #28a745;
            color: white;
        }

        .accept-btn:hover {
            background-color: #218838;
        }

        .reject-btn {
            background-color: #dc3545;
            color: white;
        }

        .reject-btn:hover {
            background-color: #c82333;
        }

        .btn-container {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <?php
        $invoices = getInvoices($conn, $user_id);
        if (!empty($invoices)) {
            foreach ($invoices as $invoice) {
                ?>
                <div class="invoice" id="invoice-<?php echo $invoice['InvoiceId']; ?>">
                    <h3>Invoice ID: <?php echo $invoice['InvoiceId']; ?></h3>
                    <ul>
                        <li>Amount: <?php echo $invoice['Amount']; ?></li>
                        <li>Description: <?php echo $invoice['InvoiceDes']; ?></li>
                        <li>Status: <?php echo $invoice['InvoiceStatus']; ?></li>
                        <li>Ticket ID: <?php echo $invoice['TicketId']; ?></li>
                    </ul>
                    <div class="btn-container">
                        <form method="post" action="">
                            <input type="hidden" name="invoiceId" value="<?php echo $invoice['InvoiceId']; ?>">
                            <button type="submit" name="action" value="accept" class="accept-btn">Accept</button>
                            <button type="submit" name="action" value="reject" class="reject-btn">Reject</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No invoices found for the user.</p>";
        }
        ?>
    </div>
</body>

</html>