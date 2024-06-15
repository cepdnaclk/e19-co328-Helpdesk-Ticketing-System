<?php
include 'db_conn.php';
include('authentication_to.php');
include('header-to-back.php');
?>
<?php 
    $user_id= $_SESSION['auth_user']['userid'];
?>
<?php if (isset($_SESSION['status'])) { ?>
    <p class="status"><?php echo $_SESSION['status']; 
    unset($_SESSION['status']) ?></p>
    <?php }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Tickets</title>    
    <link rel="stylesheet" href="public/css/to-available-ticket.css">
</head>
<body>
    <?php
        $status = "Pending";
        $sql1 = "SELECT * FROM ticket WHERE TStatus=?";
        $stmt = mysqli_prepare($conn, $sql1);
        mysqli_stmt_bind_param($stmt, "s", $status);
        mysqli_stmt_execute($stmt);
        $result1 = mysqli_stmt_get_result($stmt);
        $resultcheck1 = mysqli_num_rows($result1);

        if ($resultcheck1 > 0) {
            while ($trow = mysqli_fetch_assoc($result1)) {
                $ticketID = $trow['TicketId'];
                $opened = $trow['OpenDateTime'];
                
                $priority = $trow['TPriority'];
                $description = $trow['TicketDes'];
                $TOID = $trow['TechOfficerId'];
                $invoice = $trow ['InvoiceId'];
               

                if($priority == "1") {
                    echo '<div class="card priority">';
                    echo '<table>';
                        echo '<tr class="data"><td>Ticket ID:</td><td>' . $ticketID . '</td></tr>';
                        echo '<tr class="data"><td>Opened:</td><td>' . $opened . '</td></tr>';
                        echo '<tr class="data"><td>Priority:</td><td>' . $priority . '</td></tr>';
                        echo '<tr class="data"><td>Description:</td><td>' . $description . '</td></tr>';
                        echo '<tr><td colspan="2" class="merged-content">This ticket is Not yet accepted by an officer</td></tr>';
                        echo '</table>';
                        echo '<form action="to-update-table.php" method="post">';
                        echo ' <input type="hidden" name="ticketId" value="'. $ticketID.'">';
                        echo '<button>Accept the ticket</button>';
                        echo '</form>';
                }
                    echo '</div>';

                
                }
                if($priority == '0') {
                    echo '<div class="card normal">';
                    echo '<table>';
                    echo '<tr class="data"><td>Ticket ID:</td><td>' . $ticketID . '</td></tr>';
                    echo '<tr class="data"><td>Opened:</td><td>' . $opened . '</td></tr>';
                    echo '<tr class="data"><td>Priority:</td><td>' . $priority . '</td></tr>';
                    echo '<tr class="data"><td>Description:</td><td>' . $description . '</td></tr>';
                    echo '<tr><td colspan="2" class="merged-content">This ticket is Not yet accepted by an officer</td></tr>';
                    echo '</table>';
                    echo '<form action="to-update-table.php" method="post">';
                    echo ' <input type="hidden" name="ticketId" value="'. $ticketID.'">';
                    echo '<button>Accept the ticket</button>';
                    echo '</form>';
            }
                echo '</div>';


            
        }else{
            echo 'No Pending Tickets';
        }
    

    ?>
</body>
</html>
