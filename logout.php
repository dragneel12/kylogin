
<html>
<head>

<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="515231560990-jn8gs9lhfe83tjnsu1ocofvnnjil9or0.apps.googleusercontent.com"></head>
<body>
<script>
  
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  
</script>

<body>
</html>
<?php
 session_start();
 if (!isset($_SESSION['user'])) {
  header("Location: index.php");
 } else if(isset($_SESSION['user'])!="") {
  header("Location: home.php");
 }
 
 if (isset($_GET['logout'])) {
  unset($_SESSION['user']);
 
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit;
 }
 ?>
