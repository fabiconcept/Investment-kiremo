<?php
include 'conn.php';
session_start();
if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password1 = $_POST['password'];
    $password2 = $_POST['password'];
    $email = $_POST['email'];
    $seq = $_POST['sq'];
    $sea = $_POST['sa'];

// referal code
    $ref = uniqid();



    $email1 = $_POST['email1'];
    $btc = $_POST['pay_account']['1006']['btc'];
    $eth = $_POST['pay_account']['1007']['eth'];
    $bnb = $_POST['pay_account']['1008']['bnb'];
    $mdPass = md5($password1);
    $find = $mysqli->query("SELECT id FROM accounts WHERE email = '$email'");
    $findref = $mysqli->query("SELECT id FROM accounts WHERE email = '$email'");
    $count = mysqli_num_rows($find);
    if ($count == 0) {
        $query = $mysqli->query("INSERT INTO accounts (name,username,email,password,view,refcode,btc,eth,bnb,seq,sea) VALUES ('$fullname','$username','$email','$mdPass','$password1','$ref','$btc','$eth','$bnb','$seq','$sea')");
        if ($query) {
            echo "<script>alert('Registration Complete, proceed to login page')</script>";
            $_SESSION['holo'] = 'grammy';
            $_SESSION['name'] = $fullname;
            $_SESSION['password'] = $password2;
            $_SESSION['email'] = $email;
            $_SESSION['seq'] = $seq;
            $_SESSION['sea'] = $sea;

            echo "<script>window.location.href = '../../temp/'</script>";
        }
    }else{
        echo "<script>alert('You already have an account, login instead!')</script>";
    }
    echo $mysqli->error;
}
?>