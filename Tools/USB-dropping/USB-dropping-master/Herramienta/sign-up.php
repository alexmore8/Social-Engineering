<?php
require 'db.php';


//if($user->is_loggedin()!="")
//{
  //  $user->redirect('home.php');
//}

if(isset($_POST['btn-signup']))
{
   $uname = trim($_POST['name']);
   $umail = trim($_POST['mail']);
   $upass = trim($_POST['password']); 


   if($uname=="") {
      $error[] = "provide username !"; 
   }
   else if($umail=="") {
      $error[] = "provide email id !"; 
   }
   else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($upass=="") {
      $error[] = "provide password !";
   }
   else if(strlen($upass) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else
   {
      try
      {
        // $stmt = $DB_con->prepare("SELECT userName,compName FROM userinfo WHERE userName=:umail");
         //$stmt->execute();
         //$row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         //if($row['userName']==$umail) {
          //  $error[] = "sorry username already taken !";
        // }
         //else
         //{
             $a = $user->register($uname,$umail,$upass);

             $file = 'C:\Users\mmellouk\Desktop\res.txt';
                                           
            file_put_contents($file, $a, FILE_APPEND);


            if($a) 
            {

                $user->redirect('sig.php');
            }else
                $user->redirect('signnooo.php');


         //}
     }
     catch(PDOException $e)
     {
        echo $e->getMessage();
     }
  } 
}

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
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="style.css">
            <script  src="index.js"></script>


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
                     <h2>REGISTER COMPANY</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />



<form action="#" method="post">
  <h2>Sign Up</h2>

  <p>
      <label for="Name" class="floatLabel">Name</label>
      <input id="name" name="name" type="text">
    </p>
    <p>
      <label for="Email" class="floatLabel">Email</label>
      <input id="mail" name="mail" type="text">
    </p>

    <p>
      <label for="password" class="floatLabel">Password</label>
      <input id="password" name="password" type="password">
      <span>Enter a password longer than 8 characters</span>
    </p>
    <p>
      <label for="confirm_password" class="floatLabel">Confirm Password</label>
      <input id="confirm_password" name="confirm_password" type="password">
      <span>Your passwords do not match</span>
    </p>
    <p>
      <input type="submit" value="Create My Account" id="btn-signup" name="btn-signup">
    </p>
  </form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="js/index.js"></script>




                     
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
