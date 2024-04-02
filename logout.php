<!DOCTYPE html>
<html>
<?php
   session_start();
?>
<head>
<title>Logout</title
</head>
<body>
<?php
   unset($_SESSION["username"]);   
   echo '<p>You have successfully logged out.</p>';
   header('Refresh: 2; URL = index.php');
?>
</body>
</html>