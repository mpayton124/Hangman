<?php
   session_start();
   unset($_SESSION["username"]);  
   header('Refresh: 2; URL = index.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Logout</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="logout-message">
<?php
   echo '<p>You have successfully logged out. You will be sent to the main menu shortly.</p>';
?>
</div>
</body>
</html>