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
	<link rel="stylesheet" href="winloss.css">
	<style>
	body {
        background-image: url('images/lose.svg');
		background-size: cover;
        }
	</style>
</head>
<body>
    <div style="background-color:#cf5545; width: 30%;
    height: 20%;">
        <h1>YOU LOST!</h1>
        <?php
        echo "<h2>Word: " . $_SESSION['word'] . "</h2>";
        ?>
        <!-- going back to main menu: -->
        <form action = "index.php" method = "post">
        <button type = "submit">Main Menu</button>
    </div>
    
</body>
</html>