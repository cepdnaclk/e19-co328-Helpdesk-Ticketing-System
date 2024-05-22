<?php 
session_start();

if (isset($_SESSION['authenticated_customer'])) {
    $_SESSION['status'] = "You are already logged in";
    header("Location: customer-home.php");
    exit(0);
}
else if (isset($_SESSION['authenticated_to'])) {
    $_SESSION['status'] = "You are already logged in";
    header("Location: to-home.php");
    exit(0);
}
else if (isset($_SESSION['authenticated_admin'])) {
    $_SESSION['status'] = "You are already logged in";
    header("Location: admin-home.php");
    exit(0);
}
else if (isset($_SESSION['authenticated_engineer'])) {
    $_SESSION['status'] = "You are already logged in";
    header("Location: engineer-home.php");
    exit(0);
}
else if (isset($_SESSION['authenticated_director'])) {
    $_SESSION['status'] = "You are already logged in";
    header("Location: director-home.php");
    exit(0);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="icon" href="images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="img-container">
                    <img class="sign-in-img" src="images/help-desk.png" alt="help-desk">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <main class="form-signin w-100 m-auto">
                    <form action="login.php" method="post">
                    <img class="mb-2 logo" src="images/logo.png" alt="" height="100">
                    <h1 class="h3 mb-3 fw-bold">Sign in</h1>
                
                    <?php if (isset($_SESSION['status'])) { ?>
                        <p class="status"><?php echo $_SESSION['status']; 
                        unset($_SESSION['status']) ?></p>
                    <?php }
                    ?>

                    <div class="form-floating">
                        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                
                    <button class="btn btn-primary w-100 py-2 btn-css" name="sign-btn" type="submit">Sign in</button>

                    <p class="mt-3 text-body-primary">Don't have an account? <a href="sign-up.php">Sign Up</a></p>
                    </form>
                </main>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>