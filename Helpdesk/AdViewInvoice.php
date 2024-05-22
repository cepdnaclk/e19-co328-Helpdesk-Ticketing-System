<?php 
    include 'db_conn.php';
    include('authentication_admin.php');
    include('header-back.php');

    $data = $_GET['data'];
    $sql = "SELECT * FROM invoice WHERE InvoiceId = $data";
    $result = mysqli_query($conn,$sql);

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
            background-color: #FAF1E4;
        }
    </style>

    <title>Document</title>
</head>
<body>
    <section id="pricing" class="my-3">
        <div class="container-lg mx-3">
            <div class="m-4 p-3 titleSt"><h2>Relevent Invoice Details</h2></div>
            <pre></pre>

            <div class="row my-4 ms-5 justify-content-center">

                    <div class="col-4 mb-3">
                        <div class="card border-2" style="background-color: #8abae6;">
                        <div class="card-body p-3 cardSt">
                            <?php
                                if($result){
                                    $row = mysqli_fetch_assoc($result);
                                     
                                    $num= mysqli_num_rows($result);
                                    if($num == 0){
                                        echo "NULL";
                                    }else{
                                    ?>

                                        <h5 class="mb-2 text-center card-title">Invoice ID:
                                            <?php echo $row['InvoiceId']; ?> 
                                        </h5>
                                        <p class="card-text">Amount :
                                            <?php echo $row['Amount']; ?> 
                                        </p>
                                        <!-- <p class="card-text">Invoice Status :
                                            <?php echo $row['IStatus']; ?>
                                        </p> -->
                                        <p class="card-text">Invoice Des :
                                            <?php echo $row['InvoiceDes']; ?>
                                        </p>                                        

                                    <?php }
                                    ?>

                                <?php } ?>

                        </div>
                        </div>
                    </div>
               
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>