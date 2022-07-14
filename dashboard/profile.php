<?php
    session_start();
    include 'sqlcon.php';
    if (!isset($_SESSION['cry'])) {
        header("location: signin.php");
    }else{
        $email = $_SESSION['cry'];
        $get = $mysqli->query("SELECT * FROM account WHERE email = '$email' LIMIT 1");
        $fetch = $get->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fetch['name']?> | Profile</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="dashboard">

<div id="preloader">
    <i>.</i>
    <i>.</i>
    <i>.</i>
</div>

<div id="main-wrapper">

    <div class="header">
        <div class="container">
            <div id="google_translate_element"></div>

        <div class="row">
            <div class="col-xxl-12">
                <div class="header-content">
                    <div class="header-left">
                    <div class="brand-logo"><a class="mini-logo" href="index.php"><img src="images/logoi.png" alt="" width="40"></a></div>
                    <div class="search">
                        <form action="#">
                            
                        </form>
                    </div>
                    </div>
                    <div class="header-right">
                    <div class="dark-light-toggle"><span class="dark"><i class="ri-moon-line"></i></span><span class="light"><i class="ri-sun-line"></i></span></div>
                    <div class="nav-item dropdown notification dropdown">
                        
                        </div>
                    </div>
                    <div class="dropdown profile_log dropdown">
                        <div data-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                            <div class="user icon-menu active"><span><i class="ri-user-line"></i></span></div>
                        </div>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu dropdown-menu-right">
                            <div class="user-email">
                                <div class="user">
                                <span class="thumb"><img src="images/profile/3.png" alt=""></span>
                                <div class="user-info">
                                    <h5><?php echo $fetch['name']?></h5>
                                    <span><?php echo $fetch['email']?></span>
                                </div>
                                </div>
                            </div>
                            <a class="dropdown-item" href="profile.php"><span><i class="ri-user-line"></i></span>Profile</a>
                                            <a class="dropdown-item" href="balance.php"><span><i class="ri-wallet-line"></i></span>Balance</a>
                                            <a class="dropdown-item" href="settings-profile.php"><span><i class="ri-settings-3-line"></i></span>Settings</a>
                                            <a class="dropdown-item" href="deposit.php"><span><i class="ri-time-line"></i></span>Deposit</a>
                                            
                                            <a class="dropdown-item logout" onclick = 'logout()'><i class="ri-logout-circle-line"></i>Logout</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="sidebar">
    <div class="brand-logo"><a class="full-logo" href="index.php"><img src="images/logoi.png" alt="" width="30"></a></div>
    <div class="menu">
        <ul>
        <li><a href="index.php">
                    <span><i class="ri-home-5-line"></i></span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a href="balance.php">
                    <span><i class="ri-wallet-line"></i></span>
                    <span class="nav-text">Wallet</span>
                </a>
            </li>
            <li><a href="bill.php">
                    <span><i class="ri-bit-coin-line"></i></span>
                    <span class="nav-text">Investment</span>
                </a>
            </li>
            <li><a href="referral.php">
                    <span><i class="ri-user-add-line"></i></span>
                    <span class="nav-text">Referral</span>
                </a>
            </li>
            <li><a href="profile.php">
                    <span><i class="ri-user-3-fill"></i></span>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li class="logout"><a onclick="logout()">
                    <span><i class="ri-logout-circle-line"></i></span>
                    <span class="nav-text">Signout</span>
                </a>
            </li>
        </ul>
    </div>
</div>

    <div class="content-body">
        <div class="container">
            <div class="page-title">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-4">
                        <div class="page-title-content">
                            <p class="mb-2"><?php echo $fetch['name'];?> Profile</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="breadcrumbs">
                            <a href="#">
                                Home
                                <!-- -->
                            </a>
                            <span><i class="ri-arrow-right-s-line"></i></span><a href="#">Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="card welcome-profile">
                        <div class="card-body">
                            <img src="images/profile/3.png" alt="">
                            <h4>Welcome, <?php echo $fetch['name'];?>!</h4>
                            <?php
                                $addr = $fetch['address'];
                                $post = $fetch['postcode'];
                                $city = $fetch['city'];
                                $img = $fetch['img'];
                                $country = $fetch['country'];
                                $phone = $fetch['phone'];
                                $num = 8;
                                $per = 100/8;
                                if ($addr == null) {
                                    $num = $num - 1;
                                }
                                if ($post == 0) {
                                    $num = $num - 1;
                                }
                                if ($city == null) {
                                    $num = $num - 1;
                                }
                                if ($country == null) {
                                    $num = $num - 1;
                                }
                                if ($phone == 0) {
                                    $num = $num - 1;
                                }
                                $percent = $num * $per;
                                
                                if ($addr == null | $post == 0 | $city == null | $country == null) {
                                ?>
                                <p>Looks like your account is <?php echo $num*$per?>% complete. Verify yourself to use the full potential of Xtrader.</p>
                            <?php
                                }
                            ?>
                            <ul>
                                <?php
                                    $percent = $num * $per;
                                    if ($percent == 100) {
                                ?>
                                    <li><a href="#"><span class="verified"><i class="ri-check-line"></i></span>Account setup complete</a></li>
                                <?php
                                    }else {
                                ?>
                                    <li><a href="#"><span class="not-verified"><i class="ri-check-line"></i></span>Account setup (<?php echo $percent.'%'?>)</a></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-xxl-6 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update &amp; Setup </h4>
                        </div>
                        <div class="card-body">
                            <h5>Account Status :<?php if ($percent != 100) {
                                echo '<span class="text-warning"> Pending <i
                                class="icofont-warning"></i></span></h5>
                    <p>Your account is not fully setup. Setup your account to enable funding, trading, and withdrawal.</p>
                    <a href="settings-profile.php" class="btn btn-primary">Complete setup</a>';
                            }else {
                                echo '<span class="text-success"> Complete <i
                                class="icofont-warning"></i></span></h5>
                    <p>Your account is fully setup. You can now fund, trade, and withdraw.</p>';
                            } ?>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header flex-row">
                            <h4 class="card-title">Information </h4>
                            <?php
                            if ($percent != 100) {

                                ?>
                            <a class="btn btn-primary" href="settings-profile.php">Edit</a>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="card-body">
                            <form class="row">
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="user-info">
                                        <span>USER ID</span>
                                        <h4><?php echo $fetch['refid'] ?></h4>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="user-info">
                                        <span>EMAIL ADDRESS</span>
                                        <h4><?php echo $fetch['email'] ?></h4>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="user-info">
                                        <span>Phone number</span>
                                        <h4><?php  
                                            if ($fetch['phone'] == 0) {
                                                echo 'N/A';
                                            }else {
                                                $number = $fetch['phone'];
                                                            $result = sprintf('%s-%s-%s', substr($number, 1, 3), substr($number, 4, 4), substr($number, 8));
                                                            echo $result;
                                            }
                                         ?></h4>
                                    </div>
                                </div>
                                
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="user-info">
                                        <span>COUNTRY OF RESIDENCE</span>
                                        <h4><?php 
                                            if ($fetch['country']==NULL) {
                                                echo 'N/A';
                                            }else {
                                                echo $fetch['country'];
                                            }
                                         ?></h4>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="user-info">
                                        <span>TYPE</span>
                                        <h4>Personal</h4>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="user-info">
                                        <span>Current Ip Address</span>
                                        <h4><?php  
                                            echo $_SERVER['REMOTE_ADDR'];
                                         ?></h4>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>








<script>
        function logout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = 'logout.php';
            }
        }
    </script>




<script type="text/javascript">// <![CDATA[
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
// ]]></script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>






<script src="js/scripts.js"></script>


</body>


</html>
<?php
    }
?>