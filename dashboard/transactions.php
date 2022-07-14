<?php
    include 'sqlcon.php';
    
function toMoney($e){
    $decimal = 2;
    $decimalChar = '.';
    $thousandSeperator = ',';
    return number_format($e, $decimal,$decimalChar,$thousandSeperator);
 }
    session_start();
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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fetch['name']?> | Transactions</title>
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
    <div class="brand-logo"><a class="full-logo" href="index-2.html"><img src="images/logoi.png" alt="" width="40"></a></div>
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
                            <h3>Transactions</h3>
                            <p class="mb-2"> Welcome your xtions dashboard</p>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="breadcrumbs"><a href="index.php">Home </a><span><i
                                    class="ri-arrow-right-s-line"></i></span><a href="#">Transactions</a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-primary"><span><i class="ri-file-copy-2-line"></i></span></div>
                        <div class="widget-content">
                            <h3><?php echo $total?></h3>
                            <p>Total Transactions</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-success"><span><i class="ri-file-list-3-line"></i></span></div>
                        <div class="widget-content">
                            <h3>$<?php echo toMoney($ver_depo)?></h3>
                            <p>Approved Deposits</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-warning"><span><i class="ri-file-paper-line"></i></span></div>
                        <div class="widget-content">
                            <h3>$<?php echo toMoney($pen_depo)?></h3>
                            <p>Pending Deposits</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-danger"><span><i class="ri-file-paper-2-line"></i></span></div>
                        <div class="widget-content">
                            <h3>$<?php echo toMoney($can_depo)?></h3>
                            <p>Cancelled Deposits</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-primary"><span><i class="ri-file-download-line"></i></span></div>
                        <div class="widget-content">
                        <?php
                            if ($investPro > 0) {
                                $col = "style='color: rgb(13, 194, 13);'";
                                $sign = '+';
                            }else {
                                $col = "";
                                $sign = '';
                            }
                            ?>
                            <h3 <?php echo $col ?>><?php echo $sign ?> $<?php echo toMoney($investPro)?></h3>
                            <p>Investment Profit</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-success"><span><i class="ri-hand-coin-fill"></i></span></div>
                        <div class="widget-content">
                            <?php
                            if ($ver_with > 0) {
                                $col = "style='color: rgb(13, 194, 13);'";
                                $sign = '+';
                            }else {
                                $col = "";
                                $sign = '';
                            }
                            ?>
                            <h3 <?php echo $col?>><?php echo $sign?> $<?php echo toMoney($ver_with)?></h3>
                            <p>Approved Withdrawal</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-warning"><span><i class="ri-hand-coin-line"></i></span></div>
                        <div class="widget-content">
                            <h3>$<?php echo toMoney($pen_with)?></h3>
                            <p>Pending Withdrawals</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="stat-widget d-flex align-items-center bg-white">
                        <div class="widget-icon me-3 bg-danger"><span><i class="ri-delete-bin-line"></i></span></div>
                        <div class="widget-content">
                            <h3>$<?php echo toMoney($can_with)?></h3>
                            <p>Cancelled Withdrawals</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-6 col-md-6 text-center">
                    <div class="card-header flex-row">
                        <h4 class="card-title text-center">Navigate</h4>
                    </div>
                        <a href="#deposit">
                            <div class="col-l-4 btn btn-primary btn-block" style='margin: 5px;'>
                                <button type="submit" class="btn btn-primary btn-block">Deposit</button>
                            </div>
                        </a>
                        <a href="#with">
                            <div class="col-l-4 btn btn-primary btn-block" style='margin: 5px;'>
                                <button type="submit" class="btn btn-primary btn-block">Withdrawals</button>
                            </div>
                        </a>
                        <a href="#trans">
                            <div class="col-l-4 btn btn-primary btn-block" style='margin: 5px;'>
                                <button type="submit" class="btn btn-primary btn-block">All Transactions</button>
                            </div>
                        </a>
                        <br>
                        <br>
                </div>
                <div class="col-xl-12" id="trans">
                    <div class="card">
                        <div class="card-header flex-row">
                            <h4 class="card-title">Investment History</h4>
                            
                        </div>
                        <div class="card-body">
                            <div class="invoice-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check">S/N</div>
                                                </th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 0;
                                                $list = $mysqli->query("SELECT * FROM transactions WHERE email ='$email' ORDER BY date DESC LIMIT 5");
                                                while ($fetchLs = $list->fetch_array()) {
                                            ?>
                                            <?php if ($fetchLs['type'] == 2) {
                                                    $sn++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/invest.png" alt="" width="30"
                                                        class="me-2">Bought an Investment plan</td>
                                                <td style='color: rgb(237, 43, 43)'>- $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 5) {
                                                $sn++;

                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn?>
                                                </td>
                                                <td><img src="images/ico/invest.png" alt="" width="30"
                                                        class="me-2">Investment Profit Export</td>
                                                <td style='color: rgb(13, 194, 13);'>+ $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?
                                                }
                                            ?>
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




                <div class="col-xl-12 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-header flex-row">
                            <h4 class="card-title" id="deposit">Deposit History</h4>
                            
                        </div>
                        <div class="card-body">
                            <div class="invoice-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check">S/N</div>
                                                </th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 0;
                                                $list = $mysqli->query("SELECT * FROM transactions WHERE email ='$email' ORDER BY date DESC");
                                                while ($fetchLs = $list->fetch_array()) {
                                            ?>
                                            <?php if ($fetchLs['type'] == 1 & $fetchLs['status'] == 0) {
                                                $sn++;
                                            ?>
                                            <tr>
                                                <td>
                                                <?php 
                                                    echo $sn;
                                                    if ($fetchLs['status'] == 0) {
                                                        $bg = 'text-warning';
                                                    }elseif ($fetchLs['status'] == 1) {
                                                        $bg = 'text-success';
                                                    }else {
                                                        $bg = 'text-danger';
                                                    }
                                                    ?>
                                                </td>
                                                <td><img src="images/ico/pending-depo.png" alt="" width="30"
                                                        class="me-2">Deposit</td>
                                                <td class="">+ $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            
                                            <?php }elseif ($fetchLs['type'] == 1 & $fetchLs['status'] == 1) {
                                                $sn++;
                                                if ($fetchLs['status'] == 0) {
                                                    $bg = 'text-warning';
                                                }elseif ($fetchLs['status'] == 1) {
                                                    $bg = 'text-success';
                                                }else {
                                                    $bg = 'text-danger';
                                                }

                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/approve-depo.png" alt="" width="30"
                                                        class="me-2">Deposit</td>
                                                <td class="<?php echo $bg?>">+ $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 1 & $fetchLs['status'] == 2) {
                                                $sn++;
                                                if ($fetchLs['status'] == 0) {
                                                    $bg = 'text-warning';
                                                }elseif ($fetchLs['status'] == 1) {
                                                    $bg = 'text-success';
                                                }else {
                                                    $bg = 'text-danger';
                                                }

                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/cancel-depo.png" alt="" width="30"
                                                        class="me-2">Deposit</td>
                                                <td class="<?php echo $bg?>">+ $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?
                                                }
                                            ?>
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





                <div class="col-xl-12 col-lg-6 col-md-6" id="with">
                    <div class="card">
                        <div class="card-header flex-row">
                            <h4 class="card-title">Withdrawal History </h4>
                            
                        </div>
                        <div class="card-body">
                            <div class="invoice-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check">S/N</div>
                                                </th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 0;
                                                $list = $mysqli->query("SELECT * FROM transactions WHERE email ='$email' ORDER BY date DESC");
                                                while ($fetchLs = $list->fetch_array()) {
                                            ?>
                                            <?php if ($fetchLs['type'] == 6 & $fetchLs['status'] == 1) {
                                                $sn++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/approve-with.png" alt="" width="30"
                                                        class="me-2">Withdraw</td>
                                                <td <?php echo $col?>><?php echo $sign ?> $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 6 & $fetchLs['status'] == 0) {
                                                $sn++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/pending-with.png" alt="" width="30"
                                                        class="me-2">Withdraw</td>
                                                <td class="text-warning">+ $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 6 & $fetchLs['status'] == 2) {
                                                $sn++;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/cancel-with.png" alt="" width="30"
                                                        class="me-2">Withdraw</td>
                                                <td>$<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-12" id="trans">
                    <div class="card">
                        <div class="card-header flex-row">
                            <h4 class="card-title">All Transactions History </h4>
                            
                        </div>
                        <div class="card-body">
                            <div class="invoice-table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-check">S/N</div>
                                                </th>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sn = 0;
                                                $list = $mysqli->query("SELECT * FROM transactions WHERE email ='$email' ORDER BY date DESC");
                                                while ($fetchLs = $list->fetch_array()) {
                                                    $sn++;
                                            ?>
                                            <?php if ($fetchLs['type'] == 1 & $fetchLs['status'] == 0) {
                                            ?>
                                            <tr>
                                                <td>
                                                <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/pending-depo.png" alt="" width="30"
                                                        class="me-2">Deposit</td>
                                                <td>$<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            
                                            <?php }elseif ($fetchLs['type'] == 1 & $fetchLs['status'] == 1) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/cancel-depo.png" alt="" width="30"
                                                        class="me-2">Deposit</td>
                                                <td>$<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 1 & $fetchLs['status'] == 2) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/approve-depo.png" alt="" width="30"
                                                        class="me-2">Deposit</td>
                                                <td>$<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 6 & $fetchLs['status'] == 1) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/approve-with.png" alt="" width="30"
                                                        class="me-2">Withdraw</td>
                                                <td <?php echo $col?>><?php echo $sign ?> $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 6 & $fetchLs['status'] == 0) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/pending-with.png" alt="" width="30"
                                                        class="me-2">Withdraw</td>
                                                <td>$<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        if ($fetchLs['status'] == 0) {
                                                            echo '<span class="badge px-3 py-2 bg-warning">Pending</span>';
                                                        }elseif ($fetchLs['status'] == 1) {
                                                            echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                        }else {
                                                            echo '<span class="badge px-3 py-2 bg-danger">Declined</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 2) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn ?>
                                                </td>
                                                <td><img src="images/ico/invest.png" alt="" width="30"
                                                        class="me-2">Bought an Investment plan</td>
                                                <td style='color: rgb(237, 43, 43)'>- $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php }elseif ($fetchLs['type'] == 5) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $sn?>
                                                </td>
                                                <td><img src="images/ico/invest.png" alt="" width="30"
                                                        class="me-2">Investment Profit Export</td>
                                                <td style='color: rgb(13, 194, 13);'>+ $<?php echo toMoney($fetchLs['amount']) ?></td>
                                                <td>
                                                    <?php
                                                        echo '<span class="badge px-3 py-2 bg-success">Successful</span>';
                                                    ?>
                                                </td>
                                                <td><?php echo date('F d, Y <p> h:m:i a', strtotime($fetchLs['date']))?></td>
                                            </tr>
                                            <?php
                                                }
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