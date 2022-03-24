
<?php
require 'db.php';
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>YOUR CAMPAIGN RESULTS</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
      <link rel="stylesheet" href="css/style3.css">

  
</head>

<body>
  <section>
  <!--for demo wrap-->
  <h1>YOUR CAMPAIGN RESULTS</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th>USB</th>
          <th>Date</th>
          <th>Machine Name</th>
          <th>User Name</th>
          <th>Os Version</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
<?php
include 'CachedPDOStatement.php';

$host = '127.0.0.1';
$db = 'phishing';
$port = '3306';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$opt = [
	PDO::ATTR_ERRMODE              =>  PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE   =>  PDO::FETCH_ASSOC,
	PDO::ATTR_EMULATE_PREPARES     =>   false,
];

$pdo = new PDO($dsn,$user,$pass, $opt);

//$id = $_GET['id'];

$id = $_GET['id_comp'];

$data_query = sprintf("SELECT * FROM campaigninfo where id_comp = %s;", $id);


$result = $pdo->query($data_query);



$resultCached = new CachedPDOStatement($result);

foreach ($resultCached as $row) {
    echo "<tr><td>".$row["id_usb"]. "</td><td>".$row["Hour"]."</td><td>".$row["machineName"]."</td><td>".$row["userName"]."</td><td>".$row["osVersion"]."</td></tr>";
}


?>
      </tbody>
    </table>
  </div>
</section>


<!-- follow me template -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
