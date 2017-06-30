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
}if ($errTyp=="success") {
  header("Location: index.php");
 }

}





?>


<!DOCTYPE html>
<html>
<head>
<style>
body, html {
    height: 100%;
    margin: 0;
}

.hero-image {
  background-image: url("35916579-best-pictures.jpg");
  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover ;
  position: relative;
}
.col-md-12{position:relative;min-height:1px;padding-right:15px;padding-left:15px}
/*.container{padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto}*/
.form-group{margin-bottom:15px}
.input-group{display:inline-table;vertical-align:middle
color:#3c763d;background-color:#dff0d8;border-color:#3c763d}
.input-group-addon{color:#8a6d3b;background-color:#fcf8e3;border-color:#8a6d3b}
.text-danger:hover{color:#843534}
.text-danger{color:#a94442}
.form-control{display:block;width:90%;height:34px;padding:6px 12px;font-size:14px;line-height:1.42857143;color:#555;background-color:#fff;background-image:none;border:1px solid #ccc;border-radius:6px;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,.075);box-shadow:inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s}
.btn-block{margin-top:5px}
.btn{display:inline-block;padding:6px 12px;margin-bottom:0;font-size:14px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px}
.btn-primary{color:#fff;background-color:#337ab7;border-color:#2e6da4}
.hero-text {
  text-align: center;
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: black;
}
.error {color: #000000;}
</style>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="515231560990-jn8gs9lhfe83tjnsu1ocofvnnjil9or0.apps.googleusercontent.com">
<title>Registration</title>
<link rel="stylesheet" href="/home/mukesh-deo/Downloads/bootstrap-3.3.7-dist/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div class="hero-text">
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
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
                <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
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
<div class="g-signin2" data-onsuccess="onSignIn"></div>


 <script type="text/javascript">
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  var pass= profile.getId(); // Do not send to your backend! Use an ID token instead.
  var name=profile.getName();
//$.post("register.php", data);
// window.location.href = "register.php?w1=" +name; 
  console.log('Image URL: ' + profile.getImageUrl());
  var email= profile.getEmail(); // This is null if the 'email' scope is not present.
window.location.href = "register_google.php?name=" +name+"&email="+email+"&pass="+pass;
}



  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }

</script>
            
   </div>
   
   </form> 
 
 
 
  </div>

 
 </div>

</body>
</html>
<?php ob_end_flush(); ?>
