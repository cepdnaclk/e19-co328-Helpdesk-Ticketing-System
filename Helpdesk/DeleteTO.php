<?php 
    include('db_conn.php');

    $db = mysqli_select_db($conn,"techub");

    if(isset($_POST['delete'])){
        $id = $_POST['id'];
        $sql = "DELETE FROM techofficer WHERE TechOfficerID=$id ";
        $result = mysqli_query($conn, $sql);

        if($result){
            echo '<script> alert("Tech-Officer details are Deleted"); </script>';
            header("location:AdminTO.php");
        }else{
            
            echo '<script> alert("Tech-Officer details are not Deleted"); </script>';    
            header("location:AdminTO.php");        
        }
    };
?>