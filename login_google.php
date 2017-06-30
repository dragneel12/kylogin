<?php
ob_start();
session_start();
$nameError=$emailError=$passError=$idError="";
if(isset($_SESSION['users'])!=""){
header("Location: home.php");


}

include_once 'connection.php';

$error=false;

$email=trim($_GET['email']);
$email=strip_tags($email);
$email=htmlspecialchars($email);


$pass=trim($_GET['pass']);
$pass=strip_tags($pass);
$pass=htmlspecialchars($pass);





 if(empty($email)){
   $error = true;
   $emailError = "	*  Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "	* Please enter valid email address.";
  }

if (empty($pass)){
	$error =true;
	$passError="	*  please enter password";
	}
	
	
	
	
if (!$error){

$password=hash('sha256',$pass);
$res=mysql_query("SELECT userId,userName,userPass FROM users WHERE userEmail='$email'");
$row=mysql_fetch_array($res);
$count=mysql_num_rows($res);


if ($count ==1 && $row['userPass']==$password){
$_SESSION['user']=$row['userId'];
header("Location: home.php");

} else {
	$errMSG ="* Incorrect Credentials";
	}
}


?>
