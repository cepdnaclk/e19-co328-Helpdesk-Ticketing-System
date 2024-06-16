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

    <style>
        body{
            background-color: aliceblue;
        }
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
        <h2 class="m-4 p-3 titleSt" style="color: white;">Customer Details</h2>
        <pre></pre>
        
        <form action="" method="post">
            <div class="container m-3">
                <!-- <h5 class="fw-light">Search TO by id</h5> -->
                <input type="text" placeholder=" Search by name" name="TOid">
                <button class="btn btn-warning btn-sm searchBtn" name="submitt">Search</button>
            </div>
        </form>

        <div>
            <?php
                if(isset($_POST['submitt'])){
                    $searchCust = $_POST['TOid'];
                    $sql = "SELECT * FROM customer WHERE CustomerName like '%$searchCust%' ";

                    $result = mysqli_query($conn,$sql);

                    if(!empty($searchCust)){
                        if($result){
                            $num = mysqli_num_rows($result);
                            if($num>0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<div class="col-lg-3  mb-3 mx-4">';
                                    echo '<div class="card-border" style="background-color: #083e71;">';
                                    echo '<div class="card-body p-3 cardSt">';
                                    echo '<h5 class="card-title text-center mb-2"> '.$row['CustomerName'].' </h5>';
                                    echo '<p class="card-text"> Customer ID: '.$row['CustomerID'].'</p>';
                                    echo '<p class="card-text">Register No: '.$row['RegNo'].'</p>';
                                    echo '<p class="card-text">Email: '.$row['Email'].'</p>';
                                    echo '<p class="card-text">Contact No: '.$row['ContactNo'].'</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }else{
                                echo '<h4 class="m-4" style="color: grey;">Data not found.</h4>';
                            }
                        }else{}
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
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Register No</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                </tr>
                            </thead>
                            <tbody style="background-color: #FAF1E4;">
                                <?php 
                                    $sql = "SELECT * FROM customer";
                                    $result = mysqli_query($conn,$sql);
                                    $customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                    foreach($customers as $customer){ ?>
                                        <tr>
                                            <td> <?php echo $customer['CustomerID'] ?> </td>
                                            <td> <?php echo $customer['CustomerName'] ?> </td>
                                            <td> <?php echo $customer['RegNo'] ?> </td>
                                            <td> <?php echo $customer['Email'] ?> </td>
                                            <td> <?php echo $customer['ContactNo'] ?> </td>
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