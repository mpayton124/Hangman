<?php
session_start();
unset($_SESSION['progress']['level']);
unset($_SESSION['progress']['difficulty']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You Lost...</title>
</head>
<body>
    <p>YOU LOST!</p>
	<p>Better luck next time...</p>
    <!-- going back to main menu: -->
	<form action = "index.php" method = "post">
    <button type = "submit">Main Menu</button>
    
</body>
</html>