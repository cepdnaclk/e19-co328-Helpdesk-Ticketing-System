<?php 
    include 'db_conn.php';
    include('authentication_admin.php');
    include('header-admin.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h2 class="m-4 text-center" style="color: white;">Updates</h2>
        <br>
        
        <div class="row justify-content-center m-3">

            <div class="col-md-4" style="cursor: pointer;" onclick="directToCust()">
                <div class="card mb-4 h-100">
                    <div class="card-body cardSt text-center">
                        <pre></pre>
                        <pre></pre>
                        <h5 style="color: #053B50;">Customers</h5>
                        <pre></pre>
                        <div class="card-text">
                        <?php
                            $sql = "SELECT * FROM customer";
                            $result = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result);
                            echo 'No of Customers: ';
                            /* <p>No of customers: </p> */
                            echo $num;
                        ?>
                        </div>
                        <pre></pre>
                    </div>
                </div>
            </div>

            <div class="col-md-4" style="cursor: pointer;" onclick="directToTO()">
                <div class="card mb-4 h-100">
                    <div class="card-body cardSt text-center">
                        <pre></pre>
                        <pre></pre>
                        <h5 style="color: #053B50;">Technical Officers</h5>
                        <pre></pre>
                        <div class="card-text">
                        <?php
                            $sql = "SELECT * FROM techofficer";
                            $result = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result);
                            echo 'No of Technical Officers: ';
                            echo $num;
                        ?>
                        </div>
                        <pre></pre>
                    </div>
                </div>
            </div>

                      

        </div>

        <div class="row justify-content-center m-3">

        <div class="col-md-4" style="cursor: pointer;" onclick="directToTicket()">
                <div class="card mb-4 h-100">
                    <div class="card-body cardSt text-center">
                        <pre></pre>
                        <pre></pre>
                        <h5 style="color: #053B50;">Tickets</h5>
                        <pre></pre>
                        <div class="card-text">
                        <?php
                            $sql = "SELECT * FROM ticket";
                            $result = mysqli_query($conn,$sql);
                            $num = mysqli_num_rows($result);
                            echo 'No of Tickets: ';
                            echo $num;                            
                        ?>
                        </div>
                        <pre></pre>
                    </div>
                </div>
            </div> 
            
            
            <div class="col-md-4" style="cursor: pointer;" onclick="directToInvoice()">
                <div class="card mb-4 h-100">
                    <div class="card-body cardSt text-center">
                        <pre></pre>
                        <h5 style="color: #053B50;">Invoices</h5>
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
        function directToCust(){
            window.location.href = "AdminCustomer.php";
        }
        function directToTO(){
            window.location.href = "AdminTO.php";
        }
        function directToTicket(){
            window.location.href = "AdminTicket.php";
        }
        function directToInvoice(){
            window.location.href = "Ad_invForm.php";
        }
        function directToAdmin(){
            window.location.href = "AdminAdmin.php";
        }
        function directToReg(){
            window.location.href = "AdminReg.php";
        }
        function directToRegTO(){
            window.location.href = "TO_Reg.php";
        }
    </script>
</body>
</html>