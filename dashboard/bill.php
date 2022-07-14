<?php
session_start();
function toMoney($e)
{
    $decimal = 2;
    $decimalChar = '.';
    $thousandSeperator = ',';
    return number_format($e, $decimal, $decimalChar, $thousandSeperator);
}
function toCrypto($e)
{
    $decimal = 8;
    $decimalChar = '.';
    $thousandSeperator = ',';
    return number_format($e, $decimal, $decimalChar, $thousandSeperator);
}
include 'sqlcon.php';
if (!isset($_SESSION['cry'])) {
    header("location: signin.php");
} else {
    $email = $_SESSION['cry'];
    $get = $mysqli->query("SELECT * FROM account WHERE email = '$email' LIMIT 1");
    $getcoin = $mysqli->query("SELECT * FROM coinhold WHERE email = '$email' LIMIT 1");
    $getInvest = $mysqli->query("SELECT * FROM investment WHERE email = '$email' LIMIT 1");
    $fetchInvest = $getInvest->fetch_array();
    $fetch = $get->fetch_array();
    $fetchcoin = $getcoin->fetch_array();

    $addr = $fetch['address'];
    $post = $fetch['postcode'];
    $city = $fetch['city'];
    $img = $fetch['img'];
    $country = $fetch['country'];
    $phone = $fetch['phone'];
    $num = 8;
    $per = 100 / 8;
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

    if ($percent < 100) {
        echo "<script>alert('Please complete setting up your account to access this page, your account is $percent% complete')</script>";
        echo "<script>window.location.href='settings-profile.php';</script>";
    } elseif ($fetchInvest['plan'] == 0) {
        echo "<script>alert('You have no active investment plan yet, get a plan.')</script>";
        echo "<script>window.location.href='plan.php';</script>";
    } else {

?>
        <!DOCTYPE html>
        <html lang="en">


        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?php echo $fetch['name'] ?> | Investments</title>
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
                                                                        <p><?php echo "Account created successfully"; ?></p>
                                                                        <span><?php echo $a['date'] ?></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div>

                                                            </div>
                                                            </a>
                                                        <?php
                                                        } elseif ($a['type'] == 2) {
                                                        ?>
                                                            <a class="" href="#">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                                    <div>
                                                                        <p><?php echo "Account setup complete"; ?></p>
                                                                        <span><?php echo $a['date'] ?></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div>

                                                            </div>
                                                            </a>
                                                            </a>
                                                        <?php
                                                        } elseif ($a['type'] == 7) {
                                                        ?>
                                                            <a class="" href="#">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-3 icon pending"><i class="ri-link-m"></i></span>
                                                                    <div>
                                                                        <p><?php echo "New Referral link click"; ?></p>
                                                                        <span><?php echo $a['date'] ?></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div>

                                                            </div>
                                                            </a>
                                                            </a>
                                                        <?php
                                                        } elseif ($a['type'] == 8) {
                                                        ?>
                                                            <a class="" href="#">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-3 icon success"><i class="ri-user-add-line"></i></span>
                                                                    <div>
                                                                        <p><?php echo "New referral"; ?></p>
                                                                        <span><?php echo $a['date'] ?></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div>

                                                            </div>
                                                            </a>
                                                            </a>
                                                        <?php
                                                        } elseif ($a['type'] == 4) {
                                                            $amout = '$' . toMoney($a['amount']);
                                                        ?>
                                                            <a class="" href="#">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                                    <div>
                                                                        <p><?php echo "You Invested $amout"; ?></p>
                                                                        <span><?php echo $a['date'] ?></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div>

                                                            </div>
                                                            </a>
                                                            </a>
                                                        <?php
                                                        } elseif ($a['type'] == 5) {
                                                            $amout = '$' . toMoney($a['amount']);
                                                        ?>
                                                            <a class="" href="#">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                                    <div>
                                                                        <p><?php echo "You exported your investment <br> earnings ($amout)"; ?></p>
                                                                        <span><?php echo $a['date'] ?></span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                            <div>

                                                            </div>
                                                            </a>
                                                            <?php
                                                        } elseif ($a['type'] == 3) {
                                                            $am = toMoney($a['amount']);
                                                            if ($a['status'] == 0) {
                                                            ?>
                                                                <a class="" href="#">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-3 icon pending"><i class="ri-question-mark"></i></span>
                                                                        <div>
                                                                            <p><?php echo "Pending deposit of $$am"; ?></p>
                                                                            <span><?php echo $a['date'] ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div>

                                                                </div>
                                                                </a>
                                                            <?php
                                                            } elseif ($a['status'] == 1) {
                                                            ?>
                                                                <a class="" href="#">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                                        <div>
                                                                            <p><?php echo "Deposit of $$am has been verified"; ?></p>
                                                                            <span><?php echo $a['date'] ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div>

                                                                </div>
                                                                </a>
                                                            <?php
                                                            } elseif ($a['status'] == 2) {
                                                            ?>
                                                                <a class="" href="#">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-3 icon fail"><i class="bi bi-x"></i></span>
                                                                        <div>
                                                                            <p><?php echo "Deposit of $$am was declined"; ?></p>
                                                                            <span><?php echo $a['date'] ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div>

                                                                </div>
                                                                </a>
                                                            <?php
                                                            }
                                                        } elseif ($a['type'] == 6) {
                                                            $am = toMoney($a['amount']);
                                                            if ($a['status'] == 0) {
                                                            ?>
                                                                <a class="" href="#">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-3 icon pending"><i class="ri-question-mark"></i></span>
                                                                        <div>
                                                                            <p><?php echo "Pending withdrawal of $$am"; ?></p>
                                                                            <span><?php echo $a['date'] ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div>

                                                                </div>
                                                                </a>
                                                            <?php
                                                            } elseif ($a['status'] == 1) {
                                                            ?>
                                                                <a class="" href="#">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-3 icon success"><i class="ri-check-double-line"></i></span>
                                                                        <div>
                                                                            <p><?php echo "Withdrawal of $$am has been verified"; ?></p>
                                                                            <span><?php echo $a['date'] ?></span>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                                <div>

                                                                </div>
                                                                </a>
                                                            <?php
                                                            } elseif ($a['status'] == 2) {
                                                            ?>
                                                                <a class="" href="#">
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="me-3 icon fail"><i class="bi bi-x"></i></span>
                                                                        <div>
                                                                            <p><?php echo "Withdrawal of $$am was declined"; ?></p>
                                                                            <span><?php echo $a['date'] ?></span>
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
                                                        <span class="thumb"><img src="<?php echo $fetch['img'] ?>" alt=""></span>
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

                                                <a class="dropdown-item logout" onclick='logout()'><i class="ri-logout-circle-line"></i>Logout</a>
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
                                    <span><i class="ri-user-3-line"></i></span>
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
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <?php
                                        $inv = $mysqli->query("SELECT * FROM investment WHERE email = '$email'");
                                        $fetchInv = $inv->fetch_array();

                                        $plan = $fetchInv['plan'];
                                        $getPlan = $mysqli->query("SELECT * FROM plans WHERE id = '$plan'");
                                        $fetchPlan = $getPlan->fetch_array();
                                        $start = strtotime($fetchInvest['startdate']) / 86400;
                                        $end = strtotime($fetchInvest['enddate']) / 86400;
                                        $now = strtotime(date('Y-m-d H:m:i')) / 86400;
                                        ?>
                                        <h4 class="card-title">Investment Dashboard</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-primary"><span><i class="ri-calendar-2-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3>
                                                            <?php
                                                            if (intval($now - $start) < intval($end - $start)) {
                                                                echo 'Day ' . intval($now - $start);
                                                            } else {
                                                                echo 'End';
                                                            }
                                                            ?>
                                                        </h3>
                                                        <p>Invest day</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-success"><span><i class="ri-line-chart-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3 style='color: rgb(13, 194, 13);'>+ $<?php
                                                                                                if (intval($now - $start) < intval($end - $start)) {
                                                                                                    echo toMoney(($fetchPlan['interest'] * ($now - $start) / 100) * $fetchInvest['paid']);
                                                                                                } else {
                                                                                                    echo toMoney(($fetchPlan['interest'] * ($fetchPlan['length']) / 100) * $fetchInvest['paid']);
                                                                                                }
                                                                                                ?>
                                                        </h3>
                                                        <p>Current Investment profit</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-warning"><span><i class="ri-calendar-check-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3>$<?php
                                                                if (intval($now - $start) < intval($end - $start)) {
                                                                    echo toMoney((($fetchPlan['interest'] / 100) * $fetchInvest['paid']) * intval(($now - $start) + 1));
                                                                } else {
                                                                    echo toMoney((($fetchPlan['interest'] / 100) * $fetchInvest['paid']) * $fetchPlan['length']);
                                                                }
                                                                ?></h3>
                                                        <p>Expected profit milestone</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-primary"><span><i class="bi-cash-stack"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3>$<?php
                                                                echo toMoney($fetchInvest['paid']);
                                                                ?>
                                                        </h3>
                                                        <p>Amount invested (Principal)</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-success"><span><i class="ri-briefcase-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3> <?php
                                                                echo $fetchPlan['name'];
                                                                ?>
                                                        </h3>
                                                        <p>Active plan</p>
                                                        <?php
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-danger"><span><i class="ri-wallet-3-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3>
                                                            <?php
                                                            $inv = $mysqli->query("SELECT * FROM investment WHERE email = '$email'");
                                                            $fetchInv = $inv->fetch_array();
                                                            ?>
                                                            <?php
                                                            $plan = $fetchInv['plan'];
                                                            $getPlan = $mysqli->query("SELECT * FROM plans WHERE id = '$plan'");
                                                            $fetchPlan = $getPlan->fetch_array();
                                                            echo $fetchPlan['interest'] . '%';
                                                            ?>
                                                        </h3>
                                                        <p>Interest Rate</p>
                                                        <?php
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-primary"><span><i class="ri-calendar-2-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3>
                                                            <?php
                                                            echo $fetchPlan['length'] . ' Days';
                                                            ?>
                                                        </h3>
                                                        <p>Invest Length</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-primary"><span><i class="ri-wallet-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3 style='color: rgb(13, 194, 13);'>$<?php
                                                                                                if (intval($now - $start) < intval($end - $start)) {
                                                                                                    echo toMoney($fetchInvest['paid'] + ($fetchPlan['interest'] * ($now - $start) / 100) * $fetchInvest['paid']);
                                                                                                } else {
                                                                                                    echo toMoney($fetchInvest['paid'] + ($fetchPlan['interest'] * ($fetchPlan['length']) / 100) * $fetchInvest['paid']);
                                                                                                }
                                                                                                ?></h3>
                                                        <p>Total Balance</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-primary"><span><i class="ri-calendar-2-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3>
                                                            <?php echo date('(l) F d, Y', strtotime($fetchInvest['startdate'])) ?>
                                                        </h3>
                                                        <p>Start Date</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="stat-widget d-flex align-items-center">
                                                    <div class="widget-icon me-3 bg-primary"><span><i class="ri-calendar-2-line"></i></span></div>
                                                    <div class="widget-content">
                                                        <h3>
                                                            <?php echo date('(l) F d, Y', strtotime($fetchInvest['enddate'])) ?>
                                                        </h3>
                                                        <p>End Date</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php
                            if (intval($now - $start) >= intval($end - $start)) {
                            ?>
                                <button type="button" class="btn btn-success m-2" data-toggle="modal" data-target="#addCard">Export to wallet</button>
                            <?php
                            }
                            ?>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>

            </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addCard" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCardLabel">Export to main wallet</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="identity-upload" method='POST'>
                                <div class="row g-3">
                                    <div class="col-xl-12">
                                        <label class="form-label">Transaction Type</label>
                                        <input type="text" class="form-control" name="" placeholder="Withdraw to my wallet" disabled>
                                    </div>
                                    <div class="col-xl-12">
                                        <label class="form-label">Amount</label>
                                        <input type="text" class="form-control" name="" value="$<?php echo toMoney($fetchInvest['paid'] + ($fetchPlan['interest'] * ($fetchPlan['length']) / 100) * $fetchInvest['paid']); ?>" disabled>
                                    </div>
                                    <div class="col-xl-4">
                                        <label class="form-label">Select Cryptocurrency</label>
                                        <select class="form-select" name="coin" required>
                                            <option value="1">Bitcoin (BTC)</option>
                                            <option value="2">Etheruem (ETH)</option>
                                            <option value="3">Bitcoin cash (BCH)</option>
                                        </select>

                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="with" class="btn btn-primary">withdraw</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['with'])) {
                $amount = ($fetchInvest['paid'] + ($fetchPlan['interest'] * ($fetchPlan['length']) / 100) * $fetchInvest['paid']);
                $chosen_amount = $amount;
                $coin = $_POST['coin'];

                $coin = $mysqli->real_escape_string($coin);

                if ($coin == NULL | $coin < 1 | $coin > 3) {
                    echo "<script>alert('Please select a valid cryptocurrency from to list provide!')</script>";
                } else {
                    if ($coin == 1) {
                        $coin = 'btc';
                        $amount = $amount / $btcPrice;
                    } elseif ($coin == 2) {
                        $coin = 'eth';
                        $amount = $amount / $ethPrice;
                    } elseif ($coin == 3) {
                        $amount = $amount / $bchPrice;
                        $coin = 'bnb';
                    }

                    $amount = $amount + $fetchcoin[$coin];
                    $query = $mysqli->query("UPDATE coinhold SET $coin = '$amount' WHERE email = '$email' LIMIT 1");
                    if ($query) {
                        $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','5','$chosen_amount')");
                        $transac = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','5','$chosen_amount')");
                        $query = $mysqli->query("UPDATE investment SET plan = '0', paid = '0' WHERE email = '$email' LIMIT 1");
                        echo "<script>alert('Done!')</script>";
                        echo "<script>window.location.href='balance.php'</script>";
                    } else {
                        echo "<script>alert('" . $mysqli->error . ", this is not you fault!')</script>";
                    }
                }
            }
            ?>
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


            <script src="vendor/chartjs/chartjs.js"></script>




            <script src="js/plugins/chartjs-bar-init.js"></script>




            <script>
                function logout() {
                    if (confirm("Are you sure you want to logout?")) {
                        window.location.href = 'logout.php';
                    }
                }
            </script>






            <script type="text/javascript">
                // <![CDATA[
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'en',
                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                    }, 'google_translate_element');
                }
                // ]]>
            </script>
            <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>




            <script src="js/scripts.js"></script>


        </body>


        </html>

<?php
    }
}
?>