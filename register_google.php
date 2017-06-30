<?php
ob_start();
session_start();
$nameError=$emailError=$passError=$idError="";
if(isset($_SESSION['users'])!=""){
header("Location: home.php");


}

include_once 'connection.php';


$error=false;

/*	$id=trim($_POST['id_']);
$id=strip_tags($id);
$id=htmlspecialchars($id);*/

$name=trim($_GET['name']);

$name=strip_tags($name);
$name=htmlspecialchars($name);



$email=trim($_GET['email']);
$email=strip_tags($email);
$email=htmlspecialchars($email);


$pass=trim($_GET['pass']);
$pass=strip_tags($pass);
$pass=htmlspecialchars($pass);

/*
if(empty($id)){
	$error=true;
   $idError="Please enter your id ";
   
} else {
	$query="SELECT * FROM users WHERE userId='$id'";
	$result_=mysql_query($query);
	if ($result_==false)
{
    die(mysql_error());
}else {
	$count_=mysql_num_rows($result_);
	if($count_!=0) {
		$error=true;
   $idError="ID is already in use";
		}
		}
		}
*/
if(empty($name)){
	$error=true;
   $nameError="Please enter your full name";

   
} else if(strlen($name)<3) {
	$error=true;
   $nameError="Please enter valid name";
	
} else if(!preg_match("/^[a-zA-z ]+$/",$name )) {
	
	$error=true;
   $nameError="Please enter your valid name";
}

if (!filter_var($email,FILTER_VALIDATE_EMAIL)){

   $error=true;
   $emailError="Please enter valid email id";
} else {
	$query="SELECT * FROM users WHERE userEmail='$email'";
	$result=mysql_query($query);
	if ($result==false)
{
    die(mysql_error());
}else {
	$count=mysql_num_rows($result);
	if($count!=0) {
		$error=true;
   $emailError="Email is already in use";
header("Location: home.php");
		}
		}
}

if(empty($pass)){
	$error=true;
   $passError="Please enter your password";
   
} else if(strlen($name)<3) {
	$error=true;
   $passError="Please enter valid password";
	
}

$password=hash('sha256',$pass);

if (!$error){
$query ="INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
$res=mysql_query($query);
if ($res){
	$errTyp="success";
	$errMsg="successfully register";
	unset($id);
	unset($name);
	unset($email);
	unset($pass);

	header("Location: home.php");
echo $errTyp;
	
} else {
	$errTyp="danger";
	$errMsg="something went wrong";
	
}
}
echo $errTyp;
if ($errTyp=="success") {
echo hello;
  header("Location: index.php");
 }





?>
