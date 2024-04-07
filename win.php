<?php
session_start();

$_SESSION['progress']['totalwins'] = (($_SESSION['progress']['totalwins']) + 1);
if ($_SESSION['progress']['totalwins'] == 6) {
	header("Location: finalwin.php");
}


function updatePoints(){
    $lines = file("leaderboard_list.txt", FILE_IGNORE_NEW_LINES);


    if (isset($_SESSION['username'])){
        $loggedIn = true;
        $userToUpdate = $_SESSION['username'];
    }else{
        $loggedIn = false;
    }

    
    $pointsToAdd = 0;
    if ($_SESSION['progress']['difficulty'] == "easy"){
        $pointsToAdd = 1;
    }else if ($_SESSION['progress']['difficulty'] == "medium"){
        $pointsToAdd = 3;
    }else{
        $pointsToAdd = 5;
    }
    if ($loggedIn){
    foreach ($lines as &$line) {
   
        list($username, $points) = explode(",", $line);
        if ($username == $userToUpdate) {        
            $points = $points + $pointsToAdd;
			$line = "$username,$points";
        }
    }
    
    file_put_contents("leaderboard_list.txt", implode("\r\n", $lines));
    print"You have earned $pointsToAdd points.";
    }
    else{
        print"<p>You are not logged in, so you cannot earn points! :(</p>
        <a href = 'login.html'><p>Log in or sign up to earn and save your points!</p></a>";
    }
    
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
        // finalWinScreen();
		$num = (($_SESSION['progress']['level']) + 1);
    }
}else
{
   
    $num = (($_SESSION['progress']['level'])+1);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You Won!</title>
	<link rel="stylesheet" href="winloss.css">
	<style>
	body {
            background-image: url('win.png');
            background-size: cover;
        }
	</style>
</head>
<body>
    <div style="height:50%">
        <?php
        echo "<h2>Congrats! </h2><br><h3>Word: " . $_SESSION['word'] . "</h3>";
        updatePoints();
        ?>

        <!-- going back to main menu: -->
        <h2>You can head home here...</h2>
        <form action = "index.php" method = "post">
            <button type = "submit">Main Menu</button>
        </form>

        <h2> Or continue on!</h2>
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

        <h2> More of <?php $difficulty ?> levels </h2>
        <form action = "gamescreen.php" method = "post">
                    <?php
                    echo "<input type = 'hidden' name = 'difficulty' value = $difficulty>";
                    echo "<button type = 'submit'>Play more From $difficulty </button>";
                    ?>
            </form>

    </div>
</body>
</html>