<?php
ob_start();
session_start();
$nameError=$emailError=$passError=$idError="";
if(isset($_SESSION['users'])!=""){
header("Location: home.php");


}

include_once 'connection.php';

$error=false;
if (isset($_POST['btn-signup'])){
/*	$id=trim($_POST['id_']);
$id=strip_tags($id);
$id=htmlspecialchars($id);*/

$name=trim($_POST['name']);
$name=strip_tags($name);
$name=htmlspecialchars($name);



$email=trim($_POST['email']);
$email=strip_tags($email);
$email=htmlspecialchars($email);


$pass=trim($_POST['pass']);
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
	
	
} else {
	$errTyp="danger";
	$errMsg="something went wrong";
	
}
}

}



?>


<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<link rel="stylesheet" href="/home/mukesh-deo/Downloads/bootstrap-3.3.7-dist/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div class="container">

 <div id="login-form">
   <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
   
   <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Sign Up.</h2>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
   
     
    <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
             <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="" />
                </div>
                <span class=""><?php echo $nameError; ?></span>
            </div>
            
                <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="" />
                </div>
                <span class=""><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class=""><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
   </div>
   
   </form> 
 
 
 
 
 
 
 </div>

</body>
</html>
<?php ob_end_flush(); ?>