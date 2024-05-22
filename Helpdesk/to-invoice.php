<?php 
    include 'db_conn.php';
    include('authentication_to.php');
    include('header-to-back.php');
?>
<?php 
    $status="Repair Done";
    $ticketID = $_POST['ticketId']
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row my-4">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Invoice</h4>
                    </div>
                    <div class="card-body p-4">
                        <div id="show_alert"></div>
                        <form action="inv_action.php" method="post" id="add_form">
                            <div class="show_item" id="show_item">
                                <div class="row ps-4">   
                                                                                                      
                                    <div class="col-2 mb-3">
                                        <input type="text" name="ticketID[]" class="form-control" placeholder="Ticket ID" value="<?php echo $ticketID ?>" disabled required>
                                        <input type="hidden" name="ticketID[]" value="<?php echo $ticketID ?>" />
                                    </div>
                                    <!-- <div class="col-2 mb-3">
                                        <input type="text" name="invStatus[]" class="form-control" value="Pending" disabled required hidden>
                                    </div> -->
                                    <div class="col-4 mb-3">
                                        <input type="text" name="Inv_des[]" class="form-control" placeholder="Description" required>
                                    </div>                                
                                    <div class="col-2 mb-3">
                                        <input type="text" name="Amountt[]" class="form-control" placeholder="Amount" required>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="ps-4"> <input type="submit" value="Add" class="btn btn-warning w-25" id="addBtn"> </div>                            
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


</body>
</html>
