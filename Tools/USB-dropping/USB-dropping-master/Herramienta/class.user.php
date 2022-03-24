<?php
require 'password.php';


class USER
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function register($uname,$umail,$upass)
    {
       try
       {
           $new_password = hash('sha256', $upass);
           $role = 'user';
   
           $stmt = $this->db->prepare("INSERT INTO userinfo(role, userName,pass,compName) VALUES(:role, :umail,:upass,:uname)");

           $stmt->bindparam(":role", $role);
           $stmt->bindparam(":uname", $uname);
           $stmt->bindparam(":umail", $umail);
           $stmt->bindparam(":upass", $new_password);            
           $stmt->execute(); 

          $file = 'C:\Users\mmellouk\Desktop\dump\res.txt';
                                           
          file_put_contents($file, $stmt , FILE_APPEND);

           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function login($umail,$upass)
    {
       try
       {
          $stmt = $this->db->prepare("SELECT * FROM userinfo WHERE userName=:umail LIMIT 1");
          //$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
          $stmt->bindparam(":umail", $umail);
          $stmt->execute();
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
             if(hash('sha256',$upass) == $userRow['pass'])
             {
                $_SESSION['company_name'] = $userRow['compName'];
                $_SESSION['user_session'] = $userRow['userName'];
                $_SESSION['id_comp'] = $userRow['id_comp'];
                $_SESSION['role'] = $userRow['role'];
				$_SESSION['usbCounter'] = $userRow['usbCounter'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
}
?>