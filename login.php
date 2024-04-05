<?php
    session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
   
   
   function usernameExists($usernameInput) {
    $filename = 'leaderboard_list.txt';
    $lines = file($filename, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        list($username, $points) = explode(",", $line);
        if ($usernameInput == $username) {
            return true;
        }
    }
    // return in_array($username, $usernames);
   }
	   
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
$username = $_POST["username"];

if (usernameExists($username)) {
	$_SESSION["username"] = $username;
	?> <p>Welcome back, <?php echo $_SESSION['username']; ?>. You can return home <a href = "index.php">here.</a></p> <?php 
} else {
	$filename = 'leaderboard_list.txt';
    file_put_contents($filename, "\n"."$username,0", FILE_APPEND);
    $_SESSION["username"] = $username;
	?> <p>Welcome, <?php echo $_SESSION['username']; ?>. You can return home <a href = "index.php">here.</a></p> <?php
}
?>
</body>
</html>