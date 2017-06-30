<?php
 ob_start();
 session_start();
 require_once 'connection.php';
 
 
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<div class="">
<div class="hero-text">
<div class="container">


 <div id="login-form">
   
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 class="">Welcome - <?php echo $userRow['userName']; ?></h2>
<br> <h3 aling="center"><a href="#" onclick="signOut();"><a href ="logout.php?logout" onclick="signOut();">Sign out.</a></a></h3>

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
//window.location.href = "register_google.php?name=" +name+"&email="+email+"&pass="+pass;
}



  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }

</script>
        
         <div class="form-group">
             
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>


 </div> </div> </div> </div> </div> </body> </html>
