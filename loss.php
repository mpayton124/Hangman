<?php
session_start();
unset($_SESSION['progress']['level']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    YOU LOST!
    could do something similar to the win screen, reusing buttons etc.
    <!-- going back to main menu: -->
<form action = "index.php" method = "post">
    <button type = "submit">Main Menu</button>
    <p>add thing that lets them go back to main menu</p>
    
</body>
</html>