<?php
include 'db_conn.php';
include('authentication_engineer.php');
include('header-eng-back.php');
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
                $customerEmail= $trow['customerEmail'];
                $customerPhone = $trow['Telephone'];
                
                $sql2= "SELECT TechOfficerID, TechOfficerName FROM techofficer";
                $result2 = $conn->query($sql2);
                if($priority == "1") {
                    echo '<div class="card priority">';
                        echo '<div class = "content">';
                            echo '<table>';
                                echo '<tr class="data"><td>Ticket ID:</td><td>' . $ticketID . '</td></tr>';
                                echo '<tr class="data"><td>Opened:</td><td>' . $opened . '</td></tr>';
                                echo '<tr class="data"><td>Priority:</td><td>' . $priority . '</td></tr>';
                                echo '<tr class="data"><td>Description:</td><td>' . $description . '</td></tr>';
                                echo '<tr class="data"><td>Customer Email:</td><td>' . $customerEmail . '</td></tr>';
                                echo '<tr class="data"><td>Contact:</td><td>' . $description . '</td></tr>';
                                echo '</table>';
                        echo '</div>';
                        echo '<div class= "action">';
                        
                            echo '<form action="to-update-table.php" method="post">';
                                echo ' <input type="hidden" name="ticketId" value="'. $ticketID.'">';
                                echo 'Choose Technical Officer : ';
                                
                                echo '<select name ="Techofficer" id = "Techofficer" required>';
                                echo "<option value='' disabled selected>Select a Technical Officer</option>";
                                while ($row2 = $result2->fetch_assoc()) {
                                    // Set the value of the option to TechOfficerID
                                    // Display only TechOfficerName in the dropdown list
                                    echo "<option value='" . $row2['TechOfficerID'] . "'>" . $row2['TechOfficerName'] . "</option>";
                                }
                                echo "</select>";
                                  echo '<br>';
                                echo '<button class = "accept">Accept the ticket</button>';
                            echo '</form>';

                            echo '<form action="update-deletion.php" method = "post">';
                                echo ' <input type="hidden" name="ticketId" value="'. $ticketID.'">';
                                
                                echo '<button class="reject">Reject the ticket</button>';
                            echo '</form>';
                            
                        echo '</div>';
                    echo '</div>';
                }
                
                else if($priority == '0') {
                    echo '<div class="card normal">';
                        echo '<div class = "content">';
                            echo '<table>';
                                echo '<tr class="data"><td>Ticket ID:</td><td>' . $ticketID . '</td></tr>';
                                echo '<tr class="data"><td>Opened:</td><td>' . $opened . '</td></tr>';
                                echo '<tr class="data"><td>Priority:</td><td>' . $priority . '</td></tr>';
                                echo '<tr class="data"><td>Description:</td><td>' . $description . '</td></tr>';
                                echo '<tr class="data"><td>Customer Email:</td><td>' . $customerEmail . '</td></tr>';
                                echo '<tr class="data"><td>Contact:</td><td>' . $description . '</td></tr>';
                                echo '</table>';
                        echo '</div>';
                        echo '<div class= "action">';
                            echo '<form action="to-update-table.php" method="post">';
                                echo ' <input type="hidden" name="ticketId" value="'. $ticketID.'">';
                                echo 'Choose Technical Officer : ';
                                
                                echo '<select name ="Techofficer" id = "Techofficer" required>';
                                echo "<option value='' disabled selected>Select a Technical Officer</option>";
                                while ($row2 = $result2->fetch_assoc()) {
                                    // Set the value of the option to TechOfficerID
                                    // Display only TechOfficerName in the dropdown list
                                    echo "<option value='" . $row2['TechOfficerID'] . "'>" . $row2['TechOfficerName'] . "</option>";
                                }
                                echo "</select>";
                                  echo '<br>';
                                echo '<button class = "accept">Accept the ticket</button>';
                            echo '</form>';
                            echo '<form action="update-deletion.php" method = "post">';
                                echo ' <input type="hidden" name="ticketId" value="'. $ticketID.'">';
                                
                                echo '<button class="reject">Reject the ticket</button>';
                            echo '</form>';
                            
                        echo '</div>';
                    echo '</div>';
            }

                
                }
                
                


            
        }else{
            echo '<h5 style="color:white; margin-top:20px;"> No Pending Tickets </h5>';
        }
    

    ?>
</body>
</html>
