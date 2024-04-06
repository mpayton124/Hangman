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
    <title>YOU WON!</title>
	<link rel="stylesheet" href="winloss.css">
	<style>
	body {
            background-image: url('finalwin.png');
            background-size: cover;
        }
	</style>
</head>
<body>
    <div>
        <h1>YOU WON!</h1>
        <p>You are a hangman expert!</p>
        <?php
        echo "<h2>Word: " . $_SESSION['word'] . "</h2>";
        ?>
        <form action = "index.php" method = "post">
            <button type = "submit">Main Menu</button>
        </form>
        <br>
        <form action = "gamescreen.php" method = "post">
            <input type = "hidden" name = "difficulty" value = "easy">
            <button type = "submit">Play Again From Easy Level 1</button>
        </form>
        
    </div>
</body>
</html>