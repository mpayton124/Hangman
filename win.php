<!DOCTYPE html>
<html lang="en">
<?php
   session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>YOU WON!</h1>
<p>Congratulations, <?php print $_SESSION['username'] ?>! You did good and successfully guessed the word: <?php print $_SESSION['word'] ?>.</p>
<!-- logic for incrementing the level + other bits go here - will add tomorrow-->
<p><a href = "gamescreen.php">Continue on!</a></p>
<p><a href = "index.php">Go home</a><p>
</body>
</html>