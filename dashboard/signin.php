<?php
    session_start();
    include 'sqlcon.php';
    if (isset($_POST['log'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $password = $mysqli->real_escape_string($password);
        $email = $mysqli->real_escape_string($email);

        $mdpass = md5($password);

        $query = $mysqli->query("SELECT * FROM account WHERE email = '$email' AND password = '$mdpass' LIMIT 1");
        $count = mysqli_num_rows($query);

        if ($count > 0) {
            echo "<script>alert('Login sucessful!')</script>";
            $_SESSION['cry'] = $email;
            echo "<script>window.location.href ='index.php';</script>";
        }else {
            echo "<script>alert('Unauthorized login!')</script>";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="@@class">

<div id="preloader">
    <i>.</i>
    <i>.</i>
    <i>.</i>
</div>

<div class="authincation section-padding">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">
                <div class="mini-logo text-center my-4">
                    <a href="../outside/indexbc14.html"><img src="images/logo.png" alt=""></a>
                    <h4 class="card-title mt-5">Sign into Kiremo</h4>
                </div>
                <div class="auth-form card">
                    <div class="card-body">
                        <form method="post" name="myform" class="signin_validate row g-3" action="">
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="hello@example.com"
                                    name="email" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <div class="col-6">
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name='log'>Sign in</button>
                            </div>
                        </form>
                        <p class="mt-3 mb-0">Don't have an account? <a class="text-primary" href="signup.php">Sign
                                up</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>




















<script src="js/scripts.js"></script>


</body>


</html>