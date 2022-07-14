<?php
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

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $fetch['name']?> | Profile Setting</title>
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
                    
                    <div class="dropdown profile_log dropdown">
                        <div data-toggle="dropdown" aria-haspopup="true" class="" aria-expanded="false">
                            <div class="user icon-menu active"><span><i class="ri-user-line"></i></span></div>
                        </div>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu dropdown-menu-right">
                            <div class="user-email">
                                <div class="user">
                                <span class="thumb"><img src="<?php echo $fetch['img'];?>" alt=""></span>
                                <div class="user-info">
                                    <h5><?php echo $fetch['name']; echo $percent;
            ?></h5>
                                    <span><?php echo $fetch['email'];?></span>
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
                                    <h3>Profile</h3>
                                    <p class="mb-2">Welcome to your Profile page</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="breadcrumbs"><a href="#">Settings </a><span><i
                                            class="ri-arrow-right-s-line"></i></span><a href="#">Profile</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-12">
                    <div class="settings-menu">
    <a href="settings-profile.php">Profile</a>
    <a href="transactions.php">Transactions</a>
    
</div>
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-xxl-12 col-12 mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control" value="<?php echo $fetch['name'] ?>" disabled>
                                        </div>
                                        <div class="col-xxl-12 col-12 mb-3">
                                            <div class="d-flex align-items-center">
                                                <img class="me-3 rounded-circle me-0 me-sm-3"
                                                src="<?php echo $fetch['img'];?>" width="55" height="55" alt="" Required>
                                                <div class="media-body">
                                                    <h4 class="mb-0"><?php echo $fetch['name'] ?></h4>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">User Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form action="#">
                                        <div class="row g-3">
                                            <div class="col-12 mb-3">
                                                <label class="form-label">User Email</label>
                                                <input type="email" class="form-control" placeholder="<?php echo $fetch['email']?>" disabled>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label">User Password</label>
                                                <input type="password" class="form-control" placeholder="<?php echo $fetch['view'] ?>" disabled>
                                                <small class="mt-2 mb-0 d-block text-center text-warning">This is your login infomations 
                                                </small>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Personal Information</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" name="myform" class="personal_validate">
                                        <div class="row g-4">
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" class="form-control" value="<?php echo $fetch['name'] ?>"
                                                    name="fullname" disabled>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" placeholder="<?php echo $fetch['email'] ?>"
                                                    name="email" disabled>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <label class="form-label">Phone</label>
                                                <input type="number" class="form-control"
                                                    placeholder="<?php 
                                                        if ($fetch['phone']==0) {
                                                            echo 'example: 448 404 2555';
                                                            $able = 'Required';
                                                        }else {

                                                            $number = $fetch['phone'];
                                                            $result = sprintf('%s-%s-%s', substr($number, 1, 3), substr($number, 4, 4), substr($number, 8));
                                                            echo $result;
                                                            $able = 'disabled';
                                                        }
                                                        ?>" name="permanentphone" <?php echo $able?>>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control"
                                                    placeholder="<?php 
                                                        if ($fetch['address']==null) {
                                                            echo 'Enter your address';
                                                            $able = 'Required';
                                                        }else {
                                                            echo $fetch['address'];
                                                            $able = 'disabled';
                                                        }
                                                        ?>" name="permanentaddress" <?php echo $able?>>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" placeholder="<?php 
                                                        if ($fetch['city']==null) {
                                                            echo 'Enter your current city';
                                                            $ableCity = 'Required';
                                                        }else {
                                                            echo $fetch['city'];
                                                            $ableCity = 'disabled';
                                                        }
                                                        ?>
                                                "
                                                    name="city" <?php echo $ableCity ?>>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <label class="form-label">Post Code</label>
                                                <input type="number" class="form-control" placeholder="<?php 
                                                        if ($fetch['postcode']== 0) {
                                                            echo 'Enter your Post Code';
                                                            $ablePost = 'Required';
                                                        }else {
                                                            echo $fetch['postcode'];
                                                            $ablePost = 'disabled';
                                                        }
                                                        ?>"
                                                    name="postal" <?php echo $ablePost?>>
                                            </div>
                                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                <label class="form-label">Country</label>
                                                <?php
                                                    if ($fetch['country'] == null) {
                                                        $ableCon = 'Required';
                                                ?>
                                                <select class="form-select" name="country">
                                                    <option value="">Choose your country</option>
                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Åland Islands">Åland Islands</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="American Samoa">American Samoa</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Anguilla">Anguilla</option>
                                                    <option value="Antarctica">Antarctica</option>
                                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Aruba">Aruba</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas">Bahamas</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bermuda">Bermuda</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Bosnia and Herzegovina">Bosnia and
                                                        Herzegovina
                                                    </option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Bouvet Island">Bouvet Island</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="British Indian Ocean Territory">British
                                                        Indian
                                                        Ocean Territory</option>
                                                    <option value="Brunei Darussalam">Brunei Darussalam
                                                    </option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Cape Verde">Cape Verde</option>
                                                    <option value="Cayman Islands">Cayman Islands</option>
                                                    <option value="Central African Republic">Central African
                                                        Republic</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Christmas Island">Christmas Island
                                                    </option>
                                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling)
                                                        Islands
                                                    </option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo">Congo</option>
                                                    <option value="Congo, The Democratic Republic of The">
                                                        Congo, The
                                                        Democratic Republic of The</option>
                                                    <option value="Cook Islands">Cook Islands</option>
                                                    <option value="Costa Rica">Costa Rica</option>
                                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Czech Republic">Czech Republic</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican Republic">Dominican Republic
                                                    </option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="El Salvador">El Salvador</option>
                                                    <option value="Equatorial Guinea">Equatorial Guinea
                                                    </option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Falkland Islands (Malvinas)">Falkland
                                                        Islands
                                                        (Malvinas)</option>
                                                    <option value="Faroe Islands">Faroe Islands</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="French Guiana">French Guiana</option>
                                                    <option value="French Polynesia">French Polynesia
                                                    </option>
                                                    <option value="French Southern Territories">French
                                                        Southern
                                                        Territories</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia">Gambia</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Gibraltar">Gibraltar</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Greenland">Greenland</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guadeloupe">Guadeloupe</option>
                                                    <option value="Guam">Guam</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guernsey">Guernsey</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Heard Island and Mcdonald Islands">Heard
                                                        Island
                                                        and Mcdonald Islands</option>
                                                    <option value="Holy See (Vatican City State)">Holy See
                                                        (Vatican
                                                        City State)</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong Kong">Hong Kong</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran, Islamic Republic of">Iran, Islamic
                                                        Republic
                                                        of</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Isle of Man">Isle of Man</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jersey">Jersey</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="Korea, Democratic People's Republic of">
                                                        Korea,
                                                        Democratic People's Republic of</option>
                                                    <option value="Korea, Republic of">Korea, Republic of
                                                    </option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Lao People's Democratic Republic">Lao
                                                        People's
                                                        Democratic Republic</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libyan Arab Jamahiriya">Libyan Arab
                                                        Jamahiriya
                                                    </option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macao">Macao</option>
                                                    <option value="Macedonia, The Former Yugoslav Republic of">
                                                        Macedonia, The Former Yugoslav Republic of</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Marshall Islands">Marshall Islands
                                                    </option>
                                                    <option value="Martinique">Martinique</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mayotte">Mayotte</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Micronesia, Federated States of">
                                                        Micronesia,
                                                        Federated States of</option>
                                                    <option value="Moldova, Republic of">Moldova, Republic
                                                        of
                                                    </option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Montserrat">Montserrat</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Myanmar">Myanmar</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="Netherlands Antilles">Netherlands
                                                        Antilles
                                                    </option>
                                                    <option value="New Caledonia">New Caledonia</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="Niue">Niue</option>
                                                    <option value="Norfolk Island">Norfolk Island</option>
                                                    <option value="Northern Mariana Islands">Northern
                                                        Mariana
                                                        Islands</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Palestinian Territory, Occupied">
                                                        Palestinian
                                                        Territory, Occupied</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Papua New Guinea">Papua New Guinea
                                                    </option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Pitcairn">Pitcairn</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Puerto Rico">Puerto Rico</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Reunion">Reunion</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russian Federation">Russian Federation
                                                    </option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="Saint Helena">Saint Helena</option>
                                                    <option value="Saint Kitts and Nevis">Saint Kitts and
                                                        Nevis
                                                    </option>
                                                    <option value="Saint Lucia">Saint Lucia</option>
                                                    <option value="Saint Pierre and Miquelon">Saint Pierre
                                                        and
                                                        Miquelon</option>
                                                    <option value="Saint Vincent and The Grenadines">Saint
                                                        Vincent
                                                        and The Grenadines</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Sao Tome and Principe">Sao Tome and
                                                        Principe
                                                    </option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="South Georgia and The South Sandwich Islands">
                                                        South Georgia and The South Sandwich Islands
                                                    </option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan
                                                        Mayen
                                                    </option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syrian Arab Republic">Syrian Arab
                                                        Republic
                                                    </option>
                                                    <option value="Taiwan, Province of China">Taiwan,
                                                        Province of
                                                        China</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania, United Republic of">Tanzania,
                                                        United
                                                        Republic of</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Timor-leste">Timor-leste</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tokelau">Tokelau</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad and Tobago">Trinidad and Tobago
                                                    </option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Turks and Caicos Islands">Turks and
                                                        Caicos
                                                        Islands</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Emirates">United Arab
                                                        Emirates
                                                    </option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="United States">United States</option>
                                                    <option value="United States Minor Outlying Islands">
                                                        United
                                                        States Minor Outlying Islands</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Viet Nam">Viet Nam</option>
                                                    <option value="Virgin Islands, British">Virgin Islands,
                                                        British
                                                    </option>
                                                    <option value="Virgin Islands, U.S.">Virgin Islands,
                                                        U.S.
                                                    </option>
                                                    <option value="Wallis and Futuna">Wallis and Futuna
                                                    </option>
                                                    <option value="Western Sahara">Western Sahara</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                                <?php                                                        
                                                    }else {                                                
                                                        $ableCon = 'disabled';
                                                    ?>
                                                    <select class="form-select" name="country" <?php echo $ableCon?>>
                                                        <option value="Zimbabwe"><?php echo $fetch['country'];?></option>
                                                    </select>
                                                <?php
                                                    }
                                                ?>
                                            </div>

                                            <div class="col-12">
                                                <?php
                                                    if ($percent < 100) {
                                                        echo '<button class="btn btn-primary pl-5 pr-5" name="update" type="submit">Save</button>';
                                                    }
                                                ?>
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
    </div>

</div>

<?php
// Update the user personal infomation

if (isset($_POST['update'])) {
    if ($fetch['address'] == null) {
        $addr = $_POST['permanentaddress'];
    }else {
        $addr = $fetch['address'];
    }
    if ($fetch['city'] == null) {
        $city = $_POST['city'];
    }else {
        $city = $fetch['city'];
    }
    if ($fetch['postcode'] == 0) {
        $postCode = $_POST['postal'];
    }else {
        $postCode = $fetch['postcode'];
    }
    if ($fetch['country'] == null) {
        $country = $_POST['country'];
    }else {
        $country = $fetch['country'];
    }
    if ($fetch['phone'] == 0) {
        $phone = $_POST['permanentphone'];
    }else {
        $phone = $fetch['phone'];
    }

    $addr = $mysqli->real_escape_string($addr);
    $city = $mysqli->real_escape_string($city);
    $postCode = $mysqli->real_escape_string($postCode);
    $phone = $mysqli->real_escape_string($phone);
    $country = $mysqli->real_escape_string($country);


    if ($percent != 100) {
        if ($addr == null | strlen($addr) < 5) {
            echo '<script>alert("Invalid Address")</script>';
        }elseif ($city == null | strlen($city) < 3) {
            echo '<script>alert("Invalid City name")</script>';
        }elseif ($postCode == null | strlen($postCode) < 4 | strlen($postCode) > 6) {
            echo '<script>alert("Invalid Postal code")</script>';
        }elseif ($country == null) {
            echo '<script>alert("Please Choose your country")</script>';
        }elseif ($phone == null | strlen($phone) < 10 | strlen($phone) > 15) {
            echo '<script>alert("Invalid Phone Number!")</script>';
        }else {
            $query = $mysqli->query("UPDATE account SET phone = '$phone',  address = '$addr', city ='$city', postcode='$postCode', country = '$country' WHERE email = '$email'");
            if ($query) {
                $notify = $mysqli->query("INSERT INTO notify (email,type,amount) VALUES ('$email','2','0')");
                echo '<script>alert("Account Updated successfully!"); window.location.href="profile.php"</script>';

            }
        }
    }


}
?>


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