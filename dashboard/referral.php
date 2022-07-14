<?php

function toMoney($e){
    $decimal = 0;
    $decimalChar = '.';
    $thousandSeperator = ',';
    return number_format($e, $decimal,$decimalChar,$thousandSeperator);
}

session_start();
include 'sqlcon.php';
if (!isset($_SESSION['cry'])) {
    header("location: signin.php");
}else{
    $email = $_SESSION['cry'];
    $get = $mysqli->query("SELECT * FROM account WHERE email = '$email' LIMIT 1");
    if (!$get) {
        echo "<script>logout()</script>";
    }
    $fetch = $get->fetch_array();
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') {
        $url = 'https://';
    }else {
       $url = 'http://';
    }
    $url .= $_SERVER['HTTP_HOST'];
    $url .= dirname($_SERVER['PHP_SELF']).'/signup.php';
    ?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fetch['name']?> | Referral System</title>
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
                                <div class="brand-logo">
  
                                <a class="mini-logo" href="index.php"><img src="images/logoi.png" alt="" width="40"></a>
                                </div>
                                <div class="search">
                                    
                                </div>
                            </div>
                            <div class="header-right">
                                <div class="dark-light-toggle"><span class="dark"><i class="ri-moon-line"></i></span><span class="light"><i class="ri-sun-line"></i></span></div>
                                <div class="nav-item dropdown notification dropdown">
                                    <div data-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                        <div class="notify-bell icon-menu"><span><i class="ri-notification-2-line"></i></span></div>
                                    </div>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu notification-list dropdown-menu dropdown-menu-right">
                         <h4>Recent Notification</h4>
                         <div class="lists">
                         <?php
                                $getNot = $mysqli->query("SELECT * FROM notify WHERE email ='$email' ORDER BY id desc LIMIT 5");
                                while ($a = $getNot->fetch_array()) {
                                    if ($a['type'] == 1) {
                            ?>
                            <a class="" href="#">
                                                <div class="d-flex align-items-center">
                                                <span class="me-3 icon success"><i class="ri-check-line"></i></span>
                                                    <div>
                                                        <p><?php echo "Account created successfully";?></p>
                                                        <span><?php echo $a['date']?></span>
                                                    </div>
                                                </div>
                                            </a>
                                    <div>
                                        
                                </div>
                                </a>
                                <?php
                                    }elseif ($a['type'] == 2) {
                                        ?>
                                        <a class="" href="#">
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                                <div>
                                                                    <p><?php echo "Account setup complete";?></p>
                                                                    <span><?php echo $a['date']?></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                <div>
                                                    
                                            </div>
                                            </a>
                                            </a>
                                            <?php
                                    }elseif ($a['type'] == 7) {
                                        ?>
                                        <a class="" href="#">
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3 icon pending"><i class="ri-link-m"></i></span>
                                                                <div>
                                                                    <p><?php echo "New Referral link click";?></p>
                                                                    <span><?php echo $a['date']?></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                <div>
                                                    
                                            </div>
                                            </a>
                                            </a>
                                            <?php
                                    }elseif ($a['type'] == 8) {
                                        ?>
                                        <a class="" href="#">
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3 icon success"><i class="ri-user-add-line"></i></span>
                                                                <div>
                                                                    <p><?php echo "New referral";?></p>
                                                                    <span><?php echo $a['date']?></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                <div>
                                                    
                                            </div>
                                            </a>
                                            </a>
                                <?php
                                    }elseif ($a['type'] == 4) {
                                        $amout = '$'.toMoney($a['amount']);
                                        ?>
                                        <a class="" href="#">
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                                <div>
                                                                    <p><?php echo "You Invested $amout";?></p>
                                                                    <span><?php echo $a['date']?></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                <div>
                                                    
                                            </div>
                                            </a>
                                            </a>
                                <?php
                                    }elseif ($a['type'] == 5) {
                                        $amout = '$'.toMoney($a['amount']);
                                        ?>
                                        <a class="" href="#">
                                                            <div class="d-flex align-items-center">
                                                                <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                                <div>
                                                                    <p><?php echo "You exported your investment <br> earnings ($amout)";?></p>
                                                                    <span><?php echo $a['date']?></span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                <div>
                                                    
                                            </div>
                                            </a>
                                            <?php
                                                }elseif ($a['type'] == 3) {
                                                    $am = toMoney($a['amount']);
                                                    if ($a['status'] == 0) {
                                                    ?>
                                                    <a class="" href="#">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-3 icon pending"><i class="ri-question-mark"></i></span>
                                                        <div>
                                                            <p><?php echo "Pending deposit of $$am";?></p>
                                                            <span><?php echo $a['date']?></span>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    <div>

                                                    </div>
                                                    </a>
                                                        <?php
                                                                }elseif ($a['status'] == 1) {
                                                        ?>
                                                        <a class="" href="#">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                        <div>
                                                            <p><?php echo "Deposit of $$am has been verified";?></p>
                                                            <span><?php echo $a['date']?></span>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    <div>

                                                    </div>
                                                    </a>
                                                    <?php
                                                             }elseif ($a['status'] == 2) {
                                                                    ?>
                                                                    <a class="" href="#">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-3 icon fail"><i class="bi bi-x"></i></span>
                                                                    <div>
                                                                        <p><?php echo "Deposit of $$am was declined";?></p>
                                                                        <span><?php echo $a['date']?></span>
                                                                    </div>
                                                                </div>
                                                                </a>
                                                                <div>
            
                                                                </div>
                                                                </a>
                                                    <?php
                                                                }    
                                            }elseif ($a['type'] == 6) {
                                                    $am = toMoney($a['amount']);
                                                    if ($a['status'] == 0) {
                                                    ?>
                                                    <a class="" href="#">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-3 icon pending"><i class="ri-question-mark"></i></span>
                                                        <div>
                                                            <p><?php echo "Pending withdrawal of $$am";?></p>
                                                            <span><?php echo $a['date']?></span>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    <div>

                                                    </div>
                                                    </a>
                                                        <?php
                                                                }elseif ($a['status'] == 1) {
                                                        ?>
                                                        <a class="" href="#">
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                        <div>
                                                            <p><?php echo "Withdrawal of $$am has been verified";?></p>
                                                            <span><?php echo $a['date']?></span>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    <div>

                                                    </div>
                                                    </a>
                                                    <?php
                                                                }elseif ($a['status'] == 2) {
                                                        ?>
                                                        <a class="" href="#">
                                                    <div class="d-flex align-items-center">
                                                    <span class="me-3 icon fail"><i class="bi bi-x"></i></span>
                                                        <div>
                                                            <p><?php echo "Withdrawal of $$am was declined";?></p>
                                                            <span><?php echo $a['date']?></span>
                                                        </div>
                                                    </div>
                                                    </a>
                                                    <div>

                                                    </div>
                                                    </a>
                                                        
                                                                    <?php
                                                                            }
                                                            }
                                                        ?>
                            <?php
                                }
                            ?>
                         </div>
                      </div>
                                </div>
                                <div class="dropdown profile_log dropdown">
                                    <div data-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                                        <div class="user icon-menu active"><span><i class="ri-user-line"></i></span></div>
                                    </div>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu dropdown-menu-right">
                                        <div class="user-email">
                                            <div class="user">
                                                <span class="thumb"><img src="<?php echo $fetch['img']?>" alt=""></span>
                                                <div class="user-info">
                                                    <h5><?php echo $fetch['name'] ?></h5>
                                                    <span><?php echo $fetch['email'] ?></span>
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
                    <span><i class="ri-user-add-fill"></i></span>
                    <span class="nav-text">Referral</span>
                </a>
            </li>
            <li><a href="profile.php">
                    <span><i class="ri-user-3-line"></i></span>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
            <li class="logout"><a onclick = 'logout()'>
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
                            <h3>Referral</h3>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="breadcrumbs"><a href="#">Home </a><span><i
                                    class="ri-arrow-right-s-line"></i></span><a href="#">Referral
                                    </a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-primary"><span><i class="ri-user-line"></i></span></div>
                        <div class="widget-content">
                            <h3>
                                <?php
                                    $myref = $fetch['refid'];
                                    $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                    $count = mysqli_num_rows($test);
                                    $refCash = $count * 20;
                                    if (strlen($count) == 0) {
                                        echo '000';
                                    }elseif (strlen($count) <=9) {
                                        echo '00'.$count;
                                    }elseif (strlen($count) <=99) {
                                        echo '0'.$count;
                                    }else {
                                        echo $count;
                                    }
                                ?>
                            </h3>
                            <p>Total Referral</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-success"><span><i class="ri-hand-coin-line"></i></span></div>
                        <div class="widget-content">
                            <h3>$<?php echo toMoney($refCash); ?></h3>
                            <p>Earnings from Referrals</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-warning"><span><i class="ri-external-link-line"></i></span></div>
                        <div class="widget-content">
                            <h3><?php echo $fetch['linkclick']?></h3>
                            <p>Referral Link Clicks</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-danger"><span><i class="ri-emotion-laugh-line"></i></span></div>
                        <div class="widget-content">
                            <h3>$<?php echo $refCash; ?></h3>
                            <p>Total Referral earning</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header flex-row">
                            <h4 class="card-title">Referred Users</h4>
                            <input style='display: none' type="text" name="" id="word" value='<?php 
                                $refid = $fetch['refid'];
                                echo $url."?ref=$refid"?>'>
                            <a class="btn btn-primary" onclick='copyText()'><span><i
                                        class="ri-file-copy-2-line"></i> </span>Copy Referral Link</a>
                        </div>
                        <div class="card-body">
                            <div class="invoice-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                </th>
                                                <th>Name</th>
                                                <th>Amount Earned</th>
                                                <th>Investment Plan</th>
                                                <th>join Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $refby = $fetch['refid'];
                                                $con = 0;
                                                $to = $mysqli->query("SELECT * FROM account WHERE refby ='$refby'");
                                                while ($getRef = $to->fetch_array()) {
                                                    $con = $con + 1;
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="form-check"><?php echo $con;?></div>
                                                </td>
                                                <td><img src="images/profile/3.png" alt="" width="30"
                                                        class="me-2"><?php echo $getRef['name'];?></td>
                                                <td class='text-center'>$20</td>
                                                <?php
                                                        $urRef  = $getRef['email'];
                                                        $getStatus = $mysqli->query("SELECT * FROM investment WHERE email ='$urRef' LIMIT 1");
                                                        $look = $getStatus->fetch_array();
                                                        $plan = $look['plan'];
                                                        $getPlan = $mysqli->query("SELECT * FROM plans");
                                                        $Planlook = $getPlan->fetch_array();
                                                        if ($look['plan'] == 0) {
                                                            ?>
                                                            <td><span class="badge px-3 py-2 bg-danger">
                                                                
                                                                <?php
                                                                echo "No Plan Yet";
                                                        }else {
                                                            
                                                            ?>
                                                <td><span class="badge px-3 py-2 bg-success">

                                                            <?php
                                                            echo $Planlook[2];
                                                        }
                                                    ?>
                                                </span></td>
                                                <td><?php echo date('M d, Y', strtotime($getRef[14])); ?></td>
                                            </tr>
                                        <?php
                                                }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
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


<script>
    function copyText() {
        var textToCopy = document.getElementById('word');

        textToCopy.select();

        textToCopy.setSelectionRange(0, 99999);
        
        navigator.clipboard.writeText(textToCopy.value);
        alert('copied!');
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