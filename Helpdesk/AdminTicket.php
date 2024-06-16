<?php 
    include 'db_conn.php';
    include('authentication_admin.php');
    include('header-back.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!-- Include your CSS and other head elements here -->

    <style>

        /* .searchBtn{
            background-color: #022b51;
            color: white;
        } */
        .titleSt{
            color: #053B50;
            text-align: center;
        }
        .cardSt{
            background-color: #FAF1E4;
        }
    </style>

    <title>Document</title>
</head>
<body>
    <section>
        <h2 class="m-4 p-3 titleSt" style="color: white;">Ticket Details</h2>
        <pre></pre>
        
        <form action="" method="post">
            <div class="container m-3">
                <input type="number" placeholder=" Search Ticket by id" name="Ticketid">
                <button class="btn btn-warning btn-sm searchBtn" name="submitt">Search</button>
            </div>
        </form>

        <div>
            <?php
                if(isset($_POST['submitt'])){
                    $searchTicket = $_POST['Ticketid'];
                    $sql = "SELECT * FROM ticket WHERE TicketId = '$searchTicket' ";

                    $result = mysqli_query($conn,$sql);

                    if(!empty($searchTicket)){
                        if($result){
                            $num = mysqli_num_rows($result);
                            if($num>0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<div class="col-lg-3  mb-3 mx-4">';
                                    echo '<div class="card-border" style="background-color: #083e71;">';
                                    echo '<div class="card-body p-3 cardSt">';
                                    echo '<h5 class="card-title text-center mb-2">Ticket ID: '.$row['TicketId'].' </h5>';
                                    echo '<p class="card-text">Issue Type: '.$row['IssueType'].'</p>';
                                    echo '<p class="card-text">Ticket Opened At: '.$row['OpenDateTime'].'</p>';
                                    echo '<p class="card-text">Ticket Closed At: '.$row['ClosedDateTime'].'</p>';
                                    echo '<p class="card-text">Ticket Description: '.$row['TicketDes'].'</p>';
                                    echo '<p class="card-text">Ticket Status: '.$row['TStatus'].'</p>';
                                    echo '<p class="card-text">Ticket Priority: '.$row['TPriority'].'</p>';
                                    /* echo '<p class="card-text">Customer Email: '.$row['Email'].'</p>'; */
                                    echo '<p class="card-text"> <a href="AdViewCust.php?data='.$row['CustomerId'].'"> Customer ID: '.$row['CustomerId'].' </a> </p>';
                                    echo '<p class="card-text"> <a href="AdViewTO.php?data='.$row['TechOfficerId'].'"> TechOfficer ID: '.$row['TechOfficerId'].' </a></p>';
                                    echo '<p class="card-text"> <a href="AdViewInvoice.php?data='.$row['InvoiceId'].'"> Invoice ID: '.$row['InvoiceId'].' </a></p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }else{
                                echo '<h4 class="m-4">Data not found.</h4>';
                            }
                        }
                    }
                }
            ?>
        </div>

        <section>
            <pre></pre>
            <div class="container">
                <div class="row">
                    <div class="table mb-4">
                        <table class="table m-3">
                            <thead style="background-color: #033a6c;" class="text-white">
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Issue Type</th>
                                    <th>Opened At</th>
                                    <th>Closed At</th>
                                    <th>Ticket Des</th>
                                    <th>TStatus</th>
                                    <th>TPriority</th>
                                    <th>Customer ID</th>
                                    <th>TechOfficer ID</th>
                                    <th>Invoice ID</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #FAF1E4;">
                                <?php 
                                    $sql = "SELECT * FROM ticket";
                                    $result = mysqli_query($conn,$sql);
                                    $tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                    foreach($tickets as $ticket){ ?>
                                        <tr>
                                            <td> <?php echo $ticket['TicketId'] ?> </td>
                                            <td> <?php echo $ticket['IssueType'] ?> </td>
                                            <td> <?php echo $ticket['OpenDateTime'] ?> </td>
                                            <td> <?php echo $ticket['ClosedDateTime'] ?> </td>
                                            <td> <?php echo $ticket['TicketDes'] ?> </td>
                                            <td> <?php echo $ticket['TStatus'] ?> </td>
                                            <td> <?php echo $ticket['TPriority'] ?> </td>
                                            <td> <?php echo $ticket['CustomerId'] ?> </td>
                                            <td> <?php echo $ticket['TechOfficerId'] ?> </td>
                                            <td> <?php echo $ticket['InvoiceId'] ?> </td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </section>
</body>
</html>