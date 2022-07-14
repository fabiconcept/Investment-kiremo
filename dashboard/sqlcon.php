/* Updating the database with the current price of the coins. */
/* A PHP tag. */
<?php
$url = 'localhost';
$username = 'u308226313_kiremo';
$password = 'Sunshine4414.';
$db = 'u308226313_kiremo';
$mysqli = new MySqli($url, $username, $password, $db);

?>
<?php
$query = $mysqli->query("SELECT * FROM rates");
$fetch = $query->fetch_array();
$btcPrice = $fetch['btc'];
$ethPrice = $fetch['eth'];
$bchPrice = $fetch['bch'];
?>
<div style="display:none">
    <?php  
        $url = "https://bitpay.com/api/rates";
        $json = file_get_contents($url);
        if ($json) {
            $data = json_decode($json, TRUE);
            
            $rate = $data[2]["rate"];   //$data[1] is outdated now, they have updated their json order. This new number 2 now fetches USD price. 
            $ethRate = $data[13]["rate"];
            $ethRate = $rate / $ethRate; 
            $bch = $data[1]["rate"];
            $bch= $rate / $bch;  
            $update = $mysqli->query("UPDATE rates SET btc = '$rate', eth = '$ethRate', bch = '$bch'");
        }

    ?>
</div>