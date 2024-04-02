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
<h1>YOU LOST!</h1>
<p>You almost had it...the word was: <?php print $_SESSION['word'] ?>.</p>
<!-- logic for incrementing the level + other bits go here - will add tomorrow-->
<p><a href = "gamescreen.php">Continue on!</a></p>
<p><a href = "index.php">Go home</a><p>    
</body>
</html>