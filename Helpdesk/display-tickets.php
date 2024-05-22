<?php 
include('db_conn.php');
include('authentication_cus.php');
include('header-back.php');
?>

<?php 
$user_id= $_SESSION['auth_user']['userid'];

function hasPendingTickets($conn,$user_id){
    $query= "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Pending'";
    $result = mysqli_query($conn,$query);
    return mysqli_num_rows($result)>0;
}
function hasInProgressTickets($conn,$user_id){
    $query= "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='In Progress'";
    $result = mysqli_query($conn,$query);
    return mysqli_num_rows($result)>0;
}
function hasDuePayments($conn,$user_id){
    $query= "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Due Payment'";
    $result = mysqli_query($conn,$query);
    return mysqli_num_rows($result)>0;
}
function hasCompleted($conn,$user_id){
    $query= "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Completed'";
    $result = mysqli_query($conn,$query);
    return mysqli_num_rows($result)>0;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>previous tickets</title>
    <link rel="stylesheet" href="display-tickets.css">
</head>
<style>
h3{
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
    font-weight: bold;
}

th {
    font-weight: 550;
}
h4{
    font-weight: 500;
}

.check-btn{
    background-color: #4CAF50; 
    border: none;
    color: white;
    padding: 5px 20px; 
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    text-align: center;
}
.check-btn:hover{
    background-color: #45a049;
}
.clicked-btn{
    background-color: grey;
}
</style>

<body>
<?php
    $ticket_details_query_1 = mysqli_query($conn,"SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Pending'");
    $ticket_details_query_2 = mysqli_query($conn,"SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='In Progress'");
    $ticket_details_query_3 = mysqli_query($conn,"SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Due Payment'");
    $ticket_details_query_4 = mysqli_query($conn,"SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Completed'");

    $hasPending = hasPendingTickets($conn,$user_id);
    $hasInProgress = hasInProgressTickets($conn,$user_id);
    $hasDuePayment = hasDuePayments($conn,$user_id);
    $hasCompleted = hasCompleted($conn,$user_id);

?>
<h3>Pending Tickets</h3>
        <?php if($hasPending){?>
        <section>
            <table>
                <tr>
                    <th>Ticket ID</th>
                    <th>Open Date Time</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Issue Type</th>
                </tr>
                <?php
                    while ($row1 = mysqli_fetch_assoc($ticket_details_query_1)) {
                        echo "<tr>";
                        echo "<td>{$row1['TicketId']}</td>";
                        echo "<td>{$row1['OpenDateTime']}</td>";
                        echo "<td>{$row1['TPriority']}</td>";
                        echo "<td>{$row1['TicketDes']}</td>";
                        echo "<td>{$row1['IssueType']}</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>
        <?php }else{?>
            <h4>No Tickets are pending.</h4>
        <?php } ?>
<h3>Tickets In Progress</h3>
        <?php if($hasInProgress){?>
        <section>
            <table>
                <tr>
                    <th>Ticket ID</th>
                    <th>Open Date Time</th>
                    <th>Accepted Date Time</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Issue Type</th>
                    <th>Technical Officer ID</th>
                    <th>Technical Officer Email</th>
                    <th>Contact Number</th>
                    
                </tr>
                <?php
                    while ($row1 = mysqli_fetch_assoc($ticket_details_query_2)) {
                        $to_details_query_2 = mysqli_query($conn,"SELECT * FROM `techofficer` WHERE TechOfficerID='{$row1['TechOfficerId']}'");
                        $row2 = mysqli_fetch_assoc($to_details_query_2);
                        echo "<tr>";
                        echo "<td>{$row1['TicketId']}</td>";
                        echo "<td>{$row1['OpenDateTime']}</td>";
                        echo "<td>{$row1['AcceptDateTime']}</td>";
                        echo "<td>{$row1['TPriority']}</td>";
                        echo "<td>{$row1['TicketDes']}</td>";  
                        echo "<td>{$row1['IssueType']}</td>";
                        echo "<td>{$row1['TechOfficerId']}</td>";
                        echo "<td>{$row2['Email']}</td>";
                        echo "<td>{$row2['ContactNo']}</td>";                 
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>
        <?php }else{?>
            <h4>No Tickets in progress.</h4>
        <?php } ?>
        <h3>Tickets with due payments</h3>
        <?php if($hasDuePayment){?>
        <section>
            <table>
                <tr>
                <th>Ticket ID</th>
                    <th>Open Date Time</th>
                    <th>Accepted Date Time</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Issue Type</th>
                    <th>Technical Officer ID</th>
                    <th>Technical Officer Email</th>
                    <th>Contact Number</th>
                    <th>Payment</th>
                </tr>
                <?php
                    while ($row2 = mysqli_fetch_assoc($ticket_details_query_3)) {
                        $to_details_query_3 = mysqli_query($conn,"SELECT * FROM `techofficer` WHERE TechOfficerID='{$row2['TechOfficerId']}'");
                        $row3 = mysqli_fetch_assoc($to_details_query_3);
                        echo "<tr>";
                        echo "<td>{$row2['TicketId']}</td>";
                        echo "<td>{$row2['OpenDateTime']}</td>";
                        echo "<td>{$row2['AcceptDateTime']}</td>";
                        echo "<td>{$row2['TPriority']}</td>";
                        echo "<td>{$row2['TicketDes']}</td>";  
                        echo "<td>{$row2['IssueType']}</td>";
                        echo "<td>{$row2['TechOfficerId']}</td>";
                        echo "<td>{$row3['Email']}</td>";
                        echo "<td>{$row3['ContactNo']}</td>";
                        echo '<td><form action="payment.php" method="post">';
                        echo '<input type="hidden" name="ticketId" value="' . $row2['TicketId'] . '">';
                        echo '<button class="check-btn" type="submit">&#10003</button>';
                        // echo '<button class="check-btn" onclick="paymentGateway();">&#10003</button>';
                        echo '</form></td>';                    
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>
        <?php }else{ ?>
            <h4>Tickets with due payments is not available right now.</h4>
        <?php } ?>
        <h3>Completed Tickets</h3>
        <?php if($hasCompleted) { ?>
        <section>
            <table>
                <tr>
                    <th>Ticket ID</th>
                    <th>Open Date Time</th>
                    <th>Accepted Date Time</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Issue Type</th>
                    <th>Technical Officer ID</th>
                    <th>Technical Officer Email</th>
                    <th>Contact Number</th>
                </tr>
                <?php
                    while ($row3 = mysqli_fetch_assoc($ticket_details_query_4)) {
                        $to_details_query_4 = mysqli_query($conn,"SELECT * FROM `techofficer` WHERE TechOfficerID='{$row3['TechOfficerId']}'");
                        $row4 = mysqli_fetch_assoc($to_details_query_4);
                        echo "<tr>";
                        echo "<td>{$row3['TicketId']}</td>";
                        echo "<td>{$row3['OpenDateTime']}</td>";
                        echo "<td>{$row3['AcceptDateTime']}</td>";
                        echo "<td>{$row3['TPriority']}</td>";
                        echo "<td>{$row3['TicketDes']}</td>";  
                        echo "<td>{$row3['IssueType']}</td>";
                        echo "<td>{$row3['TechOfficerId']}</td>";
                        echo "<td>{$row4['Email']}</td>";
                        echo "<td>{$row4['ContactNo']}</td>";                    
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>
        <?php }else{?>
            <h4>No completed tickets.</h4>
        <?php } ?>

    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>
</html>