
<?php
require 'db.php';

//if($user->is_loggedin()!="")
//{
 //$user->redirect('home.php');
//}

if(isset($_POST['btn-login']))
{
 $umail = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];
  
 if($user->login($umail,$upass))
 {
   if($_SESSION['role'] == 'user')
        $user->redirect('userDashboard.php');
    else $user->redirect('adminDashboard.php');
 }
 else
 {
  $error = "Wrong Details !";
 } 
}
?>


<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Screen</title>
  <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'><link rel="stylesheet" href="https://i.icomoon.io/public/c4f64fe3b1/UntitledProject2/style.css">
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <img src="assets/img/capgemini.png" alt="" />
<form action="#" method="post">
  <h1>USB PHISHING</h1>
  <div class="input-contain">
    <input id="txt_uname_email" name="txt_uname_email" type="text" placeholder='Enter your username...'/>
  </div>
  <div class="input-contain">
    <input id="txt_password" name="txt_password" type="password"  placeholder='Enter your password...'/>
  </div>
  <div class="input-contain">
    <div class="custom_checkbox">
      <input type="checkbox" name='check' id='check-hidden' />
      <span class="check_box">
        <span class="icon-tick"></span>
      </span>
      <span class="text">Remember Me</span>
    </div>
  </div>
  <div class="input-contain">
    <input type="submit" value='Log In' name="btn-login" id="btn-login" />
  </div>
</form>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
