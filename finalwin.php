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
    <title>Document</title>
</head>
<body>
    <p>Game Over!</p>
	<p>You beat all 6 levels. Good work!</p>
    <form action = "index.php" method = "post">
        <button type = "submit">Main Menu</button>
    </form>
    <form action = "gamescreen.php" method = "post">
        <input type = "hidden" name = "difficulty" value = "easy">
        <button type = "submit">Play Again From Easy Level 1</button>
    </form>
</body>
</html>