<?php
session_start();
var_dump($_SESSION);

if ($_SESSION['progress']['level'] == 6) {
	header("Location: finalwin.php");
}


function updatePoints(){
    $lines = file("leaderboard_list.txt", FILE_IGNORE_NEW_LINES);
 
    $userToUpdate = $_SESSION['username'];
    $pointsToAdd = 0;
    if ($_SESSION['progress']['difficulty'] == "easy"){
        $pointsToAdd = 1;
    }else if ($_SESSION['progress']['difficulty'] == "medium"){
        $pointsToAdd = 3;
    }else{
        $pointsToAdd = 5;
    }

    foreach ($lines as &$line) {
   
        list($username, $points) = explode(",", $line);
        if ($username == $userToUpdate) {        
            $points = $points + $pointsToAdd;
        }
        $line = "$username,$points";
    }
    
    file_put_contents("leaderboard_list.txt", implode("\r\n", $lines));
    
    print"Points updated for $userToUpdate. Added $pointsToAdd points.";
    
}
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
        // unset($_SESSION['progress']['level']);
        $num =1;
    }else if ($_SESSION['progress']['difficulty'] == "medium"){
        $path_difficulty = "hard";
        // unset($_SESSION['progress']['level']);
        $num =1;
    }else{
        // level must be at hard, and we can't go any higher
        finalWinScreen();
    }
}else
{
    print"test";
    $num = (($_SESSION['progress']['level'])+1);
    print $num;
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
 updatePoints();
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
 
        if ($path_difficulty == $_SESSION['progress']['difficulty']){
            echo "<input type = 'hidden' name = 'difficulty_path_same' value = $path_difficulty>";
            echo "<button type = 'submit'>Continue to $path_difficulty $num</button>";
        }else{
            echo "<input type = 'hidden' name = 'difficulty_path' value = $path_difficulty>";

            echo "<button type = 'submit'>Continue to $path_difficulty $num</button>";
        }
       
    ?>

   

</form>
</body>
</html>