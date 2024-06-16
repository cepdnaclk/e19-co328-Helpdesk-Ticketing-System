<?php
    include 'db_conn.php';
    include('header-to-back.php');

    session_start();
    $user_id = $_SESSION['auth_user']['userid'];
    

    if(!isset($user_id)){
        header('Location: sign-in.php');
        exit();
    }
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $name = $_POST['TechOfficerName'];
        $email = $_POST['Email'];
        $contact = $_POST['ContactNo'];
        // $dp = $_POST['ProfilePicture'];

        $update_query = mysqli_query($conn,"UPDATE `techofficer` SET TechOfficerName='$name', Email='$email',ContactNo='$contact' WHERE TechOfficerID='$user_id'");

        if($update_query){
            header('location:to-profile.php');
            exit();
        }else{
            echo "Error updating profile".mysqli_error($conn);
        }
    }
?>


<html>
    <head>
        <title>Update Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

           .container {
                max-width: 500px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-top: 120px;
                
            }

            .container h1 {
                font-size: 24px;
                margin-bottom: 20px;
                text-align: center;
            }

            label {
                display: inline-block;
                font-weight: bold;
                margin-bottom: 5px;
                text-align: left;
            }
            /* .btn{
                display: flex;
                justify-content: center;
            } */

            input[type="text"],
            input[type="email"] {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            /* input[type="submit"] {
                background-color: #0088a9;
                color: #fff;
                border: none;
                border-radius: 4px;
                padding: 10px 20px;
                cursor: pointer;
                font-size: 16px;
            } */

            /* input[type="submit"]:hover {
                background-color: #007799;
            } */
        </style>
    </head>
    <body>
        <?php
            $data_query = mysqli_query($conn,"SELECT * FROM `techofficer` WHERE TechOfficerID = '$user_id'");
            $profile_data = mysqli_fetch_assoc($data_query);
        
        ?>
        <div class="container">
            <h1>Update Profile</h1>
            
                <form action="" method="post">
                    <label for="name">Name:</label>
                    <input type="text" name="TechOfficerName" id="name" value="<?php echo $profile_data['TechOfficerName']; ?>"><br>

                    <label for="email">Email:</label>
                    <input type="email" name="Email" id="email" value="<?php echo $profile_data['Email']; ?>"><br>

                    <label for="contact">Contact Number:</label>
                    <input type="text" name="ContactNo" id="contact" value="<?php echo $profile_data['ContactNo']; ?>"><br>
                    

                    <!-- <div class="btn btn-warning w-100 py-2 btn-css"><input type="submit" value="Update Profile"></div> -->
                    <button class="btn btn-warning w-100 py-2 btn-css" name="submit-btn" type="submit">Update Profile</button>
                </form>
            
        </div>
    </body>
</html>