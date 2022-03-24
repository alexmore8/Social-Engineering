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
						<a href="<?php echo $_SESSION['role'] ?>Dashboard.php" ><i class="fa fa-desktop "></i>Dashboard</a>
					</li>
                    <li>
                        <a href="settings.php"><i class="fa fa-gear "></i>Settings</a>
                    </li>
                    <li>
                        <a href="edit.php"><i class="fa fa-edit "></i>Edit</a>
                    </li>


                  
                    
                </ul>
                            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h2>ADMIN DASHBOARD</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>Welcome Admin ! </strong> You Have No pending Task For Today.
                        </div>
                       
        </div>
        	</div>
                  <!-- /. ROW  --> 
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
				
				$data_query = sprintf("SELECT ui.* FROM userinfo ui;");

				$result = $pdo->query($data_query);
				$resultCached = new CachedPDOStatement($result);

				foreach ($resultCached as $row) {  
                echo '<div class="row text-center pad-top">';
                  echo '<div class="col-lg-2 col-md-2 col-sm-2 col-xs-6">';
                      echo '<div class="div-square">';
                           echo '<a href="newindex.php?id_comp='.$row['id_comp'].'">';
 echo '<i class="fa fa-circle-o-notch fa-5x"></i>';
                      echo'<h4>'.$row['compName'].'</h4>';
                      //$_SESSION['id_comp'] = $row['id_comp'];
                      //echo 'el id_comp vale:';
                      //echo $_SESSION['id_comp'];
                      echo'</a>';
                      echo'</div>';
                  echo'</div>';                                                                                                              
                //echo'</div>'; 
                }
               ?> 
              </div>     
                     
                  </div>
              </div>
                 <!-- /. ROW  -->   
				  <div class="row">
                    <div class="col-lg-12 ">
					<br/>
                        <div class="alert alert-danger">
                             <strong>Want More Icons Free ? </strong> Checkout fontawesome website and use any icon <a target="_blank" href="http://fortawesome.github.io/Font-Awesome/icons/">Click Here</a>.
                        </div>
                       
                    </div>
                    </div>
                  <!-- /. ROW  --> 
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
