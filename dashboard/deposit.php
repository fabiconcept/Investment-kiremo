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
    if (!isset($_SESSION['plan'])) {
        header("Location: plan.php");
    } elseif ($_SESSION['plan'] == 0) {
        header("Location: plan.php");
    } else {
        $plan = $_SESSION['plan'];
        $query = $mysqli->query("SELECT * FROM plans where id ='$plan'");
        $queryIn = $mysqli->query("SELECT * FROM investment WHERE email = '$email'");
        $isPlan = $queryIn->fetch_array();
?>
        <!DOCTYPE html>
        <html lang="en">


        <meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title><?php echo $fetch['name'] ?> | Deposit</title>
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
                                            <h3>Deposit & Activate</h3>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-xxl-6 col-xl-6 text-center">
                                                <div class="col-12">
                                                    <?php
                                                    if ($_SESSION['crypto'] == 1) {
                                                        $coin = 'BTC';
                                                    ?>
                                                        <div class="col-xl-12">
                                                            <img src="images/crypto/btc.png" onclick="myFunction()" alt="" class="img-fluid">
                                                        </div>
                                                    <?php
                                                    } elseif ($_SESSION['crypto'] == 2) {
                                                        $coin = 'ETH';
                                                    ?>
                                                        <div class="col-xl-12">
                                                            <img src="images/crypto/eth.png" onclick="myFunction()" alt="" class="img-fluid">
                                                        </div>
                                                    <?php
                                                    } elseif ($_SESSION['crypto'] == 3) {
                                                        $coin = 'BCH';
                                                    ?>
                                                        <div class="col-xl-12">
                                                            <img src="images/crypto/bnb.png" onclick="myFunction()" alt="" class="img-fluid">
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($_SESSION['crypto'] == 1) {
                                                        echo "<h4 id='cp_btn' onclick='CopyToClipboard('cp_btn')'>bc1q2vhp5cgjrrv3yxvf5zthh8k40vtmgtjsxd2rc2</h4>";
                                                        $addi = "bc1q2vhp5cgjrrv3yxvf5zthh8k40vtmgtjsxd2rc2";
                                                    } elseif ($_SESSION['crypto'] == 2) {
                                                        echo "<h4 id='cp_btn' onclick='CopyToClipboard('cp_btn')'>0xc7a2A8746862d6feb84E697132b93393a21E7149</h4>";
                                                        $addi = "0xc7a2A8746862d6feb84E697132b93393a21E7149";
                                                    } else {
                                                        echo "<h4 id='cp_btn' onclick='CopyToClipboard('cp_btn')'>qphrncsdsgehfv9l87t4pk5y7wchm53ntgfa3aqxe6</h4>";
                                                        $addi = "qphrncsdsgehfv9l87t4pk5y7wchm53ntgfa3aqxe6";
                                                    }
                                                    ?>
                                                    <input type="hidden" value="<?php echo $addi ?>" id="myInput">
                                                    <div class="card-header">
                                                        <p class="card-title"><b>Scan the QR code and complete the payment then click on the Activate button activate your plan.</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <div class="col-12">
                                                    <div class="table-responsive api-table">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>

                                                                </tr>
                                                                <div class="card-header">
                                                                    <p class='text-center'>Hello. kindly copy and pay into the Bitcoin wallet address below and update your transaction details:</p><br><br>
                                                                </div>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><b>Plan:</b> </td>
                                                                    <td>
                                                                        <?php
                                                                        $getPlan = $query->fetch_array();
                                                                        echo $getPlan['name'];
                                                                        ?>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td><b>Profit:</b> </td>
                                                                    <td>
                                                                        <?php
                                                                        echo $getPlan['interest'] * $getPlan['length'] . '% over ' . $getPlan['length'] . ' days';
                                                                        ?>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td><b>Principal Return:</b> </td>
                                                                    <td>
                                                                        Yes
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td><b>Principal Withdraw:</b> </td>
                                                                    <td>
                                                                        Avaliable with 0.00% fee
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td><b>Credit amount:</b> </td>
                                                                    <td>
                                                                        $<?php echo toMoney($_SESSION['amount']); ?>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td><b>Deposit fee:</b> </td>
                                                                    <td>
                                                                        0.00% + 0.00% (min. $0.00 max. $0.00)
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td><b>Amount payable (Crypto Equivalent):</b> </td>
                                                                    <td>
                                                                        <input type="text" name="usd_amount" class="form-control" placeholder="<?php
                                                                                                                                                if ($_SESSION['crypto'] == 1) {
                                                                                                                                                    echo "$coin " . toCrypto($_SESSION['amount'] / $btcPrice);
                                                                                                                                                } elseif ($_SESSION['crypto'] == 2) {
                                                                                                                                                    echo "$coin " . toCrypto($_SESSION['amount'] / $ethPrice);
                                                                                                                                                } elseif ($_SESSION['crypto'] == 3) {
                                                                                                                                                    echo "$coin " . toCrypto($_SESSION['amount'] / $bchPrice);
                                                                                                                                                }
                                                                                                                                                ?>" disabled>
                                                                    </td>

                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="">
                                                            <div class="card alert-danger text-center" style='padding: 10px'>Click on the button below to activate your deposit. (Your deposit will be cancelled if its not recognised)</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-5 text-center">
                                                <button type="button" class="btn btn-success m-2" data-toggle="modal" data-target="#addBank">Activate</button>
                                                <form action="" method="post">
                                                    <button name='cnl' class="btn btn-danger m-2" type='submit'>Cancel</button>
                                                </form>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>

            <!-- Modal -->
            <div class="modal fade" id="addBank" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Activate</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" class="identity-upload" method='POST'>
                                <div class="row g-3">
                                    <div class="col-xl-12">
                                        <label class="form-label">Amount</label>
                                        <input type="number" class="form-control" value="<?php echo $_SESSION['amount'] ?>" name='amount' placeholder="5,000" id='am' onchange='good()' required>
                                    </div>
                                    <div class="col-xl-12" style='display: none'>
                                        <label class="form-label">Transaction ID</label>
                                        <input type="text" class="form-control" name='transid' onchange='good()' value='Madepayment' placeholder="7bd5285b20d4ad165e4e9156a57494d60d6a99f9dfc79cd45865e8f92a4c3092" id='tr' required>
                                    </div>
                                    <div class="col-xl-12">
                                        <label class="form-label">Transaction wallet address:</label>
                                        <input type="text" class="form-control" name='walletadd' onchange='good()' placeholder="3Q8GabU7qhzAvqCumVdbGxSz8JZNdgkRiF" id='wl' required>
                                    </div>
                                    <div class="col-xl-12">
                                        <img src="images/routing.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type='button' name='activate' id='bt'>Confirm</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Php control switch -->
            <?php
            if (isset($_POST['activate'])) {
                $test = $mysqli->query("SELECT id FROM deposit WHERE email='$email' AND status=0");
                $count = mysqli_num_rows($test);
                if ($count > 0) {
                    echo "<script>alert('You already have a pending deposit, please wait until the first deposit is processed!')</script>";
                } else {
                    $amount = $_POST['amount'];
                    $transid = $_POST['transid'];
                    $wallet = $_POST['walletadd'];
                    $plan = $_SESSION['plan'];
                    $coin = $_SESSION['crypto'];


                    $amount = $mysqli->real_escape_string($amount);
                    $transid = $mysqli->real_escape_string($transid);
                    $wallet = $mysqli->real_escape_string($wallet);

                    if ($amount == null | $amount == 0) {
                        echo "<script>alert('Invalid Amount entered!')</script>";
                    } elseif ($transid == null) {
                        echo "<script>alert('Invalid Transaction Hash!')</script>";
                    } elseif ($wallet == null | strlen($wallet) < 12) {
                        echo "<script>alert('Invalid Wallet address!')</script>";
                    } else {
                        $insert = $mysqli->query("INSERT INTO deposit (email,amount,plan,crypto,wallet,transid) VALUES ('$email','$amount','$plan','$coin','$wallet','$transid')");
                        $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','3','$amount')");
                        $notify = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','1','$amount')");
                        if ($insert) {
                            $_SESSION['plan'] = 0;
                            $_SESSION['crypto'] = 0;
                            $_SESSION['amount'] = 0;
                            echo "<script>alert('Your deposit will be checked and verified in at least 2 minutes, Please refreash your dashboard after 2 minutes!')</script>";
                            echo "<script>window.location.href='index.php'</script>";
                        }
                    }
                }
            }
            if (isset($_POST['cnl'])) {
                $_SESSION['plan'] = 0;
                $_SESSION['crypto'] = 0;
                $_SESSION['amount'] = 0;
                echo "<script>window.location.href='plan.php'</script>";
            }
            ?>
            <!-- end php -->
            <!-- Modal -->
            <div class="modal fade" id="successBankAccount" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Success</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="auth-form">
                                <div class="card-body">
                                    <form action="../external.php?link=https://intez-html.vercel.app/verify-step-2.php" class="identity-upload">
                                        <div class="identity-content">
                                            <span class="icon"><i class="ri-check-double-line"></i></span>
                                            <p class="text-dark">Congratulation. Your bank added</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="addCard" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCardLabel">Add card</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="identity-upload">
                                <div class="row g-3">
                                    <div class="col-xl-12">
                                        <label class="form-label">Name on card </label>
                                        <input type="text" class="form-control" placeholder="Jannatul Maowa">
                                    </div>
                                    <div class="col-xl-12">
                                        <label class="form-label">Card number </label>
                                        <input type="text" class="form-control" placeholder="5658 4258 6358 4756">
                                    </div>
                                    <div class="col-xl-4">
                                        <label class="form-label">Expiration </label>
                                        <input type="text" class="form-control" placeholder="10/22">
                                    </div>
                                    <div class="col-xl-4">
                                        <label class="form-label">CVC </label>
                                        <input type="text" class="form-control" placeholder="125">
                                    </div>
                                    <div class="col-xl-4">
                                        <label class="form-label">Postal code </label>
                                        <input type="text" class="form-control" placeholder="2368">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#successCard">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="successCard" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Success</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="auth-form">
                                <div class="card-body">
                                    <form action="../external.php?link=https://intez-html.vercel.app/verify-step-2.php" class="identity-upload">
                                        <div class="identity-content">
                                            <span class="icon"><i class="icofont-check"></i></span>
                                            <p class="text-dark">Congratulation. Your bank added</p>
                                        </div>
                                    </form>
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
                    document.execCommand('copy');
                    alert('copied!');
                    navigator.clipboard.writeText(textToCopy.value);
                }
            </script>

            <script>
                function good() {
                    var err = 0;
                    var amount = document.getElementById('am').value;
                    var transid = document.getElementById('tr').value;
                    var walladd = document.getElementById('wl').value;
                    var bt = document.getElementById('bt');
                    if (amount == null | amount == 0) {
                        err = 1;
                    } else if (transid == null | transid.length == 0) {
                        err = 2;
                    } else if (walladd == null | walladd.length == 0) {
                        err = 3;
                    } else {
                        err = 0
                    }

                    if (err == 0) {
                        bt.type = 'submit';
                    }

                    console.log(err);
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

            <script>
                    function myFunction() {
                        /* Get the text field */
                        var copyText = document.getElementById("myInput");

                        /* Select the text field */
                        copyText.select();
                        copyText.setSelectionRange(0, 99999); /* For mobile devices */

                        /* Copy the text inside the text field */
                        navigator.clipboard.writeText(copyText.value);

                        /* Alert the copied text */
                        alert("Copied the text: " + copyText.value);
                    }
            </script>

        </body>


        </html>

<?php
    }
}
?>