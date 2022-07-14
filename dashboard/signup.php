<?php
    session_start();
    include 'sqlcon.php';

    function unid($var = 6){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characterLen = strlen($characters);
        $randomString = '';
        for ($i=0; $i < $var; $i++) { 
            $randomString .=$characters[rand(0, $characterLen - 1)];
        }
        return $randomString;
    }
    $refby = '';
    if (isset($_GET['ref'])) {
        $refby = $_GET['ref'];
        $refQuery = $mysqli->query("SELECT * FROM account WHERE refid = '$refby' LIMIT 1");
        if ($refby) {
            $fetchRef = $refQuery->fetch_array();
            $linkClick = $fetchRef['linkclick'] + 1;
            $upLineMail = $fetchRef['email'];
            $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$upLineMail','7','0')");
            $clickAdd = $mysqli->query("UPDATE account SET linkclick = '$linkClick' WHERE refid = '$refby' LIMIT 1");
            $upLine = $fetchRef['name'];
            $upRef = $fetchRef['refid'];
        }
    }

    if (isset($_POST['sign'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $agree = $_POST['agree'];

        $refid = unid();

        $name = $mysqli->real_escape_string($name);
        $email = $mysqli->real_escape_string($email);
        $password = $mysqli->real_escape_string($password);

        $mdpass = md5($password);

        $testquery = $mysqli->query("SELECT id FROM account WHERE email = '$email'");
        $count = mysqli_num_rows($testquery);

        if ($count > 0) {
            echo "<script>alert('Sorry! this email is already regsitered with us.')</script>";
        }elseif ($agree != 'on') {
            echo "<script>alert('Please agree to the terms & condition before signing up!')</script>";
        }elseif (strlen($name) < 5) {
            echo "<script>alert('Your name is too short')</script>";
        }elseif ($email == NULL) {
            echo "<script>alert('Email is a required field!')</script>";
        }elseif (strlen($password) <= 8) {
            echo "<script>alert('Password too weak!')</script>";
        }else {
            // insert into account db
            $query = $mysqli->query("INSERT INTO account (email,name,password,view,refid,refby) VALUE ('$email','$name','$mdpass','$password','$refid','$refby')");
            if ($refby != '') {
                $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$upLineMail','7','0')");
            }
            // create coin data
            $coinquery = $mysqli->query("INSERT INTO coinhold (email) VALUE ('$email')");
            // create investment data
            $invquery = $mysqli->query("INSERT INTO investment (email) VALUE ('$email')");
            $amount = 0;
            if ($query) {
                echo "<script>alert('Registration successful!')</script>";
                $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','1','$amount')");
                $_SESSION['cry'] = $email;
                echo "<script>window.location.href ='index.php';</script>";
            }else {
                echo "<script>alert('".$mysqli->error."')</script>";
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Join Kiremo</title>
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
<div id="google_translate_element"></div>

        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-xl-5 col-md-6">
                <div class="mini-logo text-center my-4">
                    <a href="../outside/indexbc14.html"><img src="images/logo.png" alt=""></a>
                    <h4 class="card-title mt-5">Create your account</h4>
                </div>
                <div class="auth-form card">
                    <div class="card-body">
                        <form method="post" name="myform" class="signin_validate row g-3"
                            action="">
                            <div class="col-12">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" placeholder="Name" name="name" required>
                            </div>
                            <div class="col-12 ">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="hello@example.com"
                                    name="email" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" name = 'agree' type="checkbox" checked='checked' id="flexSwitchCheckDefault" required>
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        I certify that I am 18 years of age or older, and agree to the <a href="../outside/indexa972.html"
                                            class="text-primary">User Agreement</a> and <a href="../outside/indexa972.html"
                                            class="text-primary">Privacy Policy</a>.
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" name='sign'>Create account</button>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="mt-3 mb-0"> <a class="text-primary" href="signin.php">Sign in</a> to your
                                account</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>







<script type="text/javascript">// <![CDATA[
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
// ]]></script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>












<script src="js/scripts.js"></script>


</body>


</html>