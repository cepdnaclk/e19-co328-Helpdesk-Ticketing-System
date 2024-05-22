<?php 

include('authentication_cus.php');
include('header-customer.php');
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
    <title>Customer Home Page</title>
    <link rel="stylesheet" href="path_to_attricss_file.css" type="text/css">
    <style>
        body {
            background-image: url('images/background.jpg');
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
    }
    .container{
           color: white;
           margin-top: 11%;
    }  
    .welcomenote{
        font-size: 40px;
        padding-top:10px ;
        padding-bottom: 10px;
        font-weight: 600;
    } 
    .para{
        padding-top: 10px;
        padding-bottom: 30px;
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="welcomenote">
            WELCOME TO TECH HUB <br>HELP DESK TICKETING SYSTEM
        </div>
        <div>
            <div class="para">
                Get repaired your device from the tech hub. The computer repair<br> center of IT center of UOP.
            </div>
            <div>
                <button class="btn btn-lg btn-dark" id="create">Create a Ticket</button>
                <button class="btn btn-lg btn-dark" id="track"> Previous Tickets</button>
                
            </div>
        </div>
    </div>
    
    <script>
        
        document.getElementById("create").addEventListener("click", function() {
            window.location.href = "create-ticket.php";
        });
        document.getElementById("track").addEventListener("click", function() {
            window.location.href = "display-tickets.php";
        });

    </script>
</body>
</html>