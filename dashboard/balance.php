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
   $getInvest = $mysqli->query("SELECT * FROM investment WHERE email = '$email' LIMIT 1");
   $getcoin = $mysqli->query("SELECT * FROM coinhold WHERE email = '$email' LIMIT 1");
   $fetch = $get->fetch_array();
   $fetchcoin = $getcoin->fetch_array();
   $fetchInvest = $getInvest->fetch_array();

   $addr = $fetch['address'];
   $post = $fetch['postcode'];
   $city = $fetch['city'];
   $img = $fetch['img'];
   $country = $fetch['country'];
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
   $percent = $num * $per;
   if ($fetchcoin['btc'] == 0) {
      $classBt = 'text-danger';
   } else {
      $classBt = '';
   }
   if ($fetchcoin['eth'] == 0) {
      $classEt = 'text-danger';
   } else {
      $classEt = '';
   }
   if ($fetchcoin['bnb'] == 0) {
      $classBn = 'text-danger';
   } else {
      $classBn = '';
   }
?>


   <!DOCTYPE html>
   <html lang="en">


   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title><?php echo $fetch['name'] ?> | Wallet</title>
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
                        <span><i class="ri-wallet-fill"></i></span>
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
               <div class="page-title">
                  <div class="row align-items-center justify-content-between">
                     <div class="col-xl-4">
                        <div class="page-title-content">
                           <h3>Wallet</h3>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Balance Details</h4>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-12">
                                 <div class="total-balance">
                                    <p>Total Balance</p>
                                    <h2>$<?php
                                          $myref = $fetch['refid'];
                                          $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                          $count = mysqli_num_rows($test);
                                          $count = $count * 20;

                                          $btc = $fetchcoin['btc'] * $btcPrice;
                                          $eth = $fetchcoin['eth'] * $ethPrice;
                                          $bnb = $fetchcoin['bnb'] * $bchPrice;
                                          $total = $btc + $eth + $bnb + $count;
                                          if ($total == 0) {
                                             echo '0.00';
                                          } else {
                                             echo toMoney($total);
                                          }
                                          ?></h2>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                 <div class="balance-stats active">
                                    <p class="<?php echo $classBt ?>">Bitcoin USD</p>
                                    <h3>$<?php
                                          if ($fetchcoin['btc'] == 0) {
                                             echo '0.00';
                                          } else {
                                             echo toMoney($fetchcoin['btc'] * $btcPrice);
                                          }
                                          ?></h3>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                 <div class="balance-stats">
                                    <p class="<?php echo $classEt ?>">Ethereum USD</p>
                                    <h3>$<?php
                                          if ($fetchcoin['eth'] == 0) {
                                             echo '0.00';
                                          } else {
                                             echo toMoney($fetchcoin['eth'] * $ethPrice);
                                          }
                                          ?></h3>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                 <div class="balance-stats">
                                    <p class="<?php echo $classBn ?>">Bitcoin Cash USD</p>
                                    <h3>$<?php
                                          if ($fetchcoin['bnb'] == 0) {
                                             echo '0.00';
                                          } else {
                                             echo toMoney($fetchcoin['bnb'] * $bchPrice);
                                          }
                                          ?></h3>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                 <div class="balance-stats">
                                    <p>Refferal Earnings</p>
                                    <h3>$<?php
                                          $myref = $fetch['refid'];
                                          $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                          $count = mysqli_num_rows($test);
                                          $count = $count * 20;
                                          if ($count > 0) {
                                             echo $count;
                                          } else {
                                             echo '0.00';
                                          }
                                          ?>
                                    </h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Crypto Wallet</h4>
                        </div>
                        <div class="card-body">
                           <div class="bills-widget">
                              <div class="bills-widget-content d-flex justify-content-between align-items-center active">
                                 <div>
                                    <p class="<?php echo $classBt ?>">Bitcoin</p>
                                    <h4><?php
                                          if ($fetchcoin['btc'] == 0) {
                                             echo '0.00';
                                          } else {
                                             echo toCrypto($fetchcoin['btc']);
                                          }
                                          ?></h4>
                                 </div>
                                 <?php
                                 if (($fetchcoin['btc'] * $btcPrice) < 250 & $fetchInvest['plan'] == 0) {
                                 ?>
                                    <div><a href="deposit.php" class="btn btn-primary">Deposit</a></div>
                                 <?php
                                 } elseif ($fetchInvest['plan'] == 0) {
                                 ?>
                                    <div><a href="plan.php" class="btn btn-primary">Invest</a></div>
                                 <?php
                                 }
                                 ?>
                              </div>
                              <div class="bills-widget-content d-flex justify-content-between align-items-center">
                                 <div>
                                    <p class="<?php echo $classEt ?>">Ethereum</p>
                                    <h4><?php
                                          if ($fetchcoin['eth'] == 0) {
                                             echo '0.00';
                                          } else {
                                             echo toCrypto($fetchcoin['eth']);
                                          }
                                          ?></h4>
                                 </div>
                                 <?php
                                 if (($fetchcoin['eth'] * $ethPrice) < 250 & $fetchInvest['plan'] == 0) {
                                 ?>
                                    <div><a href="deposit.php" class="btn btn-primary">Deposit</a></div>
                                 <?php
                                 } elseif ($fetchInvest['plan'] == 0) {
                                 ?>
                                    <div><a href="plan.php" class="btn btn-primary">Invest</a></div>
                                 <?php
                                 }
                                 ?>
                              </div>
                              <div class="bills-widget-content d-flex justify-content-between align-items-center">
                                 <div>
                                    <p class="<?php echo $classBn ?>">Bitcoin Cash</p>
                                    <h4><?php
                                          if ($fetchcoin['bnb'] == 0) {
                                             echo '0.00';
                                          } else {
                                             echo toCrypto($fetchcoin['bnb']);
                                          }
                                          ?></h4>
                                 </div>
                                 <?php
                                 if (($fetchcoin['bnb'] * $bchPrice) < 250 & $fetchInvest['plan'] == 0) {
                                 ?>
                                    <div><a href="deposit.php" class="btn btn-primary">Deposit</a></div>
                                 <?php
                                 } elseif ($fetchInvest['plan'] == 0) {
                                 ?>
                                    <div><a href="plan.php" class="btn btn-primary">Invest</a></div>
                                 <?php
                                 }
                                 ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-xxl-12 col-xl-12 col-lg-12">
                     <div class="card">
                        <div class="card-header">
                           <h4 class="card-title">Withdrawable Balance</h4>
                        </div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-12">
                                 <div class="total-balance">
                                    <p>Total Balance</p>
                                    <h2>$<?php
                                          $myref = $fetch['refid'];
                                          $test = $mysqli->query("SELECT id FROM account WHERE refby = '$myref'");
                                          $count = mysqli_num_rows($test);
                                          $count = $count * 20;

                                          if (($fetchcoin['btc'] * $btcPrice) < 250) {
                                             $btc = 0;
                                          } else {
                                             $btc = $fetchcoin['btc'] * $btcPrice;
                                          }
                                          if (($fetchcoin['eth'] * $ethPrice) < 250) {
                                             $eth = 0;
                                          } else {
                                             $eth = $fetchcoin['eth'] * $ethPrice;
                                          }
                                          if (($fetchcoin['bnb'] * $bchPrice) < 250) {
                                             $bnb = 0;
                                          } else {
                                             $bnb = $fetchcoin['bnb'] * $bchPrice;
                                          }
                                          $total = $btc + $eth + $bnb + $count;
                                          if ($total < 250) {
                                             echo '0.00';
                                          } else {
                                             echo toMoney($total);
                                          }
                                          ?></h2>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                 <div class="balance-stats active">
                                    <p class="<?php echo $classBt ?>">Bitcoin USD</p>
                                    <h3>$<?php
                                          if (($fetchcoin['btc'] * $btcPrice) < 250) {
                                             echo '0.00';
                                          } else {
                                             echo toMoney($fetchcoin['btc'] * $btcPrice);
                                          }
                                          ?></h3>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                 <div class="balance-stats">
                                    <p class="<?php echo $classEt ?>">Ethereum USD</p>
                                    <h3>$<?php
                                          if (($fetchcoin['eth'] * $ethPrice) < 250) {
                                             echo '0.00';
                                          } else {
                                             echo toMoney($fetchcoin['eth'] * $ethPrice);
                                          }
                                          ?></h3>
                                 </div>
                              </div>
                              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                 <div class="balance-stats">
                                    <p class="<?php echo $classBn ?>">Bitcoin Cash USD</p>
                                    <h3>$<?php
                                          if (($fetchcoin['bnb'] * $bchPrice) < 250) {
                                             echo '0.00';
                                          } else {
                                             echo toMoney($fetchcoin['bnb'] * $bchPrice);
                                          }
                                          ?></h3>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                           <div class="bills-widget">
                              <?php
                              if (($fetchcoin['btc'] * $btcPrice) > 250) {
                              ?>
                                 <div class="bills-widget-content d-flex justify-content-between align-items-center active">
                                    <div>
                                       <p class="<?php echo $classBt ?>">Bitcoin</p>
                                       <h4>$<?php
                                             echo toMoney($fetchcoin['btc'] * $btcPrice);
                                             ?></h4>
                                    </div>
                                    <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#btc">Withdraw</button></div>
                                 </div>
                              <?php
                              }
                              ?>
                              <?php
                              if (($fetchcoin['eth'] * $ethPrice) > 250) {
                              ?>
                                 <div class="bills-widget-content d-flex justify-content-between align-items-center">
                                    <div>
                                       <p class="<?php echo $classEt ?>">Ethereum</p>
                                       <h4>$<?php
                                             echo toMoney($fetchcoin['eth'] * $ethPrice);
                                             ?>
                                       </h4>
                                    </div>
                                    <div><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eth">Withdraw</button></div>
                                 </div>
                              <?php
                              }

                              ?>
                              <?php
                              if (($fetchcoin['bnb'] * $bchPrice) > 250) {
                              ?>
                                 <div class="bills-widget-content d-flex justify-content-between align-items-center">
                                    <div>
                                       <p class="<?php echo $classBn ?>">Bitcoin Cash</p>
                                       <h4>$<?php
                                             echo toMoney($fetchcoin['bnb'] * $bchPrice);
                                             ?></h4>
                                    </div>
                                    <div>
                                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bnb">Withdraw</button>
                                    </div>
                                 </div>
                              <?php
                              }
                              ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-12" id='withboy'>
                     <div class="card">
                        <div class="card-header flex-row">
                           <h4 class="card-title">Withdrawal Addresses: </h4>
                           <?php
                           $num = 3;
                           $per = $num / 100;
                           if ($fetch['btc'] == null) {
                              $num = $num - 1;
                           }
                           if ($fetch['eth'] == null) {
                              $num = $num - 1;
                           }
                           if ($fetch['bnb'] == null) {
                              $num = $num - 1;
                           }
                           $percent = $num / $per;
                           if ($percent < 100) {
                              echo "<script>alert('Please add your preferred wallet address for withdraw purposes!'); window.location.href ='balance.php#withboy'</script>";
                           }
                           if ($percent != 100) {
                           ?>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCard">Edit</button>
                           <?php
                           }
                           ?>
                        </div>
                        <div class="card-body">
                           <form class="row">
                              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                 <div class="user-info">
                                    <span>Bitcoin Wallet</span>
                                    <h5><?php echo $fetch['btc'] ?></h5>
                                 </div>
                              </div>
                              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                 <div class="user-info">
                                    <span>Etheruem Wallet</span>
                                    <h5><?php echo $fetch['eth'] ?></h5>
                                 </div>
                              </div>
                              <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                 <div class="user-info">
                                    <span>Bitcoin Cash Wallet</span>
                                    <h5><?php
                                          echo $fetch['bnb'];
                                          ?></h5>
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

      <div class="modal fade" id="bnb" tabindex="-1">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="addCardLabel">Withdraw Bitcoin Cash</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form class="identity-upload" method="POST">
                     <div class="row g-3">
                        <div class="col-xl-12">
                           <label class="form-label">Available Balance</label>
                           <input type="text" class="form-control" placeholder="$<?php echo toMoney($fetchcoin['bnb'] * $bchPrice) ?>" disabled>
                        </div>
                        <div class="col-xl-12">
                           <label class="form-label">Wallet</label>
                           <input type="text" class="form-control" minlength="42" placeholder="<?php echo $fetch['eth'] ?>" disabled>
                        </div>
                        <div class="col-xl-12">
                           <label class="form-label">Amount</label>
                           <input type="number" class="form-control" minlength="42" placeholder="0.00" name='amt' required>
                        </div>
                     </div>
               </div>
               <i class='text-center text-warning'>Minimum withdrawal is $250 and maximum withdrawal is $<?php echo toMoney($fetchcoin['bnb'] * $bchPrice) ?></i><br>
               <div class="modal-footer">
                  <button type="submit" name="bnb" class="btn btn-primary" data-toggle="modal" data-target="#successCard">withdraw</button>
               </div>
               </form>
            </div>
         </div>
      </div>


      <div class="modal fade" id="eth" tabindex="-1">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="addCardLabel">Withdraw Etheruem</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form class="identity-upload" method="POST">
                     <div class="row g-3">
                        <div class="col-xl-12">
                           <label class="form-label">Available Balance</label>
                           <input type="text" class="form-control" placeholder="$<?php echo toMoney($fetchcoin['eth'] * $ethPrice) ?>" disabled>
                        </div>
                        <div class="col-xl-12">
                           <label class="form-label">Wallet</label>
                           <input type="text" class="form-control" placeholder="<?php echo $fetch['eth'] ?>" name='bnb' disabled>
                        </div>
                        <div class="col-xl-12">
                           <label class="form-label">Amount</label>
                           <input type="number" class="form-control" minlength="1" placeholder="0.00" name='amt' required>
                        </div>
                     </div>
               </div>
               <i class='text-center text-warning'>Minimum withdrawal is $250 and maximum withdrawal is $<?php echo toMoney($fetchcoin['eth'] * $ethPrice) ?></i><br>
               <div class="modal-footer">
                  <button type="submit" name="eth" class="btn btn-primary" data-toggle="modal" data-target="#successCard">withdraw</button>
               </div>
               </form>
            </div>
         </div>
      </div>
      <div class="modal fade" id="btc" tabindex="-1">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="addCardLabel">Withdraw Bitcoin</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form class="identity-upload" method="POST">
                     <div class="row g-3">
                        <div class="col-xl-12">
                           <label class="form-label">Available Balance</label>
                           <input type="text" class="form-control" placeholder="$<?php echo toMoney($fetchcoin['btc'] * $btcPrice) ?>" disabled>
                        </div>
                        <div class="col-xl-12">
                           <label class="form-label">Wallet</label>
                           <input type="text" class="form-control" minlength="42" placeholder="<?php echo $fetch['btc'] ?>" name='bnb' disabled>
                        </div>
                        <div class="col-xl-12">
                           <label class="form-label">Amount</label>
                           <input type="number" class="form-control" minlength="42" placeholder="0.00" name='amt' required>
                        </div>
                     </div>
               </div>
               <i class='text-center text-warning'>Minimum withdrawal is $250 and maximum withdrawal is $<?php echo toMoney($fetchcoin['btc'] * $btcPrice) ?></i><br>
               <div class="modal-footer">
                  <button type="submit" name="btc" class="btn btn-primary" data-toggle="modal" data-target="#successCard">withdraw</button>
               </div>
               </form>
            </div>
         </div>
      </div>


      <div class="modal fade" id="addCard" tabindex="-1">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="withdrawLabel">Add wallets addresses</h5>
                  <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <form class="identity-upload" method="POST">
                     <div class="row g-3">
                        <div class="col-xl-12">
                           <label class="form-label">Bitcoin Wallet</label>
                           <input type="text" class="form-control" minlength="30" placeholder="bc1q2vhp5cgjrrv3yxvf5zthh8k40vtmgtjsxd2rc2" name='btc' required>
                        </div>
                        <div class="col-xl-12">
                           <label class="form-label">Etheruem Wallet</label>
                           <input type="text" class="form-control" minlength="42" placeholder="0xc7a2A8746862d6feb84E697132b93393a21E7149" name='eth' required>
                        </div>
                        <div class="col-xl-4">
                           <label class="form-label">Bitcoin cash Wallet</label>
                           <input type="text" class="form-control" minlength="42" placeholder="bnb1ehgs7q6avgcpshp9gya7v25lk2vwpk02ldydgq" name='bnb' required>
                        </div>
                     </div>
               </div>
               <div class="modal-footer">
                  <button type="submit" name="add" class="btn btn-primary" data-toggle="modal" data-target="#successCard">Set</button>
               </div>
               </form>
            </div>
         </div>
      </div>


      <?php
      if (isset($_POST['add'])) {
         $btc = $_POST['btc'];
         $eth = $_POST['eth'];
         $bnb = $_POST['bnb'];

         $bnb = $mysqli->real_escape_string($bnb);
         $eth = $mysqli->real_escape_string($eth);
         $btc = $mysqli->real_escape_string($btc);

         if (strlen($btc) < 42) {
            echo "<script>alert('Invalid Bitcoin address')</script>";
         } elseif (strlen($bnb) < 42) {
            echo "<script>alert('Invalid Bitcoin Cash address')</script>";
         } elseif (strlen($eth) < 42) {
            echo "<script>alert('Invalid Etheruem address')</script>";
         } else {
            $query = $mysqli->query("UPDATE account SET btc ='$btc', eth ='$eth', bnb = '$bnb' WHERE email ='$email' LIMIT 1");
            if ($query) {
               echo "<script>alert('Update Successful!')</script>";
               echo "<script>window.location.href = 'balance.php'</script>";
            } else {
               echo "<script>alert('" . $mysqli->error . "')</script>";
            }
         }
      }

      if (isset($_POST['eth'])) {
         unset($_POST['btc']);
         unset($_POST['bnb']);

         $amount = $_POST['amt'];
         $amount = $mysqli->real_escape_string($amount);
         $wallet = $fetch['eth'];
         $newbal = (($fetchcoin['eth'] * $ethPrice) - $amount) / $ethPrice;
         if ($wallet == null) {
            echo "<script>alert('Please set your wallet addresses before withdrawal!')</script>";
         } elseif ($amount > ($fetchcoin['eth'] * $ethPrice)) {
            echo "<script>alert('Sorry! You do not have that amount.')</script>";
         } elseif ($amount < 250) {
            echo "<script>alert('Sorry! Amount is less than the allowed minimum.')</script>";
         } else {
            $with = $mysqli->query("INSERT INTO withdraw (email,wallet,amount,coin) VALUES ('$email','$wallet','$amount','2')");
            $transac = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','6','$amount')");
            $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','6','$amount')");
            $query = $mysqli->query("UPDATE coinhold SET eth = '$newbal' WHERE email = '$email' LIMIT 1");
            if ($notify) {
               echo "<script>alert('Your withdrawal request has been placed, we will review your request and verify it in two (2) minutes. Thank You.')</script>";
               echo "<script>window.location.href = 'balance.php'</script>";
            } else {
               echo "<script>alert('" . $mysqli->error . "!')</script>";
            }
         }
      }
      if (isset($_POST['bnb'])) {
         unset($_POST['btc']);
         unset($_POST['eth']);

         $amount = $_POST['amt'];
         $amount = $mysqli->real_escape_string($amount);
         $wallet = $fetch['bnb'];
         $newbal = (($fetchcoin['bnb'] * $bchPrice) - $amount) / $bchPrice;
         if ($wallet == null) {
            echo "<script>alert('Please set your wallet addresses before withdrawal!')</script>";
         } elseif ($amount > ($fetchcoin['bnb'] * $bchPrice)) {
            echo "<script>alert('Sorry! You do not have that amount.')</script>";
         } elseif ($amount < 250) {
            echo "<script>alert('Sorry! Amount is less than the allowed minimum.')</script>";
         } else {
            $with = $mysqli->query("INSERT INTO withdraw (email,wallet,amount,coin) VALUES ('$email','$wallet','$amount','3')");
            $transac = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','6','$amount')");
            $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','6','$amount')");
            $query = $mysqli->query("UPDATE coinhold SET bnb = '$newbal' WHERE email = '$email' LIMIT 1");
            if ($notify) {
               echo "<script>alert('Your withdrawal request has been placed, we will review your request and verify it in two (2) minutes. Thank You.')</script>";
               echo "<script>window.location.href = 'balance.php'</script>";
            } else {
               echo "<script>alert('" . $mysqli->error . "!')</script>";
            }
         }
      }
      if (isset($_POST['btc'])) {
         unset($_POST['eth']);
         unset($_POST['bnb']);

         $amount = $_POST['amt'];
         $amount = $mysqli->real_escape_string($amount);
         $wallet = $fetch['btc'];
         $newbal = (($fetchcoin['btc'] * $btcPrice) - $amount) / $btcPrice;
         if ($wallet == null) {
            echo "<script>alert('Please set your wallet addresses before withdrawal!')</script>";
         } elseif ($amount > ($fetchcoin['btc'] * $btcPrice)) {
            echo "<script>alert('Sorry! You do not have that amount.')</script>";
         } elseif ($amount < 250) {
            echo "<script>alert('Sorry! Amount is less than the allowed minimum.')</script>";
         } else {
            $with = $mysqli->query("INSERT INTO withdraw (email,wallet,amount,coin) VALUES ('$email','$wallet','$amount','1')");
            $transac = $mysqli->query("INSERT INTO transactions (email,type,amount) VALUES ('$email','6','$amount')");
            $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','6','$amount')");
            $query = $mysqli->query("UPDATE coinhold SET btc = '$newbal' WHERE email = '$email' LIMIT 1");
            if ($notify) {
               echo "<script>alert('Your withdrawal request has been placed, we will review your request and verify it in two (2) minutes. Thank You.')</script>";
               echo "<script>window.location.href='balance.php'</script>";
            } else {
               echo "<script>alert('" . $mysqli->error . "!')</script>";
            }
         }
      }
      ?>

      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


      <script src="vendor/chartjs/chartjs.js"></script>





      <script src="js/plugins/chartjs-investment.js"></script>











      <script src="js/scripts.js"></script>

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

   </body>


   </html>

<?php
}
?>