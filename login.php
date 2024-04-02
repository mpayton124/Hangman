<!DOCTYPE html>
<html>
<?php
   session_start();
   
   function usernameExists($username) {
    $filename = 'usernames.txt';
    $usernames = file($filename, FILE_IGNORE_NEW_LINES);
    return in_array($username, $usernames);
   }
	   
?>
<head>
<title>Login</title
</head>
<body>
<?php 
$username = $_POST["username"];

if (usernameExists($username)) {
	$_SESSION["username"] = $username;
	?> <p>Welcome back, <?php echo $_SESSION['username']; ?>. You can return home <a href = "index.php">here.</a></p> <?php 
} else {
	$filename = 'usernames.txt';
    file_put_contents($filename, $username . PHP_EOL, FILE_APPEND);
    $_SESSION["username"] = $username;
	?> <p>Welcome, <?php echo $_SESSION['username']; ?>. You can return home <a href = "index.php">here.</a></p> <?php
}
?>
</body>
</html>