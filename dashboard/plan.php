<?php
session_start();
function toMoney($e)
{
    $decimal = 0;
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
    $fetch = $get->fetch_array();
    $fetchcoin = $getcoin->fetch_array();
    $query = $mysqli->query("SELECT * FROM plans");
    $queryIn = $mysqli->query("SELECT * FROM investment WHERE email = '$email'");
    $isPlan = $queryIn->fetch_array();
    if (isset($_SESSION['plan'])) {
        if ($_SESSION['plan'] != 0) {
            header("location: deposit.php");
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $fetch['name'] ?> | Get a plan</title>
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
                        <div class="col-xl-12">
                            <div class="page-title">
                                <div class="row align-items-center justify-content-between">
                                    <div class="col-xl-4">
                                        <div class="page-title-content">
                                            <h3>Select a plan</h3>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">


                            <div class="row">
                                <?php
                                while ($a =  $query->fetch_array()) {
                                ?>
                                    <div class="col-xl-4 col-lg-6" name='<?php echo $a['name'] ?>'>
                                        <div class="card" id='<?php echo $a['name'] ?>'>
                                            <div class="card-header">
                                                <h4 class="card-title"><?php echo $a['name'] ?></h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="unpaid-content">
                                                    <ul>
                                                        <li>
                                                            <p class="mb-0">minimum Deposit</p>
                                                            <h5 class="mb-0">$<?php echo toMoney($a['mindepo']) ?></h5>
                                                        </li>
                                                        <li>
                                                            <p class="mb-0">Maximum Deposit</p>
                                                            <h5 class="mb-0">$<?php echo toMoney($a['maxdepo']) ?></h5>
                                                        </li>
                                                        <li>
                                                            <p class="mb-0">Daily Profit</p>
                                                            <h5 class="mb-0"><?php echo $a['interest'] ?>%</h5>
                                                        </li>
                                                        <li>
                                                            <p class="mb-0">Duration</p>
                                                            <h5 class="mb-0"><?php echo $a['length'] ?> days</h5>
                                                        </li>
                                                        <li>
                                                            <p class="mb-0">Total Profit</p>
                                                            <h5 class="mb-0"><?php echo $a['interest'] * $a['length'] ?>%</h5>
                                                        </li>
                                                        <li>
                                                            <p class="mb-0">Capital Return</p>
                                                            <h5 class="mb-0">Yes</h5>
                                                        </li>
                                                        <li>
                                                            <p class="mb-0">Instant Withdrawal</p>
                                                            <h5 class="mb-0">Yes</h5>
                                                        </li>
                                                    </ul>
                                                    <br>
                                                    <div class="text-center">
                                                        <a href='#proceed' class='btn btn-primary pl-5 pr-5'>Proceed</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-xxl-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Choose a plan: </h4>
                                            </div>
                                            <div class="card-body">
                                                <form method='POST' action="#">
                                                    <div class="col-xxl-12 col-xl-12 col-lg-12 mb-3">
                                                        <label class="form-label">Current Balance: </label>
                                                        <input type="text" class="form-control" placeholder="$<?php
                                                                                                                $myref = $fetch['refid'];
                                                                                                                $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                                                                                                $count = mysqli_num_rows($test);
                                                                                                                $refCash = $count * 20;
                                                                                                                $btc = $fetchcoin['btc'] * $btcPrice;
                                                                                                                $eth = $fetchcoin['eth'] * $ethPrice;
                                                                                                                $bnb = $fetchcoin['bnb'] * $bchPrice;
                                                                                                                $total = $btc + $eth + $bnb + $refCash;
                                                                                                                if ($total == 0) {
                                                                                                                    echo '0.00';
                                                                                                                } else {
                                                                                                                    echo toMoney($total);
                                                                                                                }
                                                                                                                ?>
                                                " disabled>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xxl-4 col-xl-4 col-lg-4 mb-3">
                                                            <label class="form-label">Bitcoin: </label>
                                                            <input type="text" class="form-control" placeholder="$<?php
                                                                                                                    $myref = $fetch['refid'];
                                                                                                                    $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                                                                                                    $count = mysqli_num_rows($test);
                                                                                                                    $refCash = $count * 20;
                                                                                                                    $btc = $fetchcoin['btc'] * $btcPrice;
                                                                                                                    $total = $btc;
                                                                                                                    if ($total == 0) {
                                                                                                                        echo '0.00';
                                                                                                                    } else {
                                                                                                                        echo toMoney($total);
                                                                                                                    }
                                                                                                                    ?>
                                                " disabled>
                                                        </div>
                                                        <div class="col-xxl-4 col-xl-4 col-lg-4 mb-3">
                                                            <label class="form-label">Ethereum: </label>
                                                            <input type="text" class="form-control" placeholder="$<?php
                                                                                                                    $myref = $fetch['refid'];
                                                                                                                    $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                                                                                                    $count = mysqli_num_rows($test);
                                                                                                                    $refCash = $count * 20;
                                                                                                                    $btc = $fetchcoin['eth'] * $ethPrice;
                                                                                                                    $total = $btc;
                                                                                                                    if ($total == 0) {
                                                                                                                        echo '0.00';
                                                                                                                    } else {
                                                                                                                        echo toMoney($total);
                                                                                                                    }
                                                                                                                    ?>
                                                " disabled>
                                                        </div>
                                                        <div class="col-xxl-4 col-xl-4 col-lg-4 mb-3">
                                                            <label class="form-label">Bitcoin Cash (BCH): </label>
                                                            <input type="text" class="form-control" placeholder="$<?php
                                                                                                                    $myref = $fetch['refid'];
                                                                                                                    $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                                                                                                    $count = mysqli_num_rows($test);
                                                                                                                    $refCash = $count * 20;
                                                                                                                    $btc = $fetchcoin['bnb'] * $bchPrice;
                                                                                                                    $total = $btc;
                                                                                                                    if ($total == 0) {
                                                                                                                        echo '0.00';
                                                                                                                    } else {
                                                                                                                        echo toMoney($total);
                                                                                                                    }
                                                                                                                    ?>
                                                " disabled>
                                                        </div>
                                                    </div>
                                                    <div class="row g-3" id='proceed'>
                                                        <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
                                                            <label class="form-label">Select a plan</label>
                                                            <select class="form-select" id='plans' name='plan' onchange='update()' required>
                                                                <?php
                                                                $queryPlan = $mysqli->query("SELECT * FROM plans");
                                                                while ($a = $queryPlan->fetch_array()) {
                                                                ?>
                                                                    <option value="<?php echo $a['id'] ?>"><?php echo $a['name'] ?> (<?php echo $a['interest'] . '%' ?>)</option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3">
                                                            <label class="form-label">Crypto Currency (to Spend )</label>
                                                            <select name='coin' class="form-select" required>
                                                                <option value="1">BITCOIN</option>
                                                                <option value="2">ETHEREUM</option>
                                                                <option value="3">BITCOIN CASH (BCH)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xxl-12 col-xl-12 col-lg-6 mb-3">
                                                            <label class="form-label">Amount</label>
                                                            <input type="number" name='amount' id='amt' class='form-control' value='200' placeholder='0.00' required>
                                                        </div>


                                                        <div class="col-12">
                                                            <button class="btn btn-primary pl-5 pr-5" name='sub' type='submit'>Continue</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <h3>
            <?php
            $plans = $mysqli->query("SELECT * FROM plans");
            while (($plan = $plans->fetch_array())) {
                if ($plan['name'] == 'Bronze') {
                    $bronze = $plan['mindepo'];
                    $hibronze = $plan['maxdepo'];
                } elseif ($plan['name'] == 'Silver') {
                    $silver = $plan['mindepo'];
                    $hisilver = $plan['maxdepo'];
                } elseif ($plan['name'] == 'Gold') {
                    $gold = $plan['mindepo'];
                    $higold = $plan['maxdepo'];
                } elseif ($plan['name'] == 'Diamond') {
                    $diam = $plan['mindepo'];
                    $hidiam = $plan['maxdepo'];
                } elseif ($plan['name'] == 'Platinum') {
                    $plat = $plan['mindepo'];
                    $hiplat = $plan['maxdepo'];
                }
            }
            ?>
            <?php
            if (isset($_POST['sub'])) {
                $err = 0;
                if ($isPlan['plan'] != 0) {
                    echo "<script>alert('You already have an active plan! please wait for the current plan to end before getting another')</script>";
                    echo "<script>window.location.href = 'bill.php';</script>";
                } else {
                    $selected_plan = $_POST['plan'];
                    $selected_crypto = $_POST['coin'];
                    $var = 'error';
                    $chosen_amount = $_POST['amount'];

                    $selected_crypto = $mysqli->real_escape_string($selected_crypto);
                    $selected_plan = $mysqli->real_escape_string($selected_plan);
                    $chosen_amount = $mysqli->real_escape_string($chosen_amount);

                    if ($selected_crypto == null | $selected_crypto == 0) {
                        $err = 1;
                        echo "<script>alert('Invalid plan selected!')</script>";
                    } elseif ($selected_plan == null | $selected_plan == 0) {
                        $err = 1;
                        echo "<script>alert('Invalid Cryptocurrency selected!')</script>";
                    } elseif ($chosen_amount == 0 | $chosen_amount == null) {
                        $err = 1;
                        echo "<script>alert('Invalid amount inputed string!')</script>";
                    }

                    if ($selected_plan == 1 & $chosen_amount < $bronze) {
                        $err = 1;
                        echo "<script>alert('Amount not upto minimum deposit for this chosen plan!')</script>";
                    } elseif ($selected_plan == 1 & $chosen_amount > $hibronze) {
                        $err = 1;
                        echo "<script>alert('Amount is above the maximum deposit, maybe choose another plan that suits your needs better!')</script>";
                    }

                    if ($selected_plan == 2 & $chosen_amount < $silver) {
                        $err = 1;
                        echo "<script>alert('Amount not upto minimum deposit for this chosen plan!')</script>";
                    } elseif ($selected_plan == 2 & $chosen_amount > $hisilver) {
                        $err = 1;
                        echo "<script>alert('Amount is above the maximum deposit, maybe choose another plan that suits your needs better!')</script>";
                    }

                    if ($selected_plan == 3 & $chosen_amount < $gold) {
                        $err = 1;
                        echo "<script>alert('Amount not upto minimum deposit for this chosen plan!')</script>";
                    } elseif ($selected_plan == 3 & $chosen_amount > $higold) {
                        $err = 1;
                        echo "<script>alert('Amount is above the maximum deposit, maybe choose another plan that suits your needs better!')</script>";
                    }

                    if ($selected_plan == 4 & $chosen_amount < $diam) {
                        $err = 1;
                        echo "<script>alert('Amount not upto minimum deposit for this chosen plan!')</script>";
                    } elseif ($selected_plan == 4 & $chosen_amount > $hidiam) {
                        $err = 1;
                        echo "<script>alert('Amount is above the maximum deposit, maybe choose another plan that suits your needs better!')</script>";
                    }

                    if ($selected_plan == 5 & $chosen_amount < $plat) {
                        $err = 1;
                        echo "<script>alert('Amount is below the minimum deposit, maybe choose another plan that suits your needs better!')</script>";
                    }
                    $available_bnb = $fetchcoin['bnb'] * $bchPrice;
                    $available_eth = $fetchcoin['eth'] * $ethPrice;
                    $available_btc = $fetchcoin['btc'] * $btcPrice;

                    if ($selected_plan == 5) {
                        $now = strtotime(date('Y-m-d H:m:i')) + (86400 * 30);
                    } else {
                        $now = strtotime(date('Y-m-d H:m:i')) + (86400 * 7);
                    }
                    $endDate = date('Y-m-d H:m:i', $now);
                    if ($selected_crypto == 1) {
                        $coin = 'btc';
                    } elseif ($selected_crypto == 2) {
                        $coin = 'eth';
                    } elseif ($selected_crypto == 3) {
                        $coin = 'bnb';
                    }
                    if ($err == 0) {
                        if ($selected_crypto == 1 & $chosen_amount <= $available_btc) {
                            $newBal = $fetchcoin['btc'] - ($chosen_amount / $btcPrice);
                            $queryInv = $mysqli->query("UPDATE investment SET plan = '$selected_plan', paid = '$chosen_amount', enddate ='$endDate' WHERE email = '$email' LIMIT 1");
                            $queryCoin = $mysqli->query("UPDATE coinhold SET $coin = '$newBal' WHERE email = '$email' LIMIT 1");
                            $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','4','$chosen_amount')");
                            $Transac = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','4','$chosen_amount')");
                            $Transac = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','2','$chosen_amount')");
                            echo "<script>alert('Plan activate!')</script>";
                            echo "<script>window.location.href='bill.php'</script>";
                        } elseif ($selected_crypto == 2 & $chosen_amount < $available_eth) {
                            $newBal = $fetchcoin['eth'] - ($chosen_amount / $ethPrice);
                            $queryInv = $mysqli->query("UPDATE investment SET plan = '$selected_plan', paid = '$chosen_amount', enddate ='$endDate' WHERE email = '$email' LIMIT 1");
                            $queryCoin = $mysqli->query("UPDATE coinhold SET $coin = '$newBal' WHERE email = '$email' LIMIT 1");
                            $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','4','$chosen_amount')");
                            $Transac = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','2','$chosen_amount')");
                            echo "<script>alert('Plan activate!')</script>";
                            echo "<script>window.location.href='bill.php'</script>";
                        } elseif ($selected_crypto == 3 & $chosen_amount < $available_bnb) {
                            $newBal = $fetchcoin['bnb'] - ($chosen_amount / $bchPrice);
                            $queryInv = $mysqli->query("UPDATE investment SET plan = '$selected_plan', paid = '$chosen_amount', enddate ='$endDate' WHERE email = '$email' LIMIT 1");
                            $queryCoin = $mysqli->query("UPDATE coinhold SET $coin = '$newBal' WHERE email = '$email' LIMIT 1");
                            $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','4','$chosen_amount')");
                            $Transac = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','2','$chosen_amount')");
                            echo "<script>alert('Plan activate!')</script>";
                            echo "<script>window.location.href='bill.php'</script>";
                        } else {
                            $_SESSION['plan'] = $selected_plan;
                            $_SESSION['crypto'] = $selected_crypto;
                            $_SESSION['amount'] = $chosen_amount;
                            echo "<script>window.location.href='deposit.php'</script>";
                        }
                    }
                }
            }
            ?>
        </h3>


        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



        <script>
            function update() {
                var plan = document.getElementById('plans').value;
                var amount = document.getElementById('amt');
                if (plan == 1) {
                    amount.value = '<?php echo $bronze ?>';
                } else if (plan == 2) {
                    amount.value = '<?php echo $silver ?>';
                } else if (plan == 3) {
                    amount.value = '<?php echo $gold ?>';
                } else if (plan == 4) {
                    amount.value = '<?php echo $diam ?>';
                } else if (plan == 5) {
                    amount.value = '<?php echo $plat ?>';
                } else {
                    amount.value = '0';
                }
            }
        </script>









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
?>