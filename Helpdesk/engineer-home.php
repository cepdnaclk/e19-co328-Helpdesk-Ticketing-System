<?php
    include 'db_conn.php';
    include('authentication_engineer.php');
    include('header-eng.php');
?>
<?php
 include 'db_conn.php';
?>
<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="public/css/to-home.css">
    </head>

    <body>
    <?php
$query= "SELECT * FROM `techofficer`";
$result = mysqli_query($conn,$query);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $TOID = $row["TechOfficerID"];
      $TOName = $row["TechOfficerName"];
      echo "<h4>".$TOName."-In Progress Tickets</h4>";
      
      //fetch in progress tickets from the table for each TO
        $status= 'In Progress';
        $sql1 = "SELECT * FROM `ticket` WHERE TStatus= ? AND TechOfficerId= ?";
        $stmt = mysqli_prepare($conn, $sql1);
        mysqli_stmt_bind_param($stmt, "ss", $status,$TOID);
        mysqli_stmt_execute($stmt);
        $result1 = mysqli_stmt_get_result($stmt);
        $resultcheck1 = mysqli_num_rows($result1);

        if ($resultcheck1 > 0) {
            echo '<table>';
            echo "<tr>";
                echo "<th>Ticket Id</th>";
                echo "<th>OpenDateTime</th>";
                echo "<th>AcceptDateTime</th>";
                echo "<th>Priority</th>";
                echo "<th>TicketDes</th>";
                echo "<th>IssueType</th>";
                echo "<th>CustomerId</th>";
                echo "</tr>";
            while ($row1 = mysqli_fetch_assoc($result1)) {
                echo "<tr>";
                echo "<td>{$row1['TicketId']}</td>";
    
                echo "<td>{$row1['OpenDateTime']}</td>";
                echo "<td>{$row1['AcceptDateTime']}</td>";
                echo "<td>{$row1['TPriority']}</td>";
                echo "<td>{$row1['TicketDes']}</td>";
                echo "<td>{$row1['IssueType']}</td>";
                echo "<td>{$row1['CustomerId']}</td>";
                echo "</tr>";

            }
            echo '</table>';
            


        }
    }
} else {
    echo "0 results";
  }
?>
        
    </body>

<?php
  $conn->close();
?>