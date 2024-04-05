<?php
   session_start();
   unset($_SESSION["username"]);  
   header('Refresh: 3; URL = index.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Logout</title
</head>
<body>
<?php
   echo '<p>You have successfully logged out. You will be sent to the main menu shortly.</p>';
?>
</body>
</html>