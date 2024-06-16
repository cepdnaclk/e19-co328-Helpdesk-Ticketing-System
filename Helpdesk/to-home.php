<?php
    include 'db_conn.php';
    include('authentication_to.php');
    include('header-to.php');
?>
<?php 
$user_id= $_SESSION['auth_user']['userid'];
?>
<?php if (isset($_SESSION['status'])) { ?>
    <p class="status"><?php echo $_SESSION['status']; 
    unset($_SESSION['status']) ?></p>
    <?php }

    function hasInProgressTickets($conn,$user_id){
        $query= "SELECT * FROM `ticket` WHERE TechOfficerId='$user_id' AND TStatus='In Progress'";
        $result = mysqli_query($conn,$query);
        return mysqli_num_rows($result)>0;
    }
    function hasDueAcceptance($conn,$user_id){
        $query= "SELECT * FROM `ticket` WHERE TechOfficerId='$user_id' AND TStatus='inAcPen'";
        $result = mysqli_query($conn,$query);
        return mysqli_num_rows($result)>0;
    }
    function hasDuePayments($conn,$user_id){
        $query= "SELECT * FROM `ticket` WHERE TechOfficerId='$user_id' AND TStatus='Due Payment'";
        $result = mysqli_query($conn,$query);
        return mysqli_num_rows($result)>0;
    }
    function hasCompleted($conn,$user_id){
        $query= "SELECT * FROM `ticket` WHERE TechOfficerId='$user_id' AND TStatus='Completed'";
        $result = mysqli_query($conn,$query);
        return mysqli_num_rows($result)>0;
    }
?>

<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="public/css/to-home.css">
        <style>
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
            h4 {
                color: grey;
            }
        </style>
    </head>
    <body>
        <?php
            $ticket_details_query_1 = mysqli_query($conn,"SELECT * FROM `ticket` WHERE TechOfficerId='$user_id' AND TStatus='In Progress'");
            $ticket_details_query_2 = mysqli_query($conn,"SELECT * FROM `ticket` WHERE TechOfficerId='$user_id' AND TStatus='Due Payment'");
            $ticket_details_query_3 = mysqli_query($conn,"SELECT * FROM `ticket` WHERE TechOfficerId='$user_id' AND TStatus='Completed'");
            $ticket_details_query_4 = mysqli_query($conn,"SELECT * FROM `ticket` WHERE TechOfficerId='$user_id' AND TStatus='inAcPen'");

            $hasInProgress = hasInProgressTickets($conn,$user_id);
            $hasDuePayment = hasDuePayments($conn,$user_id);
            $hasCompleted = hasCompleted($conn,$user_id);
            $hasDueAcceptance = hasDueAcceptance( $conn,$user_id);

        ?>

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
                    <th>Customer Email</th>
                    <th>Issue Type</th>
                    <th>Contact Number</th>
                    <th>Customer ID</th>
                    <th>Action</th>
                </tr>
                <?php
                    while ($row1 = mysqli_fetch_assoc($ticket_details_query_1)) {
                        echo "<tr>";
                        echo "<td>{$row1['TicketId']}</td>";
                        echo "<td>{$row1['OpenDateTime']}</td>";
                        echo "<td>{$row1['AcceptDateTime']}</td>";
                        echo "<td>{$row1['TPriority']}</td>";
                        echo "<td>{$row1['TicketDes']}</td>";
                        echo "<td>{$row1['customerEmail']}</td>";
                        echo "<td>{$row1['IssueType']}</td>";
                        echo "<td>{$row1['Telephone']}</td>";
                        echo "<td>{$row1['CustomerId']}</td>";
                        echo '<td><form action="to-invoice.php" method="post">';
                        echo '<input type="hidden" name="ticketId" value="' . $row1['TicketId'] . '">';
                        echo '<button class="check-btn" type="submit">&#10003</button>';
                        echo '</form></td>';
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>
        <?php }else{?>
            <h4>No Tickets in progress.</h4>
        <?php } ?>

        <h3>Tickets : Due Invoice Acceptance</h3>
        <?php if($hasDueAcceptance){?>
        <section>
            <table>
                <tr>
                    <th>Ticket ID</th>
                    <th>Open Date Time</th>
                    <th>Accepted Date Time</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Customer Email</th>
                    <th>Issue Type</th>
                    <th>Contact Number</th>
                    <th>Customer ID</th>
                    
                </tr>
                <?php
                    while ($row4 = mysqli_fetch_assoc($ticket_details_query_4)) {
                        echo "<tr>";
                        echo "<td>{$row4['TicketId']}</td>";
                        echo "<td>{$row4['OpenDateTime']}</td>";
                        echo "<td>{$row4['AcceptDateTime']}</td>";
                        echo "<td>{$row4['TPriority']}</td>";
                        echo "<td>{$row4['TicketDes']}</td>";
                        echo "<td>{$row4['customerEmail']}</td>";
                        echo "<td>{$row4['IssueType']}</td>";
                        echo "<td>{$row4['Telephone']}</td>";
                        echo "<td>{$row4['CustomerId']}</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>
        <?php }else{?>
            <h4>No Tickets.</h4>
        <?php } ?>

        <h3>Tickets with due payments</h3>
        <?php if($hasDuePayment){?>
        <section>
            <table>
                <tr>
                    <th>Ticket ID</th>
                    <th>Open Date Time</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Customer Email</th>
                    <th>Issue Type</th>
                    <th>Contact Number</th>
                    <th>Customer ID</th>
                </tr>
                <?php
                    while ($row2 = mysqli_fetch_assoc($ticket_details_query_2)) {
                        echo "<tr>";
                        echo "<td>{$row2['TicketId']}</td>";
                        echo "<td>{$row2['OpenDateTime']}</td>";
                        echo "<td>{$row2['TPriority']}</td>";
                        echo "<td>{$row2['TicketDes']}</td>";
                        echo "<td>{$row2['customerEmail']}</td>";
                        echo "<td>{$row2['IssueType']}</td>";
                        echo "<td>{$row2['Telephone']}</td>";
                        echo "<td>{$row2['CustomerId']}</td>";
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
                    <th>Closed Date Time</th>
                    <th>Priority</th>
                    <th>Description</th>
                    <th>Customer Email</th>
                    <th>Issue Type</th>
                    <th>Contact Number</th>
                    <th>Customer ID</th>
                    <th>Invoice ID</th>
                </tr>
                <?php
                    while ($row3 = mysqli_fetch_assoc($ticket_details_query_3)) {
                        echo "<tr>";
                        echo "<td>{$row3['TicketId']}</td>";
                        echo "<td>{$row3['OpenDateTime']}</td>";
                        echo "<td>{$row3['ClosedDateTime']}</td>";
                        echo "<td>{$row3['TPriority']}</td>";
                        echo "<td>{$row3['TicketDes']}</td>";
                        echo "<td>{$row3['customerEmail']}</td>";
                        echo "<td>{$row3['IssueType']}</td>";
                        echo "<td>{$row3['Telephone']}</td>";
                        echo "<td>{$row3['CustomerId']}</td>";
                        echo "<td>{$row3['InvoiceId']}</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </section>
        <?php }else{?>
            <h4>No completed tickets.</h4>
        <?php } ?>
    </body>
    <script>
        const button = document.getElementById('check-btn');
        button.addEventListener('click',function(){
            this.classList.add('clicked-btn');
        });
    </script>
    
</html>

