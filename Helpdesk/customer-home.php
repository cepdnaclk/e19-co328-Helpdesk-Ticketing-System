<?php

include ('authentication_cus.php');
include ('header-customer.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('public/images/background.jpg');
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
        }

        .container {
            color: white;
            margin-top: 11%;
        }

        .welcomenote {
            font-size: 40px;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: 600;
        }

        .para {
            padding-top: 10px;
            padding-bottom: 30px;
        }

        .button-container {
            display: flex;
            gap: 10px;
        }

        .chatbot-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }

        .chatbot-iframe {
            width: 350px;
            height: 430px;
            border: none;
        }

        .chatbot-toggle-button {
            background-color: #ffcc00;
            border: none;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
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
            <div class="button-container">
                <button class="btn btn-lg btn-outline-warning" id="create">Create a Ticket</button>
                <button class="btn btn-lg btn-outline-warning" id="track">Previous Tickets</button>
                <button class="btn btn-lg btn-outline-warning" id="invoice">Invoices</button>
            </div>
        </div>
    </div>

    <div class="chatbot-container">
        <button class="chatbot-toggle-button" id="toggle-chatbot">
            <i class="fas fa-times" id="chatbot-icon"></i>
        </button>
        <iframe class="chatbot-iframe" allow="microphone;"
            src="https://console.dialogflow.com/api-client/demo/embedded/ade9d565-2c22-4719-836f-8b9417b21510"
            id="chatbot-iframe">
        </iframe>
    </div>

    <script>
        document.getElementById("create").addEventListener("click", function () {
            window.location.href = "create-ticket.php";
        });
        document.getElementById("track").addEventListener("click", function () {
            window.location.href = "display-tickets.php";
        });
        document.getElementById("invoice").addEventListener("click", function () {
            window.location.href = "customer-invoice.php";
        });

        document.getElementById("toggle-chatbot").addEventListener("click", function () {
            var iframe = document.getElementById("chatbot-iframe");
            var icon = document.getElementById("chatbot-icon");
            if (iframe.style.display === "none") {
                iframe.style.display = "block";
                icon.classList.remove("fa-comments");
                icon.classList.add("fa-times");
            } else {
                iframe.style.display = "none";
                icon.classList.remove("fa-times");
                icon.classList.add("fa-comments");
            }
        });
    </script>
</body>

</html>