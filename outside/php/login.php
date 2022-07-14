<?php
include 'conn.php';
session_start();
if (isset($_POST['log'])) {
    $username = $_POST['username'];
    $username = $mysqli->real_escape_string($username);
    $password = $_POST['password'];
    $password = $mysqli->real_escape_string($password);
    $mdPass = md5($password);

    $test = $mysqli->query("SELECT * FROM accounts WHERE username = '$username' AND  password = '$mdPass'");
    $count = mysqli_num_rows($test);
    if ($count > 0) {
        $fetch = $test->fetch_array();
            $_SESSION['holo'] = 'grammy';
            $_SESSION['name'] = $fetch['name'];
            $_SESSION['password'] = $fetch['view'];
            $_SESSION['email'] = $fetch['email'];
            $_SESSION['seq'] = $fetch['seq'];
            $_SESSION['sea'] = $fetch['sea'];
            echo "<script>alert('Welcome back ".$_SESSION['name']."!')</script>";

            echo "<script>window.location.href = '../../temp/'</script>";
    }else{
        echo $mysqli->error;
            echo "<script>alert('".$username." not found!')</script>";
            echo "<script>window.location.href = '../indexc30b.html'</script>";
    }

}
?>