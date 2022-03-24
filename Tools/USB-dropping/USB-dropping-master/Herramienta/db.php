<?php

session_start();

$DB_host = "localhost";
$DB_user = "root";
$DB_port = 3306;
$DB_pass = "Jacaaljo8";
$DB_name = "phishing";

try
{
     $DB_con = new PDO("mysql:host={$DB_host};port={$DB_port};dbname={$DB_name}",$DB_user,$DB_pass);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}


include_once 'class.user.php';
$user = new USER($DB_con);