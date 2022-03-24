<?php
require 'db.php';
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
     
           
          
    <div id="wrapper">
         <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="assets/img/logo.png" />

                    </a>
                    
                </div>
              
               <span class="logout-spn" >                                 
				<!-- <a href="index.php" style="color:#fff;">LOGOUT</a> -->
                  <form action="index.php" method="post">
                  <input type="submit" name="btnDelete" value="LOGOUT" style="color:#55b" />
                  	<?php if (isset($_POST['btnDelete'])) {  						 
						$user->logout();
					} ?>
					</form>                
				</span> 
            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                 


                    <li class="active-link">
                        <a href="index.html" ><i class="fa fa-desktop "></i>Dashboard</a>
                    </li>
                   

                    <li>
                        <a href="ui.html"><i class="fa fa-gear "></i>Settings</a>
                    </li>
                    <li>
                        <a href="blank.html"><i class="fa fa-edit "></i>Edit</a>
                    </li>


                    
                    
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h2>USER DASHBOARD</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>Welcome <?php echo $_SESSION['company_name']; ?> ! </strong> 
                        </div>
                       
                    </div>
                    
                  <!-- /. ROW  --> 
				
				<table style="padding:3cm;width:90%;text-align:center;border:2px solid black;border-collapse:collapse;padding:5px;margin:10px;">
					<tr style="border-bottom:1pt solid black;">
						<strong><th style="text-align:center;border-bottom:1pt solid black;border:1pt solid black">usb Id</th></strong>
						<strong><th style="text-align:center;border-bottom:1pt solid black;border:1pt solid black">Clicked</th></strong>
					</tr>
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

						$id= $_SESSION['id_comp'];
						$usb_counter = $_SESSION['usbCounter'];
						
						$data_query = sprintf("SELECT ci.* FROM campaigninfo ci where ci.id_comp = %s;", $id);

						$result = $pdo->query($data_query);
						$resultCached = new CachedPDOStatement($result);


						for($i = 0; $i <= $usb_counter; ++$i) { //set array[$i]=0 by default
							$array[$i] = 0;
						}

						foreach ($resultCached as $row) { //set array[$i]=1 when id_usb found
							$array[$row["id_usb"]] = 1;
						}


						$yes = 0;
						$no = 0;
						for($i = 0; $i <= $usb_counter; ++$i) {
							echo '<tr style="border-bottom:1pt solid black;">';
							echo '<td style="border:1pt solid black;">'.$i.'</td>';
							echo '<td style="border:1pt solid black;">';
							if ($array[$i] == 1) {
								echo 'yes';
								$yes++;
							}
							else {
								echo 'no';
								$no++;
							}
							echo '</td>';
							echo '</tr>';
					
						}
						
					?>
					
				</table>

				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
					<script type="text/javascript">
					  google.charts.load('current', {'packages':['corechart']});
					  google.charts.setOnLoadCallback(drawChart);

					  function drawChart() {

						var data = google.visualization.arrayToDataTable([
						  ['Clicked', 'Either yes or no'],
						  ['Yes',     <?php echo $yes; ?>],
						  ['No',      <?php echo $no; ?>]
						]);

						var options = {
						  title: 'Clicked usb flash memories'
						};

						var chart = new google.visualization.PieChart(document.getElementById('piechart'));

						chart.draw(data, options);
					  }
				</script>
				<div id="piechart" style="width: 900px; height: 500px;"></div>



 				
                     
                  </div> 
                              
              </div>
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    <div class="footer">
      
    
            <div class="row">
                <div class="col-lg-12" >
                    &copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
                </div>
            </div>
        </div>
          

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
