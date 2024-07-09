<?php
include('db_conn.php');
include('authentication_cus.php');
include('header-back.php');

$user_id = $_SESSION['auth_user']['userid'];

function hasPendingTickets($conn, $user_id) {
    $query = "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Pending'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function hasInProgressTickets($conn, $user_id) {
    $query = "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='In Progress'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function hasDuePayments($conn, $user_id) {
    $query = "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Due Payment'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

function hasCompleted($conn, $user_id) {
    $query = "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Completed'";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result) > 0;
}

$ticket_details_query_1 = mysqli_query($conn, "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Pending'");
$ticket_details_query_2 = mysqli_query($conn, "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='In Progress'");
$ticket_details_query_3 = mysqli_query($conn, "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Due Payment'");
$ticket_details_query_4 = mysqli_query($conn, "SELECT * FROM `ticket` WHERE CustomerId='$user_id' AND TStatus='Completed'");

$hasPending = hasPendingTickets($conn, $user_id);
$hasInProgress = hasInProgressTickets($conn, $user_id);
$hasDuePayment = hasDuePayments($conn, $user_id);
$hasCompleted = hasCompleted($conn, $user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previous tickets</title>
    <link rel="stylesheet" href="public/css/display-tickets.css">
    <link rel="stylesheet" href="public/css/tab-styles.css"> <!-- External stylesheet for tab styles -->
</head>

<body>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'pending')" id="defaultOpen">Pending Tickets</button>
    <button class="tablinks" onclick="openTab(event, 'inprogress')">Tickets In Progress</button>
    <button class="tablinks" onclick="openTab(event, 'duepayment')">Tickets with Due Payments</button>
    <button class="tablinks" onclick="openTab(event, 'completed')">Completed Tickets</button>
</div>

<div id="pending" class="tabcontent">
    <?php if ($hasPending && mysqli_num_rows($ticket_details_query_1) > 0) { ?>
        <div class="card-container">
            <?php while ($row1 = mysqli_fetch_assoc($ticket_details_query_1)) { ?>
                <div class="ticket-card">
                    <h3>Ticket ID: <?= $row1['TicketId'] ?></h3>
                    <div class="ticket-details">
                        <label>Open Date Time</label>
                        <span class="value"><?= $row1['OpenDateTime'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Priority</label>
                        <span class="value"><?= $row1['TPriority'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Description</label>
                        <span class="value"><?= $row1['TicketDes'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Issue Type</label>
                        <span class="value"><?= $row1['IssueType'] ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <h4 class="no-tickets">No Tickets are pending.</h4>
    <?php } ?>
</div>


<div id="inprogress" class="tabcontent">
    <?php if ($hasInProgress && mysqli_num_rows($ticket_details_query_2) > 0) { ?>
        <div class="card-container">
            <?php while ($row2 = mysqli_fetch_assoc($ticket_details_query_2)) {
                $to_details_query_2 = mysqli_query($conn, "SELECT * FROM `techofficer` WHERE TechOfficerID='{$row2['TechOfficerId']}'");
                $row2_details = mysqli_fetch_assoc($to_details_query_2);
                ?>
                <div class="ticket-card">
                    <h3>Ticket ID: <?= $row2['TicketId'] ?></h3>
                    <div class="ticket-details">
                        <label>Open Date Time</label>
                        <span class="value"><?= $row2['OpenDateTime'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Accepted Date Time</label>
                        <span class="value"><?= '2024-05-02' /* Replace with actual Accepted Date Time */ ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Priority:</label>
                        <span class="value"><?= $row2['TPriority'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Description</label>
                        <span class="value"><?= $row2['TicketDes'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Issue Type</label>
                        <span class="value"><?= $row2['IssueType'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Technical Officer ID</label>
                        <span class="value"><?= $row2['TechOfficerId'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Technical Officer Email</label>
                        <span class="value"><?= ($row2_details ? $row2_details['Email'] : 'N/A') ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Contact Number</label>
                        <span class="value"><?= ($row2_details ? $row2_details['ContactNo'] : 'N/A') ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <h4 class="no-tickets-inprogress">No Tickets in progress.</h4>
    <?php } ?>
</div>

<div id="duepayment" class="tabcontent">
    <?php if ($hasDuePayment && mysqli_num_rows($ticket_details_query_3) > 0) { ?>
        <div class="card-container">
            <?php while ($row3 = mysqli_fetch_assoc($ticket_details_query_3)) {
                $to_details_query_3 = mysqli_query($conn, "SELECT * FROM `techofficer` WHERE TechOfficerID='{$row3['TechOfficerId']}'");
                $row3_details = mysqli_fetch_assoc($to_details_query_3);
                ?>
                <div class="ticket-card">
                    <h3>Ticket ID: <?= $row3['TicketId'] ?></h3>
                    <div class="ticket-details">
                        <label>Open Date Time:</label>
                        <span class="value"><?= $row3['OpenDateTime'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Accepted Date Time:</label>
                        <span class="value"><?= '2024-05-02' /* Replace with actual Accepted Date Time */ ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Priority:</label>
                        <span class="value"><?= $row3['TPriority'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Description:</label>
                        <span class="value"><?= $row3['TicketDes'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Issue Type:</label>
                        <span class="value"><?= $row3['IssueType'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Technical Officer ID:</label>
                        <span class="value"><?= $row3['TechOfficerId'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Technical Officer Email:</label>
                        <span class="value"><?= ($row3_details ? $row3_details['Email'] : 'N/A') ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Contact Number:</label>
                        <span class="value"><?= ($row3_details ? $row3_details['ContactNo'] : 'N/A') ?></span>
                    </div>
                    <div class="payment-btn">
                        <form action="payment.php" method="post">
                            <input type="hidden" name="ticketId" value="<?= $row3['TicketId'] ?>">
                            <button class="check-btn" type="submit">&#10003;</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <h4 class="no-tickets">Tickets with due payments are not available right now.</h4>
    <?php } ?>
</div>


<div id="completed" class="tabcontent">
    <?php if ($hasCompleted && mysqli_num_rows($ticket_details_query_4) > 0) { ?>
        <div class="card-container">
            <?php while ($row4 = mysqli_fetch_assoc($ticket_details_query_4)) {
                $to_details_query_4 = mysqli_query($conn, "SELECT * FROM `techofficer` WHERE TechOfficerID='{$row4['TechOfficerId']}'");
                $row4_details = mysqli_fetch_assoc($to_details_query_4);
                ?>
                <div class="ticket-card">
                    <h3>Ticket ID: <?= $row4['TicketId'] ?></h3>
                    <div class="ticket-details">
                        <label>Open Date Time</label>
                        <span class="value"><?= $row4['OpenDateTime'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Accepted Date Time</label>
                        <span class="value"><?= '2024-05-02' /* Replace with actual Accepted Date Time */ ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Priority</label>
                        <span class="value"><?= $row4['TPriority'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Description</label>
                        <span class="value"><?= $row4['TicketDes'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Issue Type</label>
                        <span class="value"><?= $row4['IssueType'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Technical Officer ID</label>
                        <span class="value"><?= $row4['TechOfficerId'] ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Technical Officer Email</label>
                        <span class="value"><?= ($row4_details ? $row4_details['Email'] : 'N/A') ?></span>
                    </div>
                    <div class="ticket-details">
                        <label>Contact Number</label>
                        <span class="value"><?= ($row4_details ? $row4_details['ContactNo'] : 'N/A') ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <h4 class="no-tickets">No completed tickets.</h4>
    <?php } ?>
</div>


<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
</body>
</html>


<?php
mysqli_free_result($ticket_details_query_1);
mysqli_free_result($ticket_details_query_2);
mysqli_free_result($ticket_details_query_3);
mysqli_free_result($ticket_details_query_4);
mysqli_close($conn);
?>
