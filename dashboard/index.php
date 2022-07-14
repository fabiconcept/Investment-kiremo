<?php
function toMoney($e){
    $decimal = 2;
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
        echo "<script>logout();</script>";
    }
        $getcoin = $mysqli->query("SELECT * FROM coinhold WHERE email = '$email' LIMIT 1");
        $getInvest = $mysqli->query("SELECT * FROM investment WHERE email = '$email' LIMIT 1");
        $fetchInv = $getInvest->fetch_array();
        $fetch = $get->fetch_array();
        $fetchcoin = $getcoin->fetch_array();
        $plan = $fetchInv['plan'];
        $getPlan = $mysqli->query("SELECT * FROM plans WHERE id = '$plan'");
        $fetchPlan = $getPlan->fetch_array();
?>

<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fetch['name']?> | Dashboard</title>
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
            <div class="brand-logo">
                <a class="full-logo" href="index.php"><img src="images/logoi.png" alt="" width="30"></a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">
                            <span><i class="ri-home-5-fill"></i></span>
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
                            <span><i class="ri-user-3-line"></i></span>
                            <span class="nav-text">Profile</span>
                        </a>
                    </li>
                    <li class="logout"><a onclick ="logout()">
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
                                <p class="mb-2"><?php echo $fetch['name']?> Dashboard</p>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="breadcrumbs"><a href="#">Home </a><span><i
                                    class="ri-arrow-right-s-line"></i></span><a href="#">Dashboard</a></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Overview</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="stat-widget d-flex align-items-center">
                                            <div class="widget-icon me-3 bg-primary"><span><i
                                                    class="bi-cash-stack"></i></span></div>
                                            <div class="widget-content">
                                                <h3>$<?php
                                                        $start = strtotime($fetchInv['startdate'])/86400;
                                                        $end = strtotime($fetchInv['enddate'])/86400;
                                                        $now = strtotime(date('Y-m-d H:m:i'))/86400;
                                                        $myref = $fetch['refid'];
                                                        $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                                        $count = mysqli_num_rows($test);
                                                        $refCash = $count * 20;
                                                        $btc = $fetchcoin['btc'] * $btcPrice;
                                                        $eth = $fetchcoin['eth'] * $ethPrice;
                                                        $bnb = $fetchcoin['bnb'] * $bchPrice;
                                                        $total = $btc + $eth + $bnb + $refCash;
                                                        if ($total == 0) {
                                                            if ($fetchInv['plan'] > 0) {
                                                                if (intval($now - $start) < intval($end - $start)) {
                                                                    echo toMoney($fetchInv['paid']+($fetchPlan['interest']*($now - $start)/ 100) * $fetchInv['paid']);
                                                                }else {
                                                                    echo toMoney($fetchInv['paid'] + ($fetchPlan['interest']*($fetchPlan['length'])/ 100) * $fetchInv['paid']);
                                                                }
                                                            }else {
                                                                # code...
                                                                echo '0.00';
                                                            }
                                                        }else {
                                                            if ($fetchInv['plan'] > 0) {
                                                                if (intval($now - $start) < intval($end - $start)) {
                                                                    echo toMoney($fetchInv['paid']+($fetchPlan['interest']*($now - $start)/ 100) * $fetchInv['paid']);
                                                                }else {
                                                                    echo toMoney(($fetchInv['paid'] + ($fetchPlan['interest']*($fetchPlan['length'])/ 100) * $fetchInv['paid']) + $total);
                                                                }
                                                            }else {
                                                                echo toMoney($total);
                                                            }
                                                        }
                                                    ?>
                                                 </h3>
                                                <p>Total balance</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="stat-widget d-flex align-items-center">
                                            <div class="widget-icon me-3 bg-primary"><span><i
                                                    class="bi-cash-stack"></i></span></div>
                                            <div class="widget-content">
                                                <h3>$<?php
                                                        $myref = $fetch['refid'];
                                                        $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                                        $count = mysqli_num_rows($test);
                                                        $refCash = $count * 20;
                                                        if (($fetchcoin['btc'] * $btcPrice) < 250) {
                                                            $btc = 0;
                                                         }else {
                                                            $btc = $fetchcoin['btc'] * $btcPrice;
                                                         }
                                                         if (($fetchcoin['eth'] * $ethPrice) < 250) {
                                                            $eth = 0;
                                                         }else {
                                                            $eth = $fetchcoin['eth'] * $ethPrice;
                                                         }
                                                         if (($fetchcoin['bnb'] * $bchPrice) < 250) {
                                                            $bnb = 0;
                                                         }else {
                                                            $bnb = $fetchcoin['bnb'] * $bchPrice;
                                                         }
                                                        $total = $btc + $eth + $bnb + $refCash;
                                                        if ($total == 0) {
                                                            echo '0.00';
                                                        }else {
                                                            echo toMoney($total);
                                                        }
                                                    ?>
                                                 </h3>
                                                <p>withdrawable balance</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="stat-widget d-flex align-items-center">
                                            <div class="widget-icon me-3 bg-success"><span><i
                                                    class="ri-briefcase-line"></i></span></div>
                                            <div class="widget-content">
                                                <h3>
                                                    <?php
                                                        $inv = $mysqli->query("SELECT * FROM investment WHERE email = '$email'");
                                                        $fetchInv = $inv->fetch_array();
                                                        if ($fetchInv['plan'] == 0 & $total <= 199) {
                                                            echo '<a href="deposit.php" class="btn btn-primary">Deposit</a>';
                                                        }elseif ($fetchInv['plan'] == 0 & $total >= 250) {
                                                            echo '<a href="plan.php" class="btn btn-primary">Invest now</a>';
                                                        ?>
                                                    </h3>
                                                    <p></p>
                                                    <?php
                                                        }else{
                                                            echo $fetchPlan['name'];
                                                    ?>
                                                            </h3>
                                                            <p>Active plan</p> 
                                                    <?php   
                                                        }
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="stat-widget d-flex align-items-center">
                                            <div class="widget-icon me-3 bg-danger"><span><i
                                                    class="ri-wallet-3-line"></i></span></div>
                                            <div class="widget-content">
                                                <h3>
                                            <?php
                                                        $inv = $mysqli->query("SELECT * FROM investment WHERE email = '$email'");
                                                        $fetchInv = $inv->fetch_array();
                                                        if ($fetchInv['plan'] == 0) {
                                                            echo '0.00%';
                                                        ?>
                                                    </h3>
                                                    <p>Interest Rate</p>
                                                    <?php
                                                        }else{
                                                            $plan = $fetchInv['plan'];
                                                            $getPlan = $mysqli->query("SELECT * FROM plans WHERE id = '$plan'");
                                                            $fetchPlan = $getPlan->fetch_array();
                                                            echo $fetchPlan['interest'].'%';
                                                    ?>
                                                            </h3>
                                                            <p>Interest Rate</p> 
                                                    <?php   
                                                        }
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                        <div class="stat-widget d-flex align-items-center">
                                            <div class="widget-icon me-3 bg-secondary"><span><i
                                                    class="ri-user-add-line"></i></span></div>
                                            <div class="widget-content">
                                                <h3>$<?php
                                                    if ($total == 0) {
                                                        echo '0.00';
                                                    }else {
                                                        echo toMoney($count * 20);
                                                    }
                                                ?></h3>
                                                <p>Referral Earnings</p>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="stat-widget d-flex align-items-center">
                                                <div class="widget-icon me-3 bg-primary"><span><i
                                                        class="ri-swap-box-line"></i></span></div>
                                                <div class="widget-content">
                                                    <?php
                                                            $deposit = $mysqli->query("SELECT * FROM deposit WHERE email ='$email' AND status = 0 ORDER BY date DESC  LIMIT 1");
                                                            if ($deposit) {
                                                                $fetchDepo = $deposit->fetch_array();
                                                                $echo = $fetchDepo['amount'];
                                                                if ($echo > 0) {
                                                                    $col = "class='text-warning'";
                                                                }else {
                                                                    $col = "";
                                                                }
                                                            }else {
                                                                $col = "";
                                                                $echo=0;
                                                            }
                                                        ?>
                                                    <h3 <?php echo $col?>>$<?php echo toMoney($echo)?>
                                                    </h3>
                                                    <p>Pending Deposit</p> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="stat-widget d-flex align-items-center">
                                                <div class="widget-icon me-3 bg-primary"><span><i
                                                        class="ri-wallet-line"></i></span></div>
                                                <div class="widget-content">
                                                    <?php
                                                    $with = $mysqli->query("SELECT * FROM withdraw WHERE email ='$email' AND status = 0 ORDER BY date DESC LIMIT 1");
                                                    if ($with) {
                                                        $fetchDepo = $with->fetch_array();
                                                        $echo = $fetchDepo['amount'];
                                                        if ($echo > 0) {
                                                            $col = "class='text-warning'";
                                                        }else {
                                                            $col = "";
                                                        }
                                                    }else {
                                                        $echo = 0;
                                                        $col = "";
                                                    }
                                                    ?>
                                                    <h3 <?php echo $col?>>$<?php echo toMoney($echo) ?>
                                                    </h3>
                                                    <p>Pending Withdrawal</p> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="stat-widget d-flex align-items-center">
                                                <div class="widget-icon me-3 bg-primary"><span><i
                                                        class="ri-wallet-line"></i></span></div>
                                                <div class="widget-content">
                                                <?php
                                                    $deposit = $mysqli->query("SELECT * FROM withdraw WHERE email ='$email' AND status = 1 ORDER BY date DESC LIMIT 1");
                                                    if ($deposit) {
                                                        $fetchDepo = $deposit->fetch_array();
                                                        $echo = $fetchDepo['amount'];
                                                        if ($echo > 0) {
                                                            $col = "style='color: rgb(13, 194, 13);'";
                                                            $sign = "-";
                                                        }else {
                                                            $col = "";
                                                            $sign = NULL;
                                                        }
                                                    }else {
                                                            $sign = NULL;
                                                            $col = "";
                                                        $echo=0;
                                                    }
                                                    ?>
                                                    <h3 <?php echo $col?>><?php echo $sign?> $<?php echo toMoney($echo) ?>
                                                    <p>Last Withdrawal</p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Investment History</h4>
                                    <a href="transactions.php"></a>
                                </div>
                                <div class="card-body">
                                    <div class="invoice-content">
                                        <ul>
                                        <?php
                                            $depoHis = $mysqli->query("SELECT * FROM transactions WHERE email = '$email' ORDER BY id desc");
                                            if ($depoHis) {
                                            while ($depo = $depoHis->fetch_array() ) {
                                        ?>
                                            <?php
                                                    if ($depo['type'] == 2) {
                                            ?>
                                            <li class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="invoice-user-img me-3"><img src="images/dInve.png" alt=""
                                                            width="50"></div>
                                                    <div class="invoice-info">
                                                        <h5 class="mb-0">Invested</h5>
                                                        <p> <?php echo date("d M Y", strtotime($depo['date']))." at ".date("h:m a", strtotime($depo['date'])) ?></p>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <h5 class="mb-2 text-danger">- $<?php echo toMoney($depo['amount']);?></h5>
                                                    <span class=" text-white bg-danger">paid</span>
                                                </div>
                                            </li>
                                            
                                            <?php
                                                    }elseif ($depo['type'] == 5) {
                                            ?>
                                            <li class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="invoice-user-img me-3"><img src="images/dInve.png" alt=""
                                                            width="50"></div>
                                                    <div class="invoice-info">
                                                        <h5 class="mb-0">You withdrew to wallet</h5>
                                                        <p> <?php echo date("d M Y", strtotime($depo['date']))." at ".date("h:m a", strtotime($depo['date'])) ?></p>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <h5 class="mb-2 text-success">+ $<?php echo toMoney($depo['amount']);?></h5>
                                                    <span class=" text-white bg-success">successful</span>
                                                </div>
                                            </li>
                                            <?php
                                                    }
                                                }
                                            }else {
                                            ?>
                                            <li class='text-center'>NO data</li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Recent Transactions</h4>
                                    <a href="transactions.php"></a>
                                </div>
                                <div class="card-body">
                                    <div class="invoice-content">
                                        <ul>
                                        <?php
                                        $cn = 0;
                                            $depoHis = $mysqli->query("SELECT * FROM transactions WHERE email = '$email' ORDER BY id desc");
                                            if ($depoHis) {
                                            while ($depo = $depoHis->fetch_array() ) {
                                                if ($cn == 3) {
                                                    break;
                                                }
                                                if ($depo['type'] == 1) {
                                                    $cn++;

                                        ?>
                                            <li class="d-flex justify-content-between active">
                                                <div class="d-flex align-items-center">
                                                    <div class="invoice-user-img me-3"><img src="images/deposit.png" alt="" width="50"></div>
                                                    <div class="invoice-info">
                                                        <h5 class="mb-0">Deposit</h5>
                                                        <p> <?php echo date("d M Y", strtotime($depo['date']))." at ".date("h:m a", strtotime($depo['date'])) ?></p>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <h5 class="mb-2">+ $<?php echo toMoney($depo['amount']);?></h5>
                                                    <?php
                                                        if ($depo['status'] == 0) {
                                                            echo '<span class=" text-white bg-warning">Pending</span>';
                                                        }elseif ($depo['status'] == 1) {
                                                            echo '<span class=" text-white bg-success">Comfirmed</span>';
                                                        }else {
                                                            echo '<span class=" text-white bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </div>
                                            </li>

                                            <?php
                                                    }elseif ($depo['type'] == 6) {
                                                        $cn++;
                                            ?>
                                            <li class="d-flex justify-content-between active">
                                                <div class="d-flex align-items-center">
                                                    <div class="invoice-user-img me-3"><img src="images/deposit.png" alt="" width="50"></div>
                                                    <div class="invoice-info">
                                                        <h5 class="mb-0">Withrawal</h5>
                                                        <p> <?php echo date("d M Y", strtotime($depo['date']))." at ".date("h:m a", strtotime($depo['date'])) ?></p>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <h5 class="mb-2">- $<?php echo toMoney($depo['amount']);?></h5>
                                                    <?php
                                                        if ($depo['status'] == 0) {
                                                            echo '<span class=" text-white bg-warning">Pending</span>';
                                                        }elseif ($depo['status'] == 1) {
                                                            echo '<span class=" text-white bg-success">Comfirmed</span>';
                                                        }else {
                                                            echo '<span class=" text-white bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </div>
                                            </li>
                                            <?php
                                                    }
                                                }
                                            }else {
                                            ?>
                                            <li class='text-center'>NO data</li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-xl-12" style="height: max-content;">
                            <div class="card" style='height: max-content;'>
                                <div class="card-header">
                                    <h4 class="card-title">Monitor progress</h4>
                                </div>
                                <div class="card-body">
                                    <div class="budget-content">
                                        <ul>
                                            <?php
                                            if ($fetchInv['plan'] == 0) {
                                                $check = 0;
                                            }else {
                                                $start = strtotime($fetchInv['startdate'])/86400;
                                                $end = strtotime($fetchInv['enddate'])/86400;
                                                $now = strtotime(date('Y-m-d H:m:i'))/86400;
                                                $last = $fetchPlan['length'];
                                                $curr = ($fetchPlan['interest']*($now - $start)/ 100) * $fetchInv['paid'];
                                                $finale = (($fetchPlan['interest']/100) * $fetchInv['paid']) * $fetchPlan['length'];
                                                $var = $finale / 100;
                                                $check = $curr / $var;
                                                if ($check < 100) {
                                                    $check = $check;
                                                }else {
                                                    $check = 100;
                                                }
                                            }
                                            ?>
                                            <li class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex flex-grow-2">
                                                    <div class="budget-icon me-3 mt-1"><img src="images/social/invest.png" alt="" width="40"></div>
                                                    <div class="budget-info flex-grow-2 me-3">
                                                        <div class="d-flex justify-content-between mb-1">
                                                            <h5 class="mb-1">Investment Progress</h5>
                                                            <p class="mb-0"><strong><?php echo intval($check)?> </strong>/ 100</p>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: <?php echo intval($check)?>%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
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
                                                
                                            ?>
                                            <li class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex flex-grow-2">
                                                    <div class="budget-icon me-3 mt-1"><img src="images/social/profile.png" alt="" width="40"></div>
                                                    <div class="budget-info flex-grow-2 me-3">
                                                        <div class="d-flex justify-content-between mb-1">
                                                            <h5 class="mb-1">Account setup progess</h5>
                                                            <p class="mb-0"><strong><?php echo $percent;?> </strong>/ 100</p>
                                                        </div>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" style="width: <?php echo $percent;?>%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
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


    <script src="vendor/chartjs/chartjs.js"></script>



    <script src="js/plugins/chartjs-line-init.js"></script>




    <script src="js/plugins/chartjs-donut.js"></script>






    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="js/plugins/perfect-scrollbar-init.js"></script>



    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="js/plugins/circle-progress-init.js"></script>







    <script src="js/scripts.js"></script>
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
</body>



</html>
<?php
    }
?>