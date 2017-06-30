<?php

 
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
/*
$host="db4free.net:3306";
 
 define('DBHOST', 'localhost:47120');
 define('DBUSER', 'mdeogune');
 define('DBPASS', '8423120597db');
 define('DBNAME', 'mdeo_db');
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
   
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }
/*/
$username = 'mukesh_deo'; 
$password = '8423120597db'; 
$host = '127.0.0.1:3307 '; 
$dbname = 'md_tbuser'; 

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 

try 
{ 
    $db = new PDO("mysql:host=$host;port:3306;dbname=$dbname;charset=utf8", $username, $password, $options); 
} 
catch(PDOException $ex) 
{ 
    die("Failed to connect to the database: " . $ex->getMessage()); 
} 
?>
