<?php
include 'db_conn.php';
include('authentication_director.php');
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    
    <style>
        .titleSt{
            color: #053B50;
            text-align: center;
        }
        .cardSt{
            background-color: #fff0ad;
        }
    </style>

    <title>Document</title>
</head>
<body>
    <div class="container my-4">
        <br>
        <h2 class="m-4 text-center" style="color: white;">Director Admin Dashboard</h2>
        <br>
        
        <div class="row justify-content-center m-3">

            <div class="col-md-4" style="cursor: pointer;" onclick="directToInvoice()">
                <div class="card mb-4 h-100">
                    <div class="card-body cardSt text-center">
                        <pre></pre>
                        <h5>Invoices</h5>
                        <pre></pre>
                        <div class="card-text">
                        <?php
                            $sql = "SELECT * FROM invoice";
                            $result = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result);
                            echo 'No of Invoices: ';
                            echo $num;
                            echo '<br>';

                            $sql2 = "SELECT sum(Amount) FROM invoice";
                            $result2 = mysqli_query($conn,$sql2);
                            echo 'Total Money: ';
                            while($row = mysqli_fetch_array($result2)) {
                                echo $row['sum(Amount)'];
                            }
                        ?>
                        </div>
                        <pre></pre>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script>
        function directToInvoice(){
            window.location.href = "Dire_InvForm.php"; 
        }
    </script>
</body>
</html>