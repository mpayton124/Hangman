<?php
session_start();

function finalWinScreen(){
    //go to winning screen
    header("Location: finalwin.php");
    exit();
}
$path_difficulty = $_SESSION['progress']['difficulty'];
$difficulty = $_SESSION['progress']['difficulty'];
if ($_SESSION['progress']['level'] >= 3){
    if ($_SESSION['progress']['difficulty'] == "easy"){
        $path_difficulty = "medium";
        unset($_SESSION['progress']['level']);
        $num =1;
    }else if ($_SESSION['progress']['difficulty'] == "medium"){
        $path_difficulty = "hard";
        unset($_SESSION['progress']['level']);
        $num =1;
    }else{
        // level must be at hard, and we can't go any higher
        finalWinScreen();
    }
}else
{
    
    $num = ($_SESSION['progress']['level']+1);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
 echo "<h2>YOU WON!</h2><br><p>Word: " . $_SESSION['word'] . "</p>";
?>

<!-- going back to main menu: -->
<h2> Main Menu </h2>
<form action = "index.php" method = "post">
    <button type = "submit">Main Menu</button>
</form>
<h2> More of <?php $path_difficulty ?> levels </h2>
<form action = "gamescreen.php" method = "post">
            <?php
            echo "<input type = 'hidden' name = 'difficulty' value = $difficulty>";
            echo "<button type = 'submit'>Play more From $difficulty </button>";
            ?>
	</form>
<h2> Or continue Path! </h2>
<form action = "gamescreen.php" method = "post">
    <?php
 
        
        echo "<input type = 'hidden' name = 'difficulty' value = $path_difficulty>";

        echo "<button type = 'submit'>Continue to $path_difficulty $num</button>"
    ?>

   

</form>

<p>also showing them the full word that they got correct</p>
</body>
</html>