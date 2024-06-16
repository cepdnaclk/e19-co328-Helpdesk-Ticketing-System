<?php
include 'db_conn.php';
include('authentication_to.php');
include('header-to-back.php');

$user_id = $_SESSION['auth_user']['userid'];

if (isset($_SESSION['status'])) {
    echo '<p class="status">' . $_SESSION['status'] . '</p>';
    unset($_SESSION['status']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }

        .go-back {
            color: white;
            margin-right: 30px;
            text-decoration: none;
        }

        a {
            text-decoration: none;
            color: white;
            transition: color 0.3s ease; /* Smooth transition for color change */
        }

        a:hover {
            color: #fecf00cf; /* Change color on hover to your desired color */
            text-decoration: none;
        }
        
        .edit-icon:hover{
            color: black;
        }

        .section {
            width: 45%;
            height: 100vh;
            float: left;
        }

        .box-container {
            display: flex;
            grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
            gap: 1.5rem;
            max-width: 400px;
            margin: 50px 50px auto;
            align-items: flex-start;
            float: left;
        }

        .box {
            border-radius: .5rem;
            padding: 2rem;
            background-color: #ffefa6;
            box-shadow: var(--box-shadow);
            border: var(--border);
            text-align: center;
            border: none;
            width: 350px;
            height: 300px;
            margin-top: 50px;
        }

        .box h5 {
            font-size: 26px;
            color: black;
        }

        .box p {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background-color: var(--light-bg);
            color: black;
            font-size: 26px;
            border-radius: .5rem;
            border: var(--border);
        }

        .custom-text {
            font-size: 12px;
        }

        .email-container {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .tooltip-text {
            display: inline-block;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .bg-infos {
            background-color: #fed000;
        }
    </style>
</head>

<body>
    <?php
    $data_query = mysqli_query($conn, "SELECT * FROM `techofficer` WHERE TechOfficerID = '$user_id'");
    $profile_data = mysqli_fetch_assoc($data_query);
    ?>

    <div class="section" id="section1">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10 mt-5 pt-5">
                    <div class="row z-depth-3">
                        <div class="col-sm-4 bg-infos rounded-left">
                            <div class="card-block text-center text-white">
                                <i class="fas fa-user-tie fa-7x mt-5"></i>
                                <h2 class="font-weight-bold mt-4"><?php echo $profile_data['TechOfficerName'] ?></h2>
                                <p>Technical Officer</p>
                                <a href="update_details.php" class="edit-icon">
                                    <i class="far fa-edit fa-2x mb-4"><span class="custom-text"> Edit</span></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-8 bg-white rounded-right">
                            <h3 class="mt-3 text-center">Information</h3>
                            <hr class="bg-primary">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold">ID</p>
                                    <h6 class="text-muted tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?php echo htmlspecialchars($profile_data['TechOfficerID']) ?>">
                                        <?php echo $profile_data['TechOfficerID'] ?>
                                    </h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="font-weight-bold ">Registration Number:</p>
                                    <h6 class="text-muted tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?php echo htmlspecialchars($profile_data['RegNo']); ?>">
                                        <?php echo $profile_data['RegNo'] ?>
                                    </h6>
                                </div>
                            </div>
                            <hr class="bg-primary">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="font-weight-bold">Email:</p>
                                    <h6 class="text-muted email-container tooltip-text" data-toggle="tooltip"
                                        data-placement="bottom" title="<?php echo htmlspecialchars($profile_data['Email']); ?>">
                                        <?php echo $profile_data['Email']; ?>
                                    </h6>
                                </div>
                                <div class="col-sm-6">
                                    <p class="font-weight-bold" >Contact Number:</p>
                                    <h6 class="text-muted tooltip-text" data-toggle="tooltip" data-placement="bottom" title="<?php echo htmlspecialchars($profile_data['ContactNo']) ?>">
                                        <?php echo $profile_data['ContactNo'] ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section" id="section2">
        <div class="box-container">
            <div class="box">
                <?php
                $select_In_Progress = mysqli_query($conn, "SELECT COUNT(*) FROM `ticket` WHERE TStatus = 'In Progress' AND TechOfficerID = '$user_id'") or die('query failed');
                if ($select_In_Progress) {
                    $count = mysqli_fetch_row($select_In_Progress)[0];
                }
                ?>
                <h5><?php echo $count; ?></h5>
                <p>Ticket In Progress</p>
            </div>

            <div class="box">
                <?php
                $select_Due_Payment = mysqli_query($conn, "SELECT COUNT(*) FROM `ticket` WHERE TStatus = 'Due Payment'") or die('query failed');
                if ($select_Due_Payment) {
                    $count = mysqli_fetch_row($select_Due_Payment)[0];
                }
                ?>
                <h5><?php echo $count; ?></h5>
                <p>Ticket With Due Payments</p>
            </div>

            <div class="box">
                <?php
                $select_completed = mysqli_query($conn, "SELECT COUNT(*) FROM `ticket` WHERE TStatus = 'completed'") or die('query failed');
                if ($select_completed) {
                    $completed_count = mysqli_fetch_row($select_completed)[0];
                }
                ?>
                <h5><?php echo $completed_count; ?></h5>
                <p>Completed Tickets</p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
        
    </body>
</html>