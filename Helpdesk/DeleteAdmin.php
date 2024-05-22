<?php 
    include("Connect227.php");

    $db = mysqli_select_db($conn,"techub");

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM admin WHERE AdminID=$id ";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Admin details are Deleted"); </script>';
            header("location:AdminAdmin.php");
        }else{
            
            echo '<script> alert("Admin details are not Deleted"); </script>';    
            header("location:AdminAdmin.php");        
        }
    };
?>


