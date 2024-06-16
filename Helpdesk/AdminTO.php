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
        <h2 class="m-4 p-3 titleSt" style="color: white;">Technical Officer Details</h2>
        <pre></pre>
        
        <form action="" method="post">
            <div class="container m-3">
                <!-- <h5 class="fw-light">Search TO by id</h5> -->
                <input type="number" placeholder=" Search TO by id" name="TOid" id="search_box">
                <button class="btn btn-warning btn-sm searchBtn" name="submitt">Search</button>
            </div>
        </form>

        <div>
            <?php
                if(isset($_POST['submitt'])){
                    $searchTO = $_POST['TOid'];
                    $sql = "SELECT * FROM techofficer WHERE TechOfficerID = $searchTO ";

                    $result = mysqli_query($conn,$sql);

                    if(!empty($searchTO)){
                        if($result){
                            $num = mysqli_num_rows($result);
                            if($num>0){
                                while($row = mysqli_fetch_assoc($result)){
                                    echo '<div class="col-lg-3  mb-3 mx-4">';
                                    echo '<div class="card">';
                                    echo '<div class="card-border" style="background-color: #083e71;">';
                                    echo '<div class="card-body p-3 cardSt">';
                                    echo '<h5 class="card-title text-center mb-2"> '.$row['TechOfficerName'].' </h5>';
                                    echo '<p class="card-text">TO ID: '.$row['TechOfficerID'].'</p>';
                                    echo '<p class="card-text">Register No: '.$row['RegNo'].'</p>';
                                    echo '<p class="card-text">Email: '.$row['Email'].'</p>';
                                    echo '<p class="card-text">Contact No: '.$row['ContactNo'].'</p>';
                                    echo '<button class="btn btn-danger m-2 border rounded border-2">Delete</button>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }else{
                                echo '<h4 class="m-4">Data not found.</h4>';
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
                                    <th>TO ID</th>
                                    <th>TO Name</th>
                                    <th>Register No</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th></th>
                                    <!-- <th></th> -->
                                </tr>
                            </thead>
                            <tbody style="background-color: #FAF1E4;">
                                <?php 
                                    $sql = "SELECT * FROM techofficer";
                                    $result = mysqli_query($conn,$sql);
                                    $TOfficers = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                    foreach($TOfficers as $officer){ ?>
                                        <tr>
                                            <td> <?php echo $officer['TechOfficerID'] ?> </td>
                                            <td> <?php echo $officer['TechOfficerName'] ?> </td>
                                            <td> <?php echo $officer['RegNo'] ?> </td>
                                            <td> <?php echo $officer['Email'] ?> </td>
                                            <td> <?php echo $officer['ContactNo'] ?> </td>
                                            <!-- <td> <?php echo '<button class="btn btn-danger m-2 border rounded border-2">Delete</button>'; ?> </td> -->
                                            <!-- <form action="UpdateTO.php" method="post">
                                                <input type="hidden" name="idd" value="<?php echo $officer['TechOfficerID'] ?>">
                                                <th><input type="submit" name="update" class="btn btn-success" value="UPDATE"></th>
                                            </form> -->
                                            <form action="DeleteTO.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $officer['TechOfficerID'] ?>">
                                                <th><input type="submit" name="delete" class="btn btn-danger" value="Delete"></th>
                                            </form>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

    </section>

    <script>
        const searchBox = document.querySelector('#search-box');
const card = document.querySelector('.card');
const table = document.querySelector('.table');

function toggleTable() {
  table.style.display = table.style.display === 'none' ? 'block' : 'none';
}

searchBox.addEventListener('input', () => {
  toggleTable();

  // If there is no search query, show the table.
  if (searchBox.value === '') {
    toggleTable();
  }
});

card.addEventListener('mouseover', () => {
  // If there is a search query, hide the table and show the card.
  if (searchBox.value !== '') {
    toggleTable();
  }
});

card.addEventListener('mouseout', () => {
  // If there is a search query, show the table and hide the card.
  if (searchBox.value !== '') {
    toggleTable();
  }
});

    </script>
</body>
</html>